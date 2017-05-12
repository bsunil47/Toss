<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class Ajax extends My_Controller
{

    //private $redirecturl;
    private $view_dir;

    public function __construct()
    {


        parent::__construct();

        $this->view_dir = $this->router->fetch_class() . '/' . $this->router->fetch_method();
        //$this->layout->setLayout('admin_main.php');


        $allowed_methodes = array('index');
        if (!in_array($this->router->fetch_method(), $allowed_methodes) && !$this->_is_home_logged_in()) {
            redirect(base_url());
        }
        if (in_array($this->router->fetch_method(), $allowed_methodes) && isset($this->session->userdata['user_type']) && $this->session->userdata['user_type'] <= 1) {
            redirect(base_url('admin/dashboard'));
        }
        if (in_array($this->router->fetch_method(), $allowed_methodes) && isset($this->session->userdata['user_type']) && $this->session->userdata['user_type'] == 2) {
            redirect(base_url('vendors/dashboard'));
        }
        if (in_array($this->router->fetch_method(), $allowed_methodes) && isset($this->session->userdata['user_type']) && $this->session->userdata['user_type'] == 3) {
            redirect(base_url('venues/dashboard'));
        }
        $this->load->model("admin_common_model");

    }


    public function vendorslist()
    {
        $aColumns = array('U.user_id', 'VD.company_name', 'U.email', 'U.phone', 'U.status', 'Ut.user_id', 'Ut.user_type', 'VD.vendor_id');
        //echo "<pre>";print_r($aColumns);
        $this->common_model->initialise("users as U");

        $this->common_model->join_tables = array("user_types as Ut", "vendor as VD");
        $this->common_model->join_on = array("U.user_id=Ut.user_id", "U.user_id=VD.user_id");
        $this->common_model->left_join = array('left');
        $where = array("Ut.user_type" => 2);
        $data = $this->common_model->getTable($aColumns, $where, 'U.user_id');
        //echo "<pre>";print_r($data);
        $output = $data['output'];
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            //print_r($aRow);
            //echo "<pre>";print_r($data['result']);exit;
            if ($aRow['user_type'] == 2) {
                $count++;
                $row = array();
                unset($aColumns[5]);
                foreach ($aColumns as $col) {
                    $col = trim($col, 'U.');
                    $col = trim($col, 'Ut.');
                    $col = trim($col, 'VD.');
                    $row[] = $aRow[$col];
                }
                $row[0] = $i;
                $i = $i + 1;
                $row[1] = ucfirst($aRow['company_name']);
                $status = $aRow['status'];
                if ($status == 1) {
                    $statusn = "<i class='fa fa-check' title='Active'></i>";
                    $link = '<a href="' . base_url() . 'admin/updatestatus/' . $aRow['user_id'] . '/' . $aRow["status"] . '/' . $aRow["user_type"] . '" style="color:black;margin-right:5px;"><i class="fa fa-remove" title="Inactive"></i></a>';

                } else if ($status == 0 || $status = '' || $status = 'NULL') {
                    $statusn = "<i class='fa fa-remove' title='Inactive'></i>";
                    $link = '<a href="' . base_url() . 'admin/updatestatus/' . $aRow['user_id'] . '/' . $aRow["status"] . '/' . $aRow["user_type"] . '" style="color:black;margin-right:5px;"><i class="fa fa-check" title="Active"></i></a>';

                }
                $row[4] = $statusn;
                $row[5] = $link . '<input type="hidden" name="type" value="vendor">' . '<a href="' . base_url() . 'admin/viewvendor/' . $aRow['vendor_id'] . '" style="color:black;margin-right:5px;"><i class="fa fa-eye" title="View"></i></a>' . '<a href="' . base_url() . 'admin/listvenue/' . $aRow['vendor_id'] . '" style="color:black;margin-right:5px;"><i class="fa fa-list" title="List"></i></a>' . '<a href="' . base_url() . 'admin/editvendor/' . $aRow['vendor_id'] . '" style="color:black;margin-right:5px;"><i class="fa fa-pencil" title="Edit"></i></a>';


                $output['aaData'][] = $row;
            }

        }

        if ($this->input->get_post('sSearch')) {
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);
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


    private function updatestatusall($table, $datastatus, $where)
    {
        $this->common_model->initialise($table);
        $this->common_model->status = $datastatus;
        $this->common_model->set_status($where);

    }


    public function venuechange()
    {
        $venueid = $this->input->post('venueid');
        $this->common_model->initialise("venues as V");
        $this->common_model->join_tables = array("venue_category as VC", "categories as C");
        $this->common_model->join_on = array("V.venue_id=VC.venue_id", "VC.category_id=C.category_id");
        $select = "V.venue_id as venueid,VC.category_id as venuecategoryid,C.category_name as categoryname";
        $where = "V.venue_id = " . $venueid;
        $getcats = $this->common_model->get_records(0, $select, $where);
        $data = $getcats;
        echo json_encode($data);

    }

    public function categorychange()
    {
        $catsid = $this->input->post('catid');
        $catid = implode(",", $catsid);
//echo "<pre>";print_r($catid);exit;
        $this->common_model->initialise("sub_categories");
        $where = "category_id in($catid)";
        $getsubcats = $this->common_model->get_records(0, "*", $where);
        $data = $getsubcats;
        echo json_encode($data);

    }

    public function subcategorychange()
    {
        $catsid = $this->input->post('catid');
        $subcatsid = $this->input->post('subcatid');
        $catid = implode(",", $catsid);
        $subcatid = implode(",", $subcatsid);
        $this->common_model->initialise("sub_sub_categories");
        $where = "category_id IN($catid) AND sub_category_id IN($subcatid)";
        $getsubsubcats = $this->common_model->get_records(0, "*", $where);
        $data = $getsubsubcats;
        echo json_encode($data);

    }

    public function subcategorychangeaddon()
    {

        $subcatid = $this->input->post('subcatid');

        $this->common_model->initialise("sub_sub_categories");
        $where = "sub_category_id IN($subcatid)";
        $getsubsubcats = $this->common_model->get_records(0, "*", $where);
        $data = $getsubsubcats;
        echo json_encode($data);

    }


    public function venueslist()
    {
        $aColumns = array('V.venue_id', 'V.venue_display_name', 'V.phone', 'V.email', 'V.status', 'VD.vendor_id', 'VD.company_name');
        $this->common_model->initialise("venues as V");
        $this->common_model->join_tables = array("vendor as VD");
        $this->common_model->join_on = array("V.vendor_id=VD.vendor_id");
        $this->common_model->left_join = array('left');

        $where = '';
        $data = $this->common_model->getTable($aColumns, $where, 'V.venue_id');
        $output = $data['output'];
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $count++;
            $row = array();
            foreach ($aColumns as $col) {
                $col = trim($col, 'V.');
                $col = trim($col, 'VD.');
                $row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;
            $row[1] = ucfirst($aRow['company_name']);
            //$row[2]=$aRow['category_type'];
            $row[2] = ucfirst($aRow['venue_display_name']);
            $row[3] = $aRow['phone'];
            $row[4] = $aRow['email'];
            //$row[4] = $devicetype;
            $status = $aRow['status'];
            if ($status == 1) {
                $statusn = "<i class='fa fa-check' title='Active'></i>";
                $link = '<a href="' . base_url() . 'admin/updatestatus/' . $aRow['venue_id'] . '/' . $aRow["status"] . '/6" style="color:black;margin-right:5px;"><i class="fa fa-check" title="status"></i></a>';
            } else if ($status == 0 || $status == '' || $status == 'NULL') {
                $statusn = "<i class='fa fa-remove' title='Inactive'></i>";
                $link = '<a href="' . base_url() . 'admin/updatestatus/' . $aRow['venue_id'] . '/' . $aRow["status"] . '/6" style="color:black;margin-right:5px;"><i class="fa fa-check" title="status"></i></a>';
            }
            $row[5] = $statusn;
            $row[6] = $link . '<a href="' . base_url() . 'admin/viewvenueinfo/' . $aRow['venue_id'] . '" style="color:black;margin-right:5px;"><i class="fa fa-eye" title="view"></i></a>' . '<a href="' . base_url() . 'admin/editvenueinfo/' . $aRow['venue_id'] . '/1" style="color:black;margin-right:5px;"><i class="fa fa-pencil" title="Edit"></i></a>' . '<a href="' . base_url() . 'admin/viewvenueusersinfo/' . $aRow['venue_id'] . '" style="color:black;margin-right:5px;"><i class="fa fa-user" title="Users"></i></a>';
            //$row[6]=$link.'<a href="'.base_url().'vendors/viewvenueinfo/'.$aRow['venue_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-eye" title="view"></i></a>'.'<a href="'.base_url().'vendors/editvenueinfo/'.$aRow['venue_id'].'/1" style="color:black;margin-right:5px;"><i class="fa fa-pencil" title="Edit"></i></a>'.'<a href="'.base_url().'vendors/viewvenueusersinfo/'.$aRow['venue_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-user" title="User"></i></a>'.'<a href="'.base_url().'adm/manageslots/'.$aRow['venue_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-clock-o" title="Slots"></i></a>'.'<a href="'.base_url().'vendors/managefacilities/'.$aRow['venue_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-glass" title="Facilities"></i></a>'.'<a href="'.base_url().'vendors/manageaddons/'.$aRow['venue_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-puzzle-piece" title="Addons"></i></a>'.'<a href="'.base_url().'vendors/managepricing/'.$aRow['venue_id'].'" style="color:black;margin-right:5px;"><i class="fa fa-money" title="Pricing"></i></a>';
            $output['aaData'][] = $row;

        }

        if ($this->input->get_post('sSearch')) {
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);
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


    public function subcategorylist2()
    {
        $aColumns = array('S.sub_cat_id', 'S.category_id', 'S.sub_cat_name', 'S.status', 'C.category_name');
        $this->common_model->initialise("subcategories as S");
        $this->common_model->join_tables = array("categories as C");
        $this->common_model->join_on = array("S.category_id=C.cat_id");
        $this->common_model->left_join = array('left');

        $where = array("S.status" => 1);
        $data = $this->common_model->getTable($aColumns, $where, 'S.subcat_id');
        $output = $data['output'];
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $count++;
            $row = array();
            foreach ($aColumns as $col) {
                $col = trim($col, 'S.');
                $col = trim($col, 'C.');
                $row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;
            $row[1] = $aRow['category_name'];
            $row[2] = $aRow['subcat_name'];

            $status = $aRow['status'];
            if ($status == 1) {
                $statusn = "<i class='fa fa-check' title='Active'></i>";
                $link = '<a href="' . base_url() . 'admin/updatestatus/' . $aRow['subcat_id'] . '/' . $aRow["status"] . '/1" style="color:black"><i class="fa fa-check" title="status"></i></a>';
            } else if ($status == 0 || $status = '' || $status = 'NULL') {
                $statusn = "<i class='fa fa-remove' title='Inactive'></i>";
                $link = '<a href="' . base_url() . 'admin/updatestatus/' . $aRow['subcat_id'] . '/' . $aRow["status"] . '/1" style="color:black"><i class="fa fa-check" title="status"></i></a>';
            }
            $row[3] = $statusn;
            $row[4] = $link . '<a href="' . base_url() . 'admin/viewvendor/' . $row[0] . '" style="color:black"><i class="fa fa-eye" title="view"></i></a>' . '<a href="' . base_url() . 'admin/edituserinfo/' . $row[0] . '" style="color:black"><i class="fa fa-pencil" title="Edit"></i></a>';

            $output['aaData'][] = $row;

        }

        if ($this->input->get_post('sSearch')) {
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);

    }

    public function subcategorylist()
    {
        $aColumns = array('S.sub_category_id', 'S.category_id', 'S.sub_category_name', 'S.status', 'C.category_name');
        $this->common_model->initialise("sub_categories as S");
        $this->common_model->join_tables = array("categories as C");
        $this->common_model->join_on = array("S.category_id = C.category_id");
        //$this->common_model->left_join = array('left');
        $where = 0;

        $data = $this->common_model->getTable($aColumns, $where, 'S.sub_category_id');
        $output = $data['output'];
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $count++;
            $row = array();
            foreach ($aColumns as $col) {

                $col = trim($col, 'S.');

                $col = trim($col, 'C.');

                $row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;

            $row[1] = ucfirst($aRow['category_name']);
            $row[2] = ucfirst($aRow['sub_category_name']);
            $status = $aRow['status'];

            if ($status == 1) {
                $statusn = "<i class='fa fa-check' title='Active'></i>";
                $link = '<a href="' . base_url() . 'admin/updatestatus/' . $aRow['sub_category_id'] . '/' . $aRow["status"] . '/7" style="color:black;margin-right:5px;"><i class="fa fa-remove" title="Inactive"></i></a>';
            } else if ($status == 0 || $status = '' || $status = 'NULL') {
                $statusn = "<i class='fa fa-remove' title='Inactive'></i>";
                $link = '<a href="' . base_url() . 'admin/updatestatus/' . $aRow['sub_category_id'] . '/' . $aRow["status"] . '/7" style="color:black;margin-right:5px;"><i class="fa fa-check" title="Active"></i></a>';
            }
            $row[3] = $statusn;
            $row[4] = $link . '<a href="' . base_url() . 'admin/editsubcategory/' . $aRow['sub_category_id'] . '" style="color:black;margin-right:5px;"><i class="fa fa-pencil" title="Edit"></i></a>';
            $output['aaData'][] = $row;
        }
        if ($this->input->get_post('sSearch')) {
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);
    }


    public function subsubcategorylist()
    {
        $aColumns = array('SS.sub_sub_category_id', 'SS.sub_sub_category_name', 'SS.sub_category_id', 'SS.category_id', 'S.sub_category_name', 'C.category_name', 'SS.status');
        $this->common_model->initialise("sub_sub_categories as SS");
        $this->common_model->join_tables = array("categories as C", "sub_categories as S");
        $this->common_model->join_on = array("SS.category_id=C.category_id", "SS.category_id=S.sub_category_id");
        $this->common_model->left_join = array('left', 'left');
        $where = 0;

        $data = $this->common_model->getTable($aColumns, $where, 'SS.sub_category_id');
        $output = $data['output'];
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $count++;
            $row = array();
            foreach ($aColumns as $col) {

                $col = trim($col, 'S.');

                $col = trim($col, 'C.');

                $row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;
            $row[1] = ucfirst($aRow['category_name']);
            $row[2] = ucfirst($aRow['sub_category_name']);
            $row[3] = ucfirst($aRow['sub_sub_category_name']);
            $status = $aRow['status'];

            if ($status == 1) {
                $statusn = "<i class='fa fa-check' title='Active'></i>";
                $link = '<a href="' . base_url() . 'admin/updatestatus/' . $aRow['sub_sub_category_id'] . '/' . $aRow["status"] . '/77" style="color:black;margin-right:5px;"><i class="fa fa-remove" title="Inactive"></i></a>';
            } else if ($status == 0 || $status = '' || $status = 'NULL') {
                $statusn = "<i class='fa fa-remove' title='Inactive'></i>";
                $link = '<a href="' . base_url() . 'admin/updatestatus/' . $aRow['sub_sub_category_id'] . '/' . $aRow["status"] . '/77" style="color:black;margin-right:5px;"><i class="fa fa-check" title="Active"></i></a>';
            }
            $row[4] = $statusn;
            //$row[5]=$statusn;
            $row[5] = $link . '<a href="' . base_url() . 'admin/editsubsubcategory/' . $aRow['sub_sub_category_id'] . '" style="color:black;margin-right:5px;"><i class="fa fa-pencil" title="Edit"></i></a>';
            $output['aaData'][] = $row;
        }
        if ($this->input->get_post('sSearch')) {
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);
    }





  public function getPData()
    {
        $aColumns = array('P.price_id', 'V.venue_display_name','P.price_type','S.sub_category_name','SS.sub_sub_category_name','M.membership_name', 'PD.amount','PD.type', 'P.status');
        $this->common_model->initialise("prices as P");
        $this->common_model->join_tables = array("price_details as PD","venues as V","sub_categories as S","sub_sub_categories as SS","membership_types as M" );
        $this->common_model->join_on = array("P.price_id = PD.price_id","P.venue_id = V.venue_id","P.base_type_id = S.sub_category_id","P.base_type_id = SS.sub_sub_category_id","PD.type = M.membership_type_id");
        //$this->common_model->join_on = array("P.venue_id = V.venue_id");
        $this->common_model->left_join = array('left','left', 'left', 'left','left');
        //echo $this->session->userdata("user_id");
        $where = array("P.venue_id" => $_POST['venueid']);
        //$where='';
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
                $link = '<a href="' . base_url() . 'admin/updatestatus/' . $aRow['price_id'] . '/' . $aRow["status"] . '/11" style="color:black;margin-right:5px;"><i class="fa fa-remove" title="Inactive"></i></a>';
            } else if ($status == 0 || $status == '' || $status == 'NULL') {
                $statusn = "<i class='fa fa-remove' title='Inactive'></i>";
                $link = '<a href="' . base_url() . 'admin/updatestatus/' . $aRow['price_id'] . '/' . $aRow["status"] . '/11" style="color:black;margin-right:5px;"><i class="fa fa-check" title="Active"></i></a>';
            }
            $row[5] = $statusn;
            $row[6] = $link . '<a href="' . base_url() . 'admin/viewprice/' . $aRow['price_id'] . '/' . $_POST['venueid'] . '" style="color:black"><i class="fa fa-eye" title="View"></i></a>&nbsp;&nbsp;<a href="' . base_url() . 'admin/editprice/' . $aRow['price_id'] . '/' . $_POST['venueid'] .'/'.$aRow['type']. '" style="color:black"><i class="fa fa-pencil" title="Edit"></i></a>';
            $output['aaData'][] = $row;
        }
        if ($this->input->get_post('sSearch')) {
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);
    }

    public function getmembership()
    {
        $this->common_model->initialise('membership_types');
        $membershiptype = $this->common_model->get_records(0, '*', '');
        echo json_encode($membershiptype);
    }

    public function getcategories()
    {
        $this->common_model->initialise('categories');
        $categories = $this->common_model->get_records(0, '*', '');
        echo json_encode($categories);
    }

    public function getsubcategories()
    {
        $this->common_model->initialise('sub_categories');
        $subcategories = $this->common_model->get_records(0, '*', '');
        echo json_encode($subcategories);
    }

    public function getfacilities()
    {
        $this->common_model->initialise('facilities');
        $facilities = $this->common_model->get_records(0, '*', '');
        echo json_encode($facilities);
    }

    public function getsubsubcategories()
    {
        $this->common_model->initialise('sub_sub_categories');
        $subcategories = $this->common_model->get_records(0, '*', '');
        echo json_encode($subcategories);
    }

    public function getslots()
    {
        $this->common_model->initialise('time_slots as S');
        $this->common_model->join_tables = array('venues as V');
        $this->common_model->join_on = array("S.venue_id = V.venue_id");
        $venues = $this->common_model->get_records(0, 'V.venue_display_name,V.venue_id', '');
        echo json_encode($venues);
    }
public function getasubcategories()
{
    $this->common_model->initialise('venue_sub_category as VS');
    $this->common_model->join_tables=array('sub_categories as S','venues as V');
    $this->common_model->join_on=array('VS.sub_category_id = S.sub_category_id','VS.venue_id = V.venue_id');
    $result=$this->common_model->get_records(0,"S.sub_category_id,S.sub_category_name","V.venue_id = '".$_POST['venue_id']."'");
    echo json_encode($result);
 }
public function getasubsubcategories()
{
    $this->common_model->initialise('venue_sub_sub_categories as VS');
    $this->common_model->join_tables=array('sub_sub_categories as S','venues as V');
    $this->common_model->join_on=array('VS.sub_sub_category_id = S.sub_sub_category_id','VS.venue_id = V.venue_id');
    $result=$this->common_model->get_records(0,"S.sub_sub_category_id,S.sub_sub_category_name","V.venue_id = '".$_POST['venue_id']."'");
    echo json_encode($result);
 }

    public function getADData()
    {
        $aColumns = array('V.venue_id','V.venue_display_name','A.base_type','A.base_type_id','C.category_name', 'SC.sub_category_name','SSC.sub_sub_category_name', 'A.addon_name','A.status', 'A.amount', 'U.name', 'A.created_on');
        $this->common_model->initialise("addon as A");
        $this->common_model->join_tables = array("venues as V","categories as C", "sub_categories as SC","sub_sub_categories as SSC", "users as U", "vendor as VD");
        $this->common_model->join_on = array("A.venue_id = V.venue_id","A.base_type_id = C.category_id", "A.base_type_id = SC.sub_category_id","A.base_type_id = SSC.sub_sub_category_id", "A.created_by=U.user_id", "V.vendor_id = VD.vendor_id");
        $this->common_model->left_join = array('left','left', 'left', 'left','left', 'left');
        //echo $this->session->userdata("user_id");
        $where = array("A.venue_id" => $_POST['venueid']);
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
                $link = '<a href="' . base_url() . 'admin/updateastatus/' . $aRow['venue_id'] . '/' . $aRow['status'] . '/'. $aRow['base_type_id'].'/'.$aRow['base_type'].'" style="color:black;margin-right:5px;"><i class="fa fa-remove" title="Inactive"></i></a>';
            } else if ($status == 0 || $status == '' || $status == 'NULL') {
                $statusn = "<i class='fa fa-remove' title='Inactive'></i>";
                $link = '<a href="' . base_url() . 'admin/updateastatus/' . $aRow['venue_id'] . '/' . $aRow['status'] . '/'. $aRow['base_type_id'].'/'.$aRow['base_type'].'" style="color:black;margin-right:5px;"><i class="fa fa-check" title="Active"></i></a>';
            }
            $row[5] = $statusn;
            $row[6] = $link . '<a href="'.base_url() .'admin/viewaddon/'.$aRow['venue_id'].'/'. $aRow['base_type_id'].'/'.$aRow['base_type'].'" style="color:black;margin-right:5px;"><i class="fa fa-eye" title="View"></i></a>&nbsp;&nbsp;<a href="'.base_url() .'admin/editaddon/'.$aRow['venue_id'].'/'. $aRow['base_type_id'].'/'.$aRow['base_type'].'" style="color:black;margin-right:5px;"><i class="fa fa-pencil" title="Edit"></i></a>';
            $output['aaData'][] = $row;
        }
        if ($this->input->get_post('sSearch')) {
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);
    }





    private function getvfacilities()
    {
        $this->common_model->initialise('venue_facilities as VF');
        $this->common_model->join_tables = array('venues as V', 'facilities as F', 'vendor as VD');
        $this->common_model->join_on = array("VF.venue_id = V.venue_id", "VF.facility_id = F.facility_id", "V.vendor_id = VD.vendor_id");
        $facilities = $this->common_model->get_records(0, 'VF.*,F.facility_name', "VD.user_id = '" . $this->session->userdata('user_id') . "'", '', '', "VF.facility_id");
        return $facilities;
    }

    /*** End of addon ***/

    /*Coins*/

    public function dayslots()
    {
        //echo "i am coming here";exit;
        $venueid = $this->input->post('venueid');
        $categoryid = $this->input->post('categoryid');
        $subcategoryid = $this->input->post('subcategoryid');
        $dayid = $this->input->post('dayid');

        $slot_from_time = explode(" ", $this->input->post('slotfromtime'));
        $slot_to_time = explode(" ", $this->input->post('slottotime'));
        $this->common_model->initialise('working_hours as W');
        $this->common_model->join_tables = array("venues as V", "categories as C", "venue_category as VC");
        $this->common_model->join_on = array("W.venue_id=V.venue_id", "W.category_id=C.category_id", "W.category_id=VC.category_id");
        $select = "W.*,V.venue_id as venueid";
        $where = "W.day_id = '$dayid' and V.venue_id='$venueid'";
        $getslots = $this->common_model->get_records(0, $select, $where, '', '', 'W.day_id');
        $this->common_model->initialise("time_slots as TS");
        $this->common_model->join_tables = array("working_hours as W");
        $this->common_model->join_on = array("TS.day_id=W.day_id");
        $where = "TS.day_id = " . $dayid;
        $getslotsdata = $this->common_model->get_records(0, "*", $where, '', '', "TS.slot_id");

        //echo "<pre>";print_r($getslotsdata);exit;
        $data = $getslots;
        //echo $slot_from_time[0];echo "<br />";
        //echo $slot_to_time[0];echo "<br />";
        $slotfromtime = $slot_from_time[0] . ":00";
        //echo $slotfromtime;echo "<br />";
        $slottotime = $slot_to_time[0] . ":00";
        //echo $slottotime;echo "<br />";
        if (!empty($data)) {

            if ($slotfromtime >= $data[0]->start_time && $slottotime <= $data[0]->end_time && $dayid == $data[0]->day_id) {


                foreach ($getslotsdata as $getslotdata) {
                    //echo $slotfromtime;echo "<br />";
                    //echo $slottotime;echo "<br />";
                    if ($slotfromtime > $getslotdata->slot_to_time && $slottotime > $getslotdata->slot_to_time && $dayid != $getslotdata->day_id) {
                        //echo "i am greater than	";exit;

                        $this->common_model->initialise("time_slots");
                        $where = "slot_from_time = '$slotfromtime' and slot_to_time = '$slottotime' and day_id = '$dayid'";
                        $select = "*";
                        $getdetails = $this->common_model->get_record_single($where, $select);
                        if (empty($getdetails)) {
                            //echo "i am coming to if condition";exit;
                            $data = "success";


                        } else {

                            $data = "Fail";
                        }

                    } else {
                        //echo "i am coming to first else condition";exit;
                        $data = "Exists";
                    }
                }

            } else {
                //echo "i am coming to second else condtion";exit;
                $data = "notmatch";
            }

        }

        echo json_encode($data);
        //echo $categoryid;
    }

    public function slotslist()
    {
        $aColumns = array('TS.slot_id', 'TS.day_id', 'TS.slot_from_time', 'TS.slot_to_time', 'TS.status', 'V.venue_id', 'V.venue_display_name', 'V.vendor_id');
        $this->common_model->initialise("time_slots as TS");
        $this->common_model->join_tables = array("venues as V", "working_hours as W");
        $this->common_model->join_on = array("TS.venue_id = V.venue_id");
        //$this->common_model->left_join = array('left','left');

        $where = "TS.venue_id = '" . $_POST['venueid'] . "'";
        $data = $this->common_model->getTable($aColumns, $where, '', '', 'TS.slot_id');
        $output = $data['output'];
        $count = 0;
        $i = $this->input->get_post('iDisplayStart') + 1;
        foreach ($data['result'] as $aRow) {
            $count++;
            $row = array();
            foreach ($aColumns as $col) {
                $col = trim($col, 'TS.');
                $col = trim($col, 'V.');
                $col = trim($col, 'W.');
                $row[] = $aRow[$col];
            }
            $row[0] = $i;
            $i = $i + 1;
            $row[1] = ucfirst($aRow['venue_display_name']);

            $row[2] = $aRow['slot_from_time'];
            $row[3] = $aRow['slot_to_time'];
            //$row[4] = $devicetype;
            $status = $aRow['status'];
            if ($status == 1) {
                $statusn = "<i class='fa fa-check' title='Active'></i>";
                $link = '<a href="' . base_url() . 'admin/updatestatus/' . $aRow['slot_id'] . '/' . $aRow["status"] . '/13" style="color:black;margin-right:5px;"><i class="fa fa-remove" title="Active"></i></a>';
            } else if ($status == 0 || $status = '' || $status = 'NULL') {
                $statusn = "<i class='fa fa-remove' title='Inactive'></i>";
                $link = '<a href="' . base_url() . 'admin/updatestatus/' . $aRow['slot_id'] . '/' . $aRow["status"] . '/13" style="color:black;margin-right:5px;"><i class="fa fa-check" title="Inactive"></i></a>';
            }
            $row[4] = $statusn;
            $row[5] = $link . '<a href="' . base_url() . 'admin/viewslotinfo/' . $aRow['slot_id'] . '/' . $aRow['venue_id'] . '" style="color:black;margin-right:5px;"><i class="fa fa-eye" title="view"></i></a>' . '<a href="' . base_url() . 'admin/editslotinfo/' . $aRow['slot_id'] . '/' . $aRow['venue_id'] . '" style="color:black"><i class="fa fa-pencil" title="Edit"></i></a>';

            $output['aaData'][] = $row;


        }

        if ($this->input->get_post('sSearch')) {
            $output['iTotalRecords'] = $count;
            $output['iTotalDisplayRecords'] = $count;
        }
        echo json_encode($output);

    }


    public function search()
    {
        $id = $_GET['term'];
        $this->common_model->initialise('vendor');
        $where = "company_name LIKE '" . $id . "%'  ";
        $vendors = $this->common_model->get_records(0, 'company_name', $where);
        foreach ($vendors as $vendor) {
            $data[] = $vendor->company_name;
        }
        echo json_encode($data);
    }

    public function searchallvenues()
    {
        $id = $_GET['term'];
        $this->common_model->initialise('venues');
        $where = "venue_display_name LIKE '" . $id . "%'  ";
        $venues = $this->common_model->get_records(0, 'venue_display_name,venue_id', $where);
        //$uli='<ul>';
        foreach ($venues as $venue) {
            $data[] = $venue->venue_display_name;
            //$data[] = "<input type='text' value='{$venue->venue_id}'>".$venue->venue_display_name;

        }

        echo json_encode($data);

    }


    public function getvenues()
    {
        $id = $_POST['id'];
        $this->common_model->initialise('vendor');
        $where = "company_name = '" . $id . "' ";
        $result = $this->common_model->get_record_single($where, 'vendor_id');
        $venid = $result->vendor_id;
        //$venid=1;
        $this->common_model->initialise('venues');
        $venues = $this->common_model->get_records(0, '*', "vendor_id = '" . $venid . "'");
        echo json_encode($venues);
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


    public function categorychange_subsub()
    {
        $catid = $this->input->post('catid');
        $this->common_model->initialise("sub_categories");
        $where = "category_id = $catid";
        $getsubcats = $this->common_model->get_records(0, "*", $where);
        $data = $getsubcats;
        echo json_encode($data);
    }


}


?>