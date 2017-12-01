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
        //var_dump($query);die;
        $data['ADMINS'] = null;
        if ($query) {
            $data['ADMINS'] = $query;
        }
        $this->load->view('adminneon/sidebar');
        $this->load->view('adminneon/admin_view', $data);
    }

    //GET EMPLYEE DATA HARE...
    public function get_emp() {
        $this->load->model('adminneon_m');
        $q = $this->adminneon_m->get_emp();
        $datas['EMP'] = null;
        if ($q) {
            $datas['EMP'] = $q;
        }
        $this->load->view('adminneon/sidebar');
        $this->load->view('adminneon/emp_view', $datas);
    }

    function ch_admin_insert() {
        $this->load->view('adminneon/sidebar');
        $this->load->view('adminneon/admin_insert');
    }

    public function adminform_insert() {
        $this->adminneon_m->adminform_insert();
        redirect(base_url() . 'index.php/adminneon_c/admin_getdata');
    }

    public function update_admin($admin_id) {

        $admin_id = $this->session->userdata('admin_id');

        if ($admin_id != '') {
            $query = $this->adminneon_m->edit_admin($this->uri->segment(3));
            $data['adminDetails'] = null;
            if ($query) {
                $data['adminDetails'] = $query;
            } else {
                $this->adminneon_m->adminform_insert($admin_id);
                redirect(base_url());
            }
            $this->load->view('adminneon/sidebar');
            $this->load->view('adminneon/admin_edit', $data);
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

}
