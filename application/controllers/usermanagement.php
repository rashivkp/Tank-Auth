<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');

/**
 * User management controller
 *  
 * @package		Itchool_rbac
 * @author		Mohamed Rashid C (https://twitter.com/rashivkp)
 * @based on	Tank_Auth 
 */
class Usermanagement extends CI_Controller
{

    /**
     * @var string folder name contain the view files for the current controller
     */
    private $fview = "rbac";

    function __construct()
    {
        parent::__construct();
        
        if ( ! $this->tank_auth->is_logged_in()) {
            //not logged in
            redirect('auth/login');
        }
        // check the user is authenticated to access this group
        $this->itschool_rbac->has_permission(__CLASS__);
        $this->template->write_view('menu', 'menu');
        $this->load->model('rbac/rbac_model','m_rbac');
    }

    /**
     * index page for usermanagement
     */
    function index()
    {
        $this->itschool_rbac->has_permission(__CLASS__,array('admin'));
        $this->usergroups();
    }

    /**
     * page for adding new user
     */
    function new_user()
    {
        $this->itschool_rbac->has_permission(__CLASS__,array('admin'));
        $this->load->library('form_validation');
        $data['errors']=array();
        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');
        $this->form_validation->set_rules('username', 'User Name', 'trim|required|xss_clean|alpha_dash');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('managing', 'Managing id', 'trim|required|xss_clean|numeric');
        
        if ($this->form_validation->run()) {
            if($this->tank_auth->rbac_create_user(
                    $this->form_validation->set_value('username'),
                    $this->form_validation->set_value('email'),
                    $this->input->post('password') ? $this->input->post('password') : $this->form_validation->set_value('username'),
                    FALSE,
                    $this->input->post('usergroup'),
                    $this->form_validation->set_value('managing')
                    )) {
                set_message('New User Created ..', 'alert-success');
                redirect($this->uri->uri_string());
            }
                
                    
        }

        $data['usergroups']=$this->m_rbac->get_usergroups();
        $this->template->write_view('content', $this->fview . "/new_user",$data);
        $this->template->render();
    }

    /**
     * page for adding new usergroup
     */
    function new_usergroup()
    {
        $this->itschool_rbac->has_permission(__CLASS__,array('admin'));
        $this->load->library('form_validation');
        $data['errors']=array();
        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');
        $this->form_validation->set_rules('usergroup_name', 'User group name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('priority', 'Priority', 'trim|required|xss_clean|numeric');
        
        if ($this->form_validation->run()) {
            $permissions = array();
            if (is_array($groups = $this->input->post('selected_tasgroups_h'))) {
                foreach ($groups as $group) {
                    $permissions[$group] = array();
                    if (is_array($roles = $this->input->post('srole_' . $group))) {
                        foreach ($roles as $role) {
                            $permissions[$group][] = $role;
                        }
                    }
                }
                $permissions = json_encode($permissions);
                if ($this->itschool_rbac->create_usergroup(
                        $this->form_validation->set_value('usergroup_name'), 
                        $permissions, 
                        $this->input->post('user_scope'), 
                        $this->form_validation->set_value('priority'),
                        $this->input->post('description')
                        )) {
                    set_message('New User Group Created ..', 'alert-success');
                    redirect($this->uri->uri_string());
                }
            } else {
                $data['errors']['selected_taskgroups'] = 'Please Assign Task Groups';
            }

            $errors = $this->itschool_rbac->get_error_message();
            foreach ($errors as $k => $v) {
                $data['errors'][$k] = $v;
            }
        }
        $this->template->add_js('assets/js/rbac.js');
        $data['taskgroups']=$this->m_rbac->get_taskgroups();
        $data['roles']=$this->m_rbac->get_roles();
        $data['scopes']=$this->m_rbac->get_scopes();
        $this->template->write_view('content', $this->fview . "/new_usergroup",$data);
        $this->template->render();
    }

    /**
     * page for adding a taskgroup to database
     */
    function new_taskgroup()
    {
        $this->itschool_rbac->has_permission(__CLASS__,array('admin'));
        $this->load->library('form_validation');
        $data['errors']=array();
        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');
        
        $this->form_validation->set_rules('taskgroup', 'Task Group', 'trim|required|xss_clean|alpha_dash');
        
        $data['errors'] = array();

        if ($this->form_validation->run()) {
            if($data = $this->itschool_rbac->create_taskgroup($this->form_validation->set_value('taskgroup'))) {
                set_message('New Task Group Created ..', 'alert-success');
                redirect($this->uri->uri_string());
            }
            
        }
        $errors = $this->itschool_rbac->get_error_message();
        foreach ($errors as $k => $v) {
            $data['errors'][$k] = $v;
        }

        $this->template->write_view('content', $this->fview . "/new_taskgroup", $data);
        $this->template->render();
    }
    
    /**
     * page for adding role
     */
    function new_role()
    {
        $this->itschool_rbac->has_permission(__CLASS__,array('admin'));
        $this->load->library('form_validation');
        $data['errors']=array();
        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');
        
        $this->form_validation->set_rules('role', 'Role', 'trim|required|xss_clean|alpha_dash');
        
        $data['errors'] = array();

        if ($this->form_validation->run()) {
            if($this->itschool_rbac->create_role($this->form_validation->set_value('role')))
            {
                set_message('New Role Created ..', 'alert-success');
                redirect($this->uri->uri_string());
            }
        }
        $errors = $this->itschool_rbac->get_error_message();
        foreach ($errors as $k => $v) {
            $data['errors'][$k] = $v;
        }

        $this->template->write_view('content', $this->fview . "/new_role", $data);
        $this->template->render();
    }
    
    /**
     * page for adding scope
     */
    function new_scope()
    {
        $this->itschool_rbac->has_permission(__CLASS__,array('admin'));
        $this->load->library('form_validation');
        $data['errors']=array();
        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');
        
        $this->form_validation->set_rules('scope', 'Scope', 'trim|required|xss_clean|alpha_dash');
        
        $data['errors'] = array();

        if ($this->form_validation->run()) {
            if($this->itschool_rbac->create_scope($this->form_validation->set_value('scope')))
            {
                set_message('New Scope Created ..', 'alert-success');
                redirect($this->uri->uri_string());
            }
        }
        $errors = $this->itschool_rbac->get_error_message();
        foreach ($errors as $k => $v) {
            $data['errors'][$k] = $v;
        }

        $this->template->write_view('content', $this->fview . "/new_scope", $data);
        $this->template->render();
    }
    
    /**
     * bulk user creation
     */
    function create_default_users()
    {
        $this->itschool_rbac->has_permission(__CLASS__,array('admin'));
        $this->template->write_view('content', $this->fview . "/create_default_users");
        $this->template->render();
    }
    
    /**
     * creating login credentials for all schools
     */
    function __create_school_login()
    {
        $this->itschool_rbac->has_permission(__CLASS__,array('admin'));
        $this->load->model('school/school_model','m_school');
        $schools=$this->m_school->get_schools();
        foreach($schools as $school) {
            
            $this->tank_auth->rbac_create_user(
                    $school->school_code,
                    $school->school_code, 
                    $school->school_code,
                    FALSE,
                    3,
                    $school->id
                    );
        }
        
    }
    
    /**
     * Reset password by username
     */
    function reset_password($reset_username = FALSE)
    {
        $data=array();
        if ($reset_username) {
            $data['reset_username']=$reset_username;
        } 
        $this->itschool_rbac->has_permission(__CLASS__, array('edit'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'User Name', 'trim|required|xss_clean|min_length[' . $this->config->item('username_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('username_max_length', 'tank_auth') . ']');
        if ($this->form_validation->run()) {

            if ($this->itschool_rbac->reset_password_by_username(
                            $this->form_validation->set_value('username'), $this->input->post('password') ? $this->input->post('password') : $this->form_validation->set_value('username')
                    )) {
                set_message("Password resetted successfully", "alert-success");
                redirect($this->uri->uri_string());
            }
        }
        $this->template->write_view('content', $this->fview . "/reset_password", $data);
        $this->template->render();
    }
    
    /**
     * view & manage all usergroups
     */
    function usergroups()
    {
        $this->itschool_rbac->has_permission(__CLASS__,array('admin'));
        if(is_null($data['usergroups']=$this->m_rbac->get_usergroups())) {
               $data['usergroups']=array();
               $this->template->write('content', '<br />'.error_message('There is no usergroups available to manage'));
        }
              
        foreach($this->itschool_rbac->groups as $k => $v) {
            $data['groups_config'][$v]=$k;
        }
        foreach($this->itschool_rbac->roles as $k => $v) {
            $data['roles_config'][$v]=$k;
        }
            
        $this->template->write_view('content', $this->fview . "/usergroups",$data);
        $this->template->render();
    }
    
    /**
     * edit selected usergroup
     * @param int $id
     */
    function edit_usergroup($id = 0)
    {
        $this->itschool_rbac->has_permission(__CLASS__,array('admin'));
        
        if (is_null($data['usergroups'] = $this->m_rbac->get_usergroups($id))) {
            show_404(__FILE__, FALSE);
        }
        
        $this->load->library('form_validation');
        $data['errors'] = array();
        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');
        $this->form_validation->set_rules('usergroup_name', 'User group name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('priority', 'Priority', 'trim|required|xss_clean|numeric');
        if ($this->form_validation->run()) {
            $permissions = array();
            if (is_array($groups = $this->input->post('selected_tasgroups_h'))) {
                foreach ($groups as $group) {
                    $permissions[$group] = array();
                    if (is_array($roles = $this->input->post('srole_' . $group))) {
                        foreach ($roles as $role) {
                            $permissions[$group][] = $role;
                        }
                    }
                }
                $permissions = json_encode($permissions);
                if ($this->itschool_rbac->update_usergroup(
                                $id, $this->form_validation->set_value('usergroup_name'), $permissions, $this->input->post('user_scope'), $this->form_validation->set_value('priority'), $this->input->post('description')
                        )) {
                    set_message('User Group Updated ..', 'alert-info');
                    redirect($this->uri->uri_string());
                }
            } else {
                $data['errors']['selected_taskgroups'] = 'Please Assign Task Groups';
            }

            $errors = $this->itschool_rbac->get_error_message();
            foreach ($errors as $k => $v) {
                $data['errors'][$k] = $v;
            }
        }


        $data['taskgroups'] = $this->m_rbac->get_taskgroups();
        $data['roles'] = $this->m_rbac->get_roles();
        $data['scopes'] = $this->m_rbac->get_scopes();
        foreach ($this->itschool_rbac->groups as $k => $v) {
            $data['groups_config'][$v] = $k;
        }
        foreach ($this->itschool_rbac->roles as $k => $v) {
            $data['roles_config'][$v] = $k;
        }

        //$this->template->write_view('content', $this->fview . "/usergroups", $data);
        $data['permissions'] = json_decode($data['usergroups'][0]->item_ids);
        $this->template->add_js('assets/js/rbac.js');
        $this->template->write_view('content', $this->fview . "/edit_usergroup", $data);
        $this->template->render();
    }
    
    /**
     * view the content to be used in application/config/itschool_rbac.php
     */
    function configuration()
    {   
		$this->itschool_rbac->has_permission(__CLASS__,array('admin'));    
        $data['roles']=$this->m_rbac->get_roles();
        $data['taskgroups']=$this->m_rbac->get_taskgroups();
        $path = "./application/controllers";
        $data['file_names'] = $this->itschool_rbac->scanFileNameRecursivly($path);
        $this->template->write_view('content', $this->fview . "/configuration",$data);
        $this->template->render();
    }
    
    /**
     * view members of provided usergroup
     * @param int $group_id
     */
    function members($group_id = FALSE)
    {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $this->load->model('rbac/rbac_users');
        $data['usergroups'] = $this->m_rbac->get_usergroups($group_id);
        if (!$group_id && is_null($data['usergroups'])) {
            show_404(__FILE__, FALSE);
        }
        if (is_null($data['users'] = $this->rbac_users->get_users_by_group($group_id))) {
            set_message("No members in requested group", "alert-info");
            redirect('usermanagement/usergroups');
        }
        $this->template->write_view('content', 'rbac/members', $data);
        $this->template->render();
    }
    
    /**
    * remove user
    * @param int $group_id
    * @param int $user_id
    */
    function remove_user($group_id = FALSE, $user_id = FALSE)
    {
        if (!$group_id && !$user_id) {
            show_404(__FILE__, FALSE);
        }
        $this->load->model('tank_auth/users');
        if ($this->users->delete_user($user_id)) {
            set_message('Removed User Successfully..', 'alert-info');
            redirect("usermanagement/members/$group_id");
        }
    }
    
    /**
     * defining the roles description in provided taskgroup
     * @param type $group_id
     */
    function define_roles($taskgroup_id = FALSE)
    {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $this->load->model('rbac/rbac_description', 'm_description');
        if (!$taskgroup_id) {
            show_404(__FILE__, FALSE);
        }
        if (is_null($data['taskgroup'] = $this->m_rbac->get_taskgroups($taskgroup_id))) {
            show_404(__FILE__, FALSE);
        }
        $data['roles'] = $this->m_rbac->get_roles();

        //if button pressed
        if ($this->input->post('update_description')) {
            foreach ($data['roles'] as $role) {
                $description = $this->input->post($role->item . $role->id);
                if ($description != '') {
                    if(!$this->m_description->is_description_available($taskgroup_id, $role->id))
                    {
                         $this->m_description->update_description($taskgroup_id, $role->id,
                            htmlspecialchars($description));
                    }
                    else {
                        $this->m_description->insert_description($taskgroup_id, $role->id,
                            htmlspecialchars($description));
                    }
                }
            }

            set_message("description updated ..", 'alert-success');
            redirect($this->uri->uri_string());
        }
        $this->template->write_view('content', 'rbac/define_role', $data);
        $this->template->render();
    }    
    
    /**
     * listing taskgroups
     */
    function taskgroups()
    {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $this->load->model('rbac/rbac_description','m_description');
        $data['roles']=$this->m_rbac->get_roles();
        $data['taskgroups'] = $this->m_rbac->get_taskgroups();        
        $this->template->write_view('content', 'rbac/taskgroups', $data);
        $this->template->render();
    } 

}

/* End of file usermanagement.php */
/* Location: ./application/controllers/usermanagement.php */
