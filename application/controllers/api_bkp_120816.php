<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of API
 * This give webservice for login,signup forgot password and new password for mobile application
 * @author xxxxxxxxxxx
 */
class Api extends My_Controller
{

    private $limitval;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api_model');
        $this->limitval = 20;
    }

    /*Login Api For users and Vendors
     * @email->string
     * @password->string
     * @user_type->intiger 1=customer,2=vendor
     * @login_type->intiger 1=normal,2=facebook/social network login
     **/
    public function login()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $params = $_POST;
        //print_r($data); exit;
        if (!empty($_POST) && ((!empty($_POST['email']) && !empty($_POST['social_id']) && $_POST['login_type'] == 2) || (!empty($_POST['email']) && !empty($_POST['password']) && $_POST['login_type'] == 1))) {
            $result = $this->userdetails(['email' => $this->input->post('email')], '*');
            if ($_POST['login_type'] == 1) {
                if (!empty($result) && $result->password == md5($this->input->post('password'))) {
                    $wher = array('user_id' => $result->user_id);
                    $update = $this->update_device_details($wher);
                    if ($update == false) {
                        $data['info'] = ['status' => 1, 'Message' => 'Success'];
                        $data['details'] = $result;
                    }
                } else {
                    $data['info'] = ['status' => 0, 'Message' => 'Invalid user details'];
                }
            } elseif ($_POST['login_type'] == 2) {
                if ($this->social_login_signup($params, $result)) {
                    $result = $this->userdetails(['email' => $this->input->post('email')], '*');
                    $wher = array('user_id' => $result->user_id);
                    $update = $this->update_device_details($wher);
                    $data['info'] = ['status' => 1, 'Message' => 'Success'];
                    $data['details'] = $result;
                } else {
                    $data['info'] = ['status' => 0, 'Message' => 'Previous store details dont match'];
                }

            }
        } else {
            $this->api_model->response('', 204);
        }
        $output = $this->api_model->json($data);
        echo $output;
    }

    private function userdetails($where, $select)
    {
        $this->common_model->initialise('users');
        return $result = $this->common_model->get_record_single($where, $select);
    }

    private function update_device_details($wher)
    {
        $this->common_model->initialise('device_details');
        $this->common_model->array = array('device_id' => $this->input->post('device_id'), 'device_token' => $this->input->post('device_token'), 'device_type' => $this->input->post('dtype'));
        return $update = $this->common_model->update($wher);
    }

    private function social_login_signup($data, $result)
    {
        if ($data['social_type'] == 1) {
            $array_data = ['email' => $this->input->post('email'), 'facebook_id' => $this->input->post('social_id')];
        } elseif ($data['social_type'] == 2) {
            $array_data = ['email' => $this->input->post('email'), 'google_id' => $this->input->post('social_id')];
        }

        if (!empty($result)) {

            if (($result->google_id == $this->input->post('social_id') && $_POST['social_type'] == 2) || ($result->facebook_id == $this->input->post('social_id') && $_POST['social_type'] == 1)) {
                return true;
            } elseif ((empty($result->google_id) && $_POST['social_type'] == 2) || (empty($result->facebook_id) && $_POST['social_type'] == 1)) {
                echo 'sasaa';
                $this->update_user($array_data, ['user_id' => $result->user_id]);
                return true;
            } else {
                return false;
            }
        } elseif (empty($result)) {
            $array_data['name'] = $this->input->post('name');
            $user_id = $this->insert_user($array_data);
            $this->insert_user_types($_POST['user_type'], $user_id);
            $this->insert_device_details(array('user_id' => $user_id, 'device_type' => $_POST['dtype']));
            return true;

        }
    }

    private function update_user($da_ar, $where)
    {
        $this->common_model->initialise('users');
        $this->common_model->array = $this->trim_addslashes($da_ar);
        return $this->common_model->update($where);
    }

    private function insert_user($da_ar)
    {
        $this->common_model->initialise('users');
        $this->common_model->array = $this->trim_addslashes($da_ar);
        return $this->common_model->insert_entry();
    }

    private function insert_user_types($type, $id)
    {
        $this->common_model->initialise('user_types');
        $data = array('user_id' => $id, 'user_type' => $type, 'status' => '1');
        $this->common_model->array = $data;
        $this->common_model->insert_entry();
    }

    private function insert_device_details($data_array)
    {
        $this->common_model->initialise('device_details');
        $this->common_model->array = $data_array;
        $this->common_model->insert_entry();
    }

    /*
     * Register Api for users
     * @name->string
     * @email->string
     * @phone->integer
     * @dateofbirth->date
     * @gender->string
     * @user_type->integer 4=user
     **/

    public function register()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        $required_feilds = array('name', 'email', 'password');
        $this->common_model->initialise('users');
        $user_record = $this->common_model->get_record_single(array('email' => $_POST['email']), '*');
        if (!empty($_POST) & empty($user_record)) {
            $da_ar = $_POST;
            foreach ($required_feilds as $key => $value) {
                if (empty($da_ar[$value])) {
                    // $data['info']=['status'=>0,'Message'=>"$value should not be empty"];
                    $data['error'][$value] = "$value should not be empty";
                } elseif ($value == 'password') {
                    if ((strlen($da_ar['password']) < 4)) {
                        $data['error'][$value] = "Password should contain atleast 4 characters";
                    }
                } elseif ($value = 'email') {
                    $email = $da_ar[$value];
                    if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $da_ar[$value])) {
                        $data['error'][$value] = "Please enter valid Email Address";
                    }
                }
            }//foreach
            if (!empty($data['error'])) {
                $data['info'] = ["status" => 0, "Message" => "Insufficient Data"];
            }
            if (empty($data['error'])) {

                $password = md5($_POST['password']);
                unset($da_ar['user_type']);
                unset($da_ar['dtype']);
                unset($da_ar['password']);
                $code = rand(1000, 9999);
                $da_ar['otp'] = $code;
                $da_ar['password'] = $password;
                $user_id = $this->insert_user($da_ar);
                $data['info'] = ["status" => 1, "otp" => $code, "user_id" => $user_id, "Message" => "Sucess"];
                $user_array['user_id'] = $user_id;
                if ($_POST['user_type'] == 5) {
                    $this->insert_user_types($_POST['user_type'], $user_id);
                    $this->insert_device_details(array('user_id' => $user_id, 'device_type' => $_POST['dtype']));
                    $this->send_otp($user_id);
                }
            }

        } else {
            if (!empty($user_record) && $user_record->status == '1') {
                $data['info'] = ["status" => 3, "Message" => "Already registered with this Email and Please Activate Your Account by Entering the OTP Sent to You"];
            } else if (!empty($user_record) && $user_record->status == '2') {
                $data['info'] = ["status" => 2, "Message" => "Already registered with this Email", "details" => $user_record];
            } else {
                $this->api_model->response('', 406);
            }
        }
        $output = $this->api_model->json($data);
        echo $output;
    }

    /*
     * this is a private method which is called under register api
     * @type=>user type which is integer value 4=user/customer
     * @id=>user id which is a integer value
     * **/

    private function send_otp($id)
    {
        $this->common_model->initialise('users');
        $data = (array)$this->common_model->get_record_single(array('user_id' => $id), '*', $groupby = null);
        $this->load->model('communication_model');
        $this->communication_model->send_Activate_code($data);
    }

    /*
     * this is a private method which is called under register api
     * @id=>user id which is integer value
     * **/

    public function activate()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        if (!empty($_POST)) {
            $this->common_model->initialise('users');
            $where = array('user_id' => $this->input->post('user_id'), 'otp' => $this->input->post('otp'));
            $result = $this->common_model->get_record_single($where, '*');
            if (empty($result)) {
                $data['info'] = ["status" => 0, "Message" => "Invalid OTP"];
            } else if ($result->status == '2') {
                $data['info'] = ['status' => 1, 'Message' => 'User Already Verified'];
                $data['details'] = $result;
            } else {
                $date = date('Y-m-d H:i:s');
                $this->common_model->initialise('users');
                $this->common_model->array = array('status' => 2, 'activation_date' => $date);
                $wheree = array('user_id' => $this->input->post('user_id'));
                $this->common_model->update($wheree);
                $resullt = $this->common_model->get_record_single($wheree, '*');
                $data['info'] = ['status' => 1, 'Message' => 'User Verified Sucessfully'];
                $data['details'] = $resullt;

                //$data['info']=['status'=>1,'Message'=>'User Verified Sucessfully'];
                //$data['details']=$resullt;
            }
        } else {
            $this->api_model->response('', 204);
        }
        $output = $this->api_model->json($data);
        echo $output;
    }

    /*
     * this is a private method which is called under register api
     * @id=>user id by using this we will send the otp to registered mail id
     * **/

    public function categories()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        $this->common_model->initialise('categories');
        $where = array('status' => 1);
        $result = $this->common_model->get_records(0, '*', $where);
        if (!empty($result)) {
            $data['info'] = ["status" => 1, "Message" => "Success"];
            $data['info']['catlist'] = $result;
        } else {
            $data['info'] = ["status" => 0, "Message" => "No Categories"];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    /*
      * Authenticate/User Activation Api
      * @user_id=> integer
      * @otp=>integer
      * **/

    public function landing1()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $this->common_model->initialise('categories');
            $categories = $this->common_model->get_records(0, '*', '');
            $query = "SELECT C.category_id, C.category_name,C.category_type, COUNT(*) as count FROM tbl_venues as V JOIN tbl_venue_category as VC ON V.venue_id = VC.venue_id JOIN tbl_categories as C ON  VC.category_id = C.category_id WHERE ACOS( SIN( RADIANS( `lat` ) ) * SIN( RADIANS( '" . $_POST['lat'] . "' ) ) + COS( RADIANS( `lat` ) ) * COS( RADIANS( '" . $_POST['lat'] . "' )) * COS( RADIANS( `lng` ) - RADIANS( '" . $_POST['lng'] . "' )) ) * 6380 < 1000 GROUP BY C.category_id ORDER BY C.category_id ASC ";
            $result = $this->common_model->pureQuery($query);
            //  $result=$this->common_model->storeprocedure("DashboardCategoryList({$lat},{$lng})");
            if (!empty($result)) {
                $data['info'] = ["status" => 1, "Message" => "Success"];
                $data['info']['details'] = $result;
                $data['info']['categories'] = $categories;
            } else {
                $data['info'] = ["status" => 0, "Message" => "No Activities Found"];
                $data['info']['categories'] = $categories;
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    /*
     * API for Categories
     * it will list out the categories present in the application
     **/

    public function activitylist1()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        $data = array();
        if (!empty($_POST)) {
            $this->common_model->initialise('venues as V');
            $this->common_model->join_tables = array('venue_category as VC', 'venue_sub_category as VSC', 'rating as R', 'time_slots as S', 'review as RV', 'review_details as RD', 'prices as P', 'categories as C', 'sub_categories as SC');
            $this->common_model->join_on = array("V.venue_id = VC.venue_id", "V.venue_id = VSC.venue_id", "V.venue_id = R.venue_id", "V.venue_id = S.venue_id", "V.venue_id = RV.venue_id", "RV.review_id = RD.review_id", "P.venue_id = V.venue_id", "C.category_id = VC.category_id", "SC.sub_category_id = VSC.sub_category_id");
            $this->common_model->left_join = array('left', 'left', 'left', 'left', 'left', 'left', 'left', 'left', 'left');
            $where = array('V.city' => $_POST['location'], 'VC.category_id' => $_POST['cat_id']);
            // $select="V.*,V.venue_id as venueid,count(RD.review_id) as reviewcount,P.amount,P.discount_amount,count(RV.review_id) as reviewcount";
            // $select="*,V.venue_id as venueid";
            $select = "V.venue_id,V.venue_display_name,V.rating,V.like_count,V.location,V.lat,V.lng,V.venue_pic_1,V.venue_pic_2,V.venue_pic_3,V.venue_pic_4,V.venue_pic_5,P.amount,P.discount_amount,(SELECT COUNT(*) FROM tbl_review WHERE venue_id = V.venue_id) as reviewcount";
            $result = $this->common_model->get_records(0, $select, $where);
            if (!empty($result)) {
                $data['info'] = ["status" => 1, "Message" => "Success"];
                $data['info']['details'] = $result;
            } else {
                $data['info'] = ["status" => 0, "Message" => "No Activities Found"];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    /*
     * API for Landing
     * it will show the count of activities present in that particular location category wise
     * @user_id=><integer>
     * @location=><string>
     **/

    public function activitylist()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $limit = array('limit' => $this->limitval, 'start' => $_POST['start']);
            $this->common_model->initialise('venues as V');
            $this->common_model->join_tables = array('venue_category as VC', 'venue_sub_category as VSC', 'rating as R', 'time_slots as S', 'review as RV', 'review_details as RD', 'prices as P', 'categories as C', 'sub_categories as SC');
            $this->common_model->join_on = array("V.venue_id = VC.venue_id", "V.venue_id = VSC.venue_id", "V.venue_id = R.venue_id", "V.venue_id = S.venue_id", "V.venue_id = RV.venue_id", "RV.review_id = RD.review_id", "P.venue_id = V.venue_id", "C.category_id = VC.category_id", "SC.sub_category_id = VSC.sub_category_id");
            $this->common_model->left_join = array('left', 'left', 'left', 'left', 'left', 'left', 'left', 'left', 'left');
//$where=array('V.city'=>$_POST['location'],'VC.category_id'=>$_POST['cat_id']);
            /*$location="";
            if(!empty($_POST['location'])){
                $location=" AND V.city = '".$_POST['location']."'";
            }*/
            $lat = "";
            if (!empty($_POST['lat']) && !empty($_POST['lng'])) {
                $lat = " AND ACOS( SIN( RADIANS( `V`.`lat` ) ) * SIN( RADIANS( '" . $_POST['lat'] . "' ) ) + COS( RADIANS( `V`.`lat` ) ) * COS( RADIANS( '" . $_POST['lat'] . "' )) * COS( RADIANS( `V`.`lng` ) - RADIANS( '" . $_POST['lng'] . "' )) ) * 6380 < 1000";
            }
            $subcat = "";
            if (!empty($_POST['subcat_id'])) {
                $subcat = " AND VSC.sub_category_id = '" . $_POST['subcat_id'] . "'";
            }
                   
            $where = "VC.category_id = '" . $_POST['cat_id'] . "' $subcat $lat";
//$where="$lat";
// $select="V.*,V.venue_id as venueid,count(RD.review_id) as reviewcount,P.amount,P.discount_amount,count(RV.review_id) as reviewcount";
            // $select="*,V.venue_id as venueid";
            $select = "V.venue_id,V.venue_display_name,V.rating,V.like_count,V.location,V.lat,V.lng,V.venue_pic_1,V.venue_pic_2,V.venue_pic_3,V.venue_pic_4,V.venue_pic_5,VC.category_id,VSC.sub_category_id,P.amount,P.discount_amount,(SELECT COUNT(*) FROM tbl_review WHERE venue_id = V.venue_id) as reviewcount";
            $result = $this->common_model->get_records($limit, $select, $where, 0, '', "V.venue_id");
            if (!empty($result)) {
                $data['info'] = ["status" => 1, "Message" => "Success"];
                $data['info']['details'] = $result;
            } else {
                $data['info'] = ["status" => 0, "Message" => "No Activities Found"];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    /*
    * API for Activity List
    * it will list out the actvities present in the particular category and in particular location
    * @user_id=><integer>
    * @location=><string>
    * @cat_id=><integer>
    * **/

    public function venuedetails()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $venue_id = $_POST['venue_id'];
            $category_id = $_POST['category_id'];
            $uuser = "";
            $ruser = "";
            $rselect = "IF(UL.venue_id > 0, 0, 0) as likestatus , IF(R.review_id > 0, 0, 0) as review_status";
            if (!empty($_POST['user_id'])) {
                $user_id = $_POST['user_id'];
                $uuser = " AND UL.user_id='$user_id'";
                $ruser = " AND R.user_id='$user_id'";
                $rselect = "IF(UL.venue_id > 0, 1, 0) as likestatus , IF(R.review_id > 0, 1, 0) as review_status";
            }
            $query = "SELECT V.*,$rselect
FROM (`tbl_venues` as V) 
LEFT JOIN `tbl_venue_category` as VC ON `V`.`venue_id` = `VC`.`venue_id` 
LEFT JOIN `tbl_user_like` as UL ON (V.venue_id = UL.venue_id $uuser)
LEFT JOIN `tbl_review` as R ON (V.venue_id = R.venue_id  $ruser)
WHERE `V`.`venue_id` = '$venue_id' AND `VC`.`category_id` = '$category_id'
GROUP BY R.review_id";
            $result = $this->common_model->pureQuery($query);
            if (!empty($result)) {
                $data['info'] = ["status" => 1, "Message" => "Success"];
                $data['info']['details'] = $result;
            } else {
                $data['info'] = ["status" => 0, "Message" => "No Activities Found"];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    public function venuedetails1()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $venue_id = $_POST['venue_id'];
            $category_id = $_POST['category_id'];
            $user = "";
            if (!empty($_POST['user_id'])) {
                $user_id = $_POST['user_id'];
                $user = " and user_id='$user_id'";
            }
            $query = "SELECT `V`.*,(select IF(count(*)>0,1,0 ) from tbl_user_like where venue_id='$venue_id' $user)as likestatus ,(select IF(review_id >0, 1, 0 ) from tbl_review where venue_id='$venue_id' $user)as reviewstatus  FROM (`tbl_venues` as V) LEFT JOIN `tbl_venue_category` as VC ON `V`.`venue_id` = `VC`.`venue_id`  WHERE `V`.`venue_id` = '$venue_id'  AND `VC`.`category_id` = '$category_id'";
            $result = $this->common_model->pureQuery($query);
            if (!empty($result)) {
                $data['info'] = ["status" => 1, "Message" => "Success"];
                $data['info']['details'] = $result;
            } else {
                $data['info'] = ["status" => 0, "Message" => "No Activities Found"];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    /*
     * Api for venue details
     * it will list out the details of that particular venue
     * @user_id=><integer>
     * @category_id=<integer>
     * @venue_id=<integer>
     * @location=<string>
     * **/

    public function slots1()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $cat = "";
            if (!empty($_POST['category_id'])) {
                $cat = " and S.category_id='" . $_POST['category_id'] . "'";
            }
            $subcat = "";
            if (!empty($_POST['subcategory_id'])) {
                $subcat = " and S.sub_category_id = '" . $_POST['subcategory_id'] . "'";
            }
            $query = "SELECT `S`.*, (SELECT IF(COUNT(*) >0, 1, 0 ) FROM tbl_booking WHERE booking_type='1' and venue_id='" . $_POST['venue_id'] . "' and day_id='" . $_POST['day_id'] . "' and date(created_on)='" . $_POST['date'] . "') as slotstatus
FROM (`tbl_time_slots` as S)
LEFT JOIN `tbl_booking` as B ON `S`.`venue_id` = `B`.`venue_id`
WHERE `S`.`venue_id` = '" . $_POST['venue_id'] . "' and S.day_id = '" . $_POST['day_id'] . "' $cat $subcat ";
            $result = $this->common_model->pureQuery($query);
            if (!empty($result)) {
                $data['info'] = ['status' => 1, 'Message' => 'success'];
                $data['info']['details'] = $result;
            } else {
                $data['info'] = ['status' => 0, 'Message' => 'No slots are Found'];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];

        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    public function slots()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $cat = "";
            if (!empty($_POST['category_id'])) {
                $cat = " and S.category_id='" . $_POST['category_id'] . "'";
            }
            $subcat = "";
            if (!empty($_POST['subcategory_id'])) {
                $subcat = " and S.sub_category_id = '" . $_POST['subcategory_id'] . "'";
            }
            if ($type == 1) {
                $slotstatus = "date(created_on)='" . $_POST['date'] . "'";
            } else if ($type == 2) {
                $date = strtotime("+30 days", strtotime($_POST['date']));
                $end_date = date("Y-m-d", $date);
                $slotstatus = "date(created_on) between '" . $_POST['date'] . "' and '$end_date'";
            } else if ($type == 3) {
                $date = strtotime("+90 days", strtotime($_POST['date']));
                $end_date = date("Y-m-d", $date);
                $slotstatus = "date(created_on) between '" . $_POST['date'] . "' and '$end_date'";
            } else if ($type == 4) {
                $date = strtotime("+180 days", strtotime($_POST['date']));
                $end_date = date("Y-m-d", $date);
                $slotstatus = "date(created_on) between '" . $_POST['date'] . "' and '$end_date'";
            } else if ($type == 5) {
                $date = strtotime("+365 days", strtotime($_POST['date']));
                $end_date = date("Y-m-d", $date);
                $slotstatus = "date(created_on) between '" . $_POST['date'] . "' and '$end_date'";
            }
            $query = "SELECT `S`.*, (SELECT IF(COUNT(*) >0, 1, 0 ) FROM tbl_booking WHERE booking_type='1' and venue_id='" . $_POST['venue_id'] . "' and day_id='" . $_POST['day_id'] . "' and $slotstatus) as slotstatus
FROM (`tbl_time_slots` as S)
LEFT JOIN `tbl_booking` as B ON `S`.`venue_id` = `B`.`venue_id`
WHERE `S`.`venue_id` = '" . $_POST['venue_id'] . "' and S.day_id = '" . $_POST['day_id'] . "' $cat $subcat ";
            $result = $this->common_model->pureQuery($query);
            if (!empty($result)) {
                $data['info'] = ['status' => 1, 'Message' => 'success'];
                $data['info']['details'] = $result;
            } else {
                $data['info'] = ['status' => 0, 'Message' => 'No slots are Found'];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];

        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    /*
     * Api for slot times
     * it will list out the  available time slots
     * @user_id => int
     * @category_id => int
     * @subcategory_id => int
     * @venue_id => int
     * **/

    public function facilities()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $this->common_model->initialise('facilities as F');
            $this->common_model->join_tables = array("venue_facilities as VF", "venues as V");
            $this->common_model->join_on = array('VF.facility_id=F.facility_id', 'V.venue_id=VF.venue_id');
            $select = "V.venue_id,F.*";
            $where = "V.venue_id = '" . $_POST['venue_id'] . "'";
            $result = $this->common_model->get_records(0, $select, $where);
            if (!empty($result)) {
                $data['info'] = ["status" => 1, "Message" => "Success"];
                $data['info']['details'] = $result;
            } else {
                $data['info'] = ["status" => 0, "Message" => "No Facilities Found"];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    /*
     * Api for slot times
     * it will list out the  available time slots
     * @user_id => int
     * @category_id => int
     * @subcategory_id => int
     * @venue_id => int
     * @type => int 1=day,2=month,3=quarter,4=half-yaerly,5=yearly
     * **/

    public function rating()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST) && !empty($_POST['user_id']) && !empty($_POST['venue_id']) && !empty($_POST['rate'])) {
            $this->common_model->initialise('rating');
            $getrate = $this->common_model->get_record_single("user_id = '" . $_POST['user_id'] . "' and venue_id = '" . $_POST['venue_id'] . "'", '*');
            if (empty($getrate)) {
                $this->common_model->initialise('rating');
                $this->common_model->array = array('venue_id' => $this->input->post('venue_id'), 'user_id' => $this->input->post('user_id'), 'rate' => $this->input->post('rate'));
                $result = $this->common_model->insert_entry();
                $this->updatevenuerate($_POST['venue_id']);
            } else if (!empty($getrate)) {
                $this->common_model->initialise('rating');
                $this->common_model->array = array('venue_id' => $this->input->post('venue_id'), 'user_id' => $this->input->post('user_id'), 'rate' => $this->input->post('rate'));
                $where = "user_id = '" . $_POST['user_id'] . "' and venue_id = '" . $_POST['venue_id'] . "'";
                $uresult = $this->common_model->update($where);
                $this->updatevenuerate($_POST['venue_id']);
            }
            if (isset($result) || $uresult == false) {
                $data['info'] = ["status" => 1, "Message" => "Success"];
            } else {
                $data['info'] = ["status" => 0, "Message" => "Check With the data"];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    /*
     * Api for Facilitites times
     * it will list out the  available time slots
     * @user_id => int
     * @venue_id => int
     * **/

    private function updatevenuerate($id)
    {
        $this->common_model->initialise('rating');
        $getrate = $this->common_model->get_record_single("venue_id = '$id'", "sum(rate) as total,count(*) as num");
        $avgrate = $getrate->total / $getrate->num;
        $this->common_model->initialise('venues');
        $this->common_model->array = array('rating' => $avgrate);
        $update = $this->common_model->update("venue_id = '$id'");
        if ($update == false) {
            return true;
        } else return false;
    }

    /*
     * Api for Rating
     * @user_id=><int>
     * @venue_id=><int>
     * @rate=><int>
     * **/

    public function review()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST) && !empty($_POST['user_id']) && !empty($_POST['venue_id']) && !empty($_POST['review']) && !empty($_POST['review_type'])) {
            if ($_POST['review_type'] == 1) {
                $this->common_model->initialise('review');
                $this->common_model->array = array('user_id' => $this->input->post('user_id'), 'venue_id' => $this->input->post('venue_id'));
                $rev_id = $this->common_model->insert_entry();
                if (isset($rev_id)) {
                    $rddata = array('review_id' => $rev_id, 'user_id' => $this->input->post('user_id'), 'message' => $this->input->post('review'), 'review_type' => $this->input->post('review_type'));
                    $rd_id = $this->reviewdetails($rddata);
                }
            } else if ($_POST['review_type'] == 2 && !empty($_POST['review_id'])) {
                $rddata = array('review_id' => $this->input->post('review_id'), 'user_id' => $this->input->post('user_id'), 'message' => $this->input->post('review'), 'review_type' => $this->input->post('review_type'));
                $rd_id = $this->reviewdetails($rddata);
            }
            if (isset($rd_id)) {
                $data['info'] = ['status' => 1, 'Message' => 'Review Added Successfully'];
            } else {
                $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    private function reviewdetails($data)
    {
        $this->common_model->initialise('review_details');
        $this->common_model->array = $data;
        $id = $this->common_model->insert_entry();
        if (isset($id)) {
            return $id;
        } else {
            return FALSE;
        }
    }

    /*
     * Api For Review
     * @user_id=><int>
     * @venue_id=><int>
     * @review_id=<int>
     * @review_type=<int> 1=review 2=replay
     * @review=><text>
     * **/

    public function userlike()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST) && !empty($_POST['user_id']) && !empty($_POST['venue_id'])) {
            $this->common_model->initialise('venues');
            $getlike = $this->common_model->get_record_single("venue_id = '" . $_POST['venue_id'] . "'", "like_count");
            $this->common_model->initialise('user_like');
            $getlikes = $this->common_model->get_records(0, '*', "venue_id = '" . $_POST['venue_id'] . "' and user_id = '" . $_POST['user_id'] . "'");
            if (empty($getlikes)) {
                $this->common_model->array = array('user_id' => $_POST['user_id'], 'venue_id' => $_POST['venue_id']);
                $id = $this->common_model->insert_entry();
                $this->common_model->initialise('venues');
                $lk = $getlike->like_count + 1;
                $this->common_model->array = array('like_count' => $lk);
                $update = $this->common_model->update("venue_id = '" . $_POST['venue_id'] . "'");
                if (isset($id) && $update == false) {
                    $data['info'] = ['status' => 1, 'Message' => 'success'];
                } else {
                    $data['info'] = ['status' => 0, 'Message' => 'check with data'];
                }
            } else {
                $data['info'] = ['status' => 0, 'Message' => 'Already liked'];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    public function venuesearch()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $this->common_model->initialise('venues as V');
            $this->common_model->join_tables = array('venue_category as VC', 'venue_sub_category as VSC', 'rating as R', 'time_slots as S', 'review as RV', 'review_details as RD', 'prices as P', 'categories as C', 'sub_categories as SC');
            $this->common_model->join_on = array("V.venue_id = VC.venue_id", "V.venue_id = VSC.venue_id", "V.venue_id = R.venue_id", "V.venue_id = S.venue_id", "V.venue_id = RV.venue_id", "RV.review_id = RD.review_id", "P.venue_id = V.venue_id", "C.category_id = VC.category_id", "SC.sub_category_id = VSC.sub_category_id");
            $this->common_model->left_join = array('left', 'left', 'left', 'left', 'left', 'left', 'left', 'left', 'left');
            $where = "V.venue_display_name LIKE '%" . $_POST['term'] . "%' OR V.city LIKE '%" . $_POST['term'] . "%' OR C.category_name LIKE '%" . $_POST['term'] . "%' OR SC.sub_category_name LIKE '%" . $_POST['term'] . "%'";
            $select = "V.venue_id,V.venue_display_name,V.rating,V.like_count,V.location,V.lat,V.lng,V.venue_pic_1,V.venue_pic_2,V.venue_pic_3,V.venue_pic_4,V.venue_pic_5,VC.category_id,P.amount,P.discount_amount,(SELECT COUNT(*) FROM tbl_review WHERE venue_id = V.venue_id) as reviewcount";
            $result = $this->common_model->get_records(0, $select, $where, 0, '', 'V.venue_id');
            if (!empty($result)) {
                $data['info'] = ["status" => 1, "Message" => "Success"];
                $data['info']['details'] = $result;
            } else {
                $data['info'] = ["status" => 0, "Message" => "No Activities Found"];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    /*
     * ApI for Like
     * @user_id=><int>
     * @venue_id=><int>
     * **/

    public function facilitypricing1()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $this->common_model->initialise('venues as V');
            $this->common_model->join_tables = array("venue_facilities as VF", "facilities as F", "prices as P");
            $this->common_model->join_on = array("V.venue_id = VF.venue_id", "VF.facility_id = F.facility_id", "V.venue_id = P.venue_id");
            $where = "P.price_type = '4' and P.base_type_id=VF.facility_id and V.venue_id='" . $_POST['venue_id'] . "'";
            $select = "V.venue_id,F.facility_name,P.price_id,P.amount,P.discount_amount";
            $getfacilities = $this->common_model->get_records(0, $select, $where);
            if (!empty($getfacilities)) {
                $data['info'] = ['status' => 1, 'Message' => 'success'];
                $data['info']['details'] = $getfacilities;
            } else {
                $data['info'] = ['status' => 0, 'Message' => 'No facilities Found'];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    /*
    * Api For Search
    * @term=><varchar>
    *
    * **/

    public function facilitypricing()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $this->common_model->initialise('addon');
            $getfacilities = $this->common_model->get_records(0, '*', "venue_id = '" . $_POST['venue_id'] . "'");
            if (!empty($getfacilities)) {
                $data['info'] = ['status' => 1, 'Message' => 'success'];
                $data['info']['details'] = $getfacilities;
            } else {
                $data['info'] = ['status' => 0, 'Message' => 'No facilities Found'];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    /*
     * Api for facility pricing
     * @venue_id=><int>
     * **/

    public function profileupdate()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        $required_feilds = array('user_id');
        if (!empty($_POST)) {
            $da_ar = $_POST;
            foreach ($required_feilds as $key => $value) {
                if (empty($da_ar[$value])) {
                    $data['error'][$value] = "$value should not be empty";
                }
            }
            if (empty($data['error'])) {

                $data_array = array('name' => $_POST['name'], 'gender' => $_POST['gender'], 'phone' => $_POST['phone']);
                if (!empty($_FILES)) {
                    $target_dir = FCPATH . "images/";
                    if (!is_dir($target_dir . "profiles")) {
                        mkdir($target_dir . "profiles", 0777, true);
                    }
                    foreach ($_FILES as $key => $value) {
                        $allwoed_extentions = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF');
                        $target_file = $target_dir . "profiles" . '/' . "{$_POST['user_id']}_user" . ".jpg";
                        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                        if (!in_array($imageFileType, $allwoed_extentions)) {
                            $data['error'] = 'Problem with Upload data';
                        } else {
                            if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
                                $filename = $_POST['user_id'] . "_user" . ".jpg";
                                $data_array[$key] = $filename;
                            }
                        }
                    }
                }

                $this->common_model->initialise('users');
                $this->common_model->array = $data_array;
                $update = $this->common_model->update(array('user_id' => $_POST['user_id']));
                $result = $this->userdetails(['user_id' => $_POST['user_id']], '*');
                $data['info'] = ["status" => 1, "Message" => "Profile Updated Successfully"];
                $data['details'] = $result;
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    public function bookinghistory()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $this->common_model->initialise('booking');
            $select = '*';
            $where = "user_id = '" . $_POST['user_id'] . "'";
            $result = $this->common_model->get_records(0, $select, $where);
            if (!empty($result)) {
                $data['info'] = ['status' => 1, "Message" => "Success"];
                $data['info']['details'] = $result;
            } else {
                $data['info'] = ['status' => 0, "Message" => 'No Bookings are found'];
            }

        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    /*
     * API for User Prifile Update
     * @user_id=><int>
     * @mobile=><varchar>
     * @name=><varchar>
     * @user_pic=><varchar>
     * @gender=><tinyint>1=male,0=female
     * **/

    public function forgotpassword()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST) && !empty($_POST['email'])) {
            $this->common_model->initialise('users');
            $user_record = $this->common_model->get_record_single(array('email' => $_POST['email']), '*');
            if (!empty($user_record)) {
                $this->common_model->initialise('hashurl');
                $code = hash('sha512', hash('md5', $_POST['email']) . hash('md5', date('ymdHis')));
                $this->common_model->array = array('user_id' => $user_record->user_id, 'hashcode' => $code, 'type' => 1);
                $hashcode = $this->common_model->insert_entry();
                $this->load->model('communication_model');
                $this->communication_model->send_recover_code(array('email' => $_POST['email'], 'message' => $code, 'name' => $user_record->name));
                $data['info'] = ['status' => 1, "Message" => "We have sent you a link to change your password"];
            } else {
                $data['info'] = ['status' => 0, 'Message' => 'Not registered with us'];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data);
        echo $output;
    }

    /*
     *API for booking History
     * @user_id => <int>
     * **/

    public function subcategories()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks whether it is POST or GET*/
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST['cat_id'])) {
            $this->common_model->initialise('sub_categories');
            $where = array('category_id' => $_POST['cat_id'], 'status' => 1);
            $result = $this->common_model->get_records(0, '*', $where, 'sub_category_id');
            if (!empty($result)) {
                $data['info'] = ["status" => 1, "Message" => "Success"];
                $data['subcategories'] = $result;
            } else {
                $data['info'] = ["status" => 0, "Message" => 'No sub categories'];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insufficient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }
    /*
     * Api for booking a Slot
     * @user_id=><int>
     * @slot_id=><int>
     * @venue_id=><int>
     *
     * **/

    /*
     * Api for forgot password
     * @email => <string>
     * **/

    public function subsubcatlist()
    {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') { /* checks whether it is POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST['cat_id']) && ($_POST['subcat_id'])) {
            $this->common_model->initialise('sub_sub_categories');
            $where = array('category_id' => $_POST['cat_id'], 'sub_category_id' => $_POST['subcat_id'], 'status' => 1);
            $result = $this->common_model->get_records(0, '*', $where, 'sub_sub_category_id');
            if (!empty($result)) {
                $data['info'] = ['status' => 1, 'Message' => 'Success'];
                $data['subsubcatlist'] = $result;
            } else {
                $data['info'] = ['status' => 0, 'Message' => 'No Sub Subcategories'];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insufficient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    /*
	* API for sub categories list
	* This API will list out the sub categories by category wise present in the application
	* @cat_id=><int>
	*/

    public function bookinglocations()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks whethter it is POST or GET*/
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $this->common_model->initialise('history_location as HL');
            $this->common_model->join_tables = array("booking as B", "categories as C");
            $this->common_model->join_on = array("HL.user_id = B.user_id", "HL.category_id = C.category_id");
            $where = "HL.user_id = '" . $_POST['user_id'] . "' ";
            $result = $this->common_model->get_records(0, 'lat,lng,place,C.category_name', $where);
            if (!empty($result)) {
                $data['info'] = ['status' => 1, 'Message' => 'Success'];
                $data['locations'] = $result;
            } else {
                $data['info'] = ['status' => 0, 'Message' => 'No Locations Presently'];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insufficient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    /* API for Sub Sub Categories
	 * This API will list out the Sub Sub Categories
	 * @cat_id=><int>
	 * @subcat_id=><int>
	 */

    public function book()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $date = $_POST['date'];
            $venuedetails = $this->getvenuedetails($_POST['venue_id']);
            $this->common_model->initialise('booking');
            $getbooked = $this->common_model->get_records(0, '*', "venue_id = '" . $_POST['venue_id'] . "' and day_id = '" . $_POST['day_id'] . "' and booked_date = '" . $_POST['date'] . "'");
            if (empty($getbooked)) {
                $booking_id = "TOSS" . rand(0, 100000);
                $booked_data = array('booking_id' => $booking_id, 'venue_id' => $_POST['venue_id'], 'user_id' => $_POST['user_id'], 'user_type' => 5, 'day_id' => $_POST['day_id'], 'category_id' => $venuedetails->category_id, 'sub_category_id' => $venuedetails->sub_category_id, 'price_id' => $venuedetails->price_id, 'booking_type' => 1, 'base_type_id' => $_POST['slots'], 'amount' => $_POST['amount'], 'status' => 2, 'booked_date' => $date);
                $this->common_model->initialise('booking');
                $this->common_model->array = $booked_data;
                $ct = $this->common_model->insert_entry();
                if (isset($ct)) {
                    $data['info'] = ['status' => 1, "Message" => "Success"];
                    $data['info']['details'] = array('booking_id' => $booking_id);
                } else {
                    $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
                }
            } else {
                $data['info'] = ['status' => 0, 'Message' => 'Already Booked'];
            }
            /*else if(!empty($getbooked)){
             $this->common_model->initialise('time_slots');
             $slots=explode(',',$_POST['slots']);
             for($i=0;$i<count($slots);$i++){
             $getslotdata=$this->common_model->get_record_single("slot_id=$slots[$i]","*");
             }
         } */
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    /* API for capture history
	   getting the location and category on booking
	   @user_id=><int>
	*/

    private function getvenuedetails($id)
    {
        $this->common_model->initialise('venues as V');
        $this->common_model->join_tables = array('venue_category as VC', 'venue_sub_category as VSC', 'prices as P', 'time_slots as TS');
        $this->common_model->join_on = array('V.venue_id = VC.venue_id', 'V.venue_id = VSC.venue_id', 'V.venue_id = P.venue_id', 'V.venue_id = TS.venue_id');
        $this->common_model->left_join = array('left', 'left', 'left', 'left');
        $select = "V.*,VC.category_id,VSC.sub_category_id,P.price_id";
        $getdetails = $this->common_model->get_record_single("V.venue_id = '$id'", $select);
        if (!empty($getdetails)) {
            return $getdetails;
        }
    }

    /*
     * Api For Booking
     * @user_id=><int>
     * @venue_id=><int>
     * @day_id=><int>
     * @slots=>array
     * @amount=><float>
     * @date=><date>
     * **/

    public function payment()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $this->common_model->initialise('payment');
            $getpaydata = $this->common_model->get_record_single("booking_id = '" . $_POST['booking_id'] . "'", '*');
            if (empty($getpaydata)) {
                $payment_id = "TOSSPAY" . rand(1, 10000);
                if ($_POST['payment_type'] == 1) {
                    $this->common_model->initialise('users');
                    $coins = $this->common_model->get_record_single("user_id = '" . $_POST['user_id'] . "'", 'coins');
                    $coins = $coins->coins - $_POST['amount'];
                    $this->common_model->array = array('coins' => $coins);
                    $update = $this->common_model->update("user_id = '" . $_POST['user_id'] . "'");
                    if ($update == FALSE) {
                        $payment_data = array('payment_id' => $payment_id, 'booking_id' => $_POST['booking_id'], 'transation_id' => $_POST['transaction_id'], 'payment_type' => 1, 'status' => 1);
                        $payment = $this->payments($payment_data);
                        if (isset($payment)) {
                            $this->common_model->initialise('booking');
                            $this->common_model->array = array('status' => 1);
                            $this->common_model->update("booking_id = '" . $_POST['booking_id'] . "'");
                            $data['info'] = ['status' => 1, "Message" => "Success"];
                        } else {
                            $this->common_model->initialise('booking');
                            $this->common_model->array = array('status' => 3);
                            $this->common_model->update("booking_id = '" . $_POST['booking_id'] . "'");
                            $data['info'] = ['status' => 0, "Message" => 'Failure'];
                        }
                    }
                } else if ($_POST['payment_type'] == 2) {
                    $payment_data = array('payment_id' => $payment_id, 'booking_id' => $_POST['booking_id'], 'transation_id' => $_POST['transaction_id'], 'payment_type' => 2, 'status' => 1);
                    $payment = $this->payments($payment_data);
                    if (isset($payment)) {
                        $this->common_model->initialise('booking');
                        $this->common_model->array = array('status' => 1);
                        $this->common_model->update("booking_id = '" . $_POST['booking_id'] . "'");
                        $data['info'] = ['status' => 1, "Message" => "Success"];
                    } else {
                        $this->common_model->initialise('booking');
                        $this->common_model->array = array('status' => 3);
                        $this->common_model->update("booking_id = '" . $_POST['booking_id'] . "'");
                        $data['info'] = ['status' => 0, "Message" => 'Failure'];
                    }
                } else if ($_POST['payment_type'] == 3) {
                    $payment_data = array('payment_id' => $payment_id, 'booking_id' => $_POST['booking_id'], 'transation_id' => $_POST['transaction_id'], 'payment_type' => 3, 'status' => 1);
                    $payment = $this->payments($payment_data);
                    if (isset($payment)) {
                        $this->common_model->initialise('users');
                        $this->common_model->array = array('coins' => 0);
                        $this->common_model->update("user_id = '" . $_POST['user_id'] . "'");
                        $this->common_model->initialise('booking');
                        $this->common_model->array = array('status' => 1);
                        $this->common_model->update("booking_id = '" . $_POST['booking_id'] . "'");
                        $data['info'] = ['status' => 1, "Message" => "Success"];
                    } else {
                        $this->common_model->initialise('booking');
                        $this->common_model->array = array('status' => 3);
                        $this->common_model->update("booking_id = '" . $_POST['booking_id'] . "'");
                        $data['info'] = ['status' => 0, "Message" => 'Failure'];
                    }
                }

            } else {
                $data['info'] = ['status' => 0, 'Message' => 'Payment Already Done'];
            }


        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    private function payments($data)
    {
        $this->common_model->initialise('payment');
        $this->common_model->array = $data;
        $payment = $this->common_model->insert_entry();
        return $payment;
    }/*
     * Api for payment
     * @user_id=><int>
     * @booking_id=><varchar>
     * @transaction_id=><varchar>
     * @payment_type=><int>
     * @amount=><amount>
     * **/

    public function landing()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        // print_r($_POST);exit;
        if (!empty($_POST)) {
            if ($_POST['start'] == 0 && empty($_POST['cat_id']) && !empty($_POST['user_id'])) {
                $bookingdata = $this->bookingdata($_POST['user_id']);
                $historydata = $this->historyloc($_POST['user_id']);
                $newdata = $this->newdata($_POST['lat'], $_POST['lng']);
            } else {
                $bookingdata = $historydata = $newdata = array();
            }
            //print_r($data);exit;
            $limit = array('limit' => $this->limitval, 'start' => $_POST['start']);
            $this->common_model->initialise('venues as V');
            $this->common_model->join_tables = array('venue_category as VC', 'venue_sub_category as VSC', 'rating as R', 'time_slots as S', 'review as RV', 'review_details as RD', 'prices as P', 'categories as C', 'sub_categories as SC');
            $this->common_model->join_on = array("V.venue_id = VC.venue_id", "V.venue_id = VSC.venue_id", "V.venue_id = R.venue_id", "V.venue_id = S.venue_id", "V.venue_id = RV.venue_id", "RV.review_id = RD.review_id", "P.venue_id = V.venue_id", "C.category_id = VC.category_id", "SC.sub_category_id = VSC.sub_category_id");
            $this->common_model->left_join = array('left', 'left', 'left', 'left', 'left', 'left', 'left', 'left', 'left');
            $lat = "";
            if (!empty($_POST['lat']) && !empty($_POST['lng'])) {
                $lat = " AND (ACOS( SIN( RADIANS( `lat` ) ) * SIN( RADIANS( '" . $_POST['lat'] . "' ) ) + COS( RADIANS( `lat` ) ) * COS( RADIANS( '" . $_POST['lat'] . "' )) * COS( RADIANS( `lng` ) - RADIANS( '" . $_POST['lng'] . "' )) ) * 6380 < 2)";
            }
            $cat = "";
            if (!empty($_POST['cat_id'])) {
                $ex=explode(',',$_POST['cat_id']);
                $n = count($ex);
                if ($n > 1) {
                    $cat = " AND VC.category_id  IN (" . $_POST['cat_id'] . ")";
                } else {
                    $cat = " AND VC.category_id = '" . $_POST['cat_id'] . "'";
                }
            }
            $subcat = "";
            if (!empty($_POST['subcatid'])) {
                $exs=explode(',',$_POST['subcatid']);
                $m = count($exs);
                if ($m > 1) {
                    $subcat = " AND VSC.sub_category_id IN (" . $_POST['subcatid'] . ")";
                } else {
                    $subcat = " AND VSC.sub_category_id = '" . $_POST['subcatid'] . "'";
                }
            }
            $where = "V.status = '1'$cat$subcat $lat";
            $select = "V.venue_id,V.vendor_id,V.venue_display_name,V.rating,V.like_count,V.location,V.lat,V.lng,(SELECT group_concat(category_id) from tbl_venue_category where venue_id = V.venue_id) as category_id,P.amount,P.discount_amount,(SELECT COUNT(*) FROM tbl_review WHERE venue_id = V.venue_id) as reviewcount";
            //  $select="V.venue_id,V.venue_display_name,V.rating,V.like_count,V.location,V.lat,V.lng,V.venue_pic_1,V.venue_pic_2,V.venue_pic_3,V.venue_pic_4,V.venue_pic_5,(SELECT group_concat(category_id) from tbl_venue_category where venue_id = V.venue_id) as category_id,P.amount,P.discount_amount,(SELECT COUNT(*) FROM tbl_review WHERE venue_id = V.venue_id) as reviewcount";
            $result = $this->common_model->get_records($limit, $select, $where,'V.venue_id','desc', "V.venue_id");
            if (!empty($result)) {
                $data['info'] = ["status" => 1, "Message" => "Success"];
                $data['info']['details']['intrested'] = $bookingdata;
                $data['info']['details']['trending'] = $historydata;
                $data['info']['details']['newlyadded'] = $newdata;
                $data['info']['details']['actual'] = $result;
            } else {
                $data['info'] = ["status" => 0, "Message" => "No Activities Found"];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    private function bookingdata($id)
    {
        $this->common_model->initialise('booking as B');
        $this->common_model->join_tables = array('venues as V', 'prices as P');
        $this->common_model->join_on = array("B.venue_id = V.venue_id", "V.venue_id = P.venue_id");
        $select = "V.venue_id,V.vendor_id,V.venue_display_name,V.rating,V.like_count,V.location,V.lat,V.lng,(SELECT group_concat(category_id) from tbl_venue_category where venue_id = V.venue_id) as category_id,P.amount,P.discount_amount,(SELECT COUNT(*) FROM tbl_review WHERE venue_id = V.venue_id) as reviewcount";
        $data = $this->common_model->get_records(2, $select, "B.user_id = '$id'", '', '', "V.venue_id");
        if (isset($data)) {
            return $data;
        }
    }

    /*
    * API for Activity List (Landing)
    * it will list out the actvities present in the particular category and in particular location
    * @user_id=><integer>
    * @location=><string>
    * @category_id=><integer>
    * **/

    private function historyloc($id)
    {
        $this->common_model->initialise('history_location as H');
        $this->common_model->join_tables = array('venue_category as VS', 'venue_sub_category as VSC', 'venue_sub_sub_categories as VSSC', 'venues as V', 'prices as P');
        $this->common_model->join_on = array("H.category_id = VS.category_id", "H.sub_category_id = VSC.sub_category_id", "H.sub_sub_category_id = VSSC.sub_sub_category_id", "V.venue_id = VS.venue_id", "V.venue_id = P.venue_id");
        $this->common_model->left_join = array('left', 'left', 'left', 'left');
        $select = "V.venue_id,V.vendor_id,V.venue_display_name,V.rating,V.like_count,V.location,V.lat,V.lng,(SELECT group_concat(category_id) from tbl_venue_category where venue_id = V.venue_id) as category_id,P.amount,P.discount_amount,(SELECT COUNT(*) FROM tbl_review WHERE venue_id = V.venue_id) as reviewcount";
        $where = "H.user_id = '$id'";
        $data = $this->common_model->get_records(2, $select, $where, '', '', "V.venue_id");
        if (isset($data)) {
            return $data;
        }
    }

    private function newdata($lat, $lng)
    {
        $this->common_model->initialise('venues as V');
        $this->common_model->join_tables = array('venue_category as VC', 'venue_sub_category as VSC', 'rating as R', 'time_slots as S', 'review as RV', 'review_details as RD', 'prices as P', 'categories as C', 'sub_categories as SC');
        $this->common_model->join_on = array("V.venue_id = VC.venue_id", "V.venue_id = VSC.venue_id", "V.venue_id = R.venue_id", "V.venue_id = S.venue_id", "V.venue_id = RV.venue_id", "RV.review_id = RD.review_id", "P.venue_id = V.venue_id", "C.category_id = VC.category_id", "SC.sub_category_id = VSC.sub_category_id");
        $this->common_model->left_join = array('left', 'left', 'left', 'left', 'left', 'left', 'left', 'left', 'left');
        $laat = "";
        if (!empty($lat) && !empty($lng)) {
            $laat = " AND (ACOS( SIN( RADIANS( `lat` ) ) * SIN( RADIANS( '" . $lat . "' ) ) + COS( RADIANS( `lat` ) ) * COS( RADIANS( '" . $lat . "' )) * COS( RADIANS( `lng` ) - RADIANS( '" . $lng . "' )) ) * 6380 < 2)";
        }
        $where = "V.status = 1 $laat";
        $select = "V.venue_id,V.vendor_id,V.venue_display_name,V.rating,V.like_count,V.location,V.lat,V.lng,(SELECT group_concat(category_id) from tbl_venue_category where venue_id = V.venue_id) as category_id,P.amount,P.discount_amount,(SELECT COUNT(*) FROM tbl_review WHERE venue_id = V.venue_id) as reviewcount";
        $result = $this->common_model->get_records(2, $select, $where, "V.venue_id");
        if (isset($result)) {
            return $result;
        }
    }

    public function venuedetailsnew()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $venue_id = $_POST['venue_id'];
            $category_id = $_POST['category_id'];
            $ex = explode(",", $_POST['category_id']);
            $category_id = $_POST['category_id'];
            if (count($ex) > 1) {
                $cat = " AND `VC`.`category_id` IN ($category_id)";
            } else {
                $cat = " AND `VC`.`category_id` = '$category_id'";
            }
            $uuser = "";
            $ruser = "";
            if (!empty($_POST['user_id'])) {
                $user_id = $_POST['user_id'];
                $uuser = " AND UL.user_id='$user_id'";
                $ruser = " AND R.user_id='$user_id'";
            }
            $subcategories = $this->getsubcategories($_POST['venue_id']);
            $subsubcategories = $this->getsubsubcategories($_POST['venue_id'],$subcategories['grp_sub']->sub_cat_ids);
            $count = $this->getimages($_POST['venue_id']);
            $query = "SELECT V.*,IF(UL.venue_id > 0, 1, 0) as likestatus , IF(R.review_id > 0, 1, 0) as review_status
FROM (`tbl_venues` as V) 
LEFT JOIN `tbl_venue_category` as VC ON `V`.`venue_id` = `VC`.`venue_id` 
LEFT JOIN `tbl_user_like` as UL ON (V.venue_id = UL.venue_id $uuser)
LEFT JOIN `tbl_review` as R ON (V.venue_id = R.venue_id  $ruser)
WHERE `V`.`venue_id` = '$venue_id' $cat GROUP BY V.venue_id";
            $result = $this->common_model->pureQuery($query);
            if (!empty($result)) {
                $data['info'] = ["status" => 1, "Message" => "Success"];
                $data['info']['details']['actual'] = $result;
                $data['info']['details']['subcategories'] = $subcategories['list'];
                $data['info']['details']['subsubcategories'] = $subsubcategories;
                $data['info']['details']['venue_images'] = $count;
            } else {
                $data['info'] = ["status" => 0, "Message" => "No Activities Found"];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    private function getsubcategories($id)
    {
        $this->common_model->initialise('venues as V');
        $this->common_model->join_tables = array('venue_sub_category as VSC', 'sub_categories as SC');
        $this->common_model->join_on = array("V.venue_id = VSC.venue_id", "VSC.sub_category_id = SC.sub_category_id");
        $result['list'] = $this->common_model->get_records(0, "SC.sub_category_id,SC.sub_category_name", "V.venue_id = '$id'");
        $result['grp_sub'] = $this->common_model->get_record_single("V.venue_id = '$id'",'GROUP_CONCAT(SC.sub_category_id) as sub_cat_ids');
        if (!empty($result)) {
            return $result;
        } else {
            return array();
        }
    }

    /*
     * Api for venue details
     * it will list out the details of that particular venue
     * @user_id=><integer>
     * @category_id=<integer>
     * @venue_id=<integer>
     * @location=<string>
     * **/

    private function getimages($venueid)
    {
        $this->common_model->initialise('venues');
        $vendorid = $this->common_model->get_record_single("venue_id = '$venueid'", "vendor_id")->vendor_id;
        $directory = 'images/venues';
        for($i=1; $i<6; $i++){
            if(file_exists($directory."/$vendorid-$venueid-$i.jpg")){
                $data[] = "$vendorid-$venueid-$i.jpg";
            }
        }

        if (isset($data)) {
            return $data;
        } else {
            return array();
        }
    }

    public function getvenuesubsubcategories()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        if (!empty($_POST)) {
            $result = $this->getsubsubcategories($_POST['venue_id'], $_POST['subcategory_id']);
            if (!empty($result)) {
                $data['info'] = ["status" => 1, "Message" => "Success"];
                $data['info']['details']['actual'] = $result;
            } else {
                $data['info'] = ["status" => 0, "Message" => "No Activities Found"];
            }
        } else {
            $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    private function getsubsubcategories($id, $sid)
    {

            $subcat = " AND SSC.sub_category_id IN ($sid)";
        $this->common_model->initialise('venues as V');
        $this->common_model->join_tables = array('venue_sub_sub_categories as VSSC', 'sub_sub_categories as SSC');
        $this->common_model->join_on = array("V.venue_id = VSSC.venue_id", "VSSC.sub_sub_category_id = SSC.sub_sub_category_id");
        $where = "V.venue_id = '$id'$subcat";
        $result = $this->common_model->get_records(0, "SSC.sub_sub_category_id,SSC.sub_sub_category_name, SSC.sub_category_id", $where);
        if (!empty($result)) {
            return $result;
        } else {
            return array();
        }
    }

    public function slotlist()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data = array();
        $data['info'] = ['status' => 0, 'Message' => 'Insuffient Data'];
        if (!empty($_POST) && !empty($_POST['category_id'])) {
            $ExWhere = " AND S.category_id='" . $_POST['category_id'] . "'";
            if (!empty($_POST['sub_category_id'])) {
                $ExWhere .= " and S.sub_category_id = '" . $_POST['sub_category_id'] . "'";
                $price_type = 3;
                $base_type_id = $_POST['sub_category_id'];
            }
            if (!empty($_POST['sub_sub_category_id'])) {
                $ExWhere .= " and S.sub_sub_category_id ='" . $_POST['sub_sub_category_id'] . "'";
                $price_type = 4;
                $base_type_id = $_POST['sub_sub_category_id'];
            }
            $venue_id = $_POST['venue_id'];
            $qry = "SELECT MT.*,PS.* FROM tbl_membership_types MT
JOIN tbl_price_details as PS ON PS.type = MT.membership_type_id
JOIN tbl_prices as P ON P.price_id = PS.price_id AND P.base_type_id = $base_type_id AND P.price_type = $price_type  WHERE P.venue_id = $venue_id";
            $mempership = (array) $this->common_model->pureQuery($qry);
            $query = $this->getslots($ExWhere, $_POST['day_id'], $_POST['venue_id'],$base_type_id,$price_type, !empty($_POST['type'])? $_POST['type']:1 );
            $result = (array) $this->common_model->pureQuery($query);
            $day_id = $_POST['day_id'];
            foreach($result as $key => $value){
                $type_array =[7,30,90,180,365];
                if(empty($type) || $type ==  1){
                    $end_as = "'".$day_id."'";
                }else{
                    $end_as="DATE_ADD($day_id ,INTERVAL {$type_array[$type-2]} DAY)";
                }
                $query = "select
  a.Date as date, ($value->quantity - (SELECT COUNT(*) FROM tbl_booking where date(a.date) between booked_from_date and  booked_to_date and base_type_id = $value->slot_id AND  booking_type = 1)) as cnt
  from (
    select curdate() + INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as Date
    from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as a
    cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b
    cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c
  ) a
  where a.Date BETWEEN '$day_id' 
  and
  $end_as HAVING cnt = 0";
                $result[$key] = (array) $value;
                $result1 = $this->common_model->pureQuery($query);
                $result[$key]['not_available'] = $result1;
            }


            $data['info'] = ['status' => 0, 'Message' => 'No slots are Found'];
            if (!empty($result)) {
                $data['info'] = ['status' => 1, 'Message' => 'success'];
                $data['info']['details'] = $result;
                $data['info']['member_types'] = $mempership;
            }
        }
        $output = $this->api_model->json($data, true);
        echo $output;
    }

    private function getslots($ExWher, $day, $venueid,$base_type_id,$price_type, $type =1)
    {
        $type_array =["+7 days","+30 days","+90 days","+180 days","+365 days"];

        if(empty($type) || $type ==  1){
            $slotstatus = "date(created_on)='" . $day . "'";
        }else{
            $date = strtotime($type_array[$type - 2], strtotime($day));
            $end_date = date("Y-m-d", $date);
            $slotstatus = "date(booked_date) between '" . $day . "' and '$end_date'";
        }
        return $query = "SELECT S.*
FROM (`tbl_time_slots` as S)
LEFT JOIN `tbl_booking` as B ON `S`.`venue_id` = `B`.`venue_id`
LEFT JOIN `tbl_prices` as P ON P.venue_id = `S`.`venue_id` AND  P.price_type = 4 and P.base_type_id = 164
LEFT JOIN `tbl_price_details` as PD ON PD.price_id = `P`.`price_id` AND  PD.type = $type
WHERE `S`.`venue_id` = '" . $venueid . "' $ExWher group by S.slot_id ";
    }

    /*
     * API for slot availability list
     * @user_id=>int
     * @category_id=>int
     * @subcategory_id=>int
     * @venue_id=>int
     * @subsubcategory_id=>int
     * @type => int 1=day,2=week,3=month,4=quarter,5=half-yaerly,6=yearly
     * **/

    private function coins($id, $method)
    {
        $this->common_model->initialise('users');
        $coin = $this->common_model->get_record_single("user_id = '$id'", '*');
        $this->common_model->initialise('coins');
        $getcoin = $this->common_model->get_record_single("method = '$method'", "*");
        if ($getcoin->type == 1) {
            $coins = $coin->coins + $getcoin->coins;
            $coin_data = array('coins' => $coins);
            $updatecoin = $this->updateusercoins($coin_data, $id);
        } else if ($getcoin->type == 2) {
            if ($getcoin->limit == '') {
                $date = date("Y-m-d");
                $this->common_model->initialise('coins');
                $getdata = $this->common_model->get_record_single("date(from_date) <= '$date' and date(end_date) >= '$date'", "*");
                if (!empty($getdata)) {
                    $coins = $coin->coins + $getdata->coins;
                    $coin_data = array('coins' => $coins);
                    $updatecoin = $this->updateusercoins($coin_data, $id);
                } else {
                    $data['error'] = "Offer Expired";
                }

            } else {
                if ($getcoin->limit != 0) {
                    $coins = $coin->coins + $getcoin->coins;
                    $coin_data = array('coins' => $coins);
                    $updatecoin = $this->updateusercoins($coin_data, $id);
                    if (isset($updatecoin)) {
                        $limit = $getcoin->limit - 1;
                        $coin_data = array('limit' => $limit);
                        $this->common_model->initialise('coins');
                        $this->common_model->array = $coin_data;
                        $updatelimit = $this->common_model->update("coin_id = '$getcoin->coin_id'");
                    }
                } else {
                    $data['error'] = "Offer Expired";
                }
            }
        }
    }

    private function updateusercoins($data, $id)
    {
        $this->common_model->initialise('users');
        $this->common_model->array = $data;
        $update = $this->common_model->update("user_id = '$id'");
        if ($update == FALSE) {
            return true;
        }
    }
}

?>

