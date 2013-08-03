<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Welcome Controller
 */
class Profile extends CI_Controller
{

    /**
     * @var string folder name contain the view files for the current controller
     */
    private $fview = "profile/";

    /**
     * @var Group id from database
     */
    function __construct()
    {
        parent::__construct();
               if (!$this->tank_auth->is_logged_in()) {
            //not logged in
            redirect('auth/login');
        }
        $this->load->model('rbac/rbac_profile', 'm_profile');
        $this->template->write_view('menu', 'menu');
    }

    /**
     * Profile page
     */
    public function index()
    {
        if($this->m_profile->is_reset($this->tank_auth->get_user_id()))
            redirect('welcome/complete_registration');
        $data['user'] = $this->m_profile->get_profile($this->tank_auth->get_user_id());
        $this->template->write_view('content', $this->fview . 'profile', $data);
        $this->template->render();
    }

    /**
     * Edit Profile page
     */
    public function edit()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');

        $this->form_validation->set_rules('profile_name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email id', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('mobile', 'Mobile No.', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run()) {
            // validation ok
            $this->m_profile->change_email($this->tank_auth->get_user_id(), $this->form_validation->set_value('email'));
            $this->m_profile->update_profile($this->tank_auth->get_user_id(), array(
                'phone' => $this->form_validation->set_value('mobile'),
                'name' => $this->form_validation->set_value('profile_name')));
            set_message('Profile updated successfully.. ', 'alert-success');
            redirect('welcome');
        }
        $data['user'] = $this->m_profile->get_profile($this->tank_auth->get_user_id());
        $this->template->write_view('content', $this->fview . 'edit_profile', $data);
        $this->template->render();
    }

    /**
     * Complete Registration
     * if reset flag is 'On' then you will see this page
     */
    function complete_registration()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');

        $this->form_validation->set_rules('profile_name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email id', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('mobile', 'Mobile No.', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length[' . $this->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('password_max_length', 'tank_auth') . ']');
        $this->form_validation->set_rules('confirm_new_password', 'Verify Password', 'trim|required|xss_clean|matches[new_password]');

        if ($this->form_validation->run()) {
            // validation ok
            $this->m_profile->change_email($this->tank_auth->get_user_id(), $this->form_validation->set_value('email'));
            $this->m_profile->update_profile($this->tank_auth->get_user_id(), array(
                'phone' => $this->form_validation->set_value('mobile'),
                'name' => $this->form_validation->set_value('profile_name')));
            if($this->tank_auth->change_password($this->form_validation->set_value('password'), $this->form_validation->set_value('new_password'))) {
                set_message('Profile updated successfully.. ', 'message-success');
                redirect('welcome');
            }
            else {
                $data['errors']['password']="Incorrect password";
            }
        }
        $this->template->write('menu', '',TRUE);
        $data['user'] = $this->m_profile->get_profile($this->tank_auth->get_user_id());
        $this->template->write_view('content', $this->fview . 'complete_registration', $data);
        $this->template->render();
    }
     }

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
