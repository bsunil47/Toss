<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Venues extends My_Controller {
	
	//private $redirecturl;
	
public function __construct(){
	
	
	 parent::__construct();
	 $allowed_methodes = array('index');
	 $contlr=$this->uri->segment(1);
	 
	 $fnctn=$this->uri->segment(2);
	 
		if (!in_array($this->router->fetch_method(),$allowed_methodes) && !$this->_is_home_logged_in()) {

            redirect(base_url());
        }
	
	
	 $this->load->model("admin_common_model");
	
	 
}
public function dashboard(){
	$data=array();
	$this->common_model->initialise('user_types');
	$select = "COUNT(user_type) as countall";
	$data['staffusers']=$this->common_model->get_record_single(array("user_type"=>4),$select);
	$this->load->view("venues/landingpage",$data);
}
public function index(){
$data = array();

$this->load->view("index",$data);
}
//for status
public function updatestatus($id,$status,$usertype){
	if($status == 1){
		$statusnew = 0;
	}
	if($status == 0 || $status == '' || $status == "NULL"){
		$statusnew = 1;
	}
	$datastatus=$statusnew;
	if($usertype == 1){
	$venueid=$this->getvenueid();
	$where=array("facility_id"=>$id,"venue_id"=>$venueid);
	$this->statusupdate('venue_facilities',$datastatus,$where,'managefacilities');
	}
	if($usertype == 2){
	$where=array("price_id"=>$id);
	$this->statusupdate('prices',$datastatus,$where,'managepricing');
	}
	if($usertype == 3){
	$where=array("user_id"=>$id);
	$this->statusupdate('users',$datastatus,$where,'managestaff');
	}
	if($usertype == 4){
	$where=array("slot_id"=>$id);
	$this->statusupdate('time_slots',$datastatus,$where,'manageslots');
	}
}
private function statusupdate($table,$datastatus,$where,$page){
	$this->common_model->initialise($table);
	$this->common_model->status=$datastatus;
	$this->common_model->set_status($where);
	redirect(base_url("venues/$page"));
}

//for facilities
public function managefacilities(){
	$data=array();
	$this->common_model->initialise("facilities as F");
	$this->common_model->join_tables = array("venue_facilities as VF","venue_users as VU");
	$this->common_model->join_on = array("F.facility_id = VF.facility_id","VF.venue_id = VU.venue_id");
	$groupby="VF.facility_id";
	$where=array("VU.user_id" => $this->session->userdata('user_id'));
	$data['getallfacilities']=$this->common_model->get_records(0,"F.*,VF.status as facilitystatus,F.facility_id as facid",$where,$col = 0, $order = 'desc',$groupby);
	$this->load->view("venues/manage_facilities",$data);
}

public function addfacility(){
    $data=array();
	$this->common_model->initialise('facilities');
	$data['facilities']=$this->common_model->get_records(0,"*","");
    if(isset($_POST['faclsubmit'])){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("facility","Facility Name","required");
		$this->form_validation->set_message("required","%s Should not be Empty");
	
	if($this->form_validation->run("add_facility")==FALSE){
		$this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
	}else{
		$venueid=$this->getvenueid();
		$this->common_model->initialise('venue_facilities');
		$facarr=$_POST['facility'];
		for($i=0;$i<count($facarr);$i++){
             $facdata=array('venue_id' => $venueid,'facility_id'=>$facarr[$i],'status'=>1);
			  $this->common_model->array=$facdata;
			  $fid=$this->common_model->insert_entry();
		}
		//print_r($facdata);exit;
               if(isset($fid)){
                    $this->session->set_flashdata("facility_success","You Have Added Facility Successfully");
					redirect(base_url("venues/managefacilities"));
                }              
	}
	}
	$this->load->view('venues/add_facilities',$data);
    }
public function editfacilityinfo($facility_id){
	$data=array();
	$this->common_model->initialise("facilities");
	$select = "*";
	$where = "facility_id = ".$facility_id;
	$data['editfacilities']=$this->common_model->get_record_single($where,$select);
	$this->load->view("venues/edit_facility",$data);
	
}
public function editfacilitydetails(){
	$facility_id=$this->input->post('facilityid');
	$facilitydata=array("facility_name"=>$this->input->post('faclty_name'),	);
	if(isset($_FILES['facility_image'])){
	$target_dir="images/facilities";
	$targetfile=$target_dir."/"."{$facility_id}_facility".".jpg";
	$facilitydata['facility_image']="{$facility_id}_facility".".jpg";
	$updatefacility=$this->updatedetails($facilitydata,"facilities",$facility_id);
	move_uploaded_file($_FILES['facility_image']['tmp_name'],$targetfile);
	}else{
	$this->common_model->initialise("facilities");
	$this->common_model->array=$facilitydata;
	$where="facility_id = ".$facility_id;
	$updatefacility=$this->common_model->update($where);
	}
	if($updatefacility){
	$this->session->set_flashdata("facility_success","You Have Updated Facility Successfully");
	redirect(base_url("venues/managefacilities", 'refresh'));
	}
	
}
public function viewfacilities($id){
    $this->common_model->initialise('facilities');
    $select="facility_name,facility_image";
    $where="facility_id = ".$id;
    $data['getdetails']=$this->common_model->get_record_single($where,$select);
  $this->load->view("venues/viewfacilities",$data);
}

//Manage Pricing start
public function managepricing(){
    $data=array();
    $this->load->view("venues/pricing");
}
public function viewprice($id){
    $this->common_model->initialise('prices as P');
    $this->common_model->join_tables=array('venues as V','membership_types as M','categories as C','sub_categories as S','facilities as F','sub_sub_categories as SS','vendor as VD');
    $this->common_model->join_on=array("P.venue_id = V.venue_id","P.base_type_id = M.membership_type_id","P.base_type_id = C.category_id","P.base_type_id = S.sub_category_id","P.base_type_id = F.facility_id","P.base_type_id = SS.sub_sub_category_id","V.vendor_id = VD.vendor_id" );
    $select="P.*,VD.company_name,V.venue_display_name,M.membership_name,C.category_name,S.sub_category_name,F.facility_name,SS.sub_sub_category_name";
    $where="P.price_id = ".$id;
    $this->common_model->left_join = array('left','left','left','left','left','left','left');
    $data['getdetails']=$this->common_model->get_record_single($where,$select);
  $this->load->view("venues/viewprice",$data);
}
public function addpricing(){
  $data=array();
 $this->common_model->initialise('vendor');
 $data['vendordetails']=$this->common_model->get_records(0,'*','');
 
 $this->common_model->initialise('venues as V');
 $this->common_model->join_tables = array("venue_users as VU");
 $this->common_model->join_on = array("V.venue_id = VU.venue_id");
 $where=array("VU.user_id" => $this->session->userdata('user_id'));
 $data['venuedetails']=$this->common_model->get_records(0,'*',$where);
   $this->load->library("form_validation");
	//$this->form_validation->set_rules('vendors','Vendor name','required|trim|min_length[4]');
	$this->form_validation->set_rules('ptype','Price Type','required|trim');
	$this->form_validation->set_rules('type','Type','required|trim');
	//$this->form_validation->set_rules('vendor','Vendor','required|trim');
	$this->form_validation->set_rules('venue','Venue','required|trim');
	$this->form_validation->set_rules('amount','Amount','required');
	$this->form_validation->set_rules('damount','Discount','required|trim');
	if(isset($_POST['usersubmit'])){
		
		if($this->form_validation->run('add_user')==FALSE){ //echo "test";
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		}
		else{
                    $this->common_model->initialise('prices');
                    $this->common_model->array=array('price_type'=>$this->input->post('ptype'),'venue_id'=>$this->input->post('venue'),'base_type_id'=>$this->input->post('type'),'amount'=>$this->input->post('amount'),'discount_type'=>2,'discount_amount'=>$this->input->post('damount'));
                    $id=$this->common_model->insert_entry();
                    if(isset($id)){
                        $this->session->set_flashdata("success","You Have Added Pricing Successfully");
			redirect(base_url("venues/managepricing"));
                    }
                }
                }
  $this->load->view("venues/addprice", $data);
}
public function editprice($id){
    $data=array();
    $this->common_model->initialise('membership_types');
    $data['membershiptype']=$this->common_model->get_records(0,'*','');
  	$data['categories']=$this->getvcategories();
   	$data['subcategories']=$this->getcsubcategories();
	$this->common_model->initialise("facilities as F");
	$this->common_model->join_tables = array("venue_facilities as VF","venue_users as VU");
	$this->common_model->join_on = array("F.facility_id = VF.facility_id","VF.venue_id = VU.venue_id");
	$groupby="VF.facility_id";
	$where=array("VU.user_id" => $this->session->userdata('user_id'));
	$data['facilities']=$this->common_model->get_records(0,"F.*,F.status as facilitystatus,F.facility_id as facid",$where,$col = 0, $order = 'desc',$groupby);
	
    //$this->common_model->initialise('vendor');
    //$data['vendordetails']=$this->common_model->get_records(0,'*','');
    
	$this->common_model->initialise('prices as P');
    $this->common_model->join_tables=array('venues as V','membership_types as M','categories as C','sub_categories as S','facilities as F','venue_users as VU');
    $this->common_model->join_on=array("P.venue_id = V.venue_id","P.base_type_id = M.membership_type_id","P.base_type_id = C.category_id","P.base_type_id = S.sub_category_id","P.base_type_id = F.facility_id","V.venue_id = VU.venue_id" );
	$this->common_model->left_join = array('left','left','left','left','left','left');
    $select="P.*,V.venue_id,V.venue_display_name,M.membership_type_id,M.membership_name,C.category_id,C.category_name,S.sub_category_id,S.sub_category_name,F.facility_id,F.facility_name";
    $where="P.price_id = ".$id;
    $data['getdetails']=$this->common_model->get_record_single($where,$select);
    $this->common_model->initialise('venues');
    $data['venues']=$this->common_model->get_records(0,'*',"venue_id = '".$data['getdetails']->venue_id."'");
   if(isset($_POST['usersubmit'])){
		    $this->common_model->initialise('prices');
                    $this->common_model->array=array('price_type'=>$this->input->post('ptype'),'venue_id'=>$this->input->post('venue'),'base_type_id'=>$this->input->post('type'),'amount'=>$this->input->post('amount'),'discount_type'=>2,'discount_amount'=>$this->input->post('damount'));
                    $where="price_id = ".$id;
                    $update=$this->common_model->update($where);
                    if($update==false){
                        $this->session->set_flashdata("success","You Have Modified Pricing Successfully");
			redirect(base_url("venues/managepricing"));
                    }
                }
    $this->load->view("venues/editpricing",$data);
}
public function getPData(){
    $aColumns = array('P.price_id','V.venue_display_name','P.price_type','P.amount','P.status','M.membership_name','C.category_name','S.sub_category_name','F.facility_name','SS.sub_sub_category_name');
	$this->common_model->initialise("prices as P");
	$this->common_model->join_tables = array("venues as V","venue_users as VU","membership_types as M","categories as C","sub_categories as S","facilities as F","sub_sub_categories as SS");
	$this->common_model->join_on = array("P.venue_id = V.venue_id","V.venue_id=VU.venue_id","P.base_type_id = M.membership_type_id","P.base_type_id = C.category_id","P.base_type_id = S.sub_category_id","P.base_type_id = F.facility_id","P.base_type_id = SS.sub_sub_category_id");
	$this->common_model->left_join = array('left','left','left','left','left','left','left');
	$where=array("VU.user_id" => $this->session->userdata('user_id'));
	$data=$this->common_model->getTable($aColumns,$where,'P.price_id');
	$output=$data['output'];
	$count=0;
	$i=$this->input->get_post('iDisplayStart')+1;
	foreach($data['result'] as $aRow){
		$count++;
		$row=array();
		foreach($aColumns as $col){
				$col=trim($col,'P.');
				$col=trim($col,'V.');
				$col=trim($col,'M.');
				$col=trim($col,'C.');
				$col=trim($col,'S.');
				$col=trim($col,'F.');
				$col=trim($col,'SS');
				$col=trim($col,'VU.');
				
            $row[]=$aRow[$col];
			}
			$row[0]=$i;
			$i=$i+1;
                        $row[1]=$aRow['venue_display_name'];
                        if($aRow['price_type']==1){
                            $price="Membership";
							$pricename=$aRow['membership_name'];
                        }else if($aRow['price_type']==2){
                            $price="Category";
							$pricename=$aRow['category_name'];
                        }else if($aRow['price_type']==3){
                            $price="Subcategory";
							$pricename=$aRow['sub_category_name'];
                        }else if($aRow['price_type']==4){
                            $price="Facility";
							$pricename=$aRow['facility_name'];
                        }else if($aRow['price_type']==5){
							$price="Sub Subcatagory";
							$pricename=$aRow['sub_sub_category_name'];
							//$pricename='test';
						}
                        $row[2]=$pricename;
						$row[3]=$price;
						$row[4]=$aRow['amount'];
			$status=$aRow['status'];
			if($status ==1){
				$statusn="<i class='fa fa-check' title='Active'></i>";
				$link='<a href="'.base_url().'venues/updatestatus/'.$aRow['price_id'].'/'.$aRow["status"].'/2" style="color:black;margin-right:5px;"><i class="fa fa-remove" title="Inactive"></i></a>';
			}else if($status == 0 || $status == '' || $status == 'NULL'){
				$statusn="<i class='fa fa-remove' title='Inactive'></i>";
				$link='<a href="'.base_url().'venues/updatestatus/'.$aRow['price_id'].'/'.$aRow["status"].'/2" style="color:black;margin-right:5px;"><i class="fa fa-check" title="Active"></i></a>';
			}
			$row[5]=$statusn;
			$row[6]=$link.'<a href="'.base_url().'venues/viewprice/'.$aRow['price_id'].'" style="color:black"><i class="fa fa-eye" title="View"></i></a>&nbsp;&nbsp;<a href="'.base_url().'venues/editprice/'.$aRow['price_id'].'" style="color:black"><i class="fa fa-pencil" title="Edit"></i></a>';
			$output['aaData'][]=$row;
			}
	if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
		echo json_encode($output);
} 


// for staff start
public function managestaff(){
	
	$data=array();
	
	$this->load->view("venues/manage_staff",$data);
}
public function viewvenue(){
    $this->common_model->initialise('users');
    $select="name,email,phone,gender,profile_pic,status,created_on";
    $where="user_id = ".$this->session->userdata('user_id');
    $data['getstaffdetails']=$this->common_model->get_record_single($where,$select);
  $this->load->view("venues/view_venue",$data);
}
public function editvenueinfo(){
	$this->common_model->initialise("users as U");
	$this->common_model->join_tables=array("user_types as Ut");
	$this->common_model->join_on=array("U.user_id=Ut.user_id");
	$select="*";
	$where="U.user_id = ".$this->session->userdata('user_id');
	$data['edituserdetails']=$this->common_model->get_record_single($where,$select);
	$this->load->view("venues/edit_venue",$data);
}
public function editvenuedetails(){
			$userid=$this->session->userdata('user_id');
			$userdata=array(
			"name"=>$this->input->post('uname'),
			"email"=>$this->input->post('u_email'),
			"gender"=>$this->input->post('gender'),
			"phone"=>$this->input->post('u_phone')
			);
			$this->common_model->initialise("users");
			$this->common_model->array=$userdata;
			$where="user_id = ".$userid;
			$updateuser=$this->common_model->update($where);
			
			$target_dir="images/profiles";
			$targetfile=$target_dir."/"."{$userid}_user".".jpg";
			$userdata['profile_pic']="{$userid}_user".".jpg";
			$this->updatedetails($userdata,"users",$userid);
			$updatesuccess=move_uploaded_file($_FILES['profile_pic']['tmp_name'],$targetfile);
			if(isset($updatesuccess)){
			$this->session->set_flashdata("update_user_success","Details Updated Successfully");
			redirect(base_url("venues/editvenueinfo"));	
			}	
}

public function viewstaff($id){
    $this->common_model->initialise('users');
    $select="name,email,phone,gender,profile_pic,status,created_on";
    $where="user_id = ".$id;
    $data['getstaffdetails']=$this->common_model->get_record_single($where,$select);
  $this->load->view("venues/view_staff",$data);
}
public function addstaff(){
	$data=array();
	
	$this->load->library("form_validation");
	$this->form_validation->set_rules('uname','Name','required|trim');
	$this->form_validation->set_rules('u_email','Email','required|trim|valid_email|is_unique[tbl_users.email]');
	$this->form_validation->set_rules('u_passw','Password','required|trim');
	$this->form_validation->set_rules('gender','Gender','required|trim');
	$this->form_validation->set_rules('u_phone','Phone','required|trim');
	
	$this->form_validation->set_message('required','%s should not be empty');
	$this->form_validation->set_message('valid_email','%s should be a valid email');
	$this->form_validation->set_message('is_unique','You have Already registered with us');
	
	if(isset($_POST['usersubmit'])){
		
		if($this->form_validation->run('add_staff')==FALSE){
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		}
		else{
			
			$userdata=array(
			"name"=>$this->input->post('uname'),
			"email"=>$this->input->post('u_email'),
			"password"=>md5($this->input->post('u_passw')),
			"gender"=>$this->input->post('gender'),
			"phone"=>$this->input->post('u_phone')
			);
			$this->common_model->initialise("users");
			$this->common_model->array=$userdata;
			$userid=$this->common_model->insert_entry();
			$datausertype=array("user_id" => $userid, "user_type" => 4);
			$this->common_model->initialise("user_types");
			$this->common_model->array=$datausertype;
			$insertusertype=$this->common_model->insert_entry();
			//$insertusertype=$this->db->insert("user_types",$datausertype);
			$target_dir="images/profiles";
			$targetfile=$target_dir."/"."{$userid}_user".".jpg";
			$userdata['profile_pic']="{$userid}_user".".jpg";
			$this->updatedetails($userdata,"users",$userid);
			move_uploaded_file($_FILES['profile_pic']['tmp_name'],$targetfile);
			
			if(isset($insertusertype)){
			$this->session->set_flashdata("update_user_success","You Have Added Staff Successfully");
			redirect(base_url("venues/managestaff"));
			}
		}
	
	}
	$this->load->view("venues/add_staff");
}
public function editstaffinfo($userid){
	$this->common_model->initialise("users as U");
	$this->common_model->join_tables=array("user_types as Ut");
	$this->common_model->join_on=array("U.user_id=Ut.user_id");
	$select="*";
	$where="U.user_id = ".$userid;
	$data['edituserdetails']=$this->common_model->get_record_single($where,$select);
	//echo "<pre>";print_r($data['edituserdetails']);exit;
	$this->load->view("venues/edit_staff",$data);
}

public function editstaffdetails(){
			$userid=$this->input->post('user_id');
			$userdata=array(
			"name"=>$this->input->post('uname'),
			"email"=>$this->input->post('u_email'),
			"gender"=>$this->input->post('gender'),
			"phone"=>$this->input->post('u_phone')
			);
			$this->common_model->initialise("users");
			$this->common_model->array=$userdata;
			$where="user_id = ".$userid;
			$updateuser=$this->common_model->update($where);
			
			$target_dir="images/profiles";
			$targetfile=$target_dir."/"."{$userid}_user".".jpg";
			$userdata['profile_pic']="{$userid}_user".".jpg";
			$this->updatedetails($userdata,"users",$userid);
			$updatesuccess=move_uploaded_file($_FILES['profile_pic']['tmp_name'],$targetfile);
			if(isset($updatesuccess)){
			$this->session->set_flashdata("update_user_success","You Have Updated Staff Successfully");
			redirect(base_url("venues/managestaff"));	
			}	
}

public function getData(){
    $aColumns = array('U.user_id','U.name','U.phone','U.email','U.status','UT.user_type');
	$this->common_model->initialise("users as U");
	$this->common_model->join_tables = array("user_types as UT");
	$this->common_model->join_on = array("U.user_id = UT.user_id");
	//$this->common_model->left_join = array('left');
	$where=array("UT.user_type" => 4);
	$data=$this->common_model->getTable($aColumns,$where,'U.user_id');
	$output=$data['output'];
	$count=0;
	$i=$this->input->get_post('iDisplayStart')+1;
	foreach($data['result'] as $aRow){
		$count++;
		$row=array();
		foreach($aColumns as $col){
				$col=trim($col,'U.');
				$col=trim($col,'UT.');
            $row[]=$aRow[$col];
			}
			$row[0]=$i;
			$i=$i+1;
                        $row[1]=$aRow['name'];
                        $row[2]=$aRow['email'];
						$row[3]=$aRow['phone'];
			$status=$aRow['status'];
			if($status ==1){
				$statusn="<i class='fa fa-check' title='Active'></i>";
				$link='<a href="'.base_url().'venues/updatestatus/'.$aRow['user_id'].'/'.$aRow["status"].'/3" style="color:black;margin-right:5px;"><i class="fa fa-remove" title="Inactive"></i></a>';
			}else if($status == 0 || $status == '' || $status == 'NULL'){
				$statusn="<i class='fa fa-remove' title='Inactive'></i>";
				$link='<a href="'.base_url().'venues/updatestatus/'.$aRow['user_id'].'/'.$aRow["status"].'/3" style="color:black;margin-right:5px;"><i class="fa fa-check" title="Active"></i></a>';
			}
			$row[4]=$statusn;
			$row[5]=$link.'<a href="'.base_url().'venues/viewstaff/'.$aRow['user_id'].'" style="color:black"><i class="fa fa-eye" title="View"></i></a>&nbsp;&nbsp;<a href="'.base_url().'venues/editstaffinfo/'.$aRow['user_id'].'" style="color:black"><i class="fa fa-pencil" title="Edit"></i></a>';
			$output['aaData'][]=$row;
			}
	if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
		echo json_encode($output);
}
//for slots
public function manageslots(){
	$data=array();
	$this->load->view("venues/manage_slots");
	
}

public function addslots(){
	$data=array();
    $data['getallcategories']=$this->getvcategories();
	$data['getallvenues']=$this->getvvenues();
	 
	if(isset($_POST['timeslotsubmit'])){
        $this->load->library("form_validation");
	$this->form_validation->set_rules("venue_id","Venue Name","required|trim");
	$this->form_validation->set_rules("cat_id","Category Name","required|trim");
	$this->form_validation->set_rules("subcat_id","Subcategory Name","required|trim");
	//$this->form_validation->set_rules("day_id","Day","required|trim");
	$this->form_validation->set_rules("frm_dte","From Time","required");
	$this->form_validation->set_rules("to_dte","To Time","required");
	$this->form_validation->set_rules("max_limit","Maximum Limit","required");
	$this->form_validation->set_message("required","%s Should not be Empty");
	if($this->form_validation->run("add_slots")==FALSE){
		$this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
	}else{
	$venueid=$this->input->post('venue_id');
	$categoryid=$this->input->post('cat_id');
	$subcategoryid=$this->input->post('subcat_id');
	//$dayid=$this->input->post('day_id');
	$slotfromtimes=$this->input->post('frm_dte');
	$slottotimes=$this->input->post('to_dte');
	$this->common_model->initialise('working_hours as W');
	$this->common_model->join_tables=array("venues as V","categories as C","venue_category as VC");
	$this->common_model->join_on=array("W.venue_id=V.venue_id","W.category_id=C.category_id","W.category_id=VC.category_id");
	$select="W.*,V.venue_id as venueid";
	$where="V.venue_id = '$venueid'";
	$getslots=$this->common_model->get_records(0,$select,$where,'','','W.day_id');
	/*$this->common_model->initialise("time_slots as TS");
	$this->common_model->join_tables=array("working_hours as W");
	$this->common_model->join_on=array("TS.day_id=W.day_id");
	$where="TS.day_id = '$dayid' AND TS.venue_id='$venueid' AND TS.category_id='$categoryid' AND TS.sub_category_id='$subcategoryid'";
	$getslotsdata=$this->common_model->get_records(0,"*",$where,'','',"TS.slot_id");*/
	$data=$getslots;
	//print_r($data);exit;
       	if(!empty($data)){
           $maxlimits=$this->input->post('max_limit');
			foreach($slotfromtimes as $keys=>$slotfromtime){
                if($slotfromtime >= $data[0]->start_time && $slottotimes[$keys] <= $data[0]->end_time){
			$this->common_model->initialise('time_slots');
			$wheree="category_id = '$categoryid' AND sub_category_id = '$subcategoryid' and slot_from_time between '$slotfromtime' AND '$slottotimes[$keys]' and slot_to_time between '$slotfromtime' AND '$slottotimes[$keys]'";
			$getslotsdata1=$this->common_model->get_record_single($wheree,"*");
			if(empty($getslotsdata1)){
				$slotdata=array("venue_id"=>$this->input->post('venue_id'),"slot_from_time"=>$slotfromtime,"slot_to_time"=>$slottotimes[$keys],"status"=>1,"created_by"=>$this->session->userdata['user_id'],"category_id"=>$this->input->post('cat_id'),"sub_category_id"=>$this->input->post('subcat_id'),"quantity"=>$maxlimits[$keys]);
				$inserttimeslot=$this->db->insert("tbl_time_slots",$slotdata);
				
			}else{
				$this->session->set_flashdata("error_slot","Slot Already Exists");
				redirect(base_url("venues/addslots"));
			}
		}else{
				$this->session->set_flashdata("error_slot_time","Slot Timings Should match the Working Hours");
				redirect(base_url("venues/addslots"));
		}
	}if($inserttimeslot){
					$this->session->set_flashdata("success_slot","Slot Added Successfully");
					redirect(base_url("venues/manageslots/$venueid"));
			}
	}
		}
	}
	
	$this->load->view("venues/add_slots",$data);
}

public function editslotinfo($slot_id){
	$data=array();
    $data['getallcategories']=$this->getvcategories();
	$data['getallvenues']=$this->getvvenues();
    $data['getallsubcategories']=$this->getcsubcategories();
	$this->common_model->initialise("time_slots as TS");
	$this->common_model->join_tables=array("venues as V","categories as C","sub_categories as S","working_hours as W");
	$this->common_model->join_on=array("TS.venue_id=V.venue_id","TS.category_id = C.category_id","TS.sub_category_id = S.sub_category_id","TS.day_id = W.day_id");
	$this->common_model->left_join=array("left","left","left","left","left","left");
	$where="slot_id = ".$slot_id;
	$select="TS.*,V.venue_display_name,C.category_name,S.sub_category_name";
	$data['editslotinfo']=$this->common_model->get_record_single($where,$select);
	$this->load->view("venues/edit_slot",$data);
	
}

public function editslotdetails(){
    $data=array();
    if(isset($_POST['timeslotsubmit'])){
        $this->load->library("form_validation");
	$this->form_validation->set_rules("venue_id","Venue Name","required|trim");
	$this->form_validation->set_rules("cat_id","Category Name","required|trim");
	$this->form_validation->set_rules("subcat_id","Subcategory Name","required|trim");
	//$this->form_validation->set_rules("day_id","Day","required|trim");
	$this->form_validation->set_rules("frm_dte","From Time","required");
	$this->form_validation->set_rules("to_dte","To Time","required");
	$this->form_validation->set_rules("max_limit","Maximum Limit","required");
	$this->form_validation->set_message("required","%s Should not be Empty");
	if($this->form_validation->run("add_slots") == FALSE){
		$this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
	}else{
	$venueid=$this->input->post('venue_id');
	$categoryid=$this->input->post('cat_id');
	$subcategoryid=$this->input->post('subcat_id');
	//$dayid=$this->input->post('day_id');
	$slotfromtime=$this->input->post('frm_dte');
	$slottotime=$this->input->post('to_dte');
        $slot_id=$this->input->post('slot_id');
	$this->common_model->initialise('working_hours as W');
	$this->common_model->join_tables=array("venues as V","categories as C","venue_category as VC");
	$this->common_model->join_on=array("W.venue_id=V.venue_id","W.category_id=C.category_id","W.category_id=VC.category_id");
	$select="W.*,V.venue_id as venueid";
        $where="V.venue_id = '$venueid'";
	$getslots=$this->common_model->get_records(0,$select,$where,'','','W.day_id');
	$data=$getslots;
       	if(!empty($data)){
           $maxlimits=$this->input->post('max_limit');
	 if($slotfromtime >= $data[0]->start_time && $slottotime <= $data[0]->end_time){
			$this->common_model->initialise('time_slots');
			$wheree="venue_id = '$venueid' AND category_id = '$categoryid' AND sub_category_id='$subcategoryid' and slot_from_time between '$slotfromtime' AND '$slottotime' and slot_to_time between '$slotfromtime' AND '$slottotime'";
			$getslotsdata1=$this->common_model->get_record_single($wheree,"*");
			if(empty($getslotsdata1)){
                                $this->common_model->initialise('time_slots');
                               $this->common_model->array=array("venue_id"=>$this->input->post('venue_id'),"slot_from_time"=>$slotfromtime,"slot_to_time"=>$slottotime,"status"=>1,"created_by"=>$this->session->userdata['user_id'],"category_id"=>$this->input->post('cat_id'),"sub_category_id"=>$this->input->post('subcat_id'),"quantity"=>$maxlimits);
				$inserttimeslot=$this->common_model->update("slot_id = '".$slot_id."'");
			}else{
				$this->session->set_flashdata("error_slot","Slot Already Exists");
				redirect(base_url("venues/editslotinfo/{$slot_id}"));
			}
		}else{
				$this->session->set_flashdata("error_slot_time","Slot Timings Should match the Working Hours");
				redirect(base_url("venues/editslotinfo/{$slot_id}"));
		}
	if($inserttimeslot==FALSE){
					$this->session->set_flashdata("success_slot","Slot Updated Successfully");
					redirect(base_url("venues/manageslots/$venueid"));
			}
	}
		}
	}
	}
	public function viewslotinfo($slot_id){
    $data=array();
        $this->common_model->initialise("time_slots as TS");
	$this->common_model->join_tables=array("venues as V","categories as C","sub_categories as S","working_hours as W");
	$this->common_model->join_on=array("TS.venue_id=V.venue_id","TS.category_id = C.category_id","TS.sub_category_id = S.sub_category_id","TS.day_id = W.day_id");
	$this->common_model->left_join=array("left","left","left","left","left","left");
	$where="slot_id = ".$slot_id;
	$select="TS.*,V.venue_display_name,C.category_name,S.sub_category_name";
	$data['editslotinfo']=$this->common_model->get_record_single($where,$select);
	$this->load->view("venues/view_slot",$data);
}
public function getSData(){
    $aColumns = array('T.slot_id','T.day_id','T.venue_id','T.slot_from_time','T.slot_to_time','T.status','V.venue_display_name');
	$this->common_model->initialise("time_slots as T");
	$this->common_model->join_tables = array("venue_users as UV","venues as V");
	$this->common_model->join_on = array("T.venue_id = UV.venue_id","T.venue_id=V.venue_id");
	$this->common_model->left_join = array('left');
	$where=array("UV.user_id" => $this->session->userdata('user_id'));
	$where='';
	$data=$this->common_model->getTable($aColumns,$where,'','','T.slot_id');
	$output=$data['output'];
	$count=0;
	$i=$this->input->get_post('iDisplayStart')+1;
	foreach($data['result'] as $aRow){
		$count++;
		$row=array();
		foreach($aColumns as $col){
				$col=trim($col,'T.');
				$col=trim($col,'UV.');
            $row[]=$aRow[$col];
			}
			$row[0]=$i;
			$i=$i+1;
				$row[1]=$aRow['venue_display_name'];
				//if($aRow['day_id']=='1'){$dayname='Monday';}elseif($aRow['day_id']=='2'){$dayname='Tuesday';}elseif($aRow['day_id']=='3'){$dayname='Wednesday';}elseif($aRow['day_id']=='4'){$dayname='Thursday';}elseif($aRow['day_id']=='5'){$dayname='Friday';}elseif($aRow['day_id']=='6'){$dayname='Saturday';}elseif($aRow['day_id']=='7'){$dayname='Sunday';}
				//$row[2]=$aRow['day_id'];
				//$row[2]=$dayname;
				$row[2]=$aRow['slot_from_time'];
				$row[3]=$aRow['slot_to_time'];
						
			$status=$aRow['status'];
			if($status ==1){
				$statusn="<i class='fa fa-check' title='Active'></i>";
				$link='<a href="'.base_url().'venues/updatestatus/'.$aRow['slot_id'].'/'.$aRow["status"].'/4" style="color:black;margin-right:5px;"><i class="fa fa-remove" title="Inactive"></i></a>';
			}else if($status == 0 || $status == '' || $status == 'NULL'){
				$statusn="<i class='fa fa-remove' title='Inactive'></i>";
				$link='<a href="'.base_url().'venues/updatestatus/'.$aRow['slot_id'].'/'.$aRow["status"].'/4" style="color:black;margin-right:5px;"><i class="fa fa-check" title="Active"></i></a>';
			}
			$row[4]=$statusn;
			$row[5]=$link.'<a href="'.base_url().'venues/viewslotinfo/'.$aRow['slot_id'].'" style="color:black"><i class="fa fa-eye" title="View"></i></a>&nbsp;&nbsp;<a href="'.base_url().'venues/editslotinfo/'.$aRow['slot_id'].'" style="color:black"><i class="fa fa-pencil" title="Edit"></i></a>'; 
			$output['aaData'][]=$row;
			}
	if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
		echo json_encode($output);
}

public function getmembership(){
  $this->common_model->initialise('membership_types');
  $membershiptype=$this->common_model->get_records(0,'*','');
  echo json_encode($membershiptype);
}
public function getcategories(){
    $this->common_model->initialise("categories as C");
	$this->common_model->join_tables = array("venue_category as VC","venue_users as VU");
	$this->common_model->join_on = array("C.category_id = VC.category_id","VC.venue_id = VU.venue_id");
	$groupby="VC.category_id";
	$where=array("VU.user_id" => $this->session->userdata('user_id'));
	$categories=$this->common_model->get_records(0,"C.*",$where,$col = 0, $order = 'desc',$groupby);
	echo json_encode($categories);
}
public function getsubcategories(){
    $this->common_model->initialise("sub_categories as SC");
	$this->common_model->join_tables = array("venue_sub_category as VSC","venue_users as VU");
	$this->common_model->join_on = array("SC.sub_category_id = VSC.sub_category_id","VSC.venue_id = VU.venue_id");
	$groupby="VSC.sub_category_id";
	$where=array("VU.user_id" => $this->session->userdata('user_id'));
	$subcategories=$this->common_model->get_records(0,"SC.*",$where,$col = 0, $order = 'desc',$groupby);
	echo json_encode($subcategories);
}
public function getsubsubcategories(){
    $this->common_model->initialise("sub_sub_categories as SC");
	$this->common_model->join_tables = array("venue_sub_sub_categories as VSC","venue_users as VU");
	$this->common_model->join_on = array("SC.sub_sub_category_id = VSC.sub_sub_category_id","VSC.venue_id = VU.venue_id");
	$groupby="VSC.sub_sub_category_id";
	$where=array("VU.user_id" => $this->session->userdata('user_id'));
	$subsubcategories=$this->common_model->get_records(0,"SC.*",$where,$col = 0, $order = 'desc',$groupby);
	echo json_encode($subsubcategories);
}
public function getfacilities(){
 	$this->common_model->initialise("facilities as F");
	$this->common_model->join_tables = array("venue_facilities as VF","venue_users as VU");
	$this->common_model->join_on = array("F.facility_id = VF.facility_id","VF.venue_id = VU.venue_id");
	$groupby="VF.facility_id";
	$where=array("VU.user_id" => $this->session->userdata('user_id'));
	//$facilities=$this->common_model->get_records(0,"F.*,F.status as facilitystatus,F.facility_id as facid",$where,$col = 0, $order = 'desc',$groupby);
	$facilities=$this->common_model->get_records(0,"F.*",$where,$col = 0, $order = 'desc',$groupby);
	echo json_encode($facilities);
}
public function search(){
	$id=$_GET['term'];
	$this->common_model->initialise('vendor');
	$where = "company_name LIKE '".$id."%'  ";
	$vendors=$this->common_model->get_records(0,'company_name',$where);
	foreach($vendors as $vendor){
		$data[] = $vendor->company_name;
	}
   	echo json_encode($data);
}



public function getvenues(){
	$id=$_POST['id'];
	/*$this->common_model->initialise('vendor');
	$where = "company_name = '".$id."' ";
	$result = $this->common_model->get_record_single($where, 'vendor_id');
	$venid=$result->vendor_id;*/
	//$venid=1;
    $this->common_model->initialise('venues');
	//$venues=$this->common_model->get_records(0,'*',"vendor_id = '".$venid."'");
	$venues=$this->common_model->get_records(0,'*',"vendor_id = '".$id."'");
     echo json_encode($venues);
}

private function updatedetails($data,$table,$id){
	if($table=="facilities"){
		$this->common_model->initialise('facilities');
		$where="facility_id = '$id'";
	}
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
//for slots
private function getvcategories(){
$this->common_model->initialise('venue_category as VC');
$this->common_model->join_tables=array('venues as V','categories as C','venue_users as VU');
$this->common_model->join_on=array("VC.venue_id = V.venue_id","VC.category_id = C.category_id","V.venue_id = VU.venue_id");
$cat=$this->common_model->get_records(0,'VC.*,C.category_name',"VU.user_id = '".$this->session->userdata('user_id')."'",'','',"VC.category_id");
return $cat;
}
private function getvvenues(){
$this->common_model->initialise('venues as V');
	 $this->common_model->join_tables = array("venue_users as VU");
	 $this->common_model->join_on = array("V.venue_id = VU.venue_id");
	 $where=array("VU.user_id" => $this->session->userdata('user_id'));
	 $venues=$this->common_model->get_records(0,'*',$where);
return $venues;
}
private function getcsubcategories(){
$this->common_model->initialise('venue_sub_category as VSC');
$this->common_model->join_tables=array('venues as V','sub_categories as SC','venue_users as VU');
$this->common_model->join_on=array('VSC.venue_id = V.venue_id','VSC.sub_category_id = SC.sub_category_id','V.venue_id=VU.venue_id');
$subcat=$this->common_model->get_records(0,'VSC.*,SC.sub_category_name',"VU.user_id = '".$this->session->userdata('user_id')."'",'','',"VSC.sub_category_id");

return $subcat;
}	
public function venuechange(){
$venueid=$this->input->post('venueid');
$this->common_model->initialise("venues as V");
$this->common_model->join_tables=array("venue_category as VC","categories as C");
$this->common_model->join_on=array("V.venue_id=VC.venue_id","VC.category_id=C.category_id");
$select="V.venue_id as venueid,VC.category_id as venuecategoryid,C.category_name as categoryname";
$where="V.venue_id = ".$venueid;
$getcats=$this->common_model->get_records(0,$select,$where);
$data=$getcats;
echo json_encode($data);

}
public function categorychange(){
$catid=$this->input->post('catid');

$this->common_model->initialise('venue_sub_category as VSC');
$this->common_model->join_tables=array('sub_categories as SC','venue_users as VU');
$this->common_model->join_on=array('VSC.sub_category_id = SC.sub_category_id','VSC.venue_id = VU.venue_id');
$this->common_model->left_join=array('left');
$where = "SC.category_id = '$catid' AND VU.user_id='".$this->session->userdata('user_id')."' ";
//$getsubcats=$this->common_model->get_records(0,'VSC.*,SC.sub_category_name',"SC.category_id = '$catid' AND VU.user_id='".$this->session->userdata('user_id')."' ",'','',"VSC.sub_category_id");
$getsubcats=$this->common_model->get_records(0,'VSC.*,SC.sub_category_name',$where,'','',"VSC.sub_category_id");
$data=$getsubcats;
echo json_encode($data);

}
public function manageaddons(){
    $data=array();
    $this->load->view('venues/manageaddon');
}
	
public function addaddon(){
    $data=array();
    //$data['getvenues']=$this->getvvenues();
    $data['subcategories']=$this->getcsubcategories();
    $data['facilities']=$this->getvenuefacilities();
	if(isset($_POST['addonsubmit'])){
		$this->load->library("form_validation");
	
	$this->form_validation->set_rules("subcat_id","Subcatagory","required|trim");
	$this->form_validation->set_rules("addon","Addon","required|trim");
	if($_POST['addon']=='other'){ 
	$this->form_validation->set_rules("addon_name","Add On Name","required|trim");
        }
	$this->form_validation->set_rules("amount","Amount","required|trim");
	$this->form_validation->set_message("required","%s Should not be Empty");
	if($this->form_validation->run("add_addon")==FALSE){
		$this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
	}else{
		$this->common_model->initialise('venue_users');
		$where = array('user_id' => $this->session->userdata('user_id'));
		$venueid=$this->common_model->get_record_single($where,"venue_id");
		$venid=$venueid->venue_id;
		
             $addondata=array('venue_id' => $venid,'base_type_id'=>$_POST['subcat_id'],'base_type'=>2,'amount'=>$_POST['amount'],'status'=>1,'created_by'=>$this->session->userdata['user_id']);
            if($_POST['addon']=='other'){
                $addondata['addon_name']=addslashes($this->input->post('addon_name'));
               	}else{
                    $this->common_model->initialise('facilities');
                   $facility=$this->common_model->get_record_single("facility_id = '".$_POST['addon']."'",'facility_name');
                    $addondata['addon_name']=$facility->facility_name;
                }
                $this->common_model->initialise('addon');
                $this->common_model->array=$addondata;
                $aid=$this->common_model->insert_entry();
                if(isset($aid)){
                    $this->session->set_flashdata("addon_success","You Have Added Addon Successfully");
			redirect(base_url("venues/manageaddons"));
                }
               
	}
	}
	$this->load->view('venues/addaddon',$data);
    }

public function getADData(){
    $aColumns = array('V.venue_display_name','SC.sub_category_name','A.addon_name','A.amount','U.name','A.created_on');
	$this->common_model->initialise("addon as A");
	$this->common_model->join_tables = array("venues as V","sub_categories as SC","users as U","venue_users as VU");
	$this->common_model->join_on = array("A.venue_id = V.venue_id","A.base_type_id = SC.sub_category_id","A.created_by=U.user_id","V.venue_id = VU.venue_id");
	$this->common_model->left_join = array('left','left','left','left');
	//echo $this->session->userdata("user_id");
	$where=array("VU.user_id" => $this->session->userdata('user_id'));
	$data=$this->common_model->getTable($aColumns,$where);
	$output=$data['output'];
	$count=0;
	$i=$this->input->get_post('iDisplayStart')+1;
	foreach($data['result'] as $aRow){
		$count++;
		$row=array();
		foreach($aColumns as $col){
				$col=trim($col,'A.');
				$col=trim($col,'SC.');
				$col=trim($col,'V.');
                $col=trim($col,'U.');
                                
            $row[]=$aRow[$col];
			}
			$row[0]=$i;
			$i=$i+1;
                        $row[1]=$aRow['venue_display_name'];
                        $row[2]=$aRow['sub_category_name'];
						$row[3]=$aRow['addon_name'];
                        $row[4]=$aRow['amount'];
                        $row[5]=$aRow['name'];
                        $row[6]=$aRow['created_on'];
			$output['aaData'][]=$row;
			}
	if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
		echo json_encode($output);
}
public function customerslist(){
	
	$aColumns = array('B.booking_id','B.amount','B.created_on','B.status','SC.sub_category_name','U.name','U.user_id');
	$this->common_model->initialise("booking as B");
	$this->common_model->join_tables = array("venues as V","sub_categories as SC","users as U");
	$this->common_model->join_on = array("B.venue_id = V.venue_id","B.sub_category_id = SC.sub_category_id","B.user_id=U.user_id");
	$this->common_model->left_join = array('left','left','left');
	//echo $this->session->userdata("user_id");
	$where="V.venue_id = B.venue_id";
	$data=$this->common_model->getTable($aColumns,$where);
	$output=$data['output'];
	$count=0;
	$i=$this->input->get_post('iDisplayStart')+1;
	foreach($data['result'] as $aRow){
		$count++;
		$row=array();
		foreach($aColumns as $col){
				$col=trim($col,'B.');
				$col=trim($col,'V.');
				$col=trim($col,'SC.');
				$col=trim($col,'U.');
               
                                
            $row[]=$aRow[$col];
			//echo "<pre>";print_r($aRow[$col]);exit;
			//            
			}
			$row[0]=$i;
			$i=$i+1;
            $row[1]=$aRow['name'];
            $row[2]=$aRow['sub_category_name'];
			$row[3]=$aRow['amount'];
            $row[4]=$aRow['created_on'];
			$row[5]='<a href="'.base_url().'venues/viewcustomerinfo/'.$aRow['user_id'].'" style="color:black"><i class="fa fa-eye" title="View"></i></a>';
			$output['aaData'][]=$row;
			}
	if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
		echo json_encode($output);
}
public function managecustomers(){
	$data=array();
	$this->load->view("venues/manage_customers",$data);
}
public function viewcustomerinfo($userid){
	$data = array();
	$this->common_model->initialise("booking as B");
	$this->common_model->join_tables=array("users as U");
	$this->common_model->join_on=array("B.user_id = U.user_id");
	$select = "*";
	$where = "U.user_id = ".$userid;
	$data['getcustomerdata']=$this->common_model->get_record_single($where,$select);
	$this->load->view("venues/view_customers",$data);
}

public function changepassword(){
	$data=array();
	$userid=$this->session->userdata['user_id'];
	$c_pwd=md5($this->input->post('c_pwd'));
	$n_pwd=$this->input->post('n_pwd');
	$c_n_pwd=$this->input->post('c_n_pwd');
	$this->common_model->initialise("users");
	$where="user_id = ".$userid;
	$select="*";
	$getuserid=$this->common_model->get_record_single($where,$select);
	//echo "<pre>";print_r($getuserid);exit;
	if(isset($_POST['pwdsubmit'])){
		
	$this->load->library("form_validation");
	$this->form_validation->set_rules("c_pwd","Current Password","required|trim");
	$this->form_validation->set_rules("n_pwd","New Password","required|trim");
	$this->form_validation->set_rules("c_n_pwd","Confirm Password","required|trim|matches[n_pwd]");
	$this->form_validation->set_message("required","%s Should not be Empty");
	
	if($this->form_validation->run("changepwd")==FALSE){
		$this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
	}else if($c_pwd != $getuserid->password){
		$this->session->set_flashdata("c_pwd_error","Current Password is Wrong");
		redirect(base_url("venues/changepassword"));
		
	}else if($n_pwd != $c_n_pwd){
		$this->session->set_flashdata("n_pwd_error","Password and Confirm Password Should Match");
		redirect(base_url("venues/changepassword"));
	}else{	
				$passdata=array(
				"password"=>md5($n_pwd)
				);				
				$this->common_model->initialise("users");
				$this->common_model->array=$passdata;
				$where="user_id = ".$userid;
				$updatepwddata=$this->common_model->update($where);
				
				if(isset($updatepwddata)){
				$this->session->set_flashdata("update_pwd","Password Updated Successfully");
				redirect(base_url("venues/changepassword"));
				}
			}			
	}
	$this->load->view("venues/change_password",$data);
}

private function getvenuefacilities(){
 	$this->common_model->initialise("facilities as F");
	$this->common_model->join_tables = array("venue_facilities as VF","venue_users as VU");
	$this->common_model->join_on = array("F.facility_id = VF.facility_id","VF.venue_id = VU.venue_id");
	$groupby="VF.facility_id";
	$where=array("VU.user_id" => $this->session->userdata('user_id'));
	$facilities=$this->common_model->get_records(0,"F.*",$where,$col = 0, $order = 'desc',$groupby);
	return $facilities;
}

private function getvenueid(){
	$this->common_model->initialise('venue_users');
	$where = array('user_id' => $this->session->userdata('user_id'));
	$venueid=$this->common_model->get_record_single($where,"venue_id");
	$venid=$venueid->venue_id;
	return 	$venid;
}
/*
 * Functin to extract zipfiles into venues folder
 * **/
public function zipfiles(){
    $data=array();
        if(isset($_POST['vendorsubmit'])){
	     if(!empty($_FILES)){
        $FileType = pathinfo($_FILES['vupload']['name'], PATHINFO_EXTENSION);}
        if (!empty($_FILES) && is_uploaded_file($_FILES['vupload']['tmp_name']) && ($FileType =='zip')) {
            $basic_array = array();
            $data['error'] = "Problem with file upload";
           $target_dir="images/venues/";
            $target_file = $target_dir . basename($_FILES["vupload"]["name"]);
            if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
            if (move_uploaded_file($_FILES['vupload']['tmp_name'], $target_file)) {
               $fileinfo = pathinfo($target_dir . $_FILES["vupload"]["name"]); 
               $zip = new ZipArchive;
               $res = $zip->open($target_dir.$fileinfo['basename']);
                if ($res === TRUE) {
                 $zip->extractTo($target_dir);
                 $zip->close();
                 unlink($target_file);
                 $this->recurse_copy($target_dir.$fileinfo['filename'], $target_dir);
                 $this->delTree($target_dir.$fileinfo['filename']);
                  $this->session->set_flashdata('success', 'File Uploads Successfully');
                    redirect(base_url("admin/zipfiles"));    
                      }  else{
                           $this->session->set_flashdata('error', 'Check the File Uploaded');
                    redirect(base_url("admin/zipfiles"));
                      }                  
            }
            else{
                           $this->session->set_flashdata('error', 'Check the File Uploaded');
                    redirect(base_url("admin/zipfiles"));
                      }    
}
}
 $this->load->view("zipfiles", $data);
}
private function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
                
            } 
        } 
    } 
    closedir($dir); 
}
private  function delTree($dir)
    { 
        $files = array_diff(scandir($dir), array('.', '..')); 
        foreach ($files as $file) { 
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
        }
        return rmdir($dir); 
    } 
     public function manageimages($venueid,$vendorid)
{
    $data=array();
    $data['venueid']=$venueid;
    $data['vendorid']=$vendorid;
    $data['images']=$this->getimages($venueid,$vendorid);
    $this->load->view("venues/venue_images",$data);
}
private function getimages($venueid,$vendorid){
    $directory = 'images/venues';
$handler = opendir($directory);
while ($file = readdir($handler)) {
 if ($file != "." && $file != "..") {
      if(preg_match('(^'.$vendorid.'+[-]+'.$venueid.'+[^\\s]+(\\.(?i)(jpg|png|gif|bmp))$)', $file)) {   
    $data[] = $file;
        }
    }
}if(isset($data)){
return $data;
}
}
public function deleteimages($venueid,$vendorid,$imcount){
   $target_dir="images/venues/" ;
   $path=$target_dir.$vendorid."-".$venueid."-".$imcount.".jpg";
   if(unlink($path)){
       $this->session->set_flashdata('success', 'Deleted Successfully');
       redirect(base_url("venues/manageimages/$venueid/$vendorid"));
   }
}
public function addimages($venueid,$vendorid){
     $data=array();
     $data['venueid']=$venueid;
     $data['vendorid']=$vendorid;
      if(isset($_POST['vendorsubmit'])){
	     if(!empty($_FILES)){
                 $imgexist=$this->getimages($venueid, $vendorid);
                 $n=count($imgexist);
                 $img=explode(".",$imgexist[$n-1]);
                 $img2=explode("-",$img[0]);
                 $imcount=$img2[2];
                 $imncount=$imcount+1;
                 $target_dir="images/venues/";
      $allwoed_extentions = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF');
      $target_file = $target_dir .$vendorid."-".$venueid."-".$imncount.".jpg";
      $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
      if (!in_array($imageFileType, $allwoed_extentions)) {
                   $this->session->set_flashdata('error','Problem with Upload data');
                    redirect(base_url("venues/manageimages/$venueid/$vendorid"));    
                 } else {
                     if (move_uploaded_file($_FILES["iupload"]["tmp_name"],$target_file)) 
                {
                      $this->session->set_flashdata('success', 'Image Uploaded Successfully');
                     redirect(base_url("venues/manageimages/$venueid/$vendorid"));    
                     }
                 }
             }
      }
     $this->load->view("venues/addimage",$data);                   
}
}
	

	
?>