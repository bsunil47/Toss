<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Admin extends CI_Controller {
	
	//private $redirecturl;
	
public function __construct(){
	
	
	 parent::__construct();
	 $allowed_methodes = array('index','dashboard', 'logout');
	 $contlr=$this->uri->segment(1);
	 //echo $contlr;exit;
	 $fnctn=$this->uri->segment(2);
	 //echo "<pre>";print_r($this->session->userdata);exit;
	 
	 /*if(!in_array($fnctn,$allowed_methodes) && isset($this->session->userdata['user_type']) && @$this->session->userdata['user_id']==1){
		 
		 
		//echo "i am coming"; exit;
		 redirect(base_url("admin/dashboard"));
	}*/
	
	 $this->load->model("admin_common_model");
	
	 
}
public function index(){
	$data=array('email'=>$this->input->post('email1'),'password'=>md5($this->input->post('password1')));

	if(isset($_POST['loginsubmit'])){
	$this->load->library('form_validation');	
	$this->form_validation->set_rules('email1','Email','required|trim|valid_email');
	$this->form_validation->set_rules('password1','Password','required|trim');
	$this->form_validation->set_message('required','%s Should not be Empty');
	$this->form_validation->set_message('valid_email','%s Should be Valid Email');
	if($this->form_validation->run()==FALSE){
		 $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
	}
	else{
		
	    $getdata=$this->admin_common_model->getusersdetails();
		//echo "<pre>";print_r($getdata);
		if(!empty($getdata)){
			$userid=$getdata[0]['u_id'];
			$getusertype=$this->admin_common_model->getusertypes($userid);
			//echo "<pre>";print_r($getusertype);
			if(!empty($getusertype)){
				
				//echo "<pre>";print_r($getusertype);exit;
				$this->session->set_userdata("user_id",$getusertype[0]['user_id']);
				$this->session->set_userdata("user_type",$getusertype[0]['user_type']);
				$this->session->set_userdata("user_name",$getusertype[0]['name']);
				$this->session->set_userdata("user_email",$getusertype[0]['email']);
				$this->session->set_userdata("user_phone",$getusertype[0]['phone']);
				if($getusertype[0]['user_type']==0){
					
					redirect(base_url("admin/dashboard"));
					
				}
				if($getusertype[0]['user_type']==1){
					redirect(base_url("admin/dashboard"));
					
				}
				if($getusertype[0]['user_type']==2){
					redirect(base_url("admin/dashboard"));
					
				}
				if($getusertype[0]['user_type']==3){
					redirect(base_url("admin/dashboard"));
					
				}
				
			}else{
				$this->session->set_flashdata('error','Not Able to Login');
				redirect(base_url("admin/"));
			
			}
			
			
			
		}else{
			$this->session->set_flashdata('error','Invalid Username or Password');
			redirect(base_url("admin/"));
			
		}
		
		}
	}
	$this->load->view("login",$data);
}
	
public function dashboard(){
	$data=array();
	$this->load->view("landingpage",$data);
}
public function vendorslist(){
	$aColumns = array('U.u_id','U.name','U.email','U.phone','U.dtype','U.status','Ut.user_id','Ut.user_type');
	//echo "<pre>";print_r($aColumns);
	$this->common_model->initialise("users as U");
	
	$this->common_model->join_tables=array("user_types as Ut");
	$this->common_model->join_on=array("U.u_id=Ut.user_id");
	$this->common_model->left_join = array('left');
	$where=array("Ut.user_type"=>1);
	$data=$this->common_model->getTable($aColumns,$where,'U.u_id');
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
			$dtype=$aRow['dtype'];
			if($dtype== 1){$devicetype='IOS';}else if($dtype== 2){$devicetype='Android';}
		    //$row[4] = $devicetype;
			$status=$aRow['status'];
			if($status ==1){
				$statusn="<i class='fa fa-check' title='Active'></i>";
				$link='<a href="'.base_url().'admin/vendorstatus/'.$aRow['u_id'].'/'.$aRow["status"].'/1" style="color:black"><i class="fa fa-check" title="status"></i></a>';
			}else if($status==0 || $status='' || $status='NULL'){
				$statusn="<i class='fa fa-remove' title='Inactive'></i>";
				$link='<a href="'.base_url().'admin/vendorstatus/'.$aRow['u_id'].'/'.$aRow["status"].'/1" style="color:black"><i class="fa fa-check" title="status"></i></a>';
			}
			$row[4]=$statusn;
			$row[5]=$link.'<a href="'.base_url().'admin/viewvendor/'.$row[0].'" style="color:black"><i class="fa fa-eye" title="view"></i></a>'.'<a href="'.base_url().'admin/edituserinfo/'.$row[0].'" style="color:black"><i class="fa fa-pencil" title="Edit"></i></a>';
			
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
public function managevendors(){
	$data=array();
	
	$this->load->view("manage_vendors",$data);

	
}
public function viewvendor($vendorid){
	$data=array();
	$data['viewvendordetails']=$this->admin_common_model->viewvendors($vendorid);
	/*$this->common_model->initialise("user_types");
	$result_id=$this->common_model->get_records(0,'*',array('user_type'=>1));
	foreach($result_id as $row){
	$userid=$row->user_id;	
	$this->common_model->initialise("users");
	$select="u_id,name,email,phone,status";
	$data['viewvendordetails'][]=$this->common_model->get_record_single(array('u_id'=>$userid),$select);
	//echo "<pre>";print_r($data);exit;
	}*/
	$this->load->view("view_vendors",$data);
	
}


public function managervendors(){
	$this->load->view("venue_manager");
}
public function managerdashboard(){
	$this->load->view("venue_manager");
}

public function add(){
	$data=array();
	$data['getallcategories']=$this->admin_common_model->getcategories();
	$this->load->library("form_validation");
	$this->form_validation->set_rules('uname','Name','required|trim');
	$this->form_validation->set_rules('u_email','Email','required|trim|valid_email|is_unique[tbl_users.email]');
	$this->form_validation->set_rules('u_passw','Password','required|trim');
	$this->form_validation->set_rules('gender','Gender','required|trim');
	$this->form_validation->set_rules('u_phone','Phone Number','required|regex_match[/^[0-9]{10}$/]');
	$this->form_validation->set_rules('c_name','Company Name','required|trim');
	$this->form_validation->set_rules('cat_type','Category Type','required|trim');
	$this->form_validation->set_rules('c_add1','Company Address1','required|trim');
	$this->form_validation->set_rules('c_city','Company City','required|trim');
	$this->form_validation->set_rules('c_state','Company State','required|trim');
	$this->form_validation->set_rules('c_country','Company Country','required|trim');
	$this->form_validation->set_rules('c_pincode','Company Pincode','required|numeric|trim');
	$this->form_validation->set_rules('c_pan','PAN Number','required|trim');
	$this->form_validation->set_rules('c_vat','VAT Number','required|trim');
	$this->form_validation->set_rules('c_cst','CST Number','required|trim');
	$this->form_validation->set_rules('c_tan','TAN Number','required|trim');
	$this->form_validation->set_rules('c_service_tax','Service Tax Number','required|trim');
	$this->form_validation->set_rules('benf_name','Beneficiary Name','required|trim');
	$this->form_validation->set_rules('account_number','Account Number','required|numeric|trim');
	$this->form_validation->set_rules('t_account','Type of Account','required|trim');
	$this->form_validation->set_rules('ifsc_cde','IFSC Code','required|trim');
	$this->form_validation->set_message('required','%s should not be empty');
	$this->form_validation->set_message('valid_email','%s should be a valid email');
	$this->form_validation->set_message('is_unique','You have Already registered with us');
	if(isset($_POST['usersubmit'])){
		
		if($this->form_validation->run('add_user')==FALSE){
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		}
		else{
			
			$usertype=$this->input->post('usertype');
			
			$user_pic=array();
			//foreach($_FILES as $fieldname=>$fieldvalue){
				$upl_images=$this->upload_images($user_pic);
				//echo "<pre>";print_r($upl_images);exit;
				//echo "<pre>";print_r($_FILES);echo "total files";
				//echo "<pre>";print_r($fieldname);echo "field names";
				//echo "<pre>";print_r($filename);exit;
			/*if(!$this->upload->do_upload($fieldname)){
				//$error=array("error",$this->upload->display_errors())
				$this->session->set_flashdata('error',$this->upload->display_errors());
				redirect(base_url("admin/add"));
			}
			
			else{*/
				
				if($this->input->post('tandc')==1){
				
				//echo "<pre>";print_r($upload_data);exit;
							
				//$user_pic[]=$upload_data['file_name'];
				$user_pic=$_FILES;
				
				
				//echo "<pre>";print_r($user_pic);exit;
				
			
				$data=array(
				"name"=>$this->input->post('uname'),
				"email"=>$this->input->post('u_email'),
				"password"=>md5($this->input->post('u_passw')),
				"gender"=>$this->input->post('gender'),
				"phone"=>$this->input->post('u_phone'),
				"profile_pic"=>$_FILES['u_pic']['name'],
				"status"=>1
				);
				//echo "<pre>";print_r($data);exit;
				$this->db->insert('tbl_users',$data);
				$userid=$this->db->insert_id();
				$datausertype=array(
				"user_id"=>$userid,
				"user_type"=>1
				);
				$inserttype=$this->db->insert('tbl_user_types',$datausertype);
				
				$time=time();
				if($_FILES['s_pan']['name']!=""){
					$pan=$_FILES['s_pan']['name'];
				}
				if($_FILES['s_cancl_chq']['name']!=""){
					$cancelledchq=$_FILES['s_cancl_chq']['name'];
					
				}
				if($_FILES['s_tan']['name']!=""){
					$tan=$_FILES['s_tan']['name'];
				}
				if($_FILES['s_vat']['name']!=""){
					$vat=$_FILES['s_vat']['name'];
				}
				if($_FILES['s_cst']['name']!=""){
					$cst=$_FILES['s_cst']['name'];
				}
				if($_FILES['s_srvc_tax']['name']!=""){
					$srvc_tax=$_FILES['s_srvc_tax']['name'];
				}
				
				$vendordata=array(
				"user_id"=>$userid,
				"company_name"=>$this->input->post('c_name'),
				"category_type"=>$this->input->post('cat_type'),
				"address_one"=>$this->input->post('c_add1'),
				"address_two"=>$this->input->post('c_add2'),
				"city"=>$this->input->post('c_city'),
				"state"=>$this->input->post('c_state'),
				"country"=>$this->input->post('c_country'),
				"company_pincode"=>$this->input->post('c_pincode'),
				"srvc_provider_name"=>$this->input->post('s_disp_name'),
				"pan"=>$this->input->post('c_pan'),
				"vat"=>$this->input->post('c_vat'),
				"cst"=>$this->input->post('c_cst'),
				"tan"=>$this->input->post('c_tan'),
				"service_tax"=>$this->input->post('c_service_tax'),
				"benificiary_name"=>$this->input->post('benf_name'),
				"accont_number"=>$this->input->post('account_number'),
				"account_type"=>$this->input->post('t_account'),
				"ifsc_code"=>$this->input->post('ifsc_cde'),
				"pan_image"=>$pan,
				"cancelledchq_image"=>$cancelledchq,
				"tan_image"=>$tan,
				"vat_image"=>$vat,
				"cst_image"=>$cst,
				"srvc_tax_image"=>$srvc_tax,
				"tandc_acpt"=>1,
				"web_existing"=>$this->input->post('exst_wb'),
				"web_other"=>$this->input->post('other_web'),
				"other_info_one"=>$this->input->post('other_info1'),
				"other_info_two"=>$this->input->post('other_info2'),
				"other_info_three"=>$this->input->post('other_info3'),
				"vendor_status"=>1
				);
			
			  //echo "<pre>";print_r($vendordata);exit;	
			
				$insertdetails=$this->db->insert("tbl_vendordetails",$vendordata);
				if($insertdetails){
				$this->session->set_flashdata("vendor_success","You Have Added vendor Successfully");
					redirect(base_url("admin/add"));	
					
				}
			
				
				
			}else{
					$this->session->set_flashdata("t_and_c_error","You must agree Terms and Conditions");
					redirect(base_url("admin/add"));
					
				}
				
			}
		//}	
			
		//}
		
		
	}
	$this->load->view("add_user",$data);
}
private function upload_images($dataall){
$target_dir ='images/profiles';
$id=time();
foreach ($_FILES as $key => $value) {
                 $allwoed_extentions = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF');
                 $target_file =$target_dir."/".$id.basename($_FILES[$key]["name"]);
                 $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                 if (!in_array($imageFileType, $allwoed_extentions)) {
                     $data['error'] = 'Problem with Upload data';
                 } else {
                     if (move_uploaded_file($_FILES[$key]["tmp_name"],$target_file)) {
                         $data_array= array($key => basename($_FILES[$key]["name"]));
                     }
                 }
             }
			 if(isset($data_array)){
				 return true;
			 }else{
				return $data['error'];
			 }

}

public function vendorstatus($id,$status,$usertype){
	
	
	if($status==1){
		$statusnew=0;
	}
	if($status==0){
		$statusnew=1;
	}
	$datastatus=$statusnew;
	//$this->admin_common_model->all_status($id,$datastatus,$usertype);
	$this->common_model->initialise("users");
	$this->common_model->status=$datastatus;
	$where=array("u_id"=>$id);
	$this->common_model->set_status($where);
	redirect(base_url("admin/managevendors/$usertype"));
	
}
public function edituserinfo($userid){
	$data['getallcategories']=$this->admin_common_model->getcategories();
	$data['editusersinfo']=$this->admin_common_model->edit_userinfo($userid);
	$this->load->view("edit_user",$data);
	
}
public function edituser(){
	$this->load->library("form_validation");
	$this->form_validation->set_rules('u_phone','Phone Number','regex_match[/^[0-9]{10}$/]');
	
	if(isset($_POST['usereditsubmit'])){
		if($this->form_validation->run('edit_user')==FALSE){
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		}else{
			$user_pic=array();
			
				$upl_images=$this->upload_mod_images($user_pic);
		
	$userid=$this->input->post('edituser_id');
	$getupdatedata=$this->admin_common_model->edit_user($userid);
	redirect("admin/managevendors");
		}
	}
}
private function upload_mod_images($dataall){
$target_dir ='images/profiles';
foreach ($_FILES as $key => $value) {
                 $allwoed_extentions = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF');
                 $target_file =$target_dir."/".basename($_FILES[$key]["name"]);
                 $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                 if (!in_array($imageFileType, $allwoed_extentions)) {
                     $data['error'] = 'Problem with Upload data';
                 } else {
                     if (move_uploaded_file($_FILES[$key]["tmp_name"],$target_file)) {
                         $data_array= array($key => basename($_FILES[$key]["name"]));
                     }
                 }
             }
			 if(isset($data_array)){
				 return true;
			 }else{
				return $data['error'];
			 }

}
public function addvenue(){
	$data=array();
	$data['getallcompanies']=$this->admin_common_model->getvendorcompanynames();
	$data['getallcategories']=$this->admin_common_model->getcategories();
	$data['getfacilites']=$this->admin_common_model->getallfacilities();
	$this->load->library("form_validation");
	$this->form_validation->set_rules("vendor_id","Company","required|trim");
	/*$this->form_validation->set_rules("cat_id","Category","required|trim");
	$this->form_validation->set_rules("v_name","Venue Name","required|trim");
	$this->form_validation->set_rules("v_disp_name","Venue Display Name","required|trim");
	$this->form_validation->set_rules("v_add1","Venue Address","required|trim");
	$this->form_validation->set_rules("v_city","Venue City","required|trim");
	$this->form_validation->set_rules("v_state","Venue State","required|trim");
	$this->form_validation->set_rules("v_country","Venue Country","required|trim");
	$this->form_validation->set_rules("v_pincode","Venue Pincode","required|trim");*/
	$this->form_validation->set_message('required','%s should not be empty');
	
		if(isset($_POST['venuesubmit'])){
			if($this->form_validation->run('add_venue')==FALSE){
		$this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
		
	}else{
		//echo "<pre>";print_r($_POST['facilities']);exit;	
		$time=time();
		if($_FILES['v_pic1']['name']!=""){
			$vpic1=$time.$_FILES['v_pic1']['name'];
		}else{
			$vpic1=0;
		}
        if($_FILES['v_pic2']['name']!=""){
			$vpic2=$time.$_FILES['v_pic2']['name'];
		}else{
			$vpic2=0;
		}
		if($_FILES['v_pic3']['name']!=""){
			$vpic3=$time.$_FILES['v_pic3']['name'];
		}else{
			$vpic3=0;
		}
		if($_FILES['v_pic4']['name']!=""){
			$vpic4=$time.$_FILES['v_pic4']['name'];
		}else{
			$vpic4=0;
		}
		if($_FILES['v_pic5']['name']!=""){
			$vpic5=$time.$_FILES['v_pic5']['name'];	
		}else{
			$vpic5=0;
		}
		
		
			
			 /*if(isset($data_array)){
				 return true;
			 }else{
				return $data['error'];
			 }*/
			 
			 if($_POST['facilities']){
				$facilities= implode(",",$_POST['facilities']);
			}
		$data=array(
		"vendor_id"=>$this->input->post('vendor_id'),
		"category_id"=>$this->input->post('cat_id'),
		"venue_name"=>$this->input->post('v_name'),
		"venue_disp_name"=>$this->input->post('v_disp_name'),
		"address_one"=>$this->input->post('v_add1'),
		"address_two"=>$this->input->post('v_add2'),
		"venue_city"=>$this->input->post('v_city'),
		"venue_state"=>$this->input->post('v_state'),
		"venue_country"=>$this->input->post('v_country'),
		"venue_pincode"=>$this->input->post('v_pincode'),
		"venue_pic_one"=>$vpic1,
		"venue_pic_two"=>$vpic2,
		"venue_pic_three"=>$vpic3,
		"venue_pic_four"=>$vpic4,
		"venue_pic_five"=>$vpic5,
		"facilities"=>$facilities
		);
		
		$insertvenue=$this->db->insert("tbl_venuedetails",$data);
	
		$lastinsertedid=$this->db->insert_id();
		
		//$id=$lastinsertedid;
		
			$target_dir ='images/venues';
			$crt_file =$target_dir."/".$lastinsertedid;
			if(!is_dir($crt_file)){
				//echo "i am here";exit;
				mkdir($crt_file,0777,true);
			}
			//echo "<pre>";print_r($_FILES);exit;
			foreach ($_FILES as $key => $value) {
				//echo "<pre>";print_r($_FILES);echo "first values";
                 $allwoed_extentions = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF');
				  //echo $_FILES[$key]["name"];exit;
				  $file_name=basename($_FILES[$key]["name"]);
                 $target_file =$crt_file."/".$time.basename($_FILES[$key]["name"]);
				
                 $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                 if (!in_array($imageFileType, $allwoed_extentions)) {
                     $data['error'] = 'Problem with Upload data';
                 } else {
					 //$dir=@mkdir($target_file,0777,true);
                     if (move_uploaded_file($_FILES[$key]["tmp_name"],$target_file)) {
                         $data_array= array($key => basename($_FILES[$key]["name"]));
                     }
                 }
             }
		//echo $lastinsertedid."<br />";
		for($i=1;$i<=7;$i++){
		$workingdaydata=array(
		"venue_id"=>$lastinsertedid,
		"category_id"=>$this->input->post('cat_id'),
		"day_id"=>$i,
		"frm_dte"=>$this->input->post("frm_dte$i"),
		"t_dte"=>$this->input->post("to_dte$i"),
		"wday_status"=>1
		);	
		$this->db->insert("tbl_workingdays",$workingdaydata);
		}
		
	if($insertvenue){
		$this->session->set_flashdata("venue_success","Venue Added Successfully");
		redirect("admin/addvenue");
		
			}
		}
		
	}

	$this->load->view("add_venue",$data);
}
public function add_venuebkp(){
	$this->load->view("add_venue_bkp");
	
}
public function venueslist(){
	$aColumns = array('V.venue_id','V.venue_name','V.venue_phone','V.venue_email','V.status','VD.v_id','VD.company_name','VD.category_type');
	$this->common_model->initialise("venuedetails as V");
	$this->common_model->join_tables=array("vendordetails as VD");
	$this->common_model->join_on=array("V.vendor_id=VD.v_id");
	$this->common_model->left_join = array('left');
	
	$where=array("V.status"=>1);
	$data=$this->common_model->getTable($aColumns,$where,'V.venue_id');
	$output=$data['output'];
	$count=0;
	$i=$this->input->get_post('iDisplayStart')+1;
		foreach($data['result'] as $aRow){
		$count++;
			$row=array();
			foreach($aColumns as $col){
				$col=trim($col,'V.');
				$col=trim($col,'VD.');
				$row[]=$aRow[$col];
			}
			$row[0]=$i;
			$i=$i+1;
			$row[1]=$aRow['company_name'];
			$row[2]=$aRow['category_type'];
			$row[3]=$aRow['venue_name'];
			$row[4]=$aRow['venue_phone'];
			$row[5]=$aRow['venue_email'];
		    //$row[4] = $devicetype;
			$status=$aRow['status'];
			if($status ==1){
				$statusn="<i class='fa fa-check' title='Active'></i>";
				$link='<a href="'.base_url().'admin/vendorstatus/'.$aRow['venue_id'].'/'.$aRow["status"].'/1" style="color:black"><i class="fa fa-check" title="status"></i></a>';
			}else if($status==0 || $status='' || $status='NULL'){
				$statusn="<i class='fa fa-remove' title='Inactive'></i>";
				$link='<a href="'.base_url().'admin/vendorstatus/'.$aRow['venue_id'].'/'.$aRow["status"].'/1" style="color:black"><i class="fa fa-check" title="status"></i></a>';
			}
			$row[6]=$statusn;
			$row[7]=$link.'<a href="'.base_url().'admin/viewvendor/'.$row[0].'" style="color:black"><i class="fa fa-eye" title="view"></i></a>'.'<a href="'.base_url().'admin/edituserinfo/'.$row[0].'" style="color:black"><i class="fa fa-pencil" title="Edit"></i></a>';
				
			$output['aaData'][]=$row;
				
	}
	
	if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
		echo json_encode($output);
}
public function managevenues(){
	
	$data=array();
	$this->load->view("manage_venues",$data);
}
public function manageslots(){
	$data=array();
	$this->load->view("manage_slots");
	
}
public function addslots(){
	$data=array();
	$data['getallcompanies']=$this->admin_common_model->getvendorcompanynames();
	$data['getallcategories']=$this->admin_common_model->getcategories();
	$data['getallsubcategories']=$this->admin_common_model->getsubcategories();
	$slotdata=array(
	"company_id"=>$this->input->post('company_id'),
	"company_id"=>$this->input->post('cat_id'),
	"company_id"=>$this->input->post('subcat_id'),
	"company_id"=>$this->input->post('day_id'),
	"company_id"=>$this->input->post('slot_time'),
	"company_id"=>$this->input->post('slot_price'),
	"company_id"=>$this->input->post('quantity'),
	"company_id"=>$this->input->post('company_id'),
	"company_id"=>$this->input->post('company_id'),
	"company_id"=>$this->input->post('company_id'),
	"company_id"=>$this->input->post('company_id'),
	"company_id"=>$this->input->post('company_id'),
	"company_id"=>$this->input->post('company_id'),
	"company_id"=>$this->input->post('company_id'),
	"company_id"=>$this->input->post('company_id'),
	"company_id"=>$this->input->post('company_id'),
	);
	$this->load->view("add_slots",$data);
	
}
public function accept_terms()
	{
		
            if ($this->input->post('tandc'))
		{
			return TRUE;
		}
		else
		{
			$error = 'Please read and accept our terms and conditions.';
			$this->form_validation->set_message('accept_terms', $error);
			return FALSE;
		}
	}
public function addcategory(){
	if(isset($_POST['catsubmit'])){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("cat_name","Category Name","required|trim");
		$this->form_validation->set_message("required","%s Should not be Empty");
		if($this->form_validation->run('add_cat')==FALSE){
			$this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
			
		}else{
	$data=array(
	"category_name"=>$this->input->post('cat_name'),
	"category_status"=>1
	);
	$insert=$this->db->insert("tbl_categories",$data);
	if($insert){
		$this->session->set_flashdata("success","You Have Added Category Successfully");
		redirect(base_url('admin/addcategory'));
	}
		}
	}
	$this->load->view("add_category");
}
public function addsubcategory(){
	$data['getallcategories']=$this->admin_common_model->getcategories();
	if(isset($_POST['subcatsubmit'])){
	$this->load->library("form_validation");
	$this->form_validation->set_rules("category_id","category","required|trim");
	$this->form_validation->set_rules("subcat_name","Subcategory Name","required|trim");
	if($this->form_validation->run("add_subcat")==FALSE){
		$this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
	}else{
		$data=array(
		"category_id"=>$this->input->post('category_id'),
		"subcat_name"=>$this->input->post('subcat_name'),
		"subcat_status"=>1
		);
		$insertsubcat=$this->db->insert("tbl_subcategories",$data);
		if($insertsubcat){
			$this->session->set_flashdata("subcat_success","You Have Added Subcategory  Successfully");
			redirect(base_url("admin/addsubcategory"));
			}
		}
	}
		$this->load->view("add_subcategory",$data);
}
public function managecategories(){
	//$data['getallcategories']=$this->admin_common_model->getcategories();
	$data=array();
	
	$this->load->view("manage_category",$data);
}
public function managesubcategories(){
	//$data['getallcategories']=$this->admin_common_model->getcategories();
	$data=array();
	
	$this->load->view("manage_subcategory",$data);
}
public function managefacilities(){
	$this->load->view("manage_facilities");
}
public function addfacility(){
	if(isset($_POST['faclsubmit'])){
		$this->load->library("form_validation");
	
	$this->form_validation->set_rules("faclty_name","Facility Name","required|trim");
	$this->form_validation->set_message("required","%s Should not be Empty");
	if($this->form_validation->run("add_subcat")==FALSE){
		$this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
	}else{
	$data=array(
	"faclty_name"=>addslashes($this->input->post('faclty_name')),
	"facl_status"=>1
	);
	$insertaddfaclty=$this->db->insert("tbl_facilities",$data);
	if($insertaddfaclty){
			$this->session->set_flashdata("facility_success","You Have Added Facility Successfully");
			redirect(base_url("admin/addfacility"));
			}
	}
	}
	$this->load->view("add_facilities");
	
}
public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_phone');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_type');
        
        $this->session->sess_destroy();
        redirect(base_url("admin/"));
        }
	
}
	
?>