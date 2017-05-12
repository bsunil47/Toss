<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends My_Controller
{

    //private $redirecturl;
    private $view_dir;

    public function __construct()
    {
        parent::__construct();
        $this->view_dir = $this->router->fetch_class() . '/' . $this->router->fetch_method();
        $allowed_methodes = array('index');
        if (!$this->_is_home_logged_in() && !in_array($this->router->fetch_method(), $allowed_methodes)) {
            redirect(base_url() . 'admin/index');
        }
        $this->load->model("admin_common_model");
    }
    public function index()
    {
        $login_array = ['admin/dashboard', 'admin/dashboard', 'vendors/dashboard', 'venues/dashboard'];
        if ($this->_is_home_logged_in()) {
            redirect(base_url() . $login_array[$this->session->userdata['user_type']]);
        }
        $data = array('email' => $this->input->post('email1'), 'password' => md5($this->input->post('password1')));
        if (isset($_POST['loginsubmit'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email1', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('password1', 'Password', 'required|trim');
            $this->form_validation->set_message('required', '%s Should not be Empty');
            $this->form_validation->set_message('valid_email', '%s Should be Valid Email');
            if ($this->form_validation->run() == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $getdata = $this->admin_common_model->getusersdetails();
                $this->session->set_flashdata('error', 'Invalid Username or Password');
                if (!empty($getdata)) {
                    $userid = $getdata[0]['user_id'];
                    $getusertype = $this->admin_common_model->getusertypes($userid);
                    $this->session->set_flashdata('error', 'Not Able to Login');
                    if (!empty($getusertype)) {
                        $this->session->set_userdata("user_id", $getusertype[0]['user_id']);
                        $this->session->set_userdata("user_type", $getusertype[0]['user_type']);
                        $this->session->set_userdata("user_name", $getusertype[0]['name']);
                        $this->session->set_userdata("user_email", $getusertype[0]['email']);
                        $this->session->set_userdata("user_phone", $getusertype[0]['phone']);
                        redirect(base_url($login_array[$getusertype[0]['user_type']]));
                    }
                }
                redirect(base_url("admin/"));
            }
        }
        $this->layout->setLayout('login.php');
        $this->layout->view($this->view_dir, $data);
    }
    public function dashboard()
    {
        $data = array();
        $this->common_model->initialise('user_types');
        $select = "COUNT(user_type) as countall";
        $data['appusers'] = $this->common_model->get_record_single(array("user_type" => 5), $select);
        $data['vendors'] = $this->common_model->get_record_single(array("user_type" => 2), $select);
        $this->common_model->initialise('venues');
        $select2 = "count(*) as venuescount";
        $data['venues'] = $this->common_model->get_records(0, $select2, '');
        $this->layout->view($this->view_dir, $data);
    }
    public function listvenue($vendor_id)
    {
        $data = array();
        $this->common_model->initialise("users as U");
        $this->common_model->join_tables = array("vendor as VD", "venues as V");
        $this->common_model->join_on = array("U.user_id=VD.user_id", "V.vendor_id=VD.vendor_id");
        $where = "VD.vendor_id = " . $vendor_id;
        $select = "*,V.venue_id as venueid,V.status as venuestatus,VD.vendor_id as vendorid";
        $data['venuesbyvendor'] = $this->common_model->get_records(0, $select, $where);
        $this->layout->view($this->view_dir, $data);
    }
    public function managevendors()
    {
        $data = array();
        $this->layout->view($this->view_dir, $data);
    }
    public function viewvendor($vendorid)
    {
        $data = array();
        $this->common_model->initialise("categories");
        $data['getallcategories'] = $this->common_model->get_records(0, "*", '');
        $this->common_model->initialise("vendor as VD");
        $this->common_model->join_tables = array("users as U", "venues as V", "bank_details as B", "venue_category as VC", "categories as C", "venue_sub_category as VSC", "sub_categories as SC", "working_hours as W", "venue_facilities as VF");
        $this->common_model->join_on = array("U.user_id=VD.user_id", "VD.vendor_id=V.vendor_id", "VD.vendor_id=B.vendor_id", "V.venue_id=VC.venue_id", "VC.category_id=C.category_id", "V.venue_id=VSC.venue_id", "VSC.sub_category_id=SC.sub_category_id", "V.venue_id=W.venue_id", "V.venue_id=VF.venue_id");
        $this->common_model->left_join = array('left', 'left', 'left', 'left', 'left', 'left', 'left', 'left', 'left');
        $where = "VD.vendor_id = " . $vendorid;
        $select = "V.*,V.venue_id as venueid,V.address as venueaddress,V.address2 as venueaddresstwo,V.city as venuecity,V.state as venuestate,V.country as venuecountry,V.pincode as venuepin,V.phone as venuephone,U.email as useremail,U.phone as userphone,U.name as vendorname,U.gender as vendorgendor,VD.*,VD.vendor_id as vendorid,VD.address as vendoraddress,VD.address2 as vendoraddresstwo,VD.city as vendorcity,VD.state as vendorstate,VD.country as vendorcountry,VD.pincode as vendorpin,VD.phone as vendorphone,B.*,VC.*,C.category_name as venuecategory,VSC.*,W.*,VF.*,VF.status as venue_facilitystatus";
        $data['viewvendordetails'] = $this->common_model->get_record_single($where, $select);
        $this->layout->view($this->view_dir, $data);
    }
    public function editvendor($vendorid)
    {
        $data = array();
        $data['getallcategories']=$this->getallcategoriesdata("categories");
        $data['getallsubcategories']=$this->getallcategoriesdata("sub_categories");
        $data['getallsubsubcategories']=$this->getallcategoriesdata("sub_sub_categories");
        $data['getfacilites']=$this->getallcategoriesdata("facilities");
        $this->common_model->initialise("users as U");
        $this->common_model->join_tables = array("vendor as VD", "venues as V", "bank_details as B", "venue_category as VC", "venue_sub_category as VSC", "working_hours as W", "venue_facilities as VF");
        $this->common_model->join_on = array("U.user_id=VD.user_id", "VD.vendor_id=V.vendor_id", "VD.vendor_id=B.vendor_id", "V.venue_id=VC.venue_id", "VSC.venue_id=V.venue_id", "V.venue_id=W.venue_id", "V.venue_id=VF.venue_id");
        $this->common_model->left_join = array('left', 'left', 'left', 'left', 'left', 'left', 'left');
        $where = "VD.vendor_id = " . $vendorid;
        $select = "V.*,V.venue_id as venueid,V.address as venueaddress,V.address2 as venueaddresstwo,V.city as venuecity,V.state as venuestate,V.country as venuecountry,V.pincode as venuepin,U.email as useremail,U.phone as userphone,U.name as vendorname,U.gender as vendorgendor,VD.*,VD.vendor_id as vendorid,VD.address as vendoraddress,VD.address2 as vendoraddresstwo,VD.city as vendorcity,VD.state as vendorstate,VD.country as vendorcountry,VD.pincode as vendorpin,B.*,VC.*,VSC.*,W.*,VF.*,VF.status as venue_facilitystatus";
        $data['editvendorinfo'] = $this->common_model->get_record_single($where, $select);
        $data['workinghours'] = $this->workinghours($data['editvendorinfo']->venueid);
        $data['facilities'] = $this->venuefacilities($data['editvendorinfo']->venueid);
        $this->layout->view($this->view_dir, $data);
    }
    private function workinghours($venue_id)
    {
        $this->common_model->initialise("working_hours as W");
        $this->common_model->join_tables = array("venues as V");
        $this->common_model->join_on = array("V.venue_id=W.venue_id");
        $where = "V.venue_id = " . $venue_id;
        $select = "W.*";
        $workinghours = $this->common_model->get_records(0, $select, $where);
        return $workinghours;
    }
    private function venuefacilities($venue_id)
    {
        $this->common_model->initialise("venue_facilities as VF");
        $this->common_model->join_tables = array("venues as V", "facilities as F");
        $this->common_model->join_on = array("V.venue_id=VF.venue_id", "VF.facility_id=F.facility_id");
        $where = "V.venue_id = " . $venue_id;
        $select = "VF.*,F.facility_name";
        $facilities = $this->common_model->get_records(0, $select, $where);
        return $facilities;
    }
    public function editvendordetails()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules('c_name', 'Company Name', 'required|trim');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->form_validation->set_message('valid_email', '%s should be a valid email');
        $this->form_validation->set_message('is_unique', 'You have Already registered with us');
        if (isset($_POST['vendorsubmit'])) {
            if ($this->form_validation->run('edit_vendor') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $user_id = $this->input->post('user_id');
                $vendor_id = $this->input->post('vendor_id');
                $venue_id = $this->input->post('venue_id');
                $data = array("name" => ucfirst($this->input->post('uname')),"email" => $this->input->post('u_email'),"gender" => $this->input->post('gender'),"phone" => $this->input->post('u_phone'));
                $this->common_model->initialise("users");
                $this->common_model->array = $data;
                $where = "user_id = " . $user_id;
                $updateuser = $this->common_model->update($where);
                $vendordata = array("company_name" => ucfirst($this->input->post('c_name')),"address" => $this->input->post('vendor_address'),"address2" => $this->input->post('vendor_addresstwo'),"city" => $this->input->post('vendor_city'),"state" => $this->input->post('vendor_state'),"country" => $this->input->post('vendor_country'),"pincode" => $this->input->post('vendor_pin'),"pan" => $this->input->post('c_pan'),"vat" => $this->input->post('c_vat'),"tan" => $this->input->post('c_cst'),"cst" => $this->input->post('c_tan'),"service_tax" => $this->input->post('c_service_tax'),"web_url" => $this->input->post('exst_wb'),"web_url2" => $this->input->post('other_web'),"other_info_one" => $this->input->post('other_info1'),"other_info_two" => $this->input->post('other_info2'),"other_info_three" => $this->input->post('other_info3'));
                $this->common_model->initialise("vendor");
                $this->common_model->array = $vendordata;
                $where = "vendor_id = " . $vendor_id;
                $updatevendordata = $this->common_model->update($where);
                $bankdata = array("beneficiary_name" => ucfirst($this->input->post('benf_name')),"account_number" => $this->input->post('account_number'),"account_type" => $this->input->post('t_account'),"ifsc_code" => $this->input->post('ifsc_cde'));
                $this->common_model->initialise("bank_details");
                $this->common_model->array = $bankdata;
                $where = "vendor_id = " . $vendor_id;
                $updatevendordata = $this->common_model->update($where);
                $target_dir = "images/vendors";
                $crt_dir = $target_dir . "/" . $vendor_id . "/" . $venue_id;
                if (!is_dir($crt_dir)) {
                    mkdir($crt_dir, 0777, true);
                }
                if (!empty($_FILES)) {
                    foreach ($_FILES as $key => $value) {
                        $allowed_extensions = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF');
                        $vendor_images = array("pan_image", "vat_image", "cst_image", "tan_image", "service_tax_image", "cancelled_cheque_image");
                        $file_name = basename($_FILES[$key]['name']);
                        $vendor_uploads['keys'] = $_FILES[$key];
                        $targetfile = $crt_dir . "/" . "{$venue_id}_{$key}" . ".jpg";
                        $imagefiletype = pathinfo($targetfile, PATHINFO_EXTENSION);
                        if (!in_array($imagefiletype, $allowed_extensions)) {
                            $this->session->set_flashdata("image_error", "Problem with Uploading Images");
                            redirect(base_url("admin/addvendor"));
                        } else {

                            if ($key == 'profile_pic') {
                                $targetuserdir = "images/profiles/$vendor_id";
                                $targetfileuser = $targetuserdir . "_" . "user.jpg";
                                $data[$key] = $vendorid . "_user.jpg";
                                $this->updatedetails($data, "users", $user_id);
                            } elseif (in_array($key, $vendor_images)) {
                                $targetvendordir = "images/vendors/$vendor_id";
                                $targetfileuser = $targetvendordir . "/vendor_{$key}_{$vendor_id}" . ".jpg";
                                $vendordata[$key] = "vendor_{$key}_{$vendor_id}" . ".jpg";
                                $this->updatedetails($vendordata, "vendor", $vendor_id);
                            } else {
                                $targetfileuser = $targetfile;
                                $venuedetails[$key] = "{$venue_id}_{$key}" . ".jpg";
                                $this->updatedetails($venuedetails, "venues", $venue_id);
                            }
                            move_uploaded_file($_FILES[$key]['tmp_name'], $targetfileuser);
                        }
                    }
                }
                $this->session->set_flashdata("update_vendor", "Vendor Updated Successfully");
                redirect("admin/managevendors");
            }
        }
    }
    private function updatedetails($data, $table, $id)
    {
        $tables = ["users" => 'user_id', "vendor" => 'vendor_id', "venues" => 'venue_id', 'facilities' => 'facility_id', 'categories' => 'category_id', 'sub_categories' => 'sub_category_id', 'sub_sub_categories' => 'sub_sub_category_id'];
        $this->common_model->initialise($table);
        $where = "{$tables[$table]} = '$id'";
        $this->common_model->array = $data;
        $update = $this->common_model->update($where);
        if ($update == false) {
            return true;
        } else return false;
    }
    public function editvenuedetails()
    {
        if (isset($_POST['vendorsubmit'])) {
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
                redirect(base_url("admin/managevenues"));
            } else {
                $this->session->set_flashdata("update_venue", "Venue Updated Successfully");
                redirect(base_url("admin/listvenue/$listvenue_vendor_id"));
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
    private function workinghourss($id, $key)
    {
        $this->common_model->initialise('working_hours');
        $working = $this->common_model->get_record_single("venue_id = '$id' and day_id = '$key'", '*');
        return $working;
    }
    public function getsubcat()
    {
        $getallsubcatsbycat = $this->admin_common_model->getallsubcatbycat($categoryid);
        //echo "<pre>";print_r($getallsubcats);exit;
        $html = '<div class="form-group clearfix">
                            <label class="col-sm-2 col-sm-2 control-label">Subcategories</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b-10 subcategory" name="sub_cat_id">
								<option value="">--Select SubCategory--</option>';
        foreach ($getallsubcatsbycat as $getallsubcatbycat) {
            $html .= '<option value="1">sdfdsf</option>';
        }
        $html .= '</select>';
        echo $html;
    }
    public function addvendor()
    {
        $data = array();
        $categoryid = $this->input->post('cat_id');
        $subcategoryid = $this->input->post('sub_cat_id');
        $subsubcategoryid = $this->input->post('sub_sub_cat_id');
        $data['getallcategories']=$this->getallcategoriesdata("categories");
        $data['getallsubcategories']=$this->getallcategoriesdata("sub_categories");
        $data['getallsubsubcategories']=$this->getallcategoriesdata("sub_sub_categories");
        $data['getfacilites']=$this->getallcategoriesdata("facilities");
        $this->load->library("form_validation");
        $this->form_validation->set_rules('c_name', 'Company Name', 'required|trim');
        $this->form_validation->set_rules('u_email', 'Email', 'required|trim|valid_email|is_unique[tbl_users.email]');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->form_validation->set_message('valid_email', '%s should be a valid email');
        $this->form_validation->set_message('is_unique', 'You have Already registered with us');
        if (isset($_POST['venuesubmit'])) {
            if ($this->form_validation->run('add_user') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $usertype = $this->input->post('usertype');
                $user_pic = array();
                $this->session->set_flashdata("t_and_c_error", "You must agree Terms and Conditions");
                if ($this->input->post('tandc') == 1) {
                    $user_pic = $_FILES;
                    $user_array = array('uname' => "name", "u_email" => 'email', "u_passw" => 'password', "gender" => 'gender', "u_phone" => 'phone');
                    $vendor_array = array('c_name' => "company_name", 'vendor_addressone' => "address", 'vendor_addresstwo' => "address2", 'vendor_city' => "city", 'vendor_state' => "state", 'vendor_country' => "country", 'vendor_pin' => "pincode", 'vendor_phone' => "phone", 'c_pan' => "pan", 'c_vat' => "vat", 'c_cst' => "cst", 'c_tan' => "tan", 'c_service_tax' => "service_tax", 'exst_wb' => "web_url", 'other_web' => "web_url2", 'other_info1' => "other_info_one", 'other_info2' => "other_info_two", 'other_info3' => "other_info_three");
                    $bank_array = array('benf_name' => "beneficiary_name", 'account_number' => "account_number", 't_account' => "account_type", 'ifsc_cde' => "ifsc_code");
                    $venue_array = array('v_disp_name' => "venue_display_name", 'v_add1' => "address", 'v_add2' => "address2", 'v_city' => "city", 'v_state' => "state", 'v_country' => "country", 'v_pincode' => "pincode", 'toss_ven_location' => "location", 'toss_ven_lat' => "lat", 'toss_ven_lng' => "lng", 'cp_name' => "contact_person", 'cp_mobile' => "phone", 'cp_email' => "email");
                    $params = $this->input->post();
                    foreach ($params as $key => $value) {
                        if (array_key_exists($key, $user_array)) {
                            $data[$user_array[$key]] = mysqli_real_escape_string($value);
                        }
                        if (array_key_exists($key, $vendor_array)) {
                            $vendordata[$vendor_array[$key]] = mysqli_real_escape_string($value);
                        }
                        if (array_key_exists($key, $bank_array)) {
                            $bankdata[$bank_array[$key]] = mysqli_real_escape_string($value);
                        }
                        if (array_key_exists($key, $venue_array)) {
                            $venuedetails[$venue_array[$key]] = mysqli_real_escape_string($value);
                        }
                    }
                    $venuedetails['status'] = $vendordata['status'] = $data['status'] = 1;
                    $userid = $this->insert_fun('users', $data);
                    $vendordata['user_id'] = $userid;
                    $vendordata["terms_accept"] = 1;
                    $this->insert_fun('user_types', ["user_id" => $userid, "user_type" => 2]);
                    $vendorid = $this->insert_fun('vendor', $vendordata);
                    $venuedetails['vendor_id'] = $bankdata['vendor_id'] = $vendorid;
                    $this->insert_fun('bank_details', $bankdata);
                    $venue_id = $this->insert_fun('venues', $venuedetails);
                    if ($venue_id) {
                        $this->categories_sort('category_id', $categoryid, $venue_id);
                        $this->categories_sort('sub_category_id', $subcategoryid, $venue_id);
                        $this->categories_sort('sub_sub_category_id', $subsubcategoryid, $venue_id);
                        $this->categories_sort('facility_id', $facilities, $venue_id);
                        $from_work_date = $_POST['frm_dte'];
                        $to_work_date = $_POST['to_dte'];
                        $days = $_POST['days'];
                        foreach ($days as $key => $value) {
                            $workingdata = array("venue_id" => $venue_id, "day_id" => $value, "start_time" => $from_work_date, "end_time" => $to_work_date, "status" => 1);
                            $insertworkinghours = $this->insert_fun('working_hours', $workingdata);
                        }
                    }
                    $target_dir = "images/vendors";
                    $crt_dir = $target_dir . "/" . $vendorid . "/" . $venue_id;
                    if (!is_dir($crt_dir)) {
                        mkdir($crt_dir, 0777, true);
                    }
                    foreach ($_FILES as $key => $value) {
                        $allowed_extensions = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF');
                        $vendor_images = array("pan_image", "vat_image", "cst_image", "tan_image", "service_tax_image", "cancelled_cheque_image");
                        $file_name = basename($_FILES[$key]['name']);
                        $vendor_uploads['keys'] = $_FILES[$key];
                        $targetfile = $crt_dir . "/" . "{$venue_id}_{$key}" . ".jpg";
                        $imagefiletype = pathinfo($targetfile, PATHINFO_EXTENSION);
                        if (!in_array($imagefiletype, $allowed_extensions)) {
                            $this->session->set_flashdata("image_error", "Problem with Uploading Images");
                            redirect(base_url("admin/addvendor"));
                        } else {
                            if ($key == 'profile_pic') {
                                $targetuserdir = "images/profiles/$vendorid";
                                $targetfileuser = $targetuserdir . "_" . "user.jpg";
                                $data[$key] = $vendorid . "_user.jpg";
                                $this->updatedetails($data, "users", $userid);
                            } elseif (in_array($key, $vendor_images)) {
                                $targetvendordir = "images/vendors/$vendorid";
                                $targetfileuser = $targetvendordir . "/vendor_{$key}_{$vendorid}" . ".jpg";
                                $vendordata[$key] = "vendor_{$key}_{$vendorid}" . ".jpg";
                                $this->updatedetails($vendordata, "vendor", $vendorid);
                            } else {
                                $targetfileuser = $targetfile;
                                $venuedetails[$key] = "{$venue_id}_{$key}" . ".jpg";
                                $this->updatedetails($venuedetails, "venues", $venue_id);
                            }
                            move_uploaded_file($_FILES[$key]['tmp_name'], $targetfileuser);
                        }
                    }
                    if ($insertworkinghours) {
                        $this->session->set_flashdata("t_and_c_error", null);
                        $this->session->set_flashdata("vendor_success", "You Have Added vendor Successfully");
                    }
                }
                redirect(base_url("admin/managevendors"));
            }
        }
        $this->layout->view($this->view_dir,$data);
       }
    public function updatestatus($id, $status, $usertype)
    {
        $function = $this->uri->segment(2);
          if ($status == 1) {

            $statusnew = 0;
        }
        if ($status == 0 || $status == '' || $status == "NULL") {

            $statusnew = 1;
        }
        $datastatus = $statusnew;
         /* vendor stauts change */
        if ($usertype == 2) {
            $where = array("user_id" => $id);
            $this->updatestatusall("users", $datastatus, $where);
            $this->updatestatusall("vendor", $datastatus, $where);
            redirect(base_url("admin/managevendors"));
        }
        /* venue status change */
        if ($usertype == 6) {
            $where = array("venue_id" => $id);
            $this->updatestatusall("venues", $datastatus, $where);
            redirect(base_url("admin/managevenues"));
        }

        if ($usertype == 66) {
            $where = array("venue_id" => $id);
            $this->updatestatusall("venues", $datastatus, $where);
            $vendorid = $this->common_model->get_record_single($where, "vendor_id");
            redirect(base_url("admin/listvenue/$vendorid->vendor_id"));
        }
        /* sub categories status change */
        if ($usertype == 7) {
            $where = array("sub_category_id" => $id);
            $this->updatestatusall("sub_categories", $datastatus, $where);
            redirect(base_url("admin/managesubcategories"));
        }
        /* sub Subcategories status change */
        if ($usertype == 77) {
            $where = array("sub_sub_category_id" => $id);
            $this->updatestatusall("sub_sub_categories", $datastatus, $where);
            redirect(base_url("admin/managesubsubcategories"));
        }
        /* End */
        /* facilities status change */
        if ($usertype == 9) {
            $where = array("facility_id" => $id);
            $this->updatestatusall("facilities", $datastatus, $where);
            redirect(base_url("admin/managefacilities"));
        }
        /* categories status change */
        if ($usertype == 10) {
            $where = array("category_id" => $id);
            $this->updatestatusall("categories", $datastatus, $where);
            redirect(base_url("admin/managecategories"));
        }
        if ($usertype == 11) {
            $where = array("price_id" => $id);
            $this->updatestatusall("prices", $datastatus, $where, "managepricing");
            $venueid = $this->common_model->get_record_single($where, "venue_id");
            redirect(base_url("admin/managepricing/$venueid->venue_id"));
        }
        if ($usertype == 12) {
            $where = array("price_id" => $id);
            $this->updatestatusall("prices", $datastatus, $where, "managepricing");
            $venueid = $this->common_model->get_record_single($where, "venue_id");
            redirect(base_url("admin/managepricing/$venueid->venue_id"));
        }
        /* slots status change */
        if ($usertype == 13) {
            $where = array("slot_id" => $id);
            $this->updatestatusall("time_slots", $datastatus, $where);
            $venueid = $this->common_model->get_record_single($where, "venue_id");
            redirect(base_url("admin/manageslots/$venueid->venue_id"));
        }
        /* venueusers status change */
        if ($usertype == 3) {
            $where = array("user_id" => $id);
            $this->updatestatusall("venue_users", $datastatus, $where);
            $venueid = $this->common_model->get_record_single($where, "venue_id");
            redirect(base_url("admin/viewvenueusersinfo/$venueid->venue_id"));
        }
    }
    private function updatestatusall($table, $datastatus, $where)
    {
        $this->common_model->initialise($table);
        $this->common_model->status = $datastatus;
        $this->common_model->set_status($where);

    }

    private function insert_fun($table, $data)
    {
        $this->common_model->initialise($table);
        $this->common_model->array = $data;
        return $this->common_model->insert_entry();
    }

    private function categories_sort($type, $data, $venue_id)
    {
        $type_array = ['category_id' => 'venue_category', 'sub_category_id' => 'venue_sub_category', 'sub_sub_category_id' => 'venue_sub_sub_categories', 'facility_id' => 'venue_facilities'];
        foreach ($data as $value) {
            $this->insert_fun($type_array[$type], ["venue_id" => $venue_id, "$type" => $value, "status" => 1]);
	}
        return true;
    }
   public function addvenue($vendorid)
    {
        $data = array();
        $data['vendorid']=$vendorid;
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
                    redirect(base_url("admin/listvenue/$vendorid"));
                }
            }
        }
        $this->layout->view($this->view_dir,$data);
       }
    public function editvenueinfo($venueid, $rtype, $rid)
    {
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
        $data['facilities'] = $this->venuefacilityids($venueid);
        $this->layout->view($this->view_dir, $data);
    }
    private function venuefacilityids($venueid)
    {
        $facilities = $this->common_model->pureQuery("select group_concat(facility_id) as facility_id from tbl_venue_facilities where venue_id = '$venueid'");
        return $facilities[0]->facility_id;
    }
public function viewvenueinfo($venueid)
    {
        $data = array();
        $data['getallcategories'] = $this->getallcategoriesdata("categories");
        $data['getallsubcategories'] = $this->getallcategoriesdata("sub_categories");
        $this->common_model->initialise("venues as V");
        $this->common_model->join_tables = array("vendor as VD", "venue_category as VC", "venue_sub_category as VSC", "working_hours as W", "venue_facilities as VF");
        $this->common_model->join_on = array("VD.vendor_id=V.vendor_id", "V.venue_id=VC.venue_id", "VSC.venue_id=V.venue_id", "V.venue_id=W.venue_id", "V.venue_id=VF.venue_id");
        $this->common_model->left_join = array('left', 'left', 'left', 'left', 'left');
        $where = "V.venue_id = " . $venueid;
        $select = "*,V.venue_id as venueid,V.address as venueaddress,V.address2 as venueaddresstwo,V.city as venuecity,V.state as venuestate,V.country as venuecountry,V.pincode as venuepincode,VD.vendor_id as vendorid,VF.status as venuefacilitystatus";
        $data['viewvenueinfo'] = $this->common_model->get_record_single($where, $select);
        $data['workinghours'] = $this->workinghours($venueid);
        $data['facilities'] = $this->venuefacilities($venueid);
        $this->layout->view($this->view_dir,$data);
    }
    public function managevenues()
    {

        $data = array();
        $this->load->view("manage_venues", $data);
    }
    public function viewvenueusersinfo($venueid)
    {
        $this->common_model->initialise("venue_users as VU");
        $this->common_model->join_tables = array("venues as V", "users as U", "user_types as UT");
        $this->common_model->join_on = array("VU.venue_id=V.venue_id", "VU.user_id=U.user_id", "UT.user_id=U.user_id");
        $where = "VU.venue_id = " . $venueid;
        $select = "VU.*,VU.status as venueuserstatus,V.vendor_id,U.*,UT.user_type as usertype";
        $data['viewvenueusers'] = $this->common_model->get_records(0, $select, $where);
        $this->common_model->initialise('venues');
        $data['getdetails']=$this->common_model->get_record_single("venue_id = '$venueid'","venue_id,vendor_id");
        $this->layout->view($this->view_dir,$data);
    }
     public function adduser($venue_id)
    {
        $data = array();
        $this->common_model->initialise('venues');
        $data['getdetails']=$this->common_model->get_record_single("venue_id = '$venue_id'","venue_id,vendor_id");
        $this->load->library("form_validation");
        $this->form_validation->set_rules('usertype', 'User Type', 'required|trim');
        $this->form_validation->set_rules('uname', 'Name', 'required|trim');
        $this->form_validation->set_rules('u_email', 'Email', 'required|trim|valid_email|is_unique[tbl_users.email]');
        $this->form_validation->set_rules('u_passw', 'Password', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
        $this->form_validation->set_message('required', '%s should not be empty');
        $this->form_validation->set_message('valid_email', '%s should be a valid email');
        $this->form_validation->set_message('is_unique', 'You have Already registered with us');
        if (isset($_POST['usersubmit'])) {
            if ($this->form_validation->run('add_user') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {
                $venue_id = $this->input->post('venue_id');
                $userdata = array("name" => ucfirst($this->input->post('uname')),"email" => $this->input->post('u_email'),"password" => md5($this->input->post('u_passw')),"gender" => $this->input->post('gender'),"phone" => $this->input->post('u_phone'));
                $this->common_model->initialise("users");
                $this->common_model->array = $userdata;
                $userid = $this->common_model->insert_entry();
                if (isset($userid)) {
                    $datausertype = array("user_id" => $userid,"user_type" => $this->input->post('usertype'));
                    $this->common_model->initialise("user_types");
                    $this->common_model->array = $datausertype;
                    $insertusertype = $this->common_model->insert_entry();
                    if (isset($insertusertype)) {
                        $venueuserdata = array("user_id" => $userid,"venue_id" => $venue_id,"status" => 1);
                        $this->common_model->initialise("venue_users");
                        $this->common_model->array = $venueuserdata;
                        $insertvenueuser = $this->common_model->insert_entry();
                    }
                }
                $target_dir = "images/profiles";
                $targetfile = $target_dir . "/" . "{$userid}_user" . ".jpg";
                $userdata['profile_pic'] = "{$userid}_user" . ".jpg";
                $this->updatedetails($userdata, "users", $userid);
                move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetfile);
                if (isset($insertvenueuser)) {
                    $this->session->set_flashdata("add_user_success", "You Have Added User Successfully");
                     redirect(base_url("admin/viewvenueusersinfo/{$venue_id}"));
                }
            }
        }
        $this->layout->view($this->view_dir,$data);
    }
    public function viewuserinfo($venueid, $userid)
    {
        $data['venueid']=$venueid;
        $this->common_model->initialise('venues');
        $data['getdetails']=$this->common_model->get_record_single("venue_id = '$venueid'","venue_id,vendor_id");
        $this->common_model->initialise("venue_users as VU");
        $this->common_model->join_tables = array("venues as V", "users as U", "user_types as UT");
        $this->common_model->join_on = array("VU.venue_id=V.venue_id", "VU.user_id=U.user_id", "UT.user_id=U.user_id");
        $where = "VU.user_id = " . $userid;
        $select = "VU.*,VU.status as venueuserstatus,U.*,UT.user_type as usertype";
        $data['viewuserdetails'] = $this->common_model->get_record_single($where, $select);
        $this->layout->view($this->view_dir,$data);
     }
    public function edituserinfo($venueid, $userid)
    {
        $data['venueid']=$venueid;
        $this->common_model->initialise('venues');
        $data['getdetails']=$this->common_model->get_record_single("venue_id = '$venueid'","venue_id,vendor_id");
        $this->common_model->initialise("venue_users as VU");
        $this->common_model->join_tables = array("venues as V", "users as U", "user_types as UT");
        $this->common_model->join_on = array("VU.venue_id=V.venue_id", "VU.user_id=U.user_id", "UT.user_id=U.user_id");
        $where = "VU.user_id = " . $userid;
        $select = "VU.*,VU.status as venueuserstatus,V.venue_id as venueid,U.*,UT.user_type as usertype";
        $data['edituserdetails'] = $this->common_model->get_record_single($where, $select);
        $this->layout->view($this->view_dir,$data);
    }  
     public function edituserdetails()
    {
        $venueid = $this->input->post('venue_id');
        $userid = $this->input->post('user_id');
        $userdata = array("name" => ucfirst($this->input->post('uname')),"email" => $this->input->post('u_email'),"gender" => $this->input->post('gender'),"phone" => $this->input->post('u_phone'));
        $this->common_model->initialise("users");
        $this->common_model->array = $userdata;
        $where = "user_id = " . $userid;
        $updateuser = $this->common_model->update($where);
        $datausertype = array("user_id" => $userid,"user_type" => $this->input->post('usertype'));
        $this->common_model->initialise("user_types");
        $this->common_model->array = $datausertype;
        $where = "user_id = " . $userid;
        $updateusertype = $this->common_model->update($where);
        $venueuserdata = array("user_id" => $userid,"venue_id" => $venueid,"status" => 1);
        $this->common_model->initialise("venue_users");
        $this->common_model->array = $venueuserdata;
        $where = "user_id = " . $userid;
        $updatevenueuser = $this->common_model->update($where);
        $target_dir = "images/profiles";
        $targetfile = $target_dir . "/" . "{$userid}_user" . ".jpg";
        $userdata['profile_pic'] = "{$userid}_user" . ".jpg";
        $this->updatedetails($userdata, "users", $userid);
        $updatesuccess = move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetfile);
        if (isset($updatesuccess)) {
            $this->session->set_flashdata("update_user_success", "You Have Updated User Successfully");
            redirect(base_url("admin/viewvenueusersinfo/{$venueid}"));
        }
    }
    public function accept_terms()
    {

        if ($this->input->post('tandc')) {
            return TRUE;
        } else {
            $error = 'Please read and accept our terms and conditions.';
            $this->form_validation->set_message('accept_terms', $error);
            return FALSE;
        }
    }
     public function addcategory()
    {
        if (isset($_POST['catsubmit'])) {
            $this->load->library("form_validation");
            $this->form_validation->set_rules("cat_name", "Category Name", "required|trim");
            $this->form_validation->set_message("required", "%s Should not be Empty");
            if ($this->form_validation->run('add_cat') == FALSE) {
                $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");

            } else {
                $data = array("category_name" => ucfirst($this->input->post('cat_name')),"status" => 1);
               $this->common_model->initialise('categories');
               $this->common_model->array=$data;
               $categoryid=$this->common_model->insert_entry();
                $target_dir = "images/";
                $targetfile = $target_dir . "/" . "cat_{$categoryid}.png";
                move_uploaded_file($_FILES['category_image']['tmp_name'], $targetfile);
                if ($categoryid) {
                    $this->session->set_flashdata("cat_success", "You Have Added Category Successfully");
                    redirect(base_url('admin/managecategories'));
                }
            }
        }
        $this->layout->view($this->view_dir);
        }
    public function editcategoryinfo($category_id)
    {
        $this->common_model->initialise("categories");
        $select = "*";
        $where = "category_id = " . $category_id;
        $data['editcategories'] = $this->common_model->get_record_single($where, $select);
        $this->layout->view($this->view_dir,$data);
    }
    public function editcategorydetails()
    {
        $category_id = $this->input->post('category_id');
        $categorydata = array("category_name" => ucfirst($this->input->post('cat_name')));
        $this->common_model->initialise("categories");
        $this->common_model->array = $categorydata;
        $where = "category_id = " . $category_id;
        $updatecategory = $this->common_model->update($where);
        $target_dir = "images/categories";
        $targetfile = $target_dir . "/" . "cat_{$category_id}.png";
        $facilitydata['category_image'] = "cat_{$category_id}.png";
        $this->updatedetails($facilitydata, "categories", $category_id);
        move_uploaded_file($_FILES['category_image']['tmp_name'], $targetfile);
        $this->session->set_flashdata("update_cat", "Category Updated Successfully");
        redirect(base_url("admin/managecategories"));
    }
     public function addsubcategory()
    {
        $data['getallcategories'] = $this->getallcategoriesdata("categories");
        if (isset($_POST['subcatsubmit'])) {
            $this->load->library("form_validation");
            $this->form_validation->set_rules("category_id", "category", "required");
            $this->form_validation->set_rules("subcat_name", "Subcategory Name", "required|trim");
            if ($this->form_validation->run("add_subcat") == FALSE) {
                $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
            } else {
                if ($_POST['category_id']) {
                    $cat = $_POST['category_id'];
                    for ($i = 0; $i < count($cat); $i++) {
                        $data = array("category_id" => $cat[$i],"sub_category_name" => ucfirst($this->input->post('subcat_name')),"status" => 1);
                        $this->common_model->initialise('sub_categories');
                        $this->common_model->array=$data;
                        $subcatid=$this->common_model->insert_entry();
                        $target_dir = "images/";
                        $targetfile = $target_dir . "/" . "sub_cat_{$subcatid}" . ".png";
                        copy($_FILES['sub_category_image']['tmp_name'], $targetfile);
                    }
                }
                if ($subcatid) {
                    $this->session->set_flashdata("subcat_success", "You Have Added Subcategory  Successfully");
                    redirect(base_url("admin/managesubcategories"));
                }
            }
        }
        $this->layout->view($this->view_dir,$data);
        }
    public function editsubcategory($subcategory_id)
    {
        $data = array();
        $data['getallcategories'] = $this->getallcategoriesdata("categories");
        $this->common_model->initialise("sub_categories as SC");
        $this->common_model->join_tables = array("categories as C");
        $this->common_model->join_on = array("SC.category_id=C.category_id");
        $select = "SC.category_id as categoryid,SC.*,C.*";
        $where = "SC.sub_category_id = " . $subcategory_id;
        $data['editsubcatinfo'] = $this->common_model->get_record_single($where, $select);
       $this->layout->view($this->view_dir,$data);
       }
    public function editsubcategorydetails()
    {
        if (isset($_POST['subcatsubmit'])) {
            $this->load->library("form_validation");
            $this->form_validation->set_rules("category_id", "category", "required");
            $this->form_validation->set_rules("subcat_name", "Subcategory Name", "required|trim");
            if ($this->form_validation->run("add_subcat") == FALSE) {
                $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
            } else {
                if ($_POST['category_id']) {
                    $cat = $_POST['category_id'];
                    $subcat_id = $this->input->post('subcat_id');
                    for ($i = 0; $i < count($cat); $i++) {
                        $subcatdata = array("category_id" => $cat[$i],"sub_category_name" => ucfirst($this->input->post('subcat_name')));
                        $this->common_model->initialise("sub_categories");
                        $this->common_model->array = $subcatdata;
                        $where = "sub_category_id = '$subcat_id' AND category_id = '$cat[$i]'";
                        $updatesubcat = $this->common_model->update($where);
                        $target_dir = "images/categories";
                        $targetfile = $target_dir . "/" .  "sub_cat_{$subcat_id}" . ".png";
                        $subcategorydata['sub_category_image'] = "sub_cat_{$subcat_id}" . ".png";
                        $this->updatedetails($subcategorydata, "sub_categories", $subcat_id);
                        $upload = move_uploaded_file($_FILES['sub_category_image']['tmp_name'], $targetfile);
                        if (isset($upload)) {
                            $this->session->set_flashdata("update_subcat_sucess", "Subcategory Updated Successfully");
                            redirect(base_url("admin/managesubcategories"));
                        } else {

                            $this->session->set_flashdata("update_subcat_error", "Subcategory Updated Failed");
                            redirect(base_url("admin/managesubcategories"));
                        }
                    }
                }
            }
        }
    }
    public function managecategories()
    {
        $data = array();
        $this->common_model->initialise("categories");
        $data['getallcategories'] = $this->common_model->get_records(0, "*", '');
        $this->layout->view($this->view_dir,$data);
    }
    public function managesubcategories()
    {
        $data = array();
        $this->layout->view($this->view_dir,$data);
    }
    public function managesubsubcategories()
    {
        $data = array();
        $this->layout->view($this->view_dir,$data);
    }
    public function addsubsubcategory()
    {
        $data['getallcategories'] = $this->getallcategoriesdata("categories");
        $data['getallsubcategories'] = $this->getallcategoriesdata("sub_categories");
        $this->load->library("form_validation");
        $this->form_validation->set_rules("category_id", "category", "required");
        $this->form_validation->set_rules("subsubcat_name", "Subcategory Name", "required|trim");
        if (isset($_POST['subsubcatsubmit'])) {
            if ($this->form_validation->run("add_subsubcat") == FALSE) {
                $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
            } else {
                if ($_POST['category_id']) {
                    $cats = $_POST['category_id'];
                    $subcats = $_POST['sub_category_id'];
             foreach ($cats as $key => $value) {
                        $subsubcatdata = array("category_id" => $value,"sub_category_id" => $subcats[$value],"sub_sub_category_name" => ucfirst($this->input->post('subsubcat_name')),"status" => 1);
                        $this->common_model->initialise('sub_sub_categories');
                        $this->common_model->array= $subsubcatdata;
                        $subsubcatid = $this->common_model->insert_entry();
                        $target_dir = "images/";
                        $targetfile = $target_dir . "/" . "sub_sub_cat_{$subsubcatid}" . ".png";
                        copy($_FILES['sub_sub_category_image']['tmp_name'], $targetfile);
                    }
                }
                if ($subsubcatid) {
                    $this->session->set_flashdata("subsubcat_success", "You Have Added SubSubcategory  Successfully");
                    redirect(base_url("admin/managesubsubcategories"));
                }
            }
        }
        $this->layout->view($this->view_dir,$data);
     }
    public function editsubsubcategory($subsubcategory_id)
    {
        $data = array();
        $data['getallcategories'] = $this->getallcategoriesdata("categories");
        $data['getallsubcategories'] = $this->getallcategoriesdata("sub_categories");
        $this->common_model->initialise("sub_sub_categories as SS");
        $this->common_model->join_tables = array("categories as C", "sub_categories as SC",);
        $this->common_model->join_on = array("SS.category_id=C.category_id", "SS.sub_category_id=SC.sub_category_id");
        $select = "SS.category_id as categoryid,SS.sub_category_id as subcategoryid,SS.*,SC.sub_category_name as subcatname,C.category_name as catname";
        $where = "SS.sub_sub_category_id = '$subsubcategory_id' ";
        $data['editsubsubcatinfo'] = $this->common_model->get_record_single($where, $select);
        $this->layout->view($this->view_dir,$data);
    }
    public function editsubsubcategorydetails()
    {
        if (isset($_POST['subsubcatsubmit'])) {

            $this->load->library("form_validation");
            $this->form_validation->set_rules("category_id", "category", "required");
            $this->form_validation->set_rules("sub_category_id", "Subcategory", "required");
            $this->form_validation->set_rules("subsubcat_name", "Sub Subcategory Name", "required|trim");
            if ($this->form_validation->run("edit_subsubcat") == FALSE) {

                $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
            } else {
                if ($_POST['category_id']) {
                    $cat = $_POST['category_id'];
                    $subcat_id = $this->input->post('sub_category_id');
                    $subsubcat_id = $this->input->post('subsubcat_id');
                    $subsubcatdata = array("category_id" => $cat,"sub_category_id" => $subcat_id,"sub_sub_category_name" => ucfirst($this->input->post('subsubcat_name')));
                    $this->common_model->initialise("sub_sub_categories");
                    $this->common_model->array = $subsubcatdata;
                    $where = "sub_sub_category_id = '$subsubcat_id' AND sub_category_id = '$subcat_id' AND category_id = '$cat'";
                    $updatesubsubcat = $this->common_model->update($where);
                    $target_dir = "images/categories";
                    $targetfile = $target_dir . "/" . "sub_sub_cat_{$subsubcat_id}" . ".png";
                    $subsubcategorydata['sub_sub_category_image'] = "sub_sub_cat_{$subsubcat_id}" . ".png";
                    $this->updatedetails($subsubcategorydata, "sub_sub_categories", $subsubcat_id);
                    $upload = move_uploaded_file($_FILES['sub_sub_category_image']['tmp_name'], $targetfile);
                    if (isset($upload)) {
                        $this->session->set_flashdata("update_subcat_sucess", "Subcategory Updated Successfully");
                        redirect(base_url("admin/managesubsubcategories"));
                    } else {

                        $this->session->set_flashdata("update_subcat_error", "Subcategory Updated Failed");
                        redirect(base_url("admin/managesubsubcategories"));
                    }
                }
            }
        }
    }
    /*** Manage Pricing ***/
    public function managepricing($venueid)
    {
        $data = array();
        $data['venueid']=$venueid;
        $this->common_model->initialise('venues');
        $data['getdetails']=$this->common_model->get_record_single("venue_id = '$venueid'","vendor_id");
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
    public function addpricing($venueid)
    {
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
                    redirect(base_url("admin/managepricing/$venueid"));
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
                redirect(base_url("admin/managepricing/$venueid"));
            }
        }
        $this->layout->view($this->view_dir,$data);
         }
    public function manageaddons($venueid)
    {
        $data = array();
        $this->common_model->initialise("venues");
        $select = "venue_id,vendor_id";
        $where = "venue_id = " . $venueid;
        $data['getdetails'] = $this->common_model->get_record_single($where, $select);
        $this->layout->view($this->view_dir,$data);
       }
    public function addaddon($venueid)
    {
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
                    redirect(base_url("admin/manageaddons/$venueid"));
                }
            }else{
             $this->session->set_flashdata("addon_error", "Addon Already Added");
                    redirect(base_url("admin/addaddon/$venueid"));  
        }}
        }
        $this->layout->view($this->view_dir,$data);
        }
    private function getvvenues()
    {
        $this->common_model->initialise('venues as V');
        $this->common_model->join_tables = array('vendor as VD');
        $this->common_model->join_on = array('V.vendor_id = VD.vendor_id');
        $venues = $this->common_model->get_records(0, 'V.*', "VD.user_id = '" . $this->session->userdata('user_id') . "'");
        return $venues;
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
                    redirect(base_url("admin/manageaddons/$venueid"));
}        
    }
    public function viewaddon($venueid,$basetypeid,$basetype){
        $data=array();
        $data['venueid']=$venueid;
        $this->common_model->initialise('venues');
        $data['getvdetails']=$this->common_model->get_record_single("venue_id = '$venueid'","vendor_id");
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
    /*** End Pricing ***/
    /*
 * Add on section
 * **/
    private function getcsubcategories($venueid)
    {
        $this->common_model->initialise('venue_sub_category as VSC');
        $this->common_model->join_tables = array('venues as V', 'sub_categories as SC', 'vendor as VD');
        $this->common_model->join_on = array("VSC.venue_id = V.venue_id", "VSC.sub_category_id = SC.sub_category_id", "V.vendor_id = VD.vendor_id");
        $subcat = $this->common_model->get_records(0, 'VSC.*,SC.sub_category_name', "VSC.venue_id = '" . $venueid . "'", '', '', "VSC.sub_category_id");
        return $subcat;
    }
    private function getcsubsubcategories($venueid)
    {
        $this->common_model->initialise('venue_sub_sub_categories as VSSC');
        $this->common_model->join_tables = array('venues as V', 'sub_sub_categories as SSC', 'vendor as VD');
        $this->common_model->join_on = array("VSSC.venue_id = V.venue_id", "VSSC.sub_sub_category_id = SSC.sub_sub_category_id", "V.vendor_id = VD.vendor_id");
        $subsubcat = $this->common_model->get_records(0, 'VSSC.*,SSC.sub_sub_category_name', "VSSC.venue_id = '" . $venueid . "'", '', '', "VSSC.sub_sub_category_id");
        return $subsubcat;
    }
    private function getvfacilities($venueid)
    {
        $this->common_model->initialise('venue_facilities as VF');
        $this->common_model->join_tables = array('venues as V', 'facilities as F');
        $this->common_model->join_on = array("VF.venue_id = V.venue_id", "VF.facility_id = F.facility_id");
        $facilities = $this->common_model->get_records(0, 'VF.*,F.facility_name', "V.venue_id = '" . $venueid. "'", '', '', "VF.facility_id");
        return $facilities;
    }
    /*** End of addon ***/
    /* Vendor and venue facilities */
    public function managevenuefacilities($venueid)
    {
        $data = array();
        $data['venueid'] = $venueid;
        $this->common_model->initialise("venue_facilities  as VF");
        $this->common_model->join_tables = array("venues as V", "facilities as F", "vendor as VD", "venue_category as VC");
        $this->common_model->join_on = array("VF.venue_id = V.venue_id", "VF.facility_id = F.facility_id", "V.vendor_id = VD.vendor_id", "F.base_type_id=VC.category_id");
        $data['getallfacilities'] = $this->common_model->get_records(0, "VF.*,F.facility_name,V.venue_display_name", "VF.venue_id = '" . $venueid . "'", '', '', "F.facility_id");
         $this->common_model->initialise('venues as V');
        $select = "V.venue_id,V.vendor_id";
        $where = "V.venue_id = '$venueid'";
        $data['getdetails'] = $this->common_model->get_record_single($where, $select);
        $this->layout->view($this->view_dir,$data);
     }
    public function addvenuefacility($venueid)
    {
        $data = array();
        $data['venue_id'] = $venueid;
        $this->common_model->initialise('venues as V');
        $this->common_model->join_tables=array('venue_category as VC','venue_sub_category as VSC');
        $this->common_model->join_on=array('V.venue_id = VC.venue_id','V.venue_id = VSC.venue_id');
        $result=$this->common_model->get_records(0,"group_concat(distinct(category_id))as category,group_concat(distinct(sub_category_id)) as subcategory","V.venue_id = '$venueid'");
        $cat=$result[0]->category.",".$result[0]->subcategory;
        $this->common_model->initialise('facilities as F');
        $data['facilities'] = $this->common_model->get_records(0, "F.*", "F.base_type_id IN($cat)", '', '', "F.facility_id");
        if (isset($_POST['faclsubmit'])) {
            $this->load->library("form_validation");
            $this->form_validation->set_rules("facility", "Facility Name", "required");
            $this->form_validation->set_message("required", "%s Should not be Empty");

            if ($this->form_validation->run("add_facility") == FALSE) {
                $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
            } else {
                //$venueid=$this->getvenueid();
                $this->common_model->initialise('venue_facilities');
                $facarr = $_POST['facility'];
                 foreach($facarr as $key=>$value){
                    $facdata = array('venue_id' => $venueid, 'facility_id' => $facarr[$key], 'status' => 1);
                    $this->common_model->array = $facdata;
                    $fid = $this->common_model->insert_entry();
                }
                   if (isset($fid)) {
                    $this->session->set_flashdata("facility_success", "You Have Added Facility Successfully");
                    redirect(base_url("admin/managevenuefacilities/$venueid"));
                }
            }
        }
        $this->layout->view($this->view_dir,$data);
        }
   public function updatefstatus($id, $status, $vid)
    {
        if ($status == 1) {
            $statusnew = 0;
        }
        if ($status == 0 || $status == '' || $status == "NULL") {
            $statusnew = 1;
        }
        $datastatus = $statusnew;
        $this->common_model->initialise('venue_facilities');
        $this->common_model->status = $datastatus;
        $where = "facility_id = '$id' and venue_id = '$vid'";
        $this->common_model->set_status($where);
        redirect(base_url("admin/managevenuefacilities/$vid"));
    }
    public function viewfacility($fid, $vid)
    {
        $data['venueid'] = $vid;
        $this->common_model->initialise('venue_facilities as VF');
        $this->common_model->join_tables = array('venues as V', 'facilities as F');
        $this->common_model->join_on = array("VF.venue_id = V.venue_id", "VF.facility_id = F.facility_id");
        $data['getdetails'] = $this->common_model->get_record_single("VF.venue_id = '$vid' and VF.facility_id = '$fid'", "F.*,V.venue_display_name");
        $this->layout->view($this->view_dir,$data);
    }
    public function editfacilityvenueinfo($fid, $vid)
    {
        $this->common_model->initialise('venues as V');
        $this->common_model->join_tables = array("vendor as VD");
        $this->common_model->join_on = array("V.vendor_id = VD.vendor_id");
        $data['getvenues'] = $this->common_model->get_records(0, 'V.*', "V.venue_id = '" . $vid . "'");
        //$this->common_model->initialise('facilities');
        //$data['getallfacilities']=$this->common_model->get_records(0,'*','');
        $this->common_model->initialise("venue_facilities  as VF");
        $this->common_model->join_tables = array("venues as V", "facilities as F", "vendor as VD", "venue_category as VC");
        $this->common_model->join_on = array("VF.venue_id = V.venue_id", "VF.facility_id = F.facility_id", "V.vendor_id = VD.vendor_id", "F.base_type_id=VC.category_id");
        $data['getallfacilities'] = $this->common_model->get_records(0, "VF.*,F.facility_name,V.venue_display_name", "VF.venue_id = '" . $vid . "'", '', '', "F.facility_id");
        $this->common_model->initialise('venue_facilities as VF');
        $this->common_model->join_tables = array('venues as V', 'facilities as F');
        $this->common_model->join_on = array("VF.venue_id = V.venue_id", "VF.facility_id = F.facility_id");
        $data['getdetails'] = $this->common_model->get_record_single("VF.venue_id = '$vid' and VF.facility_id = '$fid'", "F.*,V.venue_id,V.venue_display_name");
        $data['facility_id'] = $fid;
        $data['venue_id'] = $vid;
        $this->load->view("edit_venue_facility", $data);
    }
    public function editfacilityvenuedetails()
    {
        $venue_id = $this->input->post('venue');
        $facility_id = $this->input->post('facility');
        $ofacility_id = $this->input->post('ofacility');
        $facilitytype = $this->input->post('facility');
        $this->common_model->initialise('venue_facilities');
        $this->common_model->array = array('venue_id' => $venue_id, 'facility_id' => $facility_id);
        $update = $this->common_model->update("venue_id = '$venue_id' and facility_id = '$ofacility_id'");
        if ($update == FALSE) {
            redirect(base_url("admin/managevenuefacilities/{$venue_id}"));
        }

    }
    public function editfacilityvenuedetails1()
    {
        $venue_id = $this->input->post('venue');
        $facility_id = $this->input->post('facility');
        $ofacility_id = $this->input->post('ofacility');
        $facilitytype = $this->input->post('facility');
        $this->common_model->initialise('venue_facilities');
        $this->common_model->array = array('venue_id' => $venue_id, 'facility_id' => $facility_id);
        $update = $this->common_model->update("venue_id = '$venue_id' and facility_id = '$ofacility_id'");
        if ($update == FALSE) {
            redirect(base_url("admin/managevenuefacilities/{$venue_id}"));
        }

    }
    /* End Vendor and venue facilities */
    /*Coins*/
   public function managecoins()
    {
        $data = array();
        $data['getallcoins'] = $this->getallcategoriesdata('coins','',"type = 1");
        $this->layout->view($this->view_dir,$data);
    }
    public function addcoins(){
                $data=array();
               	if(isset($_POST['addcoin'])){
		$expfromdte=explode("-",$this->input->post('from_date'));
		$fromdate=$expfromdte[2]."-".$expfromdte[0]."-".$expfromdte[1];
               	$exptodte=explode("-",$this->input->post('to_date'));
		$todate=$exptodte[2]."-".$exptodte[0]."-".$exptodte[1];
		$requestcoindata=array("coins"=>$this->input->post('coins'),"method"=>$this->input->post('method'),"type"=>1,"from_date"=>$fromdate,"end_date"=>$todate,"limit"=>$this->input->post('limit'),"status"=>1);
		$insertcoins=$this->db->insert("tbl_coins",$requestcoindata);
		if(isset($insertcoins)){
			$this->session->set_flashdata("add_coin_success","You Have Added Coins Successfully");
			redirect(base_url("admin/managecoins"));
		}
		}
                $this->layout->view($this->view_dir,$data);
		}
    public function editcoinsinfo($coinid)
    {
        $this->common_model->initialise("coins");
        $data['editcoin'] = $this->common_model->get_record_single("coin_id = '$coinid'", "*");
        $this->layout->view($this->view_dir,$data);
    }
    public function editcoindetails()
    {
        if (isset($_POST['coinsubmit'])) {
            $coinid = $this->input->post("coin_id");
            $expfromdte=explode("-",$this->input->post('from_date'));
		$fromdate=$expfromdte[2]."-".$expfromdte[0]."-".$expfromdte[1];
               	$exptodte=explode("-",$this->input->post('to_date'));
		$todate=$exptodte[2]."-".$exptodte[0]."-".$exptodte[1];
            $this->load->library("form_validation");
            $this->form_validation->set_rules('coin', 'Coins', 'required|trim');
            $this->form_validation->set_rules('method', 'Method', 'required|trim');
            $this->form_validation->set_rules('type', 'Type', 'required|trim');
            $this->form_validation->set_rules('from_date', 'From Date', 'required|trim');
            $this->form_validation->set_rules('to_date', 'End Date', 'required|trim');
            $this->form_validation->set_rules('limit', 'Limit', 'required|trim');
            $this->form_validation->set_message('required', '%s should not be empty');
            $this->form_validation->set_message('valid_email', '%s should be a valid email');
            $this->form_validation->set_message('is_unique', 'You have Already registered with us');
            if ($this->form_validation->run("edit_coin") == FALSE) {
                $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
            } else {
                $editcoindata = array("coins" => $this->input->post("coin"),"method" => $this->input->post("method"),"type" => $this->input->post("type"),"from_date" => $fromdate,"end_date" => $todate,"limit" => $this->input->post("limit"));
                $this->common_model->initialise("coins");
                $this->common_model->array = $editcoindata;
                $coinupdatedata = $this->common_model->update("coin_id = '$coinid'");
                if (isset($coinupdatedata)) {
                    $this->session->set_flashdata("edit_success_coin", "Updated Successfully");
                    redirect(base_url("admin/managecoins"));
                }
            }
        }
    }
  public function managefacilities()
    {
        $data = array();
        $this->common_model->initialise("facilities");
        $data['getallfacilities'] = $this->common_model->get_records(0, "*", '', 'facility_id');
        $this->layout->view($this->view_dir,$data);
    }
    public function addfacility()
    {
        if (isset($_POST['faclsubmit'])) {
            $this->load->library("form_validation");
            $this->form_validation->set_rules("ftype", "Facility Type", "required|trim");
            $this->form_validation->set_rules("type", "You must Select Category or Subcatogory", "required|trim");
            $this->form_validation->set_rules("faclty_name", "Facility Name", "required|trim");
            $this->form_validation->set_message("required", "%s Should not be Empty");
            if ($this->form_validation->run("add_subcat") == FALSE) {
                $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
            } else {
                $facilitydata = array("base_type" => $this->input->post('ftype'),"base_type_id" => $this->input->post('type'),"facility_name" => addslashes(ucfirst($this->input->post('faclty_name'))),"status" => 1);
                $this->common_model->initialise('facilities');
                $this->common_model->array=$facilitydata;
               $facility_id = $this->common_model->insert_entry();
                $target_dir = "images/facilities";
                $targetfile = $target_dir . "/" . "{$facility_id}_facility" . ".jpg";
                $facilitydata['facility_image'] = "{$facility_id}_facility" . ".jpg";
                $this->updatedetails($facilitydata, "facilities", $facility_id);
                move_uploaded_file($_FILES['facility_image']['tmp_name'], $targetfile);
                if ($facility_id) {
                    $this->session->set_flashdata("facility_success", "You Have Added Facility Successfully");
                    redirect(base_url("admin/managefacilities"));
                }
            }
        }
        $this->layout->view($this->view_dir);
     }
    public function viewfacilityinfo($facility_id)
    {
        $data = array();
        $this->common_model->initialise("facilities as F");
        $this->common_model->join_tables = array("categories as C", "sub_categories as SC","sub_sub_categories as SSC");
        $this->common_model->join_on = array("F.base_type_id=C.category_id", "F.base_type_id=SC.sub_category_id","F.base_type_id = SSC.sub_sub_category_id");
        $this->common_model->left_join = array("left", "left","left");
        $select = "F.*,C.category_name,SC.sub_category_name,SSC.sub_sub_category_name";
        $where = "F.facility_id = " . $facility_id;
        $data['viewfacilities'] = $this->common_model->get_record_single($where, $select);
        $this->layout->view($this->view_dir,$data);
    }
    public function editfacilityinfo($facility_id)
    {
        $data = array();
        $this->common_model->initialise("facilities");
        $data['editfacilities'] = $this->common_model->get_record_single("facility_id = '$facility_id'", "*");
        $data['categories'] = $this->getallcategoriesdata("categories");
        $data['subcategories'] = $this->getallcategoriesdata("sub_categories");
        $data['subsubcategories'] = $this->getallcategoriesdata("sub_sub_categories");
        $this->layout->view($this->view_dir,$data);
    }
    public function editfacilitydetails()
    {
        $facility_id = $this->input->post('facilityid');
        $facilitydata = array("base_type" => $this->input->post('ftype'),"base_type_id" => $this->input->post('type'),"facility_name" => ucfirst($this->input->post('faclty_name')));
        $this->common_model->initialise("facilities");
        $this->common_model->array = $facilitydata;
        $updatefacility = $this->common_model->update("facility_id = '$facility_id'");
        $target_dir = "images/facilities";
        $targetfile = $target_dir . "/" . "{$facility_id}_facility" . ".jpg";
        $facilitydata['facility_image'] = "{$facility_id}_facility" . ".jpg";
        $this->updatedetails($facilitydata, "facilities", $facility_id);
        move_uploaded_file($_FILES['facility_image']['tmp_name'], $targetfile);
        $this->session->set_flashdata("update_facility", "Facilities Updated Successfully");
        redirect(base_url("admin/managefacilities"));
    }
    public function deletefacility($deleteid)
    {
        $res=$this->common_model->pureQuery("delete from `tbl_facilities` where facility_id ='$deleteid'");
        redirect(base_url("admin/managefacilities"));
    }
    public function manageslots($venueid)
    {
        $data = array();
        $this->common_model->initialise("venues");
        $select = "venue_id,vendor_id";
        $where = "venue_id = " . $venueid;
        $data['getdetails'] = $this->common_model->get_record_single($where, $select);
        $this->layout->view($this->view_dir, $data);
   }
    public function addslots($vendorid, $venueid)
    {
        $data = array();
        $data['venuedetails']=$this->venueslotdetails($venueid);
        $data['venueid'] = $venueid;
        $data['vendorid'] = $vendorid;
        $data['getallcategories']=$this->getallcategoriesdata("categories");
        $data['getallsubcategories']=$this->getallcategoriesdata("sub_categories");
        $data['getallsubsubcategories']=$this->getallcategoriesdata("sub_sub_categories");
        $this->common_model->initialise("venues");
        $data['getallvenues'] = $this->common_model->get_records(0, "*", '');
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
                                redirect(base_url("admin/addslots/$vendorid/$venueid"));
                            }
                  } else {
                            $this->session->set_flashdata("error_slot_time", "Slot Timings Should match the Working Hours");
                        redirect(base_url("admin/addslots/$vendorid/$venueid"));
                           }
                        
                    }
                    if ($inserttimeslot) {
                        $this->session->set_flashdata("success_slot", "Slot Added Successfully");
                         redirect(base_url("admin/manageslots/$venueid"));
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
        return $this->common_model->get_record_single("V.venue_id = '$venueid'", 'V.*,VC.category_id,VSC.sub_category_id,VSSC.sub_sub_category_id,W.start_time,W.end_time');
}
private function getallcategoriesdata($table,$select=null,$where=null){
    $this->common_model->initialise($table);
    if($select==null){$select="*";}
    return $this->common_model->get_records(0,$select,$where);
}
    public function viewslotinfo($slot_id, $venueid)
    {
        $this->common_model->initialise("venues");
        $data['slotid'] = $slot_id;
        $data['venueid'] = $venueid;
        $data['getallvenues'] = $this->common_model->get_records(0, "*", '');
        $this->common_model->initialise("time_slots as TS");
        $this->common_model->join_tables = array("venues as V", "categories as C", "sub_categories as S","sub_sub_categories as SS", "working_hours as W");
        $this->common_model->join_on = array("TS.venue_id=V.venue_id", "TS.category_id = C.category_id", "TS.sub_category_id = S.sub_category_id","TS.sub_sub_category_id = SS.sub_sub_category_id", "TS.venue_id = W.venue_id");
        $this->common_model->left_join = array("left", "left", "left", "left", "left", "left","left");
        $where = "slot_id = " . $slot_id;
        $select = "TS.*,V.venue_display_name,C.category_name,S.sub_category_name,SS.sub_sub_category_name";
        $data['viewslotinfo'] = $this->common_model->get_record_single($where, $select);
        $this->layout->view($this->view_dir, $data); 
    }
    public function editslotinfo($slot_id, $venueid)
    {
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
    public function editslotdetails()
    {
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
                                redirect(base_url("admin/editslotinfo/$slotid/$venueid"));
                            }
                        } else {
                            $this->session->set_flashdata("error_slot", "Slot Already Exists");
                            redirect(base_url("admin/editslotinfo/$slotid/$venueid"));
                            }
                    } else {
                        $this->session->set_flashdata("error_slot_time", "Slot Timings Should match the Working Hours");
                        redirect(base_url("admin/editslotinfo/$slotid/$venueid"));
                    }
                    if ($inserttimeslot == FALSE) {
                        $this->session->set_flashdata("success_slot", "Slot Updated Successfully");
                        redirect(base_url("admin/manageslots/$venueid"));
                    }
                }
            }
        }
    }
     public function changepassword()
    {
        $data = array();
        $userid = $this->session->userdata['user_id'];
        $c_pwd = md5($this->input->post('c_pwd'));
        $n_pwd = $this->input->post('n_pwd');
        $c_n_pwd = $this->input->post('c_n_pwd');
        $this->common_model->initialise("users");
        $where = "user_id = " . $userid;
        $select = "*";
        $getuserid = $this->common_model->get_record_single($where, $select);
        if (isset($_POST['pwdsubmit'])) {
            $this->load->library("form_validation");
            $this->form_validation->set_rules("c_pwd", "Confirm Password", "required|trim");
            $this->form_validation->set_rules("n_pwd", "New Password", "required|trim");
            $this->form_validation->set_rules("c_n_pwd", "Confirm New Password", "required|trim");
            $this->form_validation->set_message("required", "%s Should not be Empty");
            if ($this->form_validation->run("changepwd") == FALSE) {
                $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
            } else if ($c_pwd != $getuserid->password) {
                $this->session->set_flashdata("c_pwd_error", "Current Password is Wrong");
                redirect(base_url("admin/changepassword"));

            } else if ($n_pwd != $c_n_pwd) {
                $this->session->set_flashdata("n_pwd_error", "Password and Confirm Password Should Match");
                redirect(base_url("admin/changepassword"));
            } else {
                $passdata = array("password" => md5($n_pwd));
                $this->common_model->initialise("users");
                $this->common_model->array = $passdata;
                $where = "user_id = " . $userid;
                $updatepwddata = $this->common_model->update($where);
                if (isset($updatepwddata)) {
                    $this->session->set_flashdata("update_pwd", "Password Updated Successfully");
                    redirect(base_url("admin/changepassword"));
                }
            }
        }
        $this->layout->view($this->view_dir,$data);
        }
    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_phone');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_type');
        $this->session->sess_destroy();
        redirect(base_url());
    }
    public function vendorupload()
    {
        $this->common_model->initialise("categories");
        $getcats = $this->common_model->get_records(0, "category_name", "");
        $data = array();
        if (isset($_POST['vendorsubmit'])) {
            $uniqid = date('Ymdhis');
            if (!empty($_FILES)) {
                $FileType = pathinfo($_FILES['vupload']['name'], PATHINFO_EXTENSION);
            }
            if (!empty($_FILES) && is_uploaded_file($_FILES['vupload']['tmp_name']) && ($FileType == 'xlx' || $FileType == 'csv' || $FileType == 'xlsx')) {
                $basic_array = array();
                $data['error'] = "Problem with file upload";
                $target_dir = "uploads";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                if (move_uploaded_file($_FILES['vupload']['tmp_name'], $target_dir . '/' . $uniqid . '_' . $_FILES['vupload']['name'])) {
                    $this->load->library('excel');
                    $inputFileType = PHPExcel_IOFactory::identify(FCPATH . $target_dir . '/' . $uniqid . '_' . $_FILES['vupload']['name']);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objReader->setReadDataOnly(true);
                    /**  Load $inputFileName to a PHPExcel Object  * */
                    $objPHPExcel = $objReader->load(FCPATH . $target_dir . '/' . $uniqid . '_' . $_FILES['vupload']['name']);
                    $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                    $highestRow = $objWorksheet->getHighestRow();
                    $highestColumn = $objWorksheet->getHighestColumn();
                    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                    for ($row = 2; $row <= $highestRow; ++$row) {
                        $excel_list = array('company_name', 'name', 'email', 'phone', 'address', 'city', 'state', 'country', 'pincode', 'web_url', 'category', 'subcategory', 'subsubcategory','venue_display_name', 'contact_person', 'phone', 'email', 'address', 'city', 'state', 'country', 'pincode', 'location', 'lat', 'lng');
                        $venue_array = array('email', 'phone', 'address', 'city', 'state', 'country', 'pincode',  'venue_display_name', 'contact_person', 'phone', 'email', 'address', 'city', 'state', 'country', 'pincode', 'location', 'lat', 'lng');
                        $user_array = array('name', 'email', 'phone');
                        $vendor_array = array('company_name', 'phone', 'address', 'city', 'state', 'country', 'pincode', 'web_url');
                        for ($col = 1; $col <= 25; ++$col) {
                            
                          $Pin_in_arrays = $excel_list[$col-1];
                            if (in_array($Pin_in_arrays, $user_array)) {
                                $objWorksheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();
                                $user_data[$Pin_in_arrays] = $objWorksheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();
                            }
                            if (in_array($Pin_in_arrays, $vendor_array)) {
                               // echo "<pre>";print_r($this->db);exit;
                                $vendor_data[$Pin_in_arrays] = mysqli_real_escape_string($this->db->conn_id,$objWorksheet->getCellByColumnAndRow($col, $row)->getCalculatedValue());
                            }
                            if (in_array($Pin_in_arrays, $venue_array)) {
                                $venue_data[$Pin_in_arrays] = $objWorksheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();
                            }
                        }
                        $vendor_cat_data['category'] = $objWorksheet->getCellByColumnAndRow(11, $row)->getCalculatedValue();
                        $vendor_sub_cat_data['subcategory'] = $objWorksheet->getCellByColumnAndRow(12, $row)->getCalculatedValue();
                        $vendor_sub_sub_cat_data['subsubcategory'] = $objWorksheet->getCellByColumnAndRow(13, $row)->getCalculatedValue();
                        $venue_data['status'] = 1;
                        $days_data = $objWorksheet->getCellByColumnAndRow(26, $row)->getCalculatedValue();
                        $slots_data = $objWorksheet->getCellByColumnAndRow(27, $row)->getCalculatedValue();
                        $facility_data = $objWorksheet->getCellByColumnAndRow(34, $row)->getCalculatedValue();
                        $user_data['password'] = md5("123456789");
                        if (!empty($vendor_data['company_name'])) {
                            if (!empty($user_data['email'])) {
                                $getvendorid = $this->getvendorbyemail($user_data['email']);

                                if (!empty($getvendorid)) {
                                    $venue_data['vendor_id'] = $getvendorid;

                                } else {
                                    $this->common_model->initialise('vendor');
                                    //$vendor_data=$this->trim_addslashes($vendor_data);
                                    $getvendor = $this->common_model->get_record_single("company_name = '" . $vendor_data['company_name'] . "'", '*');
                                    if (!empty($getvendor)) {
                                        $venue_data['vendor_id'] = $getvendor->vendor_id;
                                    } else {
                                        $this->common_model->initialise('users');
                                        $this->common_model->array = $user_data;
                                        $user_id = $this->common_model->insert_entry();
                                        $this->common_model->initialise('user_types');
                                        $this->common_model->array = array('user_id' => $user_id, 'user_type' => 2);
                                        $ut = $this->common_model->insert_entry();
                                        $vendor_data['user_id'] = $user_id;
                                        $this->common_model->initialise('vendor');
                                        $this->common_model->array = $vendor_data;
                                        $vendor_id = $this->common_model->insert_entry();
                                        $venue_data['vendor_id'] = $vendor_id;
                                    }
                                }
                                $this->common_model->initialise('venues');
                                $this->common_model->array = $venue_data;
                                $venue_id = $this->common_model->insert_entry();
                                $categories_lists_ids = $this->insert_categories_venue($venue_id, $vendor_cat_data['category'], $vendor_sub_cat_data['subcategory'], $vendor_sub_sub_cat_data['subsubcategory']);
                                for ($i = 1; $i < 8; $i++) {
                                    $day_data = explode("-", $days_data);
                                    if (!empty($day_data[1])) {
                                        $fromtime = $day_data[0];
                                        $endtime = $day_data[1];
                                    } else {
                                        $fromtime = "00:00:00";
                                        $endtime = "23:59:59";
                                    }
                                    $warray = array('venue_id' => $venue_id, 'category_id' => $categories_lists_ids['category'], 'sub_category_id' => $categories_lists_ids['subcategory'], 'sub_sub_category_id' => $categories_lists_ids['subsubcategory'], 'day_id' => $i, 'start_time' => $fromtime, 'end_time' => $endtime, 'status' => 1);
                                    $workinghour = $this->workinghoursdata($warray);
                                }

                                if (!empty($facility_data)) {
                                    $facility = explode(',', $facility_data);
                                    $n = count($facility);
                                    for ($i = 0; $i < $n; $i++) {
                                        $this->common_model->initialise('facilities');
                                        $getfacility = $this->common_model->get_record_single("facility_name like '%$facility[$i]%'", "facility_id");
                                        if (!empty($getfacility)) {
                                            $facility_array = array('venue_id' => $venue_id, 'facility_id' => $getfacility->facility_id, 'status' => 1);
                                            $facilities = $this->uploadfacilities($facility_array);
                                        }
                                    }
                                    $data['error'] = "";
                                }
                            }
                        }
                    }
                    if (empty($data['error'])) {
                        $dnfile = $uniqid . '_' . $_FILES['vupload']['name'];
                        unlink("uploads/$dnfile");
                        // $this->setFlashmessage('success', 'File Uploads Successfully');
                        $this->session->set_flashdata("venodr_upload", "Vendor File Uploaded Successfully");
                        redirect(base_url("admin/managevendors"));
                    }
               }
            }
        }//submit
        $this->layout->view($this->view_dir,$data);
        }
    private function insert_categories_venue($venue_id, $category, $sub_category, $subsubcategory)
    {
        if (!empty($category)) {
            //echo $category; exit;
            $category = $this->getcategory($category);
            $this->common_model->initialise('venue_category');
            $this->common_model->array = array("venue_id" => $venue_id, "category_id" => $category, "status" => 1);
            $ct = $this->common_model->insert_entry();
        }
        if (!empty($sub_category)) {
            $subcategory = $this->getsubcategory($category, $sub_category);
            $this->common_model->initialise('venue_sub_category');
            $this->common_model->array = array("venue_id" => $venue_id, "sub_category_id" => $subcategory, "status" => 1);
            $sct = $this->common_model->insert_entry();
        }
        if (!empty($subsubcategory)) {
            $subsubcategory = $this->getsubsubcategory($category, $subcategory, $subsubcategory);
            $this->common_model->initialise('venue_sub_sub_categories');
            $this->common_model->array = array("venue_id" => $venue_id, "sub_sub_category_id" => $subsubcategory, "status" => 1);
            $ssct = $this->common_model->insert_entry();
        }
        return ['category' => $category, 'subcategory' => $subcategory, 'subsubcategory' => $subsubcategory];
    }
    private function getcategory($category)
    {
        $this->common_model->initialise('categories');
        $getcat = $this->common_model->get_record_single("category_name = '$category'", "category_id");
        if (!empty($getcat)) {
            return $getcat->category_id;
        } else {
            $this->common_model->array = array("category_name" => $category);
            return $this->common_model->insert_entry();
        }
    }
    private function getsubcategory($categoryid, $subcat)
    {
        $this->common_model->initialise('sub_categories');
        $getsubcat = $this->common_model->get_record_single("sub_category_name = '$subcat' AND category_id = '$categoryid'", "sub_category_id");
        if (!empty($getsubcat)) {
            return $getsubcat->sub_category_id;
        } else {
            $this->common_model->array = array("sub_category_name" => $subcat, "category_id" => $categoryid);
            return $this->common_model->insert_entry();
        }
    }
    private function getsubsubcategory($categoryid, $subcatid, $subsubcat)
    {
        $this->common_model->initialise('sub_sub_categories');
        $getsubsubcat = $this->common_model->get_record_single("sub_sub_category_name = '$subsubcat' AND category_id = '$categoryid' AND sub_category_id = '$subcatid'", "sub_sub_category_id");
          if (!empty($getsubsubcat)) {
            return $getsubsubcat->sub_sub_category_id;
        } else {
            $this->common_model->array = array("sub_sub_category_name" => $subsubcat, "category_id" => $categoryid, "sub_category_id" => $subcatid);
            return $this->common_model->insert_entry();
        }
    }
    private function workinghoursdata($data)
    {
        $this->common_model->initialise('working_hours');
        $this->common_model->array = $data;
        $wid = $this->common_model->insert_entry();
        return true;
    }
      private function getvendorbyemail($email){
        $this->common_model->initialise('users as U');
        $this->common_model->join_tables=array("vendor as V");
        $this->common_model->join_on=array("U.user_id = V.user_id");
        $vendorid=$this->common_model->get_record_single("U.email = '$email'","V.vendor_id");
        if(!empty($vendorid)){
            return $vendorid->vendor_id;
        }
    }
    /*excel Upload */
    private function slot_add($data1, $data2, $id)
    {
        $data = explode(' ', $data1);
        $this->common_model->initialise('time_slots');
        $this->common_model->array = array('slot_to_time' => $data[0]);
        $update = $this->common_model->update("slot_id = '$id'");
        if ($update == false) {
            return array('from_time' => $data[1], 'end_time' => $data2);
        }
    }
    private function uploadfacilities($data)
    {
        $this->common_model->initialise('venue_facilities');
        $this->common_model->array = $data;
        $facility = $this->common_model->insert_entry();
        return true;
    }
    public function manageimages($venueid, $vendorid)
    {
        $data = array();
        $data['venueid'] = $venueid;
        $data['vendorid'] = $vendorid;
        $data['images'] = $this->getimages($venueid, $vendorid);
        $this->layout->view($this->view_dir,$data);
    }
    private function getimages($venueid, $vendorid)
    {
        $directory = 'images/venues';
        $handler = opendir($directory);
        while ($file = readdir($handler)) {
            if ($file != "." && $file != "..") {
                if (preg_match('(^' . $vendorid . '+[-]+' . $venueid . '+[^\\s]+(\\.(?i)(jpg|png|gif|bmp))$)', $file)) {
                    $data[] = $file;
                }
            }
        }
        if (isset($data)) {
            return $data;
        }
    }
    public function deleteimages($venueid, $vendorid, $imcount)
    {
        $target_dir = "images/venues/";
        $path = $target_dir . $vendorid . "-" . $venueid . "-" . $imcount . ".jpg";
        if (unlink($path)) {
            $this->session->set_flashdata('success', 'Deleted Successfully');
            redirect(base_url("admin/manageimages/$venueid/$vendorid"));
        }
    }
/*
 * Functin to extract zipfiles into venues folder
 * **/
     public function addimages($venueid, $vendorid)
    {
        $data = array();
        $data['venueid'] = $venueid;
        $data['vendorid'] = $vendorid;
        if (isset($_POST['vendorsubmit'])) {
            if (!empty($_FILES)) {
                $imgexist = $this->getimages($venueid, $vendorid);
                $n = count($imgexist);
                if($n<=5){
                $img = explode(".", $imgexist[$n - 1]);
                $img2 = explode("-", $img[0]);
                $imcount = $img2[2];
                $imncount = $imcount + 1;
                $target_dir = "images/venues/";
                $allwoed_extentions = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF');
                $target_file = $target_dir . $vendorid . "-" . $venueid . "-" . $imncount . ".jpg";
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                if (!in_array($imageFileType, $allwoed_extentions)) {
                    $this->session->set_flashdata('error', 'Problem with Upload data');
                    } else {
                    if (move_uploaded_file($_FILES["iupload"]["tmp_name"], $target_file)) {
                        $this->session->set_flashdata('success', 'Image Uploaded Successfully');
                        }
                }
                }else{
                $this->session->set_flashdata('error','Image Limit Exceeded');
            } redirect(base_url("admin/manageimages/$venueid/$vendorid"));
            }
        }
        $this->layout->view($this->view_dir,$data);
        }
    public function catupload()
    {
        $data = array();
        if (isset($_POST['vendorsubmit'])) {
            $uniqid = date('Ymdhis');
            if (!empty($_FILES)) {
                $FileType = pathinfo($_FILES['vupload']['name'], PATHINFO_EXTENSION);
            }
            if (!empty($_FILES) && is_uploaded_file($_FILES['vupload']['tmp_name']) && ($FileType == 'xlx' || $FileType == 'csv' || $FileType == 'xlsx')) {
                $basic_array = array();
                $data['error'] = "Problem with file upload";
                $target_dir = "uploads";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                if (move_uploaded_file($_FILES['vupload']['tmp_name'], $target_dir . '/' . $uniqid . '_' . $_FILES['vupload']['name'])) {
                    $this->load->library('excel');
                    $inputFileType = PHPExcel_IOFactory::identify(FCPATH . $target_dir . '/' . $uniqid . '_' . $_FILES['vupload']['name']);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objReader->setReadDataOnly(true);
                    /**  Load $inputFileName to a PHPExcel Object  * */
                    $objPHPExcel = $objReader->load(FCPATH . $target_dir . '/' . $uniqid . '_' . $_FILES['vupload']['name']);
                    $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                    $highestRow = $objWorksheet->getHighestRow();
                    $highestColumn = $objWorksheet->getHighestColumn();
                    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                    for ($row = 1; $row <= $highestRow; ++$row) {
                        $user_data['category'] = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $catid = $this->getcatid($user_data['category']);
                        $user_data['subcategory'] = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $subcatid = $this->getsubcatid($user_data['subcategory']);
                        if (empty($subcatid)) {
                            $this->common_model->initialise('sub_categories');
                            $this->common_model->array = array('category_id' => $catid, 'sub_category_name' => $user_data['subcategory']);
                            $subcatid = $this->common_model->insert_entry();
                        }
                        $user_data['subsubcategory'] = $objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $subsubcatid = $this->getsubsubcatid($user_data['subsubcategory']);
                        if (empty($subsubcatid)) {
                            $this->common_model->initialise('sub_sub_categories');
                            $this->common_model->array = array('category_id' => $catid, 'sub_category_id' => $subcatid, 'sub_sub_category_name' => $user_data['subsubcategory']);
                            $subsubcatid = $this->common_model->insert_entry();
                        }
                        if (isset($subsubcatid)) {
                            $data['error'] = "";
                        }
                    }
                    if (empty($data['error'])) {
                        $dnfile = $uniqid . '_' . $_FILES['vupload']['name'];
                        unlink("uploads/$dnfile");
                        $this->session->set_flashdata("success", "Categories Uploaded Successfully");
                        redirect(base_url("admin/catupload"));
                    }
                }
                // }
            }
        }//submit
        $this->layout->view($this->view_dir,$data);
        }
    private function getcatid($category)
    {
        $this->common_model->initialise('categories');
        $catid = $this->common_model->get_record_single("category_name = '$category'", 'category_id');
        if (isset($catid)) {
            return $catid->category_id;
        }
    }
    private function getsubcatid($subcategory)
    {
        $this->common_model->initialise('sub_categories');
        $subcatid = $this->common_model->get_record_single("sub_category_name = '$subcategory'", "sub_category_id");
        if (isset($subcatid)) {
            return $subcatid->sub_category_id;
        }
    }
    private function getsubsubcatid($subsubcategory)
    {
        $this->common_model->initialise('sub_sub_categories');
        $subsubcatid = $this->common_model->get_record_single("sub_sub_category_name = '$subsubcategory'", "sub_sub_category_id");
        if (isset($subsubcatid)) {
            return $subsubcatid->sub_sub_category_id;
        }
    }
/*
* Functin to extract zipfiles into venues folder
* **/
    public function catzip()
    {
        $data = array();
        if (isset($_POST['vendorsubmit'])) {
            if (!empty($_FILES)) {
                $FileType = pathinfo($_FILES['vupload']['name'], PATHINFO_EXTENSION);
            }
            if (!empty($_FILES) && is_uploaded_file($_FILES['vupload']['tmp_name']) && ($FileType == 'zip')) {
                $basic_array = array();
                $data['error'] = "Problem with file upload";
                $target_dir = "images/venues/categories/";
                $zip = $this->zipfiles($target_dir, $_FILES['vupload']['name']);
                if ($zip == true) {
                    $this->session->set_flashdata('success', 'File Uploads Successfully');
                    redirect(base_url("admin/catzip"));
                } else {
                    $this->session->set_flashdata('error', 'Check the File Uploaded');
                    redirect(base_url("admin/catzip"));
                }
            } else {
                $this->session->set_flashdata('error', 'Check the File Uploaded');
                redirect(base_url("admin/catzip"));
            }
        }
        $this->layout->view($this->view_dir, $data);
        }
    public function subcatzip()
    {
        $data = array();
        if (isset($_POST['vendorsubmit'])) {
            if (!empty($_FILES)) {
                $FileType = pathinfo($_FILES['vupload']['name'], PATHINFO_EXTENSION);
            }
            $this->session->set_flashdata('error', 'Check the File Uploaded');
            if (!empty($_FILES) && is_uploaded_file($_FILES['vupload']['tmp_name']) && ($FileType == 'zip')) {
                $basic_array = array();
                $data['error'] = "Problem with file upload";
                $target_dir = "images/venues/subcategories/";
                $zip = $this->zipfiles($target_dir, $_FILES['vupload']['name']);
                $this->session->set_flashdata('error', 'Check the File Uploaded');
                if ($zip == true) {
                    $this->session->set_flashdata('error', null);
                    $this->session->set_flashdata('success', 'File Uploads Successfully');
                }
            }
            redirect(base_url("admin/subcatzip"));
        }
        $this->layout->view($this->view_dir, $data);
    }
    public function subsubcatzip()
    {
        $data = array();
        if (isset($_POST['vendorsubmit'])) {
            if (!empty($_FILES)) {
                $FileType = pathinfo($_FILES['vupload']['name'], PATHINFO_EXTENSION);
            }
            if (!empty($_FILES) && is_uploaded_file($_FILES['vupload']['tmp_name']) && ($FileType == 'zip')) {
                $basic_array = array();
                $data['error'] = "Problem with file upload";
                $target_dir = "images/venues/subsubcategories/";
                $zip = $this->zipfiles($target_dir, $_FILES['vupload']['name']);
                if ($zip == true) {
                    $this->session->set_flashdata('success', 'File Uploads Successfully');
                    redirect(base_url("admin/subsubcatzip"));
                } else {
                    $this->session->set_flashdata('error', 'Check the File Uploaded');
                    redirect(base_url("admin/subsubcatzip"));
                }
            } else {
                $this->session->set_flashdata('error', 'Check the File Uploaded');
                redirect(base_url("admin/subsubcatzip"));
            }
        }
        $this->layout->view($this->view_dir, $data);
    }
    private function zipfiles($target_dir, $file)
    {
        $target_file = $target_dir . basename($_FILES["vupload"]["name"]);
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        if (move_uploaded_file($_FILES['vupload']['tmp_name'], $target_file)) {
            $fileinfo = pathinfo($target_dir . $_FILES["vupload"]["name"]);
            $zip = new ZipArchive;
            $res = $zip->open($target_dir . $fileinfo['basename']);
            if ($res === TRUE) {
                $zip->extractTo($target_dir);
                $zip->close();
                unlink($target_file);
                $this->recurse_copy($target_dir . $fileinfo['filename'], $target_dir);
                $this->delTree($target_dir . $fileinfo['filename']);
                return true;
            } else {
                return false;
            }
        }
    }
    private function recurse_copy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);

                }
            }
        }
        closedir($dir);
    }
    private function delTree($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
}
?>