<?php

class Adminneon_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('adminneon_m');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    function index() {
        if ($this->session->userdata('isLoggedIn')) {
            redirect(base_url() . 'index.php/adminneon_c/dashboard');
        } else {
            $this->show_login(false);
        }
    }

    function login_user() {

        $this->load->model('adminneon_m');

        $admin_firstname = $this->input->post('admin_firstname');
        $admin_password = $this->input->post('admin_password');

        if ($admin_firstname && $admin_password && $this->adminneon_m->validate_user($admin_firstname, $admin_password)) {
            redirect(base_url() . 'index.php/adminneon_c/dashboard');
        } else {

            $this->show_login(true);
        }
    }

    function show_login($show_error = false) {
        $data['error'] = $show_error;
        $this->load->view('adminneon/admin_login', $data);
    }

    function logout_user() {
        $this->session->sess_destroy();
        $this->index();
    }

    function dashboard() {
        $admin_id = $this->session->userdata('admin_id');

        if ($admin_id != '') {
            $query = $this->adminneon_m->admin_getdata();
            //var_dump($query);die;
            $data['ADMINS'] = null;
            if ($query) {
                $data['ADMINS'] = $query;
            }
            $this->load->view('adminneon/sidebar');
            $this->load->view('adminneon/dashboard', $data);
        } else {
            $this->login_user();
        }
        //$this->load->view('adminneon/admin_view', $data);
    }

    public function admin_getdata() {

        $this->load->model('adminneon_m');
        $query = $this->adminneon_m->admin_getdata();
        //  var_dump($query);die;
        $data['ADMINS'] = null;
        if ($query) {
            $data['ADMINS'] = $query;
        }
        $this->load->view('adminneon/sidebar');
        $this->load->view('adminneon/admin_view', $data);
    }

    public function insert_category() {
        $this->adminneon_m->adminform_insert();
        redirect(base_url() . 'index.php/adminneon_c/admin_getdata');
    }

    public function category_insert() {
        $this->load->view('adminneon/sidebar');
        $this->load->view('adminneon/category_insert');
    }

    function ch_admin_insert() {
        $this->load->view('adminneon/sidebar');
        $this->load->view('adminneon/admin_insert');
    }

    public function category_view() {
        $data['Cat'] = $this->adminneon_m->get_category();

        $this->load->view('adminneon/sidebar');
        $this->load->view("adminneon/category_view", $data);
    }

    public function category_in() {
        $this->adminneon_m->category_insert();
        redirect(base_url() . 'index.php/adminneon_c/category_view');
    }

    public function adminform_insert() {
        $this->adminneon_m->adminform_insert();
        redirect(base_url() . 'index.php/adminneon_c/admin_getdata');
    }

    public function update_admin() {

        $id = $this->session->userdata('admin_id');
        // var_dump($admin_id);die;
        if ($id != '') {
            $admin_id = $this->input->post('update_action') == '';

            if ($admin_id == '') {
                $q = $this->adminneon_m->edit_admin($this->uri->segment(3));
                $d['adminDetails'] = null;
                if ($q) {
                    $d['adminDetails'] = $q;
                } else {
                    redirect(base_url());
                }
                $this->load->view('adminneon/sidebar');
                $this->load->view('adminneon/admin_edit', $d);
            } else {
                $this->form_validation->set_rules('admin_firstname', 'Name', 'trim|required');
                if ($this->form_validation->run() == FALSE) {
                    $q = $this->adminneon_m->edit_admin($this->uri->segment(3));
                    $d['adminDetails'] = null;
                    if ($q) {
                        $d['adminDetails'] = $q;
                    } else {
                        redirect(base_url());
                    }
                    $this->load->view('adminneon/sidebar');
                    $this->load->view('adminneon/admin_edit', $d);
                } else {

                    $data = array(
                        'admin_firstname' => $this->input->post('admin_firstname'),
                        'admin_lastname' => $this->input->post('admin_lastname'),
                        'admin_email' => $this->input->post('admin_email'),
                        'admin_contact' => $this->input->post('admin_contact')
                    );
                    $this->db->where('admin_id', $this->input->post('admin_id'));
                    $this->db->update('admin', $data);

                    redirect(base_url() . 'index.php/adminneon_c/admin_getdata');
                }
            }
        } else {
            $this->login_user();
        }
    }

    public function delete($admin_id) {
        $admin_id = $this->uri->segment(3);

        if (empty($admin_id)) {
            show_404();
        }

        $news_item = $this->adminneon_m->get_User_id('', '', $admin_id);
        if ($this->adminneon_m->delete_admin($admin_id)) {
            $this->session->set_flashdata('message', 'Deleted Sucessfully');
            redirect(base_url() . 'index.php/adminneon_c/admin_getdata');
        }
    }

//DELETE OPRATION IN EMP TABLE...
    public function empdelete($emp_id) {
        $emp_id = $this->uri->segment(3);
        if (empty($emp_id)) {
            show_404();
        }
        $n = $this->adminneon_m->get_emp_id('', '', $emp_id);
        if ($this->adminneon_m->delete_emp($emp_id)) {
            $this->session->set_flashdata('message', 'delete record..');
            redirect(base_url() . 'index.php/adminneon_c/get_emp');
        }
    }

    public function delete_category() {

        $category_id = $this->uri->segment(3);
        if (empty($category_id)) {
            show_404();
        }
        $category = $this->adminneon_m->get_category_id('', '', $category_id);
        if ($this->adminneon_m->delete_category($category_id)) {
            $this->session->set_flashdata('message', 'delete record..');
            redirect(base_url() . 'index.php/adminneon_c/category_view');
        }
    }

    /*     * ************************** emp ************************* */

    function Update_emp_master() {
        $admin_id = $this->session->userdata('admin_id');
        // var_dump($admin_id);die;
        if ($admin_id != '') {
            $emp_id = $this->input->post('update_action') == '';

            if ($emp_id == '') {
                $q = $this->adminneon_m->edit_emp_master($this->uri->segment(3));
                $d['empDetails'] = null;
                if ($q) {
                    $d['empDetails'] = $q;
                } else {
                    redirect(base_url());
                }
                $this->load->view('adminneon/sidebar');
                $this->load->view('adminneon/emp_edit', $d);
            } else {
                $this->form_validation->set_rules('emp_name', 'Name', 'trim|required');
                if ($this->form_validation->run() == FALSE) {
                    $q = $this->adminneon_m->edit_emp_master($this->uri->segment(3));
                    $d['empDetails'] = null;
                    if ($q) {
                        $d['empDetails'] = $q;
                    } else {
                        redirect(base_url());
                    }
                    $this->load->view('adminneon/sidebar');
                    $this->load->view('adminneon/emp_edit', $d);
                } else {

                    $data = array(
                        'emp_name' => $this->input->post('emp_name')
                    );
                    $this->db->where('emp_id', $this->input->post('emp_id'));
                    $this->db->update('emp', $data);

                    redirect(base_url() . 'index.php/adminneon_c/get_emp');
                }
            }
        } else {
            $this->login_user();
        }
    }

    public function get_emp_insert() {

        $data['CategoriesDetail'] = $this->adminneon_m->get_category();

        $this->load->view('adminneon/sidebar');
        $this->load->view("adminneon/emp_insert", $data);
    }

    public function get_emp() {

        $query = $this->adminneon_m->get_emp();
        //var_dump($query);die;
        $data['EMP'] = null;
        if ($query) {
            $data['EMP'] = $query;
        }
        $this->load->view('adminneon/sidebar');
        $this->load->view('adminneon/emp_view', $data);
    }

    public function emp_insert() {
        $this->adminneon_m->inst_emp();
        redirect(base_url() . 'index.php/adminneon_c/get_emp');
    }

    function get_category() {
        $this->load->model('adminneon_m');
        $q = $this->adminneon_m->get_category();
        $datas['CategoriesDetail'] = null;
        if ($q) {
            $datas['CategoriesDetail'] = $q;
        }

        $this->load->view('adminneon/sidebar');
        $this->load->view('adminneon/emp_view', $datas);
    }

#################################SUB-CATEGORY#############################################

    public function show_subcategory() {
        $data['CategoriesDetail'] = $this->adminneon_m->get_category();
        $this->load->view('adminneon/sidebar');
        $this->load->view('adminneon/subcategory_insert', $data);
    }

    public function sub_cate_insert() {
        $this->adminneon_m->subcate_insert();
        redirect(base_url() . 'index.php/adminneon_c/get_subcategory');
    }

    public function get_subcategory() {
        $data['SubCategory'] = $this->adminneon_m->get_subcategory();
        $newArray = array();
        $newArray['result'] = 'success';
        $newArray['subcategory'] = $result;
        echo json_encode($newArray);
        die;

        $this->load->view('adminneon/sidebar');
        $this->load->view('adminneon/subcategory_view', $data);
    }

    public function delete_subcategory() {
        $subcategory_id = $this->uri->segment(3);
        if (empty($subcategory_id)) {
            show_404();
        }
        $subcategory = $this->adminneon_m->get_subcategory_id('', '', $subcategory_id);
        if ($this->adminneon_m->delete_subcate($subcategory_id)) {
            $this->session->set_flashdata('message', 'delete record..');
            redirect(base_url() . 'index.php/adminneon_c/get_subcategory');
        }
    }

    function Update_subcategory_master() {

        $subcategory_id = $this->input->post('update_action') == '';

        if ($subcategory_id == '') {

            $data['subcategoryDetails'] = $this->adminneon_m->edit_subcategory($this->uri->segment(3));

            $data['CategoriesDetail'] = $this->adminneon_m->get_category();
            $this->load->view('adminneon/edit_subcategory', $data);
        } else {
            $this->form_validation->set_rules('subcategory_name', 'Full Name', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $data['subcategoryDetails'] = $this->adminneon_m->edit_subcategory($this->uri->segment(3));
                $data['CategoriesDetail'] = $this->adminneon_m->get_category();

                $this->load->view('adminneon/sidebar');
                $this->load->view('adminneon/edit_subcategory', $data);
            } else {

                $data = array(
                    'refCategory_id' => $this->input->post('sub_category'),
                    'subcategory_name' => $this->input->post('subcategory_name')
                );

                $this->db->where('subcategory_id', $this->input->post('subcategory_id'));
                $this->db->update('subcategory', $data);

                redirect(base_url() . 'index.php/adminneon_c/getSubcategory');
            }
        }
    }

    ####################################PRODUCT OPERATION######################################

    public function show_product() {


        $data['CategoriesDetail'] = $this->adminneon_m->get_category();
        $data['subcategoryDetails'] = $this->adminneon_m->getSubcategory();
        // var_dump($data);die;
        $this->load->view('adminneon/sidebar');
        $this->load->view('adminneon/product_insert', $data);
    }

    public function product_insert() {

        $this->adminneon_m->product_insert();
        redirect(base_url() . 'index.php/adminneon_c/get_product');
    }

    public function get_subcategoryid() {
        $this->load->model('adminneon_m');
        $q = $this->adminneon_m->getSubcategory();
        $datas['subCategoriesDetail'] = null;
        if ($q) {
            $datas['subCategoriesDetail'] = $q;
        }
    }

    public function get_product() {



        $data['Product'] = $this->adminneon_m->get_product();

        $this->load->view('adminneon/sidebar');
        $this->load->view('adminneon/product_view', $data);
    }

    public function delete_product() {

        $product_id = $this->uri->segment(3);
        if (empty($product_id)) {
            show_404();
        }
        $product = $this->adminneon_m->get_product_id('', '', $product_id);
        if ($this->adminneon_m->deleteproduct($product_id)) {
            $this->session->flashdata('message', 'record data');
            redirect(base_url() . 'index.php/adminneon_c/get_product');
        }
    }

    public function update_product() {
        $product_id = $this->input->post('update_action') == '';
        //var_dump($product_id); die;
        if ($product_id == '') {

            $data['productDetails'] = $this->adminneon_m->edit_product($this->uri->segment(3));
            $data['subcategoryDetails'] = $this->adminneon_m->get_subcategory();

            $data['CategoriesDetail'] = $this->adminneon_m->get_category();
            $this->load->view('adminneon/product_edit', $data);
        } else {
            $this->form_validation->set_rules('product_name', 'Full Name', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $data['productDetails'] = $this->adminneon_m->edit_product($this->uri->segment(3));
                // var_dump($data);die;
                $data['subcategoryDetails'] = $this->adminneon_m->get_subcategory();

                $data['CategoriesDetail'] = $this->adminneon_m->get_category();
                $this->load->view('adminneon/sidebar');
                $this->load->view('adminneon/product_edit', $data);
            } else {

                if (!empty($_FILES['product_image']['name'])) {

                    $config['upload_path'] = 'uploads/image/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['file_name'] = $_FILES['product_image']['name'];

                    //Load upload library and initialize configuration
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('product_image')) {
                        $uploadData = $this->upload->data();
                        $galleryimg = $uploadData['file_name'];
                    } else {
                        $galleryimg = '';
                    }
                } else {
                    $galleryimg = '';
                }
                $data = array(
                    'refCategory_id' => $this->input->post('ch_product'),
                    'refSubcategory_id' => $this->input->post('ch_subcategory'),
                    'product_name' => $this->input->post('product_name'),
                    'product_image' => $galleryimg
                );
                $this->db->where('product_id', $this->input->post('product_id'));
                $this->db->update('product', $data);
                redirect(base_url() . 'index.php/adminneon_c/get_product');
            }
        }
    }

    public function getSubcategory() {
        $refCategoryId = $_POST['id'];
        $result = $this->adminneon_m->getSubcategory($refCategoryId);
        $newArray = array();
        $newArray['result'] = 'success';
        $newArray['subcategory'] = $result;
        echo json_encode($newArray);
        die;
    }

}
