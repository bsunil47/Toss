<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends My_Controller {
	
	//private $redirecturl;
	 private $view_dir;
public function __construct(){
	
	
	 parent::__construct();
          $this->view_dir = $this->router->fetch_class() . '/' . $this->router->fetch_method();
	 $allowed_methodes = array('index');
	 $contlr=$this->uri->segment(1);
	 
	 $fnctn=$this->uri->segment(2);
	 
		if (!in_array($this->router->fetch_method(),$allowed_methodes) && !$this->_is_home_logged_in()) {

            redirect(base_url());
        }
	
	
	 $this->load->model("admin_common_model");
	
	 

	 }

public function adduser(){
	$data=array();
	$this->load->library("form_validation");
	$this->form_validation->set_rules('uname','Name','required|trim');
	$this->form_validation->set_rules('u_email','Email','required|trim|valid_email|is_unique[tbl_users.email]');
	$this->form_validation->set_rules('u_passw','Password','required|trim');
	$this->form_validation->set_rules('gender','Gender','required|trim');
	$this->form_validation->set_message('required','%s should not be empty');
	$this->form_validation->set_message('valid_email','%s should be a valid email');
	$this->form_validation->set_message('is_unique','You have Already registered with us');
	if(isset($_POST['usersubmit'])){
			if($this->form_validation->run('add_user')==FALSE){
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		}
		else{			
			$userdata=array("name"=>$this->input->post('uname'),"email"=>$this->input->post('u_email'),"password"=>md5($this->input->post('u_passw')),"gender"=>$this->input->post('gender'),"phone"=>$this->input->post('u_phone'));
			$this->common_model->initialise("users");
			$this->common_model->array=$userdata;
			$userid=$this->common_model->insert_entry();
			$datausertype=array("user_id"=>$userid,"user_type"=>1);
			$this->common_model->initialise("user_types");
			$this->common_model->array=$datausertype;
			$insertusertype=$this->common_model->insert_entry();
			$target_dir="images/profiles";
			$targetfile=$target_dir."/"."{$userid}_user".".jpg";
			$userdata['profile_pic']="{$userid}_user".".jpg";
			$this->updatedetails($userdata,"users",$userid);
			move_uploaded_file($_FILES['profile_pic']['tmp_name'],$targetfile);
			if(isset($insertusertype)){
			$this->session->set_flashdata("add_user_success","You Have Added User Successfully");
			redirect(base_url("users/manageadminusers"));
			}
		}
		}
        $this->layout->view($this->view_dir,$data);
	}

public function edituserinfo($userid){
	$this->common_model->initialise("users as U");
	$this->common_model->join_tables=array("user_types as Ut");
	$this->common_model->join_on=array("U.user_id=Ut.user_id");
	$data['edituserdetails']=$this->common_model->get_record_single("U.user_id = '$userid'","*");
	$this->layout->view($this->view_dir,$data);
}
private function updatedetails($data,$table,$id){
	if($table=="users"){
		
		$this->common_model->initialise('users');
		$where="user_id = '$id'";
	} 
	$this->common_model->array=$data;
	$update=$this->common_model->update($where);
	if($update==false){
		return true;
	}else return false;
}	 
public function appuserslist(){
	$aColumns = array('U.user_id','U.name','U.email','U.phone','U.status','Ut.user_id','Ut.user_type');
	//echo "<pre>";print_r($aColumns);exit;
	$this->common_model->initialise("users as U");
	
	$this->common_model->join_tables=array("user_types as Ut");
	$this->common_model->join_on=array("U.user_id=Ut.user_id");
	$this->common_model->left_join = array('left');
	$where=array("Ut.user_type" => 5);
	$data=$this->common_model->getTable($aColumns,$where,'U.user_id');
	//echo "<pre>";print_r($data);
	$output=$data['output'];
	$count=0;
	$i=$this->input->get_post('iDisplayStart')+1;
	foreach($data['result'] as $aRow){
		//print_r($aRow);
		//echo "<pre>";print_r($data['result']);exit;
		if($aRow['user_type']==5){
			$count++;
			$row=array();
			unset($aColumns[5]);
			foreach($aColumns as $col){
				$col=trim($col,'U.');
				$col=trim($col,'Ut.');
				$row[]=$aRow[$col];
			}
			$row[0]=$i;
			$i=$i+1;
			$status=$aRow['status'];
			if($status ==1){
				$statusn="<i class='fa fa-check' title='Active'></i>";
				$link='<a href="'.base_url().'users/updatestatus/'.$aRow['user_id'].'/'.$aRow["status"].'/'.$aRow['user_type'].'" style="color:black;margin-right:5px;"><i class="fa fa-remove" title="Inactive"></i></a>';
			}else if($status==0 || $status=='' || $status=='NULL'){
				$statusn="<i class='fa fa-remove' title='Inactive'></i>";
				$link='<a href="'.base_url().'users/updatestatus/'.$aRow['user_id'].'/'.$aRow["status"].'/'.$aRow['user_type'].'" style="color:black;margin-right:5px;"><i class="fa fa-check" title="Active"></i></a>';
			}
			$row[4]=$statusn;
			$row[5]=$link.'<a href="'.base_url().'users/viewappuserinfo/'.$aRow['user_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-eye" title="View"></i></a>';
			
			//echo "<pre>";print_r($row);exit;
			$output['aaData'][]=$row;
		}
		
	}
	
	if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
		echo json_encode($output);
	
}
public function manageappusers(){
	
	$data=array();
	$this->layout->view($this->view_dir);
}
public function viewappuserinfo($userid){
	$this->common_model->initialise("users");
	$data['viewappuser']=$this->common_model->get_record_single("user_id = '$userid'","*");
	$this->layout->view($this->view_dir,$data);
    }

public function adminuserslist(){
	$aColumns = array('U.user_id','U.name','U.email','U.phone','U.status','Ut.user_id','Ut.user_type');
	//echo "<pre>";print_r($aColumns);exit;
	$this->common_model->initialise("users as U");
	
	$this->common_model->join_tables=array("user_types as Ut");
	$this->common_model->join_on=array("U.user_id=Ut.user_id");
	$this->common_model->left_join = array('left');
	$where=array("Ut.user_type" => 1);
	$data=$this->common_model->getTable($aColumns,$where,'U.user_id');
	//echo "<pre>";print_r($data);
	$output=$data['output'];
	$count=0;
	$i=$this->input->get_post('iDisplayStart')+1;
	foreach($data['result'] as $aRow){
		//print_r($aRow);
		//echo "<pre>";print_r($data['result']);exit;
		if($aRow['user_type']==1){
			$count++;
			$row=array();
			unset($aColumns[5]);
			foreach($aColumns as $col){
				$col=trim($col,'U.');
				$col=trim($col,'Ut.');
				$row[]=$aRow[$col];
			}
			$row[0]=$i;
			$i=$i+1;
			$status=$aRow['status'];
			if($status ==1){
				$statusn="<i class='fa fa-check' title='Active'></i>";
				$link='<a href="'.base_url().'users/updatestatus/'.$aRow['user_id'].'/'.$aRow["status"].'/'.$aRow['user_type'].'" style="color:black;margin-right:5px;"><i class="fa fa-remove" title="Inactive"></i></a>';
			}else if($status==0 || $status='' || $status='NULL'){
				$statusn="<i class='fa fa-remove' title='Inactive'></i>";
				$link='<a href="'.base_url().'users/updatestatus/'.$aRow['user_id'].'/'.$aRow["status"].'/'.$aRow['user_type'].'" style="color:black;margin-right:5px;"><i class="fa fa-check" title="Active"></i></a>';
			}
			$row[4]=$statusn;
			$row[5]=$link.'<a href="'.base_url().'users/viewadminuserinfo/'.$aRow['user_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-eye" title="view"></i></a>';
			
			//echo "<pre>";print_r($row);exit;
			$output['aaData'][]=$row;
		}
		
	}
	
	if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
		echo json_encode($output);
	
}
public function viewadminuserinfo($adminuserid){
	$this->common_model->initialise("users");
	$data['viewadminuser']=$this->common_model->get_record_single("user_id = '$adminuserid'","*");
	$this->layout->view($this->view_dir,$data);
    }
public function manageadminusers(){
	$data=array();
	$this->layout->view($this->view_dir);
        }
public function updatestatus($id,$status,$usertype){
	
	if($status == 1){
		
		$statusnew = 0;
	}
	if($status == 0 || $status == '' || $status == "NULL"){
		
		$statusnew = 1;
	}
	
	$datastatus=$statusnew;
if($usertype == 5){
	$this->common_model->initialise("users");
	$this->common_model->status=$datastatus;
	$where=array("user_id"=>$id);
	$this->common_model->set_status($where);
	redirect(base_url("users/manageappusers"));
	}
	if($usertype == 1){
	$this->common_model->initialise("users");
	$this->common_model->status=$datastatus;
	$where=array("user_id"=>$id);
	$this->common_model->set_status($where);
	redirect(base_url("users/manageadminusers"));
	}
}
}
?>