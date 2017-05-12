<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_common_model extends CI_Model{
	
	public function getusersdetails(){
		
	if(isset($_POST)){
	$username=$this->input->post('email1');
	$password=md5($this->input->post('password1'));
	$this->db->select("*");
	$this->db->from("tbl_users");
	$this->db->where("email",$username);
	$this->db->where("password",$password);
	$getresult=$this->db->get()->result_array();
	//echo $this->db->last_query();exit;
	return $getresult;
		
		}
	}
	public function getusertypes($userid){
		
	$this->db->select("*");
	$this->db->from("tbl_user_types as utp");
	$this->db->join("tbl_users as u","u.u_id=utp.user_id");
	$this->db->where("utp.user_id",$userid);
	$getusertype=$this->db->get()->result_array();
	//echo $this->db->last_query();exit;
		return $getusertype;
	}
	public function getcategories(){
		
	$this->db->select("*");
	$this->db->from("tbl_categories");
	$getallcategories=$this->db->get()->result_array();
	return $getallcategories;
	}
	public function getvendorcompanynames(){
	/*$query=$this->db->query("select * from tbl_vendordetails");
	$getallcompanies=$query->result_array();*/
	$this->db->select("*");	
	$this->db->from("tbl_vendordetails");
	$getallcompanies=$this->db->get()->result_array();
	return $getallcompanies;
	}
	public function getsubcategories(){
	$this->db->select("*");	
	$this->db->from("tbl_subcategories");
	$getallsubcat=$this->db->get()->result_array();
	return $getallsubcat;
	}
	public function getVendors(){
		
	$this->db->select("*");	
	$this->db->from("tbl_vendordetails as vds");
	$this->db->join("tbl_users as u","u.u_id=vds.user_id");
	$getallvendors=$this->db->get()->result_array();
	return $getallvendors;
	}
	public function getallfacilities(){
		
	$this->db->select("*");	
	$this->db->from("tbl_facilities");
	$getallfacls=$this->db->get()->result_array();
	return $getallfacls;
	}
	
    public function viewvendors($vendorid){
		$this->db->select("*");
		$this->db->from("tbl_vendordetails as vds");
		$this->db->join("tbl_users as u","u.u_id=vds.user_id");
		$this->db->where("v_id",$vendorid);
		
		$viewvendor=$this->db->get()->result_array();
		//$this->db->last_query();exit;
		return $viewvendor;
		
		
	}
	
	public function all_status($id,$datastatus,$usertype){
						
		$data=array(
		"status"=>$datastatus
		);
		$this->db->where("u_id",$id);
		$update=$this->db->update("tbl_users",$data);
		
		
		return $update;
	}
	
	public function edit_userinfo($userid){
		
		$this->db->select("*");
		$this->db->from("tbl_vendordetails as vds");
		$this->db->join("tbl_users as u","u.u_id=vds.user_id");
		$this->db->where("v_id",$userid);
		$viewvendor=$this->db->get()->result_array();
		return $viewvendor;
	}
	public function edit_user($userid){
		//$userid=$this->input->post('edituser_id');
		$this->db->set('u.name', $this->input->post('uname'));
		$this->db->set('u.email', $this->input->post('u_email'));
		$this->db->set('u.gender', $this->input->post('gender'));
		$this->db->set('u.email', $this->input->post('u_email'));
		$this->db->set('u.phone', $this->input->post('u_phone'));
		$this->db->set('u.profile_pic', $_FILES['u_pic']['name']);
		$this->db->set('vds.company_name', $this->input->post('c_name'));
		$this->db->set('vds.category_type', $this->input->post('cat_type'));
		$this->db->set('vds.address_one', $this->input->post('c_add1'));
		$this->db->set('vds.address_two', $this->input->post('c_add2'));
		$this->db->set('vds.city', $this->input->post('c_city'));
		$this->db->set('vds.state',$this->input->post('c_state'));
		$this->db->set('vds.country', $this->input->post('c_country'));
		$this->db->set('vds.company_pincode', $this->input->post('c_pincode'));
		$this->db->set('vds.srvc_provider_name', $this->input->post('s_disp_name'));
		$this->db->set('vds.pan', $this->input->post('c_pan'));
		$this->db->set('vds.vat', $this->input->post('c_vat'));
		$this->db->set('vds.cst', $this->input->post('c_cst'));
		$this->db->set('vds.tan', $this->input->post('c_tan'));
		$this->db->set('vds.service_tax', $this->input->post('c_service_tax'));
		$this->db->set('vds.benificiary_name', $this->input->post('benf_name'));
		$this->db->set('vds.accont_number', $this->input->post('account_number'));
		$this->db->set('vds.account_type', $this->input->post('t_account'));
		$this->db->set('vds.ifsc_code', $this->input->post('ifsc_cde'));
		$this->db->set('vds.pan_image', $_FILES['s_pan']['name']);
		$this->db->set('vds.cancelledchq_image', $_FILES['s_cancl_chq']['name']);
		$this->db->set('vds.tan_image', $_FILES['s_tan']['name']);
		$this->db->set('vds.vat_image', $_FILES['s_vat']['name']);
		$this->db->set('vds.cst_image', $_FILES['s_cst']['name']);
		$this->db->set('vds.srvc_tax_image', $_FILES['s_srvc_tax']['name']);
		$this->db->set('vds.web_existing', $this->input->post('exst_wb'));
		$this->db->set('vds.web_other', $this->input->post('other_web'));
		$this->db->set('vds.other_info_one', $this->input->post('other_info1'));
		$this->db->set('vds.other_info_two', $this->input->post('other_info2'));
		$this->db->set('vds.other_info_three', $this->input->post('other_info3'));
		$this->db->where('u.u_id', $userid);
		$this->db->where('u.u_id = vds.user_id');
		$this->db->update('tbl_users as u, tbl_vendordetails as vds');
		//echo $this->db->last_query();exit;
		return true;
	}
	
	
	
}


?>