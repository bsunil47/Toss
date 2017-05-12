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
class Api extends My_Controller {

    private $limitval;

    public function __construct() {
        parent::__construct();
        $this->load->model('api_model');
        $this->limitval = 10;
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
       if (!empty($_POST) && !empty($_POST['email'])) {
            $this->common_model->initialise('users');
            $where=array('email'=>$this->input->post('email'),'password'=>md5($this->input->post('password')));
            $result=$this->common_model->get_record_single($where,'*,u_id as user_id');
            if(empty($result)){
               $data['info'] = ['status'=>0,'Message'=>'Invalid user details'];
             }else if($result->status=='2'){
               $data['info'] = ['status'=>3,'Message'=>'Please Activate Your Account by Entering the OTP Sent to You'];
              }else{
                  $data['info'] = ['status'=>1,'Message'=>'Success'];
                  $data['details'] = $result;
              }
        } else {
            $this->api_model->response('', 204);
        }
        $output = $this->api_model->json($data);
        echo $output;
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
        $required_feilds = array('name', 'email','password');
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
                }elseif ($value = 'email') {
                    $email = $da_ar[$value];
                    if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $da_ar[$value])) {
                        $data['error'][$value] = "Please enter valid Email Address";
                    }
                }
            }//foreach
            if (!empty($data['error'])) {
               $data['info'] = ["status" => 0, "Message"=>"Insufficient Data"];
               }
            if (empty($data['error'])) {
                $this->common_model->initialise('users');
                $password=md5($_POST['password']);
                unset($da_ar['user_type']);
                unset($da_ar['password']);
                $code=  rand(1000,9999);
                $da_ar['activation_key']=$code;
                $da_ar['password']=$password;
                $da_ar['status']=2;
                $this->common_model->array = $this->trim_addslashes($da_ar);
                $user_id = $this->common_model->insert_entry();
                $data['info'] = ["status" => 1,"activation_key" =>$code,"user_id" => $user_id,"Message" => "Sucess"];
                $user_array['user_id'] = $user_id;
                if ($_POST['user_type'] == 4) {
                        $this->insert_user_types($_POST['user_type'], $user_id);
                        $this->send_otp($user_id);
                    } 
                }
                         
        } else {
            if (!empty($user_record) && $user_record->status == '2') {
           $data['info'] = ["status" => 3,"Message" => "Already registered with this Email and Please Activate Your Account by Entering the OTP Sent to You"];
                }else if(!empty($user_record) && $user_record->status == '1'){
               $data['info'] = ["status" => 2,"Message" => "Already registered with this Email","details"=>$user_record];
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
    private function insert_user_types($type,$id){
        $this->common_model->initialise('user_types');
        $data=array('user_id'=>$id,'user_type'=>$type,'status'=>'1');
        $this->common_model->array =$data;
        $this->common_model->insert_entry();
    }
    /*
     * this is a private method which is called under register api
     * @id=>user id by using this we will send the otp to registered mail id
     * **/
    private function send_otp($id){
        $this->common_model->initialise('users');
        $data=(array)$this->common_model->get_record_single(array('u_id'=>$id),'*', $groupby = null);
       $this->load->model('communication_model');
        $this->communication_model->send_Activate_code($data);
      }
     /*
      * Authenticate/User Activation Api
      * @user_id=> integer
      * @otp=>integer
      * **/ 
      public function activate()
      {
       if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
       if (!empty($_POST)) {
            $this->common_model->initialise('users');
            $where=array('u_id'=>$this->input->post('user_id'),'activation_key'=>$this->input->post('otp'));
            $result=$this->common_model->get_record_single($where,'*,u_id as user_id');
            if(empty($result)){
                 $data['info']=["status" => 0,"Message" => "Invalid OTP"];
             }else if($result->status=='1'){
                $data['info']=['status'=>1,'Message'=>'User Already Verified'];
                $data['details']=$result;
                 }else{
                     $date=date('Y-m-d');
                $this->common_model->initialise('users');
                $this->common_model->array=array('status'=>1,'dateactive'=>$date);
                $wheree =array('u_id'=>$this->input->post('user_id'));
                $this->common_model->update($wheree);
                $resullt=$this->common_model->get_record_single($wheree,'*');
                if($resullt==false){
                    $resultt=$this->common_model->get_record_single("u_id ='".$result->u_id."' ",'*,u_id as user_id');
                    $data['info']=['status'=>1,'Message'=>'User Verified Sucessfully'];
                    $data['details']=$resultt;
                }
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
     * API for Categories
     * it will list out the categories present in the application
     **/
    public function categories()
    {
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data=array();
        $this->common_model->initialise('categories');
        $where=array('category_status'=>1);
        $result=$this->common_model->get_records(0, '*', $where);
        if (!empty($result)){
            $data['info']=["status" => 1,"Message" => "Success"];
            $data['info']['catlist']=$result;
        }else{
            $data['info']=["status" => 0,"Message" => "No Categories"];
        }
        $output=$this->api_model->json($data, true);
        echo $output;
    }
    /*
     * API for Landing
     * it will show the count of activities present in that particular location category wise
     * @user_id=><integer>
     * @location=><string>
     **/
    public function landing(){
        if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data=array();
        if(!empty($_POST)){
           $query="SELECT * FROM (select (select count(*) from tbl_venuedetails where category_id = '1') as FitnessCount, (select count(*) from tbl_venuedetails where category_id = '2') as AdventureCount, (select count(*) from tbl_venuedetails where category_id = '3') as SportsCount, (select count(*) from tbl_venuedetails where category_id = '4') as YogaCount, (select count(*) from tbl_venuedetails where category_id = '5') as DanceCount from tbl_venuedetails where venue_city = '".$_POST['location']."') as tmp where FitnessCount <> 0 OR AdventureCount <> 0 OR SportsCount <> 0 OR YogaCount <> 0 OR DanceCount <> 0";
            $result=$this->common_model->pureQuery($query);
           if (!empty($result)){
            $data['info']=["status" => 1,"Message" => "Success"];
            $data['info']['details']=$result;
        }else{
            $data['info']=["status" => 0,"Message" => "No Activities Found"];
        }
         }else{
            $data['info']=['status'=>0,'Message'=>'Insuffient Data'];
        }
        $output=$this->api_model->json($data, true);
        echo $output;
    }
   /*
    * API for Activity List
    * it will list out the actvities present in the particular category and in particular location
    * @user_id=><integer>
    * @location=><string>
    * @category_id=><integer>
    * **/
    public function activitylist(){
      if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data=array();
        $data=array();
        if(!empty($_POST)){
            $this->common_model->initialise('venuedetails as V');
            $this->common_model->join_tables=array('ratings as R','slots as S','reviews as RV','reviewdetails as RD');
            $this->common_model->join_on=array("V.venue_id = R.venue_id","V.venue_id = S.venue_id","V.venue_id = RV.venue_id","RV.rev_id = RD.review_id");
            $where=array('V.venue_city'=>$_POST['location'],'V.category_id'=>$_POST['cat_id']);
           $select="V.*,count(RD.review_id) as reviewcount,avg(R.rating) as ratings,MAX(S.slot_price) as price";
            $result=$this->common_model->get_records(0, $select, $where);
            if(!empty($result)){
                $data['info']=["status" => 1,"Message" => "Success"];
            $data['info']['details']=$result;
            }else{
               $data['info']=["status" => 0,"Message" => "No Activities Found"]; 
            }
        }else{
             $data['info']=['status'=>0,'Message'=>'Insuffient Data'];
        }
        $output=$this->api_model->json($data, true);
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
    public function venuedetails()
    {
         if ($this->input->server('REQUEST_METHOD') != 'POST') { /* checks wehter it is a POST or GET */
            $this->api_model->response('', 406);
        }
        $data=array();
        $data=array();
        if(!empty($_POST)){
            $this->common_model->initialise('venuedetails as V');
            $this->common_model->join_tables=array('slots as S','ratings as R','reviews as RV','reviewdetails as RD');
            $this->common_model->join_on=array("V.venue_id = S.venue_id","V.venue_id = R.venue_id","V.venue_id = RV.venue_id","RV.rev_id = RD.review_id");
            $where=array('V.venue_id'=>$_POST['venue_id'],'V.venue_city'=>$_POST['location'],'V.category_id'=>$_POST['category_id']);
           $select="V.*,max(S.slot_price) as price,count(RD.review_id) as reviewcount,avg(R.rating) as ratings";
            $result=$this->common_model->get_record_single($where,$select);
            if(!empty($result)){
                $data['info']=["status" => 1,"Message" => "Success"];
            $data['info']['details']=$result;
            }else{
               $data['info']=["status" => 0,"Message" => "No Activities Found"]; 
            }
        }
        else{
             $data['info']=['status'=>0,'Message'=>'Insuffient Data'];
        }
        $output=$this->api_model->json($data, true);
        echo $output;
    }
    }
?>

