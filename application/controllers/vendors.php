<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Vendors extends My_Controller {
	
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
public function dashboard(){
	$data=array();
	$this->common_model->initialise('user_types');
	$select = "COUNT(user_type) as countall";
	$data['appusers']=$this->common_model->get_record_single(array("user_type"=>5),$select);
	$this->common_model->initialise("venues as V");
	$this->common_model->join_tables = array("vendor as VD");
	$this->common_model->join_on = array("V.vendor_id = VD.vendor_id");
	$this->common_model->left_join = array('left');
	$select2 = "count(V.venue_id) as venuescount";
	$where = "VD.user_id = ".$this->session->userdata['user_id'];
	$data['venues']=$this->common_model->get_records(0,$select2,$where);
	$this->layout->view($this->view_dir,$data);
	}
public function listvenue($vendor_id){
	$data=array();
	$this->common_model->initialise("users as U");
	$this->common_model->join_tables=array("vendor as VD","venues as V");
	$this->common_model->join_on=array("U.user_id=VD.user_id","V.vendor_id=VD.vendor_id");
	$where="VD.vendor_id = ".$vendor_id;
	$select="*,V.venue_id as venueid,V.status as venuestatus,VD.vendor_id as vendorid";
	$data['venuesbyvendor']=$this->common_model->get_records(0,$select,$where);
	$this->layout->view($this->view_dir,$data);
       }
public function viewvendor(){
	$data=array();
        $vendorid=$this->session->userdata('user_id');
    	$this->common_model->initialise("categories");
	$data['getallcategories']=$this->common_model->get_records(0,"*",'');
	$this->common_model->initialise("vendor as VD");
	$this->common_model->join_tables=array("users as U","venues as V","bank_details as B","venue_category as VC","categories as C","venue_sub_category as VSC","sub_categories as SC","working_hours as W","venue_facilities as VF");
	$this->common_model->join_on=array("U.user_id=VD.user_id","VD.vendor_id=V.vendor_id","VD.vendor_id=B.vendor_id","V.venue_id=VC.venue_id","VC.category_id=C.category_id","V.venue_id=VSC.venue_id","VSC.sub_category_id=SC.sub_category_id","V.venue_id=W.venue_id","V.venue_id=VF.venue_id");
	$this->common_model->left_join=array('left','left','left','left','left','left','left','left','left');
        $where="VD.user_id = ".$vendorid;
	$select="V.*,V.venue_id as venueid,V.address as venueaddress,V.address as venueaddresstwo,V.city as venuecity,V.state as venuestate,V.country as venuecountry,V.pincode as venuepin,V.phone as venuephone,U.email as useremail,U.phone as userphone,U.name as vendorname,U.gender as vendorgendor,U.profile_pic,VD.*,VD.vendor_id as vendorid,VD.address as vendoraddress,VD.address as vendoraddresstwo,VD.city as vendorcity,VD.state as vendorstate,VD.country as vendorcountry,VD.pincode as vendorpin,VD.phone as vendorphone,B.*,VC.*,C.category_name as venuecategory,VSC.*,W.*,VF.*,VF.status as venue_facilitystatus";
	$data['viewvendordetails']=$this->common_model->get_record_single($where,$select);
	$this->layout->view($this->view_dir,$data);
}
public function editvendor(){
	$vendorid=$this->session->userdata('user_id');	
          $data=array();
	$this->common_model->initialise("categories");
	$data['getallcategories']=$this->common_model->get_records(0,"*",'');
	$this->common_model->initialise("sub_categories");
	$data['getallsubcategories']=$this->common_model->get_records(0,"*",'');
	$this->common_model->initialise("users as U");
	$this->common_model->join_tables=array("vendor as VD","venues as V","bank_details as B","venue_category as VC","venue_sub_category as VSC","working_hours as W","venue_facilities as VF");
	$this->common_model->join_on=array("U.user_id=VD.user_id","VD.vendor_id=V.vendor_id","VD.vendor_id=B.vendor_id","V.venue_id=VC.venue_id","VSC.venue_id=V.venue_id","V.venue_id=W.venue_id","V.venue_id=VF.venue_id");
	$this->common_model->left_join=array('left','left','left','left','left','left','left');
        $where="VD.user_id = ".$vendorid;
	$select="V.*,V.venue_id as venueid,V.address as venueaddress,V.address as venueaddresstwo,V.city as venuecity,V.state as venuestate,V.country as venuecountry,V.pincode as venuepin,U.email as useremail,U.phone as userphone,U.name as vendorname,U.gender as vendorgendor,VD.*,VD.vendor_id as vendorid,VD.address as vendoraddress,VD.address as vendoraddresstwo,VD.city as vendorcity,VD.state as vendorstate,VD.country as vendorcountry,VD.pincode as vendorpin,B.*,VC.*,VSC.*,W.*,VF.*,VF.status as venue_facilitystatus";
	$data['editvendorinfo']=$this->common_model->get_record_single($where,$select);
	$data['workinghours'] = $this->workinghours($data['editvendorinfo']->venueid);
	$data['facilities'] = $this->venuefacilities($data['editvendorinfo']->venueid);
        $this->layout->view($this->view_dir,$data);
        }
public function editvendordetails(){
	$this->load->library("form_validation");
	$this->form_validation->set_rules('uname','Name','required|trim');
	/*$this->form_validation->set_rules('u_email','Email','required|trim|valid_email|is_unique[tbl_users.email]');
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
	//$this->form_validation->set_rules('c_service_tax','Service Tax Number','required|trim');
	$this->form_validation->set_rules('benf_name','Beneficiary Name','required|trim');
	$this->form_validation->set_rules('account_number','Account Number','required|numeric|trim');
	$this->form_validation->set_rules('t_account','Type of Account','required|trim');
	$this->form_validation->set_rules('ifsc_cde','IFSC Code','required|trim');*/
	$this->form_validation->set_message('required','%s should not be empty');
	$this->form_validation->set_message('valid_email','%s should be a valid email');
	$this->form_validation->set_message('is_unique','You have Already registered with us');
	
	if(isset($_POST['vendorsubmit'])){
		if($this->form_validation->run('edit_vendor')==FALSE){
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		}else{
			$user_id=$this->input->post('user_id');
			$vendor_id=$this->input->post('vendor_id');
			$venue_id=$this->input->post('venue_id');
			
			$data=array("name"=>$this->input->post('uname'),"email"=>$this->input->post('u_email'),"gender"=>$this->input->post('gender'),"phone"=>$this->input->post('u_phone'));
			$this->common_model->initialise("users");
			$this->common_model->array=$data;
			$where="user_id = ".$user_id;
			$updateuser=$this->common_model->update($where);
			$vendordata=array("company_name"=>$this->input->post('c_name'),"address"=>$this->input->post('vendor_address'),"address2"=>$this->input->post('vendor_addresstwo'),"city"=>$this->input->post('vendor_city'),"state"=>$this->input->post('vendor_state'),"country"=>$this->input->post('vendor_country'),"pincode"=>$this->input->post('vendor_pin'),"pan"=>$this->input->post('c_pan'),"vat"=>$this->input->post('c_vat'),"tan"=>$this->input->post('c_cst'),"cst"=>$this->input->post('c_tan'),"service_tax"=>$this->input->post('c_service_tax'),"web_url"=>$this->input->post('exst_wb'),"web_url2"=>$this->input->post('other_web'),"other_info_one"=>$this->input->post('other_info1'),"other_info_two"=>$this->input->post('other_info2'),"other_info_three"=>$this->input->post('other_info3'));
			$this->common_model->initialise("vendor");
			$this->common_model->array=$vendordata;
			$where="vendor_id = ".$vendor_id;
			$updatevendordata=$this->common_model->update($where);
			$bankdata=array("beneficiary_name"=>$this->input->post('benf_name'),"account_number"=>$this->input->post('account_number'),"account_type"=>$this->input->post('t_account'),"ifsc_code"=>$this->input->post('ifsc_cde'));
			$this->common_model->initialise("bank_details");
			$this->common_model->array=$bankdata;
			$where="vendor_id = ".$vendor_id;
			$updatevendordata=$this->common_model->update($where);
			$target_dir="images/vendors";
			
				if(!empty($_FILES))	{		
				foreach($_FILES as $key=>$value){
					$allowed_extensions=array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF');
					$vendor_images=array("pan_image","vat_image","cst_image","tan_image","service_tax_image","cancelled_cheque_image");
						if($key == 'profile_pic'){
							$targetuserdir="images/profiles/$vendor_id";
							$targetfileuser=$targetuserdir."_"."user.jpg";
							$data[$key]=$vendorid."_user.jpg";
							$this->updatedetails($data,"users",$user_id);
						}elseif(in_array($key,$vendor_images)){
							$targetvendordir="images/vendors/$vendor_id";
							$targetfileuser=$targetvendordir."/vendor_{$key}_{$vendor_id}".".jpg";
							$vendordata[$key]="vendor_{$key}_{$vendor_id}".".jpg";
							$this->updatedetails($vendordata,"vendor",$vendor_id);
						}else{
							$targetfileuser = $targetfile;
							$venuedetails[$key]="{$venue_id}_{$key}".".jpg";
						    $this->updatedetails($venuedetails,"venues",$venue_id);
						}
						
						move_uploaded_file($_FILES[$key]['tmp_name'],$targetfileuser);
						
						
					}
				}
		}
                if($updatevendordata==false){
                    $this->session->set_flashdata("vendor_success","Updated Successfully");
		     redirect(base_url("vendors/editvendor"));
                }
	}
}
public function editvenuedetails(){
	/*$this->load->library("form_validation");
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
	//$this->form_validation->set_rules('c_service_tax','Service Tax Number','required|trim');
	$this->form_validation->set_rules('benf_name','Beneficiary Name','required|trim');
	$this->form_validation->set_rules('account_number','Account Number','required|numeric|trim');
	$this->form_validation->set_rules('t_account','Type of Account','required|trim');
	$this->form_validation->set_rules('ifsc_cde','IFSC Code','required|trim');
	$this->form_validation->set_message('required','%s should not be empty');
	$this->form_validation->set_message('valid_email','%s should be a valid email');
	$this->form_validation->set_message('is_unique','You have Already registered with us');*/
	if(isset($_POST['vendorsubmit'])){
	    $user_id = $this->input->post('user_id');
            $vendor_id = $this->input->post('vendor_id');
            $venue_id = $this->input->post('venue_id');
            $redirectid = $this->input->post('redirectid');
            $listvenue_vendor_id = $this->input->post('listvenue_vendor_id');
            $venuedata = array("venue_display_name" => ucfirst($this->input->post('v_disp_name')),"address" => $this->input->post('v_add1'),"address2" => $this->input->post('v_add2'),"city" => $this->input->post('v_city'),"state" => $this->input->post('v_state'),"country" => $this->input->post('v_country'),"pincode" => $this->input->post('v_pincode'),"lat" => $this->input->post('toss_ven_lat'),"lng" => $this->input->post('toss_ven_lng'),"location" => $this->input->post('toss_ven_location'),"contact_person" => $this->input->post('cp_name'),"phone" => $this->input->post('cp_mobile'),"email" => $this->input->post('cp_email'));
            $this->common_model->initialise("venues");
            $this->common_model->array = $venuedata;
            $where = "venue_id = " . $venue_id;
            $updatevendordata = $this->common_model->update($where);
            $category_id = $this->input->post('cat_id');
            $sub_category_id = $this->input->post('sub_cat_id');
            $sub_sub_category_id = $this->input->post('sub_sub_cat_id');
            $catdata=$this->venuecategoriesupdate("venue_category",$category_id,$venue_id);
            $subcatdata=$this->venuecategoriesupdate("venue_sub_category",$sub_category_id,$venue_id);
            $subsubcatdata=$this->venuecategoriesupdate("venue_sub_sub_categories",$sub_sub_category_id,$venue_id);
            $from_work_date = $_POST['frm_dte'];
            $to_work_date = $_POST['to_dte'];
            foreach ($from_work_date as $key => $value) {
                $workingdata = array("venue_id" => $venue_id,"category_id" => $category_id,"sub_category_id" => $this->input->post('sub_cat_id'),"day_id" => $key,"start_time" => $value,"end_time" => $to_work_date[$key]);
                $workinghours = $this->workinghourss($venue_id, $key);
                if (!empty($workinghours)) {
                    $dayid = $key;
                    $where = "venue_id ='$venue_id' and day_id='$dayid'";
                    $this->common_model->initialise("working_hours");
                    $this->common_model->array = $workingdata;
                    $updateworkhoursdata = $this->common_model->update($where);
                } else {
                    $this->common_model->initialise("working_hours");
                    $this->common_model->array = $workingdata;
                    $updateworkhoursdata = $this->common_model->insert_entry();
                }
            }
               if ($redirectid == 1) {
                $this->session->set_flashdata("update_venue", "Venue Updated Successfully");
                redirect(base_url("vendors/managevenues"));
            } else {
                $this->session->set_flashdata("update_venue", "Venue Updated Successfully");
                redirect(base_url("vendors/managevenues"));
            }
        }
}
private function venuecategoriesupdate($table,$data,$id){
    $cat_array=["venue_category"=>"category_id","venue_sub_category"=>"sub_category_id","venue_sub_sub_categories"=>"sub_sub_category_id"];
    $this->common_model->initialise($table);
    $this->common_model->array=array("status"=>0);
    $updatee=$this->common_model->update("venue_id = '$id'");
            for($i=0;$i<count($data);$i++){
            $get=$this->common_model->get_records(0,"*","venue_id = '$id' and $cat_array[$table] = '$data[$i]'");
            if(empty($get)){
                $this->common_model->array = array("venue_id"=>$id,$cat_array[$table]=>$data[$i],"status"=>1);
                $update=$this->common_model->insert_entry();
                if(isset($update)){
                    $updatecatdata=false;
                }
            }else{
            $this->common_model->array = array("status"=>1);
            $where = "venue_id = " . $id;
            $updatecatdata = $this->common_model->update($where);
            }}
            
return $updatecatdata;
}
private function upload_mod_images($dataall){
	
	
		
/*$target_dir ='images/profiles';
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
			 }*/
	
						


}
public function getsubcat(){
$getallsubcatsbycat=$this->admin_common_model->getallsubcatbycat($categoryid);	
				//echo "<pre>";print_r($getallsubcats);exit;	
				$html='<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Subcategories</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10 subcategory" name="sub_cat_id">
								<option value="">--Select SubCategory--</option>';
								foreach($getallsubcatsbycat as $getallsubcatbycat){
									$html.='<option value="1">sdfdsf</option>';
								}
								$html.='</select>';
								echo $html;
}
private function updatedetails($data,$table,$id){
	if($table=="users"){
		
		$this->common_model->initialise('users');
		$where="user_id = '$id'";
	} else if($table=="vendor"){
		$this->common_model->initialise('vendor');
		$where="vendor_id = '$id'";
	}else if($table=="venues"){
		$this->common_model->initialise('venues');
		$where="venue_id = '$id'";
	}else if($table=="facilities"){
		//echo "i am coming";exit;
		$this->common_model->initialise('facilities');
		$where="facility_id = '$id'";
	}
	$this->common_model->array=$data;
	$update=$this->common_model->update($where);
	if($update==false){
		return true;
	}else return false;
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

public function updatestatus($id,$status,$usertype,$vid){
    	if($status == 1){
	$statusnew = 0;
	}
	if($status == 0 || $status == ' ' || $status == NULL){
			$statusnew = 1;
	}
        $datastatus=$statusnew;
	if($usertype == 6){
            $where=array("venue_id"=>$id);
            $this->updatesstatus("venues",$datastatus,$where,"managevenues");
	  }
	if($usertype == 66){
	$where=array("venue_id"=>$id);
        $this->updatesstatus("venues",$datastatus,$where,"listvenue/$vendorid->vendor_id");
	}
	if($usertype == 7){
	$where=array("sub_category_id"=>$id);
        $this->updatesstatus("sub_categories",$datastatus,$where,"managesubcategories");
	}
	if($usertype == 10){
	$where=array("category_id"=>$id);
       $this->updatesstatus("categories",$datastatus,$where,"managecategories");
	}
	if($usertype==4){
	redirect(base_url("vendors/manageusers"));	
	}
        if($usertype == 11){
			//echo $mid;exit;
	$where=array("price_id"=>$id);
       $this->updatesstatus("prices",$datastatus,$where,"managepricing/$vid");
	}
        if($usertype == 13){
	$where=array("slot_id"=>$id);
        $this->updatesstatus("time_slots",$datastatus,$where,"manageslots/$vid");
	}
}
private function updatesstatus($tbl,$data,$where,$page)
{
    $this->common_model->initialise($tbl);
    $this->common_model->array=array('status'=>$data);
    $this->common_model->update($where);
    redirect(base_url("vendors/$page"));
}


public function addvenue(){
	$data = array();
        $this->common_model->initialise("vendor");
        $vendor_id=$this->common_model->get_record_single("user_id = '".$this->session->userdata['user_id']."'","vendor_id");
        $vendorid=$vendor_id->vendor_id;
        $categoryid = $this->input->post('cat_id');
        $subcategoryid = $this->input->post('sub_cat_id');
        $subsubcategoryid = $this->input->post('sub_sub_cat_id');
        $this->common_model->initialise("categories");
        $data['getallcategories'] = $this->common_model->get_records(0, "*", '');
        $this->common_model->initialise("facilities");
        $data['getfacilites'] = $this->common_model->get_records(0, "*", '');
        $this->load->library("form_validation");
        $this->form_validation->set_rules("cat_id", "Category", "required");
        $this->form_validation->set_message('required', '%s should not be empty');
        if (isset($_POST['venuesubmit'])) {
               if ($this->form_validation->run('add_venue') == FALSE) {
                $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
            } else {
                if ($_POST['facilities']) {
                    $facilities = implode(",", $_POST['facilities']);
                }
                $venuedetails = array("vendor_id" => $vendorid,"venue_display_name" => ucfirst($this->input->post('v_disp_name')),"address" => $this->input->post('v_add1'),"address2" => $this->input->post('v_add2'),"city" => $this->input->post('v_city'),"state" => $this->input->post('v_state'),"country" => $this->input->post('v_country'),"pincode" => $this->input->post('v_pincode'),"location" => $this->input->post('toss_ven_location'),"lat" => $this->input->post('toss_ven_lat'),"lng" => $this->input->post('toss_ven_lng'),"contact_person" => $this->input->post('cp_name'),"phone" => $this->input->post('cp_mobile'),"email" => $this->input->post('cp_email'),"status" => 1);
                $this->common_model->initialise('venues');
                $this->common_model->array=$venuedetails;
                $venue_id=$this->common_model->insert_entry();
                if ($venue_id) {
                    for ($i = 0; $i < count($categoryid); $i++) {
                        $categorydata = array("venue_id" => $venue_id,"category_id" => $categoryid[$i],"status" => 1);
                        $insertcategory = $this->db->insert("tbl_venue_category", $categorydata);
                    }
                    if ($insertcategory) {
                        for ($j = 0; $j < count($subcategoryid); $j++) {
                            $subcategorydata = array("venue_id" => $venue_id,"sub_category_id" => $subcategoryid[$j],"status" => 1);
                            $insertsubcategory = $this->db->insert("tbl_venue_sub_category", $subcategorydata);
                        }
                        if ($insertsubcategory) {
                            for ($k = 0; $k < count($subsubcategoryid); $k++) {
                                $subsubcategorydata = array("venue_id" => $venue_id,"sub_sub_category_id" => $subsubcategoryid[$k],"status" => 1);
                                $insertsubsubcategory = $this->db->insert("tbl_venue_sub_sub_categories", $subsubcategorydata);
                            }
                            if ($insertsubsubcategory) {
                                $from_work_date = $_POST['frm_dte'];
                                $to_work_date = $_POST['to_dte'];
                                $days = $_POST['days'];
                                $catid = implode(",", $categoryid);
                                $subcatid = implode(",", $subcategoryid);
                                $subsubcatid = implode(",", $subsubcategoryid);
                                foreach ($days as $key => $value) {
                                    $workingdata = array("venue_id" => $venue_id,"category_id" => $catid,"sub_category_id" => $subcatid,"sub_sub_category_id" => $subsubcatid,"day_id" => $value,"start_time" => $from_work_date,"end_time" => $to_work_date,"status" => 1);
                                    $insertworkinghours = $this->db->insert("tbl_working_hours", $workingdata);
                                }
                                if ($insertworkinghours) {
                                    if (!empty($_POST['facilities'])) {
                                        if ($_POST['facilities']) {
                                            $facilities = $_POST['facilities'];
                                            for ($i = 0; $i < count($facilities); $i++) {
                                                $facilitydata = array("venue_id" => $venue_id,"facility_id" => $facilities[$i],"status" => 1);
                                                $insertfacilitydata = $this->db->insert("tbl_venue_facilities", $facilitydata);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                $target_dir = "images/venues/";
                  $i=1;
                foreach ($_FILES as $key => $value) {
                   $allowed_extensions = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF');
                   $file_name = basename($_FILES[$key]['name']);
                    $vendor_uploads['keys'] = $_FILES[$key];
                    $targetfile = $target_dir."{$vendorid}-{$venue_id}-{$i}" . ".jpg";
                    $imagefiletype = pathinfo($targetfile, PATHINFO_EXTENSION);
                    if (!in_array($imagefiletype, $allowed_extensions)) {
                        $this->session->set_flashdata("image_error", "Problem with Uploading Images");
                        redirect(base_url("admin/addvenue"));
                    } else {
                        $targetfileuser = $targetfile;
                        $venuedetails[$key] = "{$vendorid}-{$venue_id}-{$i}" . ".jpg";
                        $this->updatedetails($venuedetails, "venues", $venue_id);
                        move_uploaded_file($_FILES[$key]['tmp_name'], $targetfileuser);
                    }
                    $i++;
                }
                if ($insertworkinghours) {
                    $this->session->set_flashdata("venue_success", "Venue Added Successfully");
                    redirect(base_url("vendors/managevenues"));
                }
            }
        }
        $this->layout->view($this->view_dir,$data);
	}
public function categorychange(){
$catid=$this->input->post('catid');
$this->common_model->initialise("sub_categories");
$where="category_id = ".$catid;
$getsubcats=$this->common_model->get_records(0,"*",$where);
$data=$getsubcats;
echo json_encode($data);

}
public function venueslist(){
	$aColumns = array('V.venue_id','V.venue_display_name','V.phone','V.email','V.status','VD.vendor_id','V.address');
	$this->common_model->initialise("venues as V");
	$this->common_model->join_tables=array("vendor as VD");
	$this->common_model->join_on=array("V.vendor_id=VD.vendor_id");
	$this->common_model->left_join = array('left');
	$id=$this->session->userdata['user_id'];
	$where='VD.user_id = '.$id;
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
			$row[1]=$aRow['venue_display_name'];
			//$row[2]=$aRow['category_type'];
			$row[2]=$aRow['address'];
			$row[3]=$aRow['phone'];
			$row[4]=$aRow['email'];
		    //$row[4] = $devicetype;
			$status=$aRow['status'];
			if($status ==1){
				$statusn="<i class='fa fa-check' title='Active'></i>";
				$link='<a href="'.base_url().'vendors/updatestatus/'.$aRow['venue_id'].'/'.$aRow["status"].'/6" style="color:black;margin-right:5px;"><i class="fa fa-remove" title="Inactive"></i></a>';
			}else if($status == 0 || $status == '' || $status == 'NULL'){
				$statusn="<i class='fa fa-remove' title='Inactive'></i>";
				$link='<a href="'.base_url().'vendors/updatestatus/'.$aRow['venue_id'].'/'.$aRow["status"].'/6" style="color:black;margin-right:5px;"><i class="fa fa-check" title="Active"></i></a>';
			}
			$row[5]=$statusn;
			$row[6]=$link.'<a href="'.base_url().'vendors/viewvenueinfo/'.$aRow['venue_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-eye" title="view"></i></a>'.'<a href="'.base_url().'vendors/editvenueinfo/'.$aRow['venue_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-pencil" title="Edit"></i></a>'.'<a href="'.base_url().'vendors/manageusers/'.$aRow['venue_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-user" title="User"></i></a>'.'<a href="'.base_url().'vendors/manageslots/'.$aRow['venue_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-clock-o" title="Slots"></i></a>'.'<a href="'.base_url().'vendors/manageaddons/'.$aRow['venue_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-puzzle-piece" title="Addons"></i></a>'.'<a href="'.base_url().'vendors/managefacilities/'.$aRow['venue_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-glass" title="Facilities"></i></a>'.'<a href="'.base_url().'vendors/managepricing/'.$aRow['venue_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-money" title="Pricing"></i></a>&nbsp;&nbsp;<a href="'.base_url().'vendors/manageimages/'.$aRow['venue_id'].'" title="Images" style="color:black;margin-right:5px;"><i class="fa fa-picture-o"></i></a>';
				
			$output['aaData'][]=$row;
				
	}
	
	if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
		echo json_encode($output);
}
public function editvenueinfo($venueid){
	$data = array();
        $data['getallcategories']=$this->getallcategoriesdata("categories");
        $data['getallsubcategories']=$this->getallcategoriesdata("sub_categories");
        $data['getallsubsubcategories']=$this->getallcategoriesdata("sub_sub_categories");
        $data['getfacilites']=$this->getallcategoriesdata("facilities");
        $data['venuecategoryinfo']=$this->getallcategoriesdata("venue_category","category_id", "venue_id = '$venueid'");
        $data['venuesubcategoryinfo']=$this->getallcategoriesdata("venue_sub_category","sub_category_id", "venue_id = '$venueid'");
        $data['venuesubsubcategoryinfo']=$this->getallcategoriesdata("venue_sub_sub_categories","sub_sub_category_id", "venue_id = '$venueid'");
        $this->common_model->initialise("vendor as VD");
        $this->common_model->join_tables = array("venues as V", "venue_category as VC", "venue_sub_category as VSC", "working_hours as W", "venue_facilities as VF");
        $this->common_model->join_on = array("VD.vendor_id=V.vendor_id", "V.venue_id=VC.venue_id", "VSC.venue_id=V.venue_id", "V.venue_id=W.venue_id", "V.venue_id=VF.venue_id");
        $this->common_model->left_join = array('left', 'left', 'left', 'left', 'left');
        $where = "V.venue_id = " . $venueid;
        $select = "V.*,V.phone as venuephone,V.address as venueaddress,V.address2 as venueaddresstwo,V.city as venuecity,V.state as venuestate,V.country as venuecountry,V.pincode as venuepincode,V.venue_id as venueid,VD.*,VC.*,VSC.*,W.*,VF.*,VF.status as venue_facilitystatus";
        $data['editvenueinfo'] = $this->common_model->get_record_single($where, $select);
        $data['workinghours'] = $this->workinghours($venueid);
        $data['facilities'] = $this->venuefacilities($venueid);
      //  $data['facilities'] = $this->venuefacilityids($venueid);
        $this->layout->view($this->view_dir, $data);
	}
private function workinghours($venue_id){
	$this->common_model->initialise("working_hours as W");
	$this->common_model->join_tables=array("venues as V");
	$this->common_model->join_on=array("V.venue_id=W.venue_id");
	$where="V.venue_id = ".$venue_id;
	$select="W.*";
	$workinghours = $this->common_model->get_records(0,$select,$where);
	return $workinghours;
}
private function venuefacilities($venue_id){
	$this->common_model->initialise("venue_facilities as VF");
	$this->common_model->join_tables=array("venues as V","facilities as F");
	$this->common_model->join_on=array("V.venue_id=VF.venue_id","VF.facility_id=F.facility_id");
	$where="V.venue_id = ".$venue_id;
	$select="VF.*,F.facility_name";
	$facilities = $this->common_model->get_records(0,$select,$where);
	return $facilities;
}
public function viewvenueinfo($venueid){
   	$data=array();
	$this->common_model->initialise("categories");
	$data['getallcategories']=$this->common_model->get_records(0,"*",'');
	$this->common_model->initialise("sub_categories");
	$data['getallsubcategories']=$this->common_model->get_records(0,"*",'');
	$this->common_model->initialise("venues as V");
	$this->common_model->join_tables=array("vendor as VD","venue_category as VC","venue_sub_category as VSC","working_hours as W","venue_facilities as VF");
	$this->common_model->join_on=array("VD.vendor_id=V.vendor_id","V.venue_id=VC.venue_id","VSC.venue_id=V.venue_id","V.venue_id=W.venue_id","V.venue_id=VF.venue_id");
	$this->common_model->left_join=array('left','left','left','left','left');
        $where="V.venue_id = ".$venueid;
	$select="*,V.venue_id as venueid,V.address as venueaddress,V.address2 as venueaddresstwo,V.city as venuecity,V.state as venuestate,V.country as venuecountry,V.pincode as venuepincode,VD.vendor_id as vendorid,VF.status as venuefacilitystatus";
	$data['viewvenueinfo']=$this->common_model->get_record_single($where,$select);
        $data['workinghours'] = $this->workinghours($venueid);
	$data['facilities'] = $this->venuefacilities($venueid);
        $this->layout->view($this->view_dir,$data);
	}
public function managevenues(){
	
	$data=array();
        $this->layout->view($this->view_dir,$data);
	}
private function getallcategoriesdata($table,$select=null,$where=null){
    $this->common_model->initialise($table);
    if($select==null){$select="*";}
    return $this->common_model->get_records(0,$select,$where);
}
public function manageslots($venue_id){
	$data=array();
        $data['venue_id']=$venue_id;
        $this->layout->view($this->view_dir,$data);
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
public function managefacilities($venueid){
	$data=array();
        $data['venue_id']=$venueid;
	$this->common_model->initialise("venue_facilities  as VF");
        $this->common_model->join_tables=array("venues as V","facilities as F","vendor as VD");
        $this->common_model->join_on=array("VF.venue_id = V.venue_id","VF.facility_id = F.facility_id","V.vendor_id = VD.vendor_id");
       $data['getallfacilities']=$this->common_model->get_records(0,"VF.*,F.facility_name,V.venue_display_name","V.venue_id = '".$venueid."'");
       $this->layout->view($this->view_dir,$data); 
     }
public function addfacility($venueid){
    $data=array();
    $data['venue_id']=$venueid;
	$this->common_model->initialise('facilities');
	$data['facilities']=$this->common_model->get_records(0,"*","");
    if(isset($_POST['faclsubmit'])){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("facility","Facility Name","required");
		$this->form_validation->set_message("required","%s Should not be Empty");
	if($this->form_validation->run("add_facility")==FALSE){
		$this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
	}else{
		$this->common_model->initialise('venue_facilities');
		$facarr=$_POST['facility'];
		for($i=0;$i<count($facarr);$i++){
             $facdata=array('venue_id' => $venueid,'facility_id'=>$facarr[$i],'status'=>1);
			  $this->common_model->array=$facdata;
			  $fid=$this->common_model->insert_entry();
		}
		if(isset($fid)){
                    $this->session->set_flashdata("facility_success","You Have Added Facility Successfully");
					redirect(base_url("vendors/managefacilities/{$venueid}"));
                }              
	}
	}
        $this->layout->view($this->view_dir,$data);
	}
public function viewfacility($fid,$vid){
    $data['venue_id']=$vid;
    $this->common_model->initialise('venue_facilities as VF');
    $this->common_model->join_tables=array('venues as V','facilities as F');
    $this->common_model->join_on=array("VF.venue_id = V.venue_id","VF.facility_id = F.facility_id");
    $data['getdetails']=$this->common_model->get_record_single("VF.venue_id = '$vid' and VF.facility_id = '$fid'","F.*,V.venue_display_name");
    $this->layout->view($this->view_dir,$data);
}
public function editfacilityinfo($fid,$vid){
    $data['venue_id']=$vid;
    $data['facility_id']=$fid;
    $this->common_model->initialise('venues as V');
    $this->common_model->join_tables=array("vendor as VD");
    $this->common_model->join_on=array("V.vendor_id = VD.vendor_id");
    $data['getvenues']=$this->common_model->get_records(0,'V.*',"VD.user_id = '".$this->session->userdata('user_id')."'");
    $this->common_model->initialise('facilities');
    $data['getallfacilities']=$this->common_model->get_records(0,'*','');
    $this->common_model->initialise('venue_facilities as VF');
    $this->common_model->join_tables=array('venues as V','facilities as F');
    $this->common_model->join_on=array("VF.venue_id = V.venue_id","VF.facility_id = F.facility_id");
    $data['getdetails']=$this->common_model->get_record_single("VF.venue_id = '$vid' and VF.facility_id = '$fid'","F.*,V.venue_id,V.venue_display_name");
    $this->layout->view($this->view_dir,$data);
    }
public function editfacilitydetails(){
    $venue_id=$this->input->post('venue');
	$facility_id=$this->input->post('facility');
        $ofacility_id=$this->input->post('ofacility');
        $facilitytype=$this->input->post('facility');
       $this->common_model->initialise('venue_facilities');
      $this->common_model->array=array('venue_id'=>$venue_id,'facility_id'=>$facility_id);
     $update=$this->common_model->update("venue_id = '$venue_id' and facility_id = '$ofacility_id'");
     if($update==FALSE){
           redirect(base_url("vendors/managefacilities/{$venue_id}"));  
     }
         
  }
public function updatefstatus($id,$status,$vid)
{
    if($status == 1){
	$statusnew = 0;
	}
	if($status == 0 || $status == '' || $status == "NULL"){
	$statusnew = 1;
	}
	$datastatus=$statusnew;
    $this->common_model->initialise('venue_facilities');
    $this->common_model->status=$datastatus;
    $where="facility_id = '$id' and venue_id = '$vid'";
    $this->common_model->set_status($where);
    redirect(base_url("vendors/managefacilities/$vid"));
}
public function userslist(){
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
				$link='<a href="'.base_url().'admin/updatestatus/'.$aRow['user_id'].'/'.$aRow["status"].'/'.$aRow['user_type'].'" style="color:black"><i class="fa fa-remove" title="Active"></i></a>';
			}else if($status==0 || $status='' || $status='NULL'){
				$statusn="<i class='fa fa-remove' title='Inactive'></i>";
				$link='<a href="'.base_url().'admin/updatestatus/'.$aRow['user_id'].'/'.$aRow["status"].'/'.$aRow['user_type'].'" style="color:black"><i class="fa fa-check" title="Inactive"></i></a>';
			}
			$row[4]=$statusn;
			$row[5]=$link.'<a href="'.base_url().'admin/viewvendor/'.$aRow['user_id'].'" style="color:black"><i class="fa fa-eye" title="view"></i></a>'.'<a href="'.base_url().'admin/edituserinfo/'.$aRow['user_id'].'" style="color:black"><i class="fa fa-pencil" title="Edit"></i></a>';
			
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
public function slotslist(){
	$aColumns = array('TS.slot_id','TS.day_id','TS.slot_from_time','TS.slot_to_time','TS.status','V.venue_id','V.venue_display_name');
	$this->common_model->initialise("time_slots as TS");
	$this->common_model->join_tables=array("venues as V","working_hours as W");
	$this->common_model->join_on=array("TS.venue_id = V.venue_id");
	//$this->common_model->left_join = array('left','left');
	$where="TS.venue_id = '".$_POST['venue_id']."'";
	$data=$this->common_model->getTable($aColumns,$where,'','','TS.slot_id');
	$output=$data['output'];
	$count=0;
	$i=$this->input->get_post('iDisplayStart')+1;
		foreach($data['result'] as $aRow){
		$count++;
			$row=array();
			foreach($aColumns as $col){
				$col=trim($col,'TS.');
				$col=trim($col,'V.');
				$col=trim($col,'W.');
				$row[]=$aRow[$col];
			}
			$row[0]=$i;
			$i=$i+1;
			$row[1]=$aRow['venue_display_name'];
			//$row[2]=$aRow['day_id'];
			$row[2]=$aRow['slot_from_time'];
			$row[3]=$aRow['slot_to_time'];
		    //$row[4] = $devicetype;
			$status=$aRow['status'];
			if($status ==1){
				$statusn="<i class='fa fa-check' title='Active'></i>";
				$link='<a href="'.base_url().'vendors/updatestatus/'.$aRow['slot_id'].'/'.$aRow["status"].'/13/'.$aRow['venue_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-remove" title="Active"></i></a>';
			}else if($status==0 || $status='' || $status='NULL'){
				$statusn="<i class='fa fa-remove' title='Inactive'></i>";
				$link='<a href="'.base_url().'vendors/updatestatus/'.$aRow['slot_id'].'/'.$aRow["status"].'/13/'.$aRow['venue_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-check" title="Inactive"></i></a>';
			}
			$row[4]=$statusn;
			$row[5]=$link.'<a href="'.base_url().'vendors/viewslotinfo/'.$aRow['venue_id'].'/'.$aRow['slot_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-eye" title="view"></i></a>'.'<a href="'.base_url().'vendors/editslotinfo/'.$aRow['slot_id'].'/'.$aRow['venue_id'].'" style="color:black"><i class="fa fa-pencil" title="Edit"></i></a>';
				
			$output['aaData'][]=$row;
				
	}
	
	if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
		echo json_encode($output);
	
}
public function addslots($venueid){
	$data = array();
        $data['venuedetails']=$this->venueslotdetails($venueid);
        $data['venueid'] = $venueid;
        $data['getallcategories']=$this->getallcategoriesdata("categories");
        $data['getallsubcategories']=$this->getallcategoriesdata("sub_categories");
        $data['getallsubsubcategories']=$this->getallcategoriesdata("sub_sub_categories");
        $data['getallvenues']=$this->getallcategoriesdata("venues");
         if (isset($_POST['timeslotsubmit'])) {
            $this->load->library("form_validation");
            $this->form_validation->set_rules("venue_id", "Venue Name", "required|trim");
            $this->form_validation->set_rules("cat_id", "Category Name", "required|trim");
            $this->form_validation->set_rules("frm_dte", "From Time", "required");
            $this->form_validation->set_rules("to_dte", "To Time", "required");
            $this->form_validation->set_rules("max_limit", "Maximum Limit", "required");
            $this->form_validation->set_message("required", "%s Should not be Empty");
            if ($this->form_validation->run("add_slots") == FALSE) {
                $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
            } else {
                $categoryid = $this->input->post('cat_id');
                $subcategoryid = $this->input->post('subcat_id');
                $subsubcategoryid = $this->input->post('subsubcat_id');
                $slotfromtimes = $this->input->post('frm_dte');
                $slottotimes = $this->input->post('to_dte');
                $this->common_model->initialise('working_hours as W');
                $this->common_model->join_tables = array("venues as V", "categories as C", "venue_category as VC");
                $this->common_model->join_on = array("W.venue_id=V.venue_id", "W.category_id=C.category_id", "W.category_id=VC.category_id");
                $select = "W.*,V.venue_id as venueid";
                $where = "V.venue_id = '$venueid'";
                $getslots = $this->common_model->get_records(0, $select, $where, '', '', 'W.day_id');
                $this->common_model->initialise("time_slots as TS");
                $this->common_model->join_tables = array("working_hours as W");
                $this->common_model->join_on = array("TS.venue_id=W.venue_id");
                $where = "TS.venue_id = '$venueid' AND TS.category_id='$categoryid' AND TS.sub_category_id='$subcategoryid' AND TS.sub_sub_category_id='$subsubcategoryid'";
                $getslotsdata = $this->common_model->get_records(0, "*", $where, '', '', "TS.slot_id");
                $data = $getslots;
                if (!empty($data)) {
                    $maxlimits = $this->input->post('max_limit');
                    $count = 1;
                    foreach ($slotfromtimes as $keys => $slotfromtime) {
                        if ($slotfromtime >= $data[0]->start_time && $slottotimes[$keys] <= $data[0]->end_time) {
                            $this->common_model->initialise('time_slots');
                            $wheree = "venue_id = '$venueid' AND category_id='$categoryid' AND sub_category_id='$subcategoryid' and slot_from_time between '$slotfromtime' AND '$slottotimes[$keys]' and slot_to_time between '$slotfromtime' AND '$slottotimes[$keys]'";
                            $getslotsdata1 = $this->common_model->get_record_single($wheree, "*");
                            if (empty($getslotsdata1)) {
                                $slotdata = array(
                                    "venue_id" => $venueid,"slot_from_time" => $slotfromtime,"slot_to_time" => $slottotimes[$keys],"status" => 1,"created_by" => $this->session->userdata['user_id'],"category_id" => $this->input->post('cat_id'),"sub_category_id" => $this->input->post('subcat_id'),"sub_sub_category_id" => $this->input->post('subsubcat_id'),"quantity" => $maxlimits[$keys]);
                               $inserttimeslot = $this->db->insert("tbl_time_slots", $slotdata);
                            } else {
                                $this->session->set_flashdata("error_slot", "Slot Already Exists");
                                redirect(base_url("vendors/addslots/$venueid"));
                            }
                  } else {
                            $this->session->set_flashdata("error_slot_time", "Slot Timings Should match the Working Hours");
                        redirect(base_url("vendors/addslots/$venueid"));
                           }
                        
                    }
                    if ($inserttimeslot) {
                        $this->session->set_flashdata("success_slot", "Slot Added Successfully");
                         redirect(base_url("vendors/manageslots/$venueid"));
                    }
                }
          }
        }
         $this->layout->view($this->view_dir, $data);
}
private function venueslotdetails($venueid){
    $this->common_model->initialise('venues as V');
        $this->common_model->join_tables = array("venue_category as VC", "venue_sub_category as VSC","venue_sub_sub_categories as VSSC","working_hours as W");
        $this->common_model->join_on = array("V.venue_id = VC.venue_id", "V.venue_id = VSC.venue_id","V.venue_id = VSSC.venue_id","V.venue_id = W.venue_id");
        $this->common_model->left_join = array('left', 'left','left','left');
        return $this->common_model->get_record_single("V.venue_id = '$venueid'", 'V.*,VC.category_id,VSC.sub_category_id,VSSc.sub_sub_category_id,W.start_time,W.end_time');
}
public function editslotinfo($slot_id,$venueid){
	$data['venueid'] = $venueid;
        $this->common_model->initialise("categories");
        $data['getallcategories']=$this->getallcategoriesdata("categories");
        $data['getallsubcategories']=$this->getallcategoriesdata("sub_categories");
        $data['getallsubsubcategories']=$this->getallcategoriesdata("sub_sub_categories");
        $this->common_model->initialise("venues");
        $data['getallvenues'] = $this->common_model->get_records(0, "*", '');
        $this->common_model->initialise("time_slots as TS");
        $this->common_model->join_tables = array("venues as V", "categories as C", "sub_categories as S", "working_hours as W");
        $this->common_model->join_on = array("TS.venue_id=V.venue_id", "TS.category_id = C.category_id", "TS.sub_category_id = S.sub_category_id", "TS.venue_id = W.venue_id");
        $this->common_model->left_join = array("left", "left", "left", "left", "left", "left");
        $where = "slot_id = " . $slot_id;
        $select = "TS.*,V.venue_display_name,C.category_name,S.sub_category_name";
        $data['editslotinfo'] = $this->common_model->get_record_single($where, $select);
        $this->layout->view($this->view_dir, $data); 
	
}
public function editslotdetails(){
     $data = array();
         if (isset($_POST['timeslotsubmit'])) {
            $this->load->library("form_validation");
            $this->form_validation->set_rules("venue_id", "Venue Name", "required|trim");
            $this->form_validation->set_rules("cat_id", "Category Name", "required|trim");
            $this->form_validation->set_rules("subcat_id", "Subcategory Name", "required|trim");
            $this->form_validation->set_rules("subsubcat_id", "SubSubcategory Name", "required|trim");
            //$this->form_validation->set_rules("day_id","Day","required|trim");
            $this->form_validation->set_rules("frm_dte", "From Time", "required");
            $this->form_validation->set_rules("to_dte", "To Time", "required");
            $this->form_validation->set_rules("max_limit", "Maximum Limit", "required");
            $this->form_validation->set_message("required", "%s Should not be Empty");
            if ($this->form_validation->run("add_slots") == FALSE) {
                $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
            } else {
                $venueid = $this->input->post('venue_id');
                $categoryid = $this->input->post('cat_id');
                $subcategoryid = $this->input->post('subcat_id');
                $subsubcategoryid = $this->input->post('subsubcat_id');
                 $maxlimit = $this->input->post('max_limit');
                 $slotfromtime = $this->input->post('frm_dte');
                $slottotime = $this->input->post('to_dte');
                $slotid = $this->input->post('slot_id');
                $this->common_model->initialise('working_hours as W');
                $this->common_model->join_tables = array("venues as V", "categories as C", "venue_category as VC");
                $this->common_model->join_on = array("W.venue_id=V.venue_id", "W.category_id=C.category_id", "W.category_id=VC.category_id");
                $select = "W.*,V.venue_id as venueid";
                $where = "V.venue_id = '$venueid'";
                $getslots = $this->common_model->get_records(0, $select, $where, '', '', 'W.day_id');
                $this->common_model->initialise("time_slots as TS");
                $this->common_model->join_tables = array("working_hours as W");
                $this->common_model->join_on = array("TS.venue_id=W.venue_id");
                $where = "TS.venue_id = '$venueid' AND TS.category_id='$categoryid' AND TS.sub_category_id='$subcategoryid' AND TS.sub_sub_category_id='$subsubcategoryid'";
                $getslotsdata = $this->common_model->get_records(0, "*", $where, '', '', "TS.slot_id");
                $data = $getslots;
                if (!empty($data)) {
                    if ($slotfromtime >= $data[0]->start_time && $slottotime <= $data[0]->end_time) {
                        $this->common_model->initialise('time_slots');
                        $redirectvenueid = $this->input->post('rdirtvenueid');
                        $wheree = "venue_id = '$venueid' AND category_id='$categoryid' AND sub_category_id='$subcategoryid' and slot_from_time between '$slotfromtime' AND '$slottotime' and slot_to_time between '$slotfromtime' AND '$slottotime'";
                        $getslotsdata1 = $this->common_model->get_record_single($wheree, "*");
                    if (empty($getslotsdata1)) {
                            $slotdata = array("slot_from_time" => $slotfromtime,"slot_to_time" => $slottotime,"quantity" => $maxlimit);
                            $this->common_model->initialise("time_slots");
                            $this->common_model->array = $slotdata;
                            $where = "slot_id = " . $slotid;
                            $timeslotupdatedata = $this->common_model->update($where);
                            if ($timeslotupdatedata) {
                                $this->session->set_flashdata("success_slot", "Slot Added Successfully");
                                redirect(base_url("vendors/editslotinfo/$slotid/$venueid"));
                            }
                        } else {
                            $this->session->set_flashdata("error_slot", "Slot Already Exists");
                            redirect(base_url("vendors/editslotinfo/$slotid/$venueid"));
                            //echo "slot already exists";
                        }
                    } else {
                        $this->session->set_flashdata("error_slot_time", "Slot Timings Should match the Working Hours");
                        redirect(base_url("vendors/editslotinfo/$slotid/$venueid"));
                    }
                    if ($inserttimeslot == FALSE) {
                        $this->session->set_flashdata("success_slot", "Slot Updated Successfully");
                        redirect(base_url("vendors/manageslots/$venueid"));
                    }
                }
            }
        }
	}
public function viewslotinfo($venueid,$slot_id){
        $data=array();
        $data['venue_id']=$venueid;
        $this->common_model->initialise("time_slots as TS");
	$this->common_model->join_tables=array("venues as V","categories as C","sub_categories as S","working_hours as W");
	$this->common_model->join_on=array("TS.venue_id=V.venue_id","TS.category_id = C.category_id","TS.sub_category_id = S.sub_category_id","TS.day_id = W.day_id");
	$this->common_model->left_join=array("left","left","left","left","left","left");
	$where="slot_id = ".$slot_id;
	$select="TS.*,V.venue_display_name,C.category_name,S.sub_category_name";
	$data['editslotinfo']=$this->common_model->get_record_single($where,$select);
        $this->layout->view($this->view_dir,$data);
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
	$this->common_model->initialise('vendor');
	$where = "company_name = '".$id."' ";
	$result = $this->common_model->get_record_single($where, 'vendor_id');
	$venid=$result->vendor_id;
	//$venid=1;
    $this->common_model->initialise('venues');
	$venues=$this->common_model->get_records(0,'*',"vendor_id = '".$venid."'");
     echo json_encode($venues);
}

//Manage Pricing start
public function managepricing($venue_id){
    $data=array();
    $data['venue_id']=$venue_id;
    $this->layout->view($this->view_dir,$data);
   }
public function viewprice($id, $venueid)
    {
        $data['venueid'] = $venueid;
        $this->common_model->initialise('prices as P');
        $this->common_model->join_tables = array('venues as V','price_details as PD','membership_types as M','sub_categories as S', 'vendor as VD','sub_sub_categories as SC');
        $this->common_model->join_on = array("P.venue_id = V.venue_id","P.price_id = PD.price_id", "PD.type = M.membership_type_id", "P.base_type_id = S.sub_category_id", "V.vendor_id = VD.vendor_id", "P.base_type_id = SC.sub_sub_category_id");
        $this->common_model->left_join = array('left', 'left', 'left', 'left', 'left', 'left');
        $select = "PD.*,VD.company_name,V.venue_display_name,M.membership_name,S.sub_category_name,SC.sub_sub_category_name,V.venue_display_name as vname";
        $where = "P.price_id = " . $id;
        $data['getdetails'] = $this->common_model->get_record_single($where, $select);
        $this->layout->view($this->view_dir,$data);
       }
public function addpricing($venueid){
   $data = array();
        $data['venueid'] = $venueid;
        $this->common_model->initialise('venue_sub_category as VS');
        $this->common_model->join_tables=array("sub_categories as SC");
        $this->common_model->join_on=array("VS.sub_category_id = SC.sub_category_id");
        $data['venuesubcategorydata']=$this->common_model->get_records(0,"SC.sub_category_id,SC.sub_category_name","VS.venue_id = '$venueid'");
        $this->common_model->initialise('venue_sub_sub_categories');
        $data['venuesubsubcategorydata']=$this->common_model->get_records(0,"*","venue_id = '$venueid'");
        $this->load->library("form_validation");
        //$this->form_validation->set_rules('vendors','Vendor name','required|trim|min_length[4]');
       $this->form_validation->set_rules('scategory',"Sub Category",'required');
        if (isset($_POST['usersubmit'])) {

            if ($this->form_validation->run('add_user') == FALSE) { //echo "test";
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $type=3;
                $basetypeid=$this->input->post('scategory');
                if(!empty($this->input->post('sscategory'))){
                    $type=4;
                    $basetypeid=$this->input->post('sscategory');
                }
                $this->common_model->initialise('prices');
                $this->common_model->array=array("price_type"=>$type,"base_type_id"=>$basetypeid,"venue_id"=>$this->input->post('venue'),"status"=>1);
                $price_id = $this->common_model->insert_entry();
                $ptype=$this->input->post('type');
                $amount=$this->input->post('amount');
                $damount=$this->input->post('damount');
                $dtype=$this->input->post('dtype');
                for($i=0;$i<6;$i++){
                    $dtype=1;
                    if($dtype[$i]=='flat'){
                        $dtype=2;
                    }
                    if(!empty($amount[$i])){
                    $price_details_array=array("price_id"=>$price_id,"type"=>$ptype[$i],"amount"=>$amount[$i],"discount_type"=>$dtype,"discount_amount"=>$damount[$i]);
                }
                $this->common_model->initialise('price_details');
                $this->common_model->array=$price_details_array;
                $this->common_model->insert_entry();
                }
                   if (isset($price_id)) {
                    $this->session->set_flashdata("success", "You Have Added Pricing Successfully");
                    redirect(base_url("vendors/managepricing/$venueid"));
                }
            }
        }
        $this->layout->view($this->view_dir,$data);
}
public function editprice($id, $venueid,$type)
    {
        $data = array();
        $data['priceid'] = $id;
        $data['venueid'] = $venueid;
        $data['type']=$type;
        $this->common_model->initialise('prices as P');
        $this->common_model->join_tables = array('price_details as PD','venues as V', 'membership_types as M', 'sub_categories as S','sub_sub_categories as SC');
        $this->common_model->join_on = array("P.price_id = PD.price_id","P.venue_id = V.venue_id", "PD.type = M.membership_type_id", "P.base_type_id = S.sub_category_id", "P.base_type_id = SC.sub_sub_category_id");
        $this->common_model->left_join = array('left', 'left', 'left', 'left', 'left');
        $select = "P.*,PD.*,M.membership_type_id,M.membership_name,S.sub_category_name,SC.sub_sub_category_name";
        $where = "P.price_id = '$id' and PD.type = '$type'";
        $data['getdetails'] = $this->common_model->get_record_single($where, $select);
        if (isset($_POST['usersubmit'])) {
            $this->common_model->initialise('price_details');
            $this->common_model->array = array('amount' => $this->input->post('amount'),'discount_amount' => $this->input->post('damount'));
            $where = "price_id = '$id' and type = '$type'";
            $update = $this->common_model->update($where);
            if ($update == false) {
                $this->session->set_flashdata("success", "You Have Modified Pricing Successfully");
                redirect(base_url("vendors/managepricing/$venueid"));
            }
        }
        $this->layout->view($this->view_dir,$data);
         }
public function getPData(){
     $aColumns = array('P.price_id', 'V.venue_display_name','P.price_type','S.sub_category_name','SS.sub_sub_category_name','M.membership_name', 'PD.amount','PD.type', 'P.status');
        $this->common_model->initialise("prices as P");
        $this->common_model->join_tables = array("price_details as PD","venues as V","sub_categories as S","sub_sub_categories as SS","membership_types as M" );
        $this->common_model->join_on = array("P.price_id = PD.price_id","P.venue_id = V.venue_id","P.base_type_id = S.sub_category_id","P.base_type_id = SS.sub_sub_category_id","PD.type = M.membership_type_id");
        $this->common_model->left_join = array('left','left', 'left', 'left','left');
        $where = array("P.venue_id" => $_POST['venue_id']);
        $data = $this->common_model->getTable($aColumns, $where, 'P.price_id');
        $output = $data['output'];
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $count++;
            $row = array();
            foreach ($aColumns as $col) {
                $col = trim($col, 'P.');
                $col = trim($col, 'V.');
                 $col = trim($col, 'PD.');
                  $col = trim($col, 'S.');
                   $col = trim($col, 'M.');
                $row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;
            $row[1] = $aRow['venue_display_name'];
           if($aRow['price_type']=='3'){
               $row[2]=$aRow['sub_category_name'];
           }else{
               $row[2]=$aRow['sub_sub_category_name'];
           }
           $row[3]=$aRow['membership_name'];
           $row[4] = $aRow['amount'];
            $status = $aRow['status'];
            if ($status == 1) {
                $statusn = "<i class='fa fa-check' title='Active'></i>";
                $link = '<a href="' . base_url() . 'vendors/updatestatus/' . $aRow['price_id'] . '/' . $aRow["status"] . '/11" style="color:black;margin-right:5px;"><i class="fa fa-remove" title="Inactive"></i></a>';
            } else if ($status == 0 || $status == '' || $status == 'NULL') {
                $statusn = "<i class='fa fa-remove' title='Inactive'></i>";
                $link = '<a href="' . base_url() . 'vendors/updatestatus/' . $aRow['price_id'] . '/' . $aRow["status"] . '/11" style="color:black;margin-right:5px;"><i class="fa fa-check" title="Active"></i></a>';
            }
            $row[5] = $statusn;
            $row[6] = $link . '<a href="' . base_url() . 'vendors/viewprice/' . $aRow['price_id'] . '/' . $_POST['venue_id'] . '" style="color:black"><i class="fa fa-eye" title="View"></i></a>&nbsp;&nbsp;<a href="' . base_url() . 'vendors/editprice/' . $aRow['price_id'] . '/' . $_POST['venue_id'] .'/'.$aRow['type']. '" style="color:black"><i class="fa fa-pencil" title="Edit"></i></a>';
            $output['aaData'][] = $row;
        }
        if ($this->input->get_post('sSearch')) {
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
  $this->common_model->initialise('categories');
  $categories=$this->common_model->get_records(0,'*','');
  echo json_encode($categories);
}
public function getsubcategories(){
  $this->common_model->initialise('sub_categories');
  $subcategories=$this->common_model->get_records(0,'*','');
  echo json_encode($subcategories);
}
public function getsubsubcategories(){
  $this->common_model->initialise('sub_sub_categories');
  $subcategories=$this->common_model->get_records(0,'*','');
  echo json_encode($subcategories);
}
public function getfacilities(){
  $this->common_model->initialise('facilities');
  $facilities=$this->common_model->get_records(0,'*','');
  echo json_encode($facilities);
  
	/*$this->common_model->initialise("facilities as F");
	$this->common_model->join_tables = array("venue_facilities as VF","venue_users as VU");
	$this->common_model->join_on = array("F.facility_id = VF.facility_id","VF.venue_id = VU.venue_id");
	$groupby="VF.facility_id";
	$where=array("VU.user_id" => $this->session->userdata('user_id'));
	$facilities=$this->common_model->get_records(0,"F.*,F.status as facilitystatus,F.facility_id as facid",$where,$col = 0, $order = 'desc',$groupby);
	echo json_encode($facilities);*/
}
public function manageusers($vid)
{
  $data=array();
  $data['venue_id']=$vid;
  $this->layout->view($this->view_dir,$data);
 }
public function getMData(){
    $aColumns = array('VU.user_id','V.venue_id','V.venue_display_name','U.name','UT.user_type','U.phone','VU.status');
	$this->common_model->initialise("venue_users as VU");
	$this->common_model->join_tables = array("venues as V","user_types as UT","users as U","vendor as VD");
	$this->common_model->join_on = array("VU.venue_id = V.venue_id","VU.user_id = UT.user_id","U.user_id = VU.user_id","V.vendor_id = VD.vendor_id");
	$this->common_model->left_join = array('left','left','left','left');
	$id=$this->session->userdata('user_id');
       // $where=array("VD.user_id"=>$id);
        $venue_id=$_POST['venue_id'];
        $where=array("V.venue_id"=>$venue_id);
	$data=$this->common_model->getTable($aColumns,$where,'VU.user_id');
	$output=$data['output'];
	$count=0;
	$i=$this->input->get_post('iDisplayStart')+1;
	foreach($data['result'] as $aRow){
		$count++;
		$row=array();
		foreach($aColumns as $col){
				$col=trim($col,'VU.');
                                $col=trim($col,'V.');
				$col=trim($col,'U.');
                                $col=trim($col,'UT.');
            $row[]=$aRow[$col];
			}
			$row[0]=$i;
			$i=$i+1;
                        $row[1]=$aRow['venue_display_name'];
                        $row[2]=$aRow['name'];
                        if($aRow['user_type']==3){
                             $row[3]="Manager";
                        }else if($aRow['user_type']==4){
                             $row[3]="Staff";
                        }
                       // $row[2]=$price;
			$row[4]=$aRow['phone'];
			$row[5]='<a href="'.base_url().'vendors/viewuserinfo/'.$aRow['venue_id'].'/'.$aRow['user_id'].'" style="color:black" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;<a href="'.base_url().'vendors/edituserinfo/'.$aRow['venue_id'].'/'.$aRow['user_id'].'" style="color:black" title="Edit"><i class="fa fa-pencil"></i></a>';
			$output['aaData'][]=$row;
			}
	if($this->input->get_post('sSearch')){
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
		echo json_encode($output);
}
public function adduser($venue_id){
	$data=array();
        $data['venue_id']=$venue_id;
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
			$venue_id=$this->input->post('venue');
			$userdata=array("name"=>$this->input->post('uname'),"email"=>$this->input->post('u_email'),"password"=>md5($this->input->post('u_passw')),"gender"=>$this->input->post('gender'),"phone"=>$this->input->post('u_phone'));
			$this->common_model->initialise("users");
			$this->common_model->array=$userdata;
			$userid=$this->common_model->insert_entry();
			if(isset($userid)){
			$datausertype=array("user_id"=>$userid,"user_type"=>$this->input->post('usertype'));
			$this->common_model->initialise("user_types");
			$this->common_model->array=$datausertype;
			$insertusertype=$this->common_model->insert_entry();
			if(isset($insertusertype)){
			$venueuserdata=array("user_id"=>$userid,"venue_id"=>$venue_id,"status"=>1);
			$this->common_model->initialise("venue_users");
			$this->common_model->array=$venueuserdata;
			$insertvenueuser=$this->common_model->insert_entry();
			}
			}
			$target_dir="images/profiles";
			$targetfile=$target_dir."/"."{$userid}_user".".jpg";
			$userdata['profile_pic']="{$userid}_user".".jpg";
			$this->updatedetails($userdata,"users",$userid);
			move_uploaded_file($_FILES['profile_pic']['tmp_name'],$targetfile);
			if(isset($insertvenueuser)){
			$this->session->set_flashdata("success","You Have Added User Successfully");
                	redirect(base_url("vendors/manageusers/{$venue_id}"));
			}
		}
		}
                $this->layout->view($this->view_dir,$data);
	}
public function viewuserinfo($venueid,$userid){
        $data['venue_id']=$venueid;
	$this->common_model->initialise("venue_users as VU");
	$this->common_model->join_tables=array("venues as V","users as U","user_types as Ut");
	$this->common_model->join_on=array("VU.venue_id=V.venue_id","VU.user_id=U.user_id","Ut.user_id=U.user_id");
	$where = "VU.user_id = ".$userid;
	$select = "VU.*,VU.status as venueuserstatus,V.venue_display_name,V.venue_id as venueid,U.*,Ut.user_type as usertype";
	$data['viewuserdetails']=$this->common_model->get_record_single($where,$select);
	$this->layout->view($this->view_dir,$data);
	}
public function edituserinfo($venueid,$userid){
        $data['venue_id']=$venueid;
	$this->common_model->initialise("venue_users as VU");
	$this->common_model->join_tables=array("venues as V","users as U","user_types as Ut");
	$this->common_model->join_on=array("VU.venue_id=V.venue_id","VU.user_id=U.user_id","Ut.user_id=U.user_id");
	$where = "VU.user_id = ".$userid;
	$select = "VU.*,VU.status as venueuserstatus,V.venue_display_name,V.venue_id as venueid,U.*,Ut.user_type as usertype";
	$data['edituserdetails']=$this->common_model->get_record_single($where,$select);
	$this->layout->view($this->view_dir,$data);
	}

public function edituserdetails(){
			$venueid=$this->input->post('venue_id');
			$userid=$this->input->post('user_id');
			$userdata=array("name"=>$this->input->post('uname'),"email"=>$this->input->post('u_email'),"gender"=>$this->input->post('gender'),"phone"=>$this->input->post('u_phone'));
			$this->common_model->initialise("users");
			$this->common_model->array=$userdata;
			$where="user_id = ".$userid;
			$updateuser=$this->common_model->update($where);
			$datausertype=array("user_id"=>$userid,"user_type"=>$this->input->post('usertype'));
			$this->common_model->initialise("user_types");
			$this->common_model->array=$datausertype;
			$where="user_id = ".$userid;
			$updateusertype=$this->common_model->update($where);
			$venueuserdata=array("user_id"=>$userid,"venue_id"=>$venueid,"status"=>1);
			$this->common_model->initialise("venue_users");
			$this->common_model->array=$venueuserdata;
			$where="user_id = ".$userid;
			$updatevenueuser=$this->common_model->update($where);
			$target_dir="images/profiles";
			$targetfile=$target_dir."/"."{$userid}_user".".jpg";
			$userdata['profile_pic']="{$userid}_user".".jpg";
			$this->updatedetails($userdata,"users",$userid);
			$updatesuccess=move_uploaded_file($_FILES['profile_pic']['tmp_name'],$targetfile);
			if(isset($updatesuccess)){
			$this->session->set_flashdata("user_success","You Have Updated User Successfully");
			redirect(base_url("vendors/manageusers/{$venueid}"));	
			}
			
}
/*
 * Add on section
 * **/
public function manageaddons($venue_id){
    $data=array();
    $data['venue_id']=$venue_id;
    $this->layout->view($this->view_dir,$data);
   }
public function getADData()
    {
        $aColumns = array('V.venue_id','V.venue_display_name','A.base_type','A.base_type_id','C.category_name', 'SC.sub_category_name','SSC.sub_sub_category_name', 'A.addon_name','A.status', 'A.amount', 'U.name', 'A.created_on');
        $this->common_model->initialise("addon as A");
        $this->common_model->join_tables = array("venues as V","categories as C", "sub_categories as SC","sub_sub_categories as SSC", "users as U", "vendor as VD");
        $this->common_model->join_on = array("A.venue_id = V.venue_id","A.base_type_id = C.category_id", "A.base_type_id = SC.sub_category_id","A.base_type_id = SSC.sub_sub_category_id", "A.created_by=U.user_id", "V.vendor_id = VD.vendor_id");
        $this->common_model->left_join = array('left','left', 'left', 'left','left', 'left');
        //echo $this->session->userdata("user_id");
        $where = array("A.venue_id" => $_POST['venue_id']);
        $data = $this->common_model->getTable($aColumns, $where);
        $output = $data['output'];
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $count++;
            $row = array();
            foreach ($aColumns as $col) {
                $col = trim($col, 'A.');
                $col = trim($col, 'V.');
                $col = trim($col, 'U.');
                $col = trim($col, 'SC.');
                 $col = trim($col, 'SSC.');
                $row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;
            $row[1] = $aRow['venue_display_name'];
            if($aRow['base_type']==2){
            $row[2] = $aRow['sub_category_name'];}elseif($aRow['base_type']==3){
                $row[2] = $aRow['sub_sub_category_name'];
            }else{$row[2] = $aRow['category_name'];}
            $row[3] = $aRow['addon_name'];
            $row[4] = $aRow['amount'];
            //$row[5] = $aRow['name'];
           // $row[6] = $aRow['created_on'];
            $status = $aRow['status'];
            if ($status == 1) {
                $statusn = "<i class='fa fa-check' title='Active'></i>";
                $link = '<a href="' . base_url() . 'vendors/updateastatus/' . $aRow['venue_id'] . '/' . $aRow['status'] . '/'. $aRow['base_type_id'].'/'.$aRow['base_type'].'" style="color:black;margin-right:5px;"><i class="fa fa-remove" title="Inactive"></i></a>';
            } else if ($status == 0 || $status == '' || $status == 'NULL') {
                $statusn = "<i class='fa fa-remove' title='Inactive'></i>";
                $link = '<a href="' . base_url() . 'vendors/updateastatus/' . $aRow['venue_id'] . '/' . $aRow['status'] . '/'. $aRow['base_type_id'].'/'.$aRow['base_type'].'" style="color:black;margin-right:5px;"><i class="fa fa-check" title="Active"></i></a>';
            }
            $row[5] = $statusn;
            $row[6] = $link . '<a href="'.base_url() .'vendors/viewaddon/'.$aRow['venue_id'].'/'. $aRow['base_type_id'].'/'.$aRow['base_type'].'" style="color:black;margin-right:5px;"><i class="fa fa-eye" title="View"></i></a>&nbsp;&nbsp;<a href="'.base_url() .'vendors/editaddon/'.$aRow['venue_id'].'/'. $aRow['base_type_id'].'/'.$aRow['base_type'].'" style="color:black;margin-right:5px;"><i class="fa fa-pencil" title="Edit"></i></a>';
            
            $output['aaData'][] = $row;
        }
        if ($this->input->get_post('sSearch')) {
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);
    }
public function updateastatus($venueid,$status,$basetypeid,$basetype){
        if($status==1){
            $statuss=0;
        }else{$statuss=1;}
        $this->common_model->initialise('addon');
        $this->common_model->array=array('status'=>$statuss);
        $update=$this->common_model->update("venue_id = '$venueid' and base_type_id = '$basetypeid' and base_type = '$basetype'");
if($update==false){
    $this->session->set_flashdata("addon_success", "Status Updated Successfully");
                    redirect(base_url("vendors/manageaddons/$venueid"));
}        
    }
public function addaddon($venueid){
    $data = array();
        $data['venueid'] = $venueid;
        $this->common_model->initialise("venues");
        $data['getdetails'] = $this->common_model->get_record_single("venue_id = '$venueid' ","venue_id,vendor_id");
        $data['subcategories'] = $this->getcsubcategories($venueid);
        $data['subsubcategories'] = $this->getcsubsubcategories($venueid);
        $data['facilities'] = $this->getvfacilities($venueid);
        $this->load->library("form_validation");
        $this->form_validation->set_rules("addon","Facility","required");
        $this->form_validation->set_rules("amount", "Amount", "required|trim");
        $this->form_validation->set_message("required", "%s Should not be Empty");
        if (isset($_POST['addonsubmit'])) {
            if ($this->form_validation->run("add_addon") == FALSE) {
                $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
            } else {
                $addondata=array('venue_id'=>$_POST['venue_id'],'amount'=>$_POST['amount'],'status' => 1, 'created_by' => $this->session->userdata['user_id']);
                if($_POST['addon']=='other'){
                    $addondata['base_type_id']=$_POST['type'];
                    $addondata['base_type']=$_POST['ptype'];
                    $addondata['addon_name']=ucfirst($_POST['addon_name']);
                }else{
                    $this->common_model->initialise('facilities');
                    $get=$this->common_model->get_record_single("facility_id = '".$_POST['addon']."'","*");
                    $addondata['base_type_id']=$get->base_type_id;
                    $addondata['base_type']=$get->base_type;
                    $addondata['addon_name']=ucfirst($get->facility_name);
                }
                $this->common_model->initialise('addon');
                $geta=$this->common_model->get_records(0,"*","venue_id = '".$addondata['venue_id']."' and base_type_id = '".$addondata['base_type_id']."' and base_type = '".$addondata['base_type']."' and addon_name = '".$addondata['addon_name']."'");
                if(empty($geta)){
                $this->common_model->array = $addondata;
                $aid = $this->common_model->insert_entry();
                if (isset($aid)) {
                    $this->session->set_flashdata("addon_success", "You Have Added Addon Successfully");
                    redirect(base_url("vendors/manageaddons/$venueid"));
                }
            }else{
             $this->session->set_flashdata("addon_error", "Addon Already Added");
                    redirect(base_url("vendors/addaddon/$venueid"));  
        }}
        }
        $this->layout->view($this->view_dir,$data);
    }
private function getcsubsubcategories($venueid)
    {
        $this->common_model->initialise('venue_sub_sub_categories as VSSC');
        $this->common_model->join_tables = array('venues as V', 'sub_sub_categories as SSC', 'vendor as VD');
        $this->common_model->join_on = array("VSSC.venue_id = V.venue_id", "VSSC.sub_sub_category_id = SSC.sub_sub_category_id", "V.vendor_id = VD.vendor_id");
        $subsubcat = $this->common_model->get_records(0, 'VSSC.*,SSC.sub_sub_category_name', "VSSC.venue_id = '" . $venueid . "'", '', '', "VSSC.sub_sub_category_id");
        return $subsubcat;
    }	
    public function viewaddon($venueid,$basetypeid,$basetype){
        $data=array();
        $data['venueid']=$venueid;
        $data['getdetails']=$this->addondetails($venueid, $basetypeid, $basetype);
        $this->layout->view($this->view_dir,$data);
    }
    public function editaddon($venueid,$basetypeid,$basetype){
        $data=array();
        $data['venueid']=$venueid;
        $data['base_type_id']=$basetypeid;
        $data['base_type']=$basetype;
        $this->common_model->initialise('venues');
        $data['getvdetails']=$this->common_model->get_record_single("venue_id = '$venueid'","vendor_id");
        $data['getdetails']=$this->addondetails($venueid, $basetypeid, $basetype);
        $this->load->library("form_validation");
        $this->form_validation->set_rules("amount", "Amount", "required|trim");
        $this->form_validation->set_message("required", "%s Should not be Empty");
        if (isset($_POST['addonsubmit'])) {
            if ($this->form_validation->run("add_addon") == FALSE) {
                $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
            } else {
                $this->common_model->initialise('addon');
                $this->common_model->array=array('amount'=>$_POST['amount']);
                $update=$this->common_model->update("venue_id = '".$_POST['venue_id']."' and base_type_id = '".$_POST['base_type_id']."' and base_type = '".$_POST['base_type']."'");
            if ($update==FALSE) {
                    $this->session->set_flashdata("addon_success", " Addon Updated Successfully");
                    redirect(base_url("admin/manageaddons/$venueid"));
                }
            }
        }
        $this->layout->view($this->view_dir,$data);
    }
     private function addondetails($venueid,$basetypeid,$basetype){
        $this->common_model->initialise('addon as A');
        $this->common_model->join_tables=array('venues as V','categories as C','sub_categories as SC','sub_sub_categories as SSC');
        $this->common_model->join_on=array('A.venue_id = V.venue_id','A.base_type_id = C.category_id','A.base_type_id = SC.sub_category_id','A.base_type_id = SSC.sub_sub_category_id');
        $this->common_model->left_join=array('left','left','left','left');
        $select="A.base_type,A.amount,A.addon_name,C.category_name,SC.sub_category_name,SSC.sub_sub_category_name,V.venue_display_name";
        $where="A.venue_id = '$venueid' and A.base_type_id = '$basetypeid' and A.base_type = '$basetype'";
        return $this->common_model->get_record_single($where,$select);
    }
/*** Request Coins ***/
	public function managecoins(){
		$data=array();
		$this->common_model->initialise("coins");
		$where="type = 2";
		$data['getallcoins']=$this->common_model->get_records(0,"*",$where);
                $this->layout->view($this->view_dir,$data);
		}
	public function addrequestcoins(){
                $data=array();
                $this->common_model->initialise('users as U');
                $this->common_model->join_tables=array('vendor as VD','venues as V');
                $this->common_model->join_on=array("U.user_id = VD.user_id","VD.vendor_id = V.vendor_id");
                $data['venuedetails']=$this->common_model->get_records(0,"V.venue_id,V.venue_display_name","U.user_id = '".$this->session->userdata('user_id')."'",'','',"V.venue_id");
		if(isset($_POST['addcoin'])){
		$expfromdte=explode("-",$this->input->post('from_date'));
		$fromdate=$expfromdte[2]."-".$expfromdte[0]."-".$expfromdte[1];
               	$exptodte=explode("-",$this->input->post('to_date'));
		$todate=$exptodte[2]."-".$exptodte[0]."-".$exptodte[1];
		$requestcoindata=array("venue_id"=>$this->input->post('venue'),"coins"=>$this->input->post('coins'),"method"=>$this->input->post('method'),"type"=>2,"from_date"=>$fromdate,"end_date"=>$todate,"limit"=>$this->input->post('limit'),"status"=>1);
		$insertcoins=$this->db->insert("tbl_coins",$requestcoindata);
		if(isset($insertcoins)){
			$this->session->set_flashdata("add_coin_success","You Have Added Coins Successfully");
			redirect(base_url("vendors/managecoins"));
		}
		}
                $this->layout->view($this->view_dir,$data);
		}
	public function editrequestcoinsinfo($coinid){
		$data=array();
                $this->common_model->initialise('users as U');
                $this->common_model->join_tables=array('vendor as VD','venues as V');
                $this->common_model->join_on=array("U.user_id = VD.user_id","VD.vendor_id = V.vendor_id");
                $data['venuedetails']=$this->common_model->get_records(0,"V.venue_id,V.venue_display_name","U.user_id = '".$this->session->userdata('user_id')."'",'','',"V.venue_id");
		$this->common_model->initialise("coins");
		$where="coin_id = ".$coinid;
		$select="*";
		$data['editrequestcoininfo']=$this->common_model->get_record_single($where,$select);
		$this->layout->view($this->view_dir,$data);
                }
	public function editrequestcoinsdetails(){
		if(isset($_POST['editcoin'])){
		$coinid=$this->input->post("coin_id");
		$expfromdte=explode("-",$this->input->post('from_date'));
		$fromdate=$expfromdte[2]."-".$expfromdte[0]."-".$expfromdte[1];
               	$exptodte=explode("-",$this->input->post('to_date'));
		$todate=$exptodte[2]."-".$exptodte[0]."-".$exptodte[1];
		$requestcoindata=array("coins"=>$this->input->post('coins'),"method"=>$this->input->post('method'),"type"=>2,"from_date"=>$fromdate,"end_date"=>$todate,"limit"=>$this->input->post('limit'),"status"=>1);
		$this->common_model->initialise("coins");
		$this->common_model->array=$requestcoindata;
		$where="coin_id = ".$coinid;
		$updatecoin=$this->common_model->update($where);
		if(isset($updatecoin)){
		$this->session->set_flashdata("update_coin_success","You Have Updated Coins Successfully");
		redirect(base_url("vendors/managecoins"));	
		}
		}
	}
	/*** End Request Coins ***/
	
	/*** Customers ***/
	public function customerslist(){
	
	$aColumns = array('B.booking_id','B.amount','B.created_on','B.status','SC.sub_category_name','U.name','U.user_id');
	$this->common_model->initialise("booking as B");
	$this->common_model->join_tables = array("venues as V","sub_categories as SC","users as U","vendor as VD");
	$this->common_model->join_on = array("B.venue_id = V.venue_id","B.sub_category_id = SC.sub_category_id","B.user_id=U.user_id","V.vendor_id=VD.vendor_id");
	$this->common_model->left_join = array('left','left','left','left');
	//echo ;
	//$where="VD.vendor_id = ".$this->session->userdata("user_id");
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
			$row[5]='<a href="'.base_url().'vendors/viewcustomerinfo/'.$aRow['user_id'].'" style="color:black"><i class="fa fa-eye" title="View"></i></a>';
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
	$this->load->view("vendors/manage_customers",$data);
}
public function viewcustomerinfo($userid){
	$data = array();
	$this->common_model->initialise("booking as B");
	$this->common_model->join_tables=array("users as U");
	$this->common_model->join_on=array("B.user_id = U.user_id");
	$select = "*";
	$where = "U.user_id = ".$userid;
	$data['getcustomerdata']=$this->common_model->get_record_single($where,$select);
	$this->load->view("vendors/view_customers",$data);
}
	/*** End of Customers ***/
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
	if(isset($_POST['pwdsubmit'])){
	$this->load->library("form_validation");
	$this->form_validation->set_rules("c_pwd","Confirm Password","required|trim");
	$this->form_validation->set_rules("n_pwd","New Password","required|trim");
	$this->form_validation->set_rules("c_n_pwd","Confirm New Password","required|trim");
	$this->form_validation->set_message("required","%s Should not be Empty");
		if($this->form_validation->run("changepwd")==FALSE){
		$this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
	}else if($c_pwd != $getuserid->password){
		$this->session->set_flashdata("c_pwd_error","Current Password is Wrong");
		redirect(base_url("vendors/changepassword"));
		
	}else if($n_pwd != $c_n_pwd){
		$this->session->set_flashdata("n_pwd_error","Password and Confirm Password Should Match");
		redirect(base_url("vendors/changepassword"));
	}else{
				$passdata=array("password"=>md5($n_pwd));
				$this->common_model->initialise("users");
				$this->common_model->array=$passdata;
				$where="user_id = ".$userid;
				$updatepwddata=$this->common_model->update($where);
				if(isset($updatepwddata)){
				$this->session->set_flashdata("update_pwd","Password Updated Successfully");
				redirect(base_url("vendors/changepassword"));
				}
			}
}
        $this->layout->view($this->view_dir,$data);
}    
public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_phone');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_type');
        
        $this->session->sess_destroy();
        redirect(base_url());
        }
        
        private function getvcategories(){
            $this->common_model->initialise('venue_category as VC');
            $this->common_model->join_tables=array('venues as V','categories as C','vendor as VD');
           $this->common_model->join_on=array("VC.venue_id = V.venue_id","VC.category_id = C.category_id","V.vendor_id = VD.vendor_id");
           $cat=$this->common_model->get_records(0,'VC.*,C.category_name',"VD.user_id = '".$this->session->userdata('user_id')."'",'','',"VC.category_id");
           return $cat;
        }
        private function getvvenues(){
            $this->common_model->initialise('venues as V');
            $this->common_model->join_tables=array('vendor as VD');
            $this->common_model->join_on=array('V.vendor_id = VD.vendor_id');
            $venues=$this->common_model->get_records(0,'V.*',"VD.user_id = '".$this->session->userdata('user_id')."'");
            return $venues;
        }
        private function getcsubcategories(){
            $this->common_model->initialise('venue_sub_category as VSC');
            $this->common_model->join_tables=array('venues as V','sub_categories as SC','vendor as VD');
            $this->common_model->join_on=array("VSC.venue_id = V.venue_id","VSC.sub_category_id = SC.sub_category_id","V.vendor_id = VD.vendor_id");
            $subcat=$this->common_model->get_records(0,'VSC.*,SC.sub_category_name',"VD.user_id = '".$this->session->userdata('user_id')."'",'','',"VSC.sub_category_id");
            return $subcat;
        }
        private function getvfacilities(){
            $this->common_model->initialise('venue_facilities as VF');
           $this->common_model->join_tables=array('venues as V','facilities as F','vendor as VD');
            $this->common_model->join_on=array("VF.venue_id = V.venue_id","VF.facility_id = F.facility_id","V.vendor_id = VD.vendor_id");
            $facilities=$this->common_model->get_records(0,'VF.*,F.facility_name',"VD.user_id = '".$this->session->userdata('user_id')."'",'','',"VF.facility_id");
            return $facilities;
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
                    redirect(base_url("vendors/zipfiles"));    
                      }  else{
                           $this->session->set_flashdata('error', 'Check the File Uploaded');
                    redirect(base_url("vendors/zipfiles"));
                      }                  
            }
            else{
                           $this->session->set_flashdata('error', 'Check the File Uploaded');
                    redirect(base_url("vendors/zipfiles"));
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
     public function manageimages($venueid)
{
    $data=array();
    $data['venueid']=$venueid;
    $this->common_model->initialise("venues");
    $venuede=$this->common_model->get_record_single("venue_id = '$venueid'","vendor_id");
    $data['vendorid']=$vendorid=$venuede->vendor_id;
    $data['images']=$this->getimages($venueid,$vendorid);
    $this->layout->view($this->view_dir,$data);
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
       redirect(base_url("vendors/manageimages/$venueid/$vendorid"));
   }
}
public function addimages($venueid){
     $data=array();
     $data['venueid']=$venueid;
     $this->common_model->initialise("venues");
    $venuede=$this->common_model->get_record_single("venue_id = '$venueid'","vendor_id");
    $data['vendorid']=$vendorid=$venuede->vendor_id;
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
                    redirect(base_url("vendors/manageimages/$venueid/$vendorid"));    
                 } else {
                     if (move_uploaded_file($_FILES["iupload"]["tmp_name"],$target_file)) 
                {
                      $this->session->set_flashdata('success', 'Image Uploaded Successfully');
                     redirect(base_url("vendors/manageimages/$venueid/$vendorid"));    
                     }
                 }
             }
      }
      $this->layout->view($this->view_dir,$data);
    }
}
?>