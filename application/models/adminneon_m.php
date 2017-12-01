<?php

class Adminneon_m extends CI_Model {

    function __construct() {
        // Call the Model constructor  
        parent::__construct();
        $this->load->library('image_lib');
    }

    function admin_getdata() {

        $this->db->select("admin_id,admin_firstname,admin_contact,admin_password,admin_email");
        $this->db->from('admin');
        $query = $this->db->get();
        return $query->result();
    }

    //GET EPMLOYE TABLE DATA
    function get_emp() {
        $this->db->select("*");
        $this->db->from('emp');
        $q = $this->db->get();
        return $q->result();
    }

    function adminform_insert() {

        if (!empty($_FILES['admin_image']['name'])) {

            $config['upload_path'] = 'uploads/image/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['admin_image']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('admin_image')) {
                $uploadData = $this->upload->data();
                $galleryimg = $uploadData['file_name'];
            } else {
                $galleryimg = '';
            }
        } else {
            $galleryimg = '';
        }

        $data = array(
            'admin_firstname' => $this->input->post('admin_firstname'),
            'admin_lastname' => $this->input->post('admin_lastname'),
            'admin_image' => $galleryimg,
            'admin_email' => $this->input->post('admin_email'),
            'admin_contact' => $this->input->post('admin_contact'),
            'admin_password' => $this->input->post('admin_password'),
            'date' => $this->input->post('date'),
        );
        $this->db->insert('admin', $data);
    }

    function set_session() {

        $this->session->set_userdata(array(
            'admin_id' => $this->details->admin_id,
            'admin_firstname' => $this->details->admin_firstname,
            'isLoggedIn' => true
                )
        );
    }

    //SET SESSION FOR EMPLYEE TABLE DATA HARE..

    function emp_set_session() {
        $this->session->set_userdata(array(
            'emp_id' => $this->info->emp_id,
            'emp_name' => $this->info->emp_name,
            'isLoggedIn' => true)
        );
    }

    function validate_user($admin_firstname, $admin_password) {
        $this->db->from('admin');
        $this->db->where('admin_firstname', $admin_firstname);
        $this->db->where('admin_password', $admin_password);
        $this->db->where('admin_status=1');
        $login = $this->db->get()->result();

        if (is_array($login) && count($login) == 1) {

            $this->details = $login[0];
            $this->set_session();
            return true;
        }
        return false;
    }

    function get_User_id($admin_id) {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('admin_id', $admin_id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    //GET EMP ID FROM EMPLYEE TABLE..
    function get_emp_id($emp_id) {
        $this->db->select("*");
        $this->db->from('emp');
        $this->db->where('emp_id', $emp_id);
        $q = $this->db->get();
        $r = $q->result();
        return $r;
    }

    function edit_admin($admin_id) {

        $this->db->select("*");
        $this->db->where('admin_id', $admin_id);

        $result = $this->db->get('admin');
        if ($result->num_rows() > 0)
            return $result->row();
        else
            return 'empty';
    }

    //HARE EDIT EMPLOYEE DATA TABLE..
    function edit_emp($emp_id) {
        $this->db->select("*");
        $this->db->where('emp_id', $emp_id);
        $r = $this->db->get('emp');
        if ($r->num_rows() > 0)
            return $r->row();
        else
            return 'empty';
    }

    function update_admin_id($admin_id) {
        $data = array(
            'admin_firstname' => $this->input->post('admin_firstname'),
            'admin_lastname' => $this->input->post('admin_lastname'),
            'admin_email' => $this->input->post('admin_email'),
            'admin_contact' => $this->input->post('admin_contact'),
            'date' => $this->input->post('date')
        );
        $this->db->where('admin_id', $this->input->post('admin_id'));
        $e = $this->db->update('admin', $data);
        return true;
        if ($e)
            redirect(base_url() . 'index.php/adminneon_c');
    }

    public function delete_admin($admin_id) {
        $this->db->where('admin_id', $admin_id);
        return $this->db->delete('admin');
    }
//EMP DELETE DATA...
    public function delete_emp($emp_id){
        $this->db->where('emp_id',$emp_id);
        return $this->db->delete('emp');
    }




    /************************  emp***********************/
    
    function edit_emp_master($emp_id) {
        $this->db->select("*");
        $this->db->where('emp_id', $emp_id);
        $result = $this->db->get('emp');
        if ($result->num_rows() > 0)
            return $result->row();
        else
            return 'empty';
    }
}
