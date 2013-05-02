<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Itschool RBAC
 *
 * RBAC implementation library for Code Igniter with dependency of Tank_auth package
 *
 * @package		Itchool_rbac
 * @author		Mohamed Rashid C (https://twitter.com/rashivkp)
 * @based on	Tank_Auth 
 */
class Itschool_rbac
{

    /**
     * contain error messages
     * @var array 
     */
    private $error = array();
    /**
     * json decoded object array
     * @var string-object
     */
    private $permissions;
    /**
     * taskgroups
     * @var array
     */
    public $groups;
    /**
     * roles
     * @var array
     */
    public $roles;

    function __construct()
    {
        $this->ci = & get_instance();
        $this->permissions = $this->get_permissions();
        $this->groups = $this->ci->config->item('rbac_groups');
        $this->roles = $this->ci->config->item('rbac_roles');
        $this->ci->load->model('rbac/rbac_model','m_rbac');
    }

    /**
     * has_permission
     * Check the permission of User in the current class(Group) or function
     * if he is not authorized, will be redirected to auth/permission
     *
     * @param string $group Class name of controller
     * @param array $role roles that can authenticate the user
     * @param bool $bool_flag if it is TRUE, then it will return a boolean
     *          and won't redirect
     * @return	bool
     */
    function has_permission($group = NULL, $role = array(), $bool_flag = FALSE)
    {
        // if role_id and group_id provided, check against the permission object
        if ($role) {
            $group = @$this->groups[$group];
            foreach ($role as $current_role) {
                $current_role = @$this->roles[$current_role];
                if (@in_array($current_role, @$this->permissions->$group))
                    return TRUE;
            }
            if (!$bool_flag)
                redirect('auth/permission');
            else
                return FALSE;
        }

        // if group id  provided, check against the permission object
        if ($group) {
            $group = $this->groups[$group];
            if (!isset($this->permissions->$group))
                if (!$bool_flag)
                    redirect('auth/permission');
                else
                    return FALSE;

            return TRUE;
        }
    }

    /**
     * Get user permissions
     *
     * @return	object
     */
    function get_permissions()
    {
        return $this->ci->session->userdata('permissions');
    }
    
    /**
     * Get user_group details
     *
     * @return	object
     */
    function get_usergroup()
    {
        
        /**
         * As of PHP 5.4 it is possible to array dereference the result of
         *  a function or method call directly. Before it was only possible using a temporary variable. 
         * @link http://php.net/manual/en/language.types.array.php#example-88 
         * return $this->ci->m_rbac->get_usergroups($this->ci->session->userdata('usergroup_id'))[0];
         * 
         */
        $user = $this->ci->m_rbac->get_usergroups($this->ci->session->userdata('usergroup_id'));
        return $user[0];
    }


    /**
     * Get user managing id
     *     
     * @return integer
     */
    function get_managing_id()
    {
        return $this->ci->session->userdata('managing');
    }
    
    /**
     * Get usergroup id
     *     
     * @return integer
     */
    function get_usergroup_id()
    {
        return $this->ci->session->userdata('usergroup_id');
    }

    /**
     * set scope variables
     */
    function set_scope_session()
    {
        
    }

    /**
     * unset scope variables
     */
    function unset_scope_session()
    {
        
    }

    /**
     * get user scope
     * @return string user-scope
     */
    function get_userscope()
    {
        return $this->ci->session->userdata('userscope');
    }
    
    /**
     * set reset off     
     */
    function set_reset_off()
    {
        $this->ci->load->model('rbac/rbac_profile','m_profile');
        $this->ci->m_profile->set_reset_off($this->ci->tank_auth->get_user_id());
    }
    
    /**
     * set reset 
     */
    function set_reset($user_id)
    {
        $this->ci->load->model('rbac/rbac_profile','m_profile');
        $this->ci->m_profile->set_reset($user_id);
    }
    
    /**
     * create scope
     * @param sting $role
     */
    function create_scope($scope)
    {
        if(!$this->ci->m_rbac->is_scope_available($scope)){
            $this->error = array('scope' => 'Requested Scope already exists');
            return NULL;
        }
        return $this->ci->m_rbac->new_scope($scope);        
    }
    
    /**
     * create a taskgroup
     * @param sting $taskgroup
     */
    function create_taskgroup($taskgroup)
    {
        if(!$this->ci->m_rbac->is_taskgroup_available($taskgroup)){
            $this->error = array('taskgroup' => 'Requested Taskgroup already exists');
            return NULL;
        }
        return $this->ci->m_rbac->new_taskgroup($taskgroup);        
    }
    
    /**
     * create a taskgroup
     * @param sting $role
     */
    function create_role($role)
    {
        if(!$this->ci->m_rbac->is_role_available($role)){
            $this->error = array('role' => 'Requested Role already exists');
            return NULL;
        }
        return $this->ci->m_rbac->new_role($role);        
    }
    
    /**
     * create usergroup
     * @param string $usergroup name
     * @param string $permissions json object
     * @param int $scope
     * @param int $priority 
     * @param string $description Description of group
     * 
     * @return bool 
     */
    function create_usergroup($usergroup, $permissions, $scope, $priority, $description = '')
    {
        if (!$this->ci->m_rbac->is_usergroup_available($usergroup)) {
            $this->error = array('usergroup_name' => 'Requested Usergroup name already exists');
            return NULL;
        }
        if($this->ci->m_rbac->is_priority_assigned($priority)) {
            $this->error = array('priority' => 'Requested priority already assigned');
            return NULL;
        }
        $data = array(
            'usergroup' => $usergroup,
            'item_ids' => $permissions,
            'description' => $description,
            'scope_id' => $scope,
            'priority' => $priority,
            'updated_by' => $this->ci->tank_auth->get_user_id(),
        );
        return $this->ci->m_rbac->new_usergroup($data);        
    }
    
    /**
     * Update usergroup
     * 
     * @param int $id usergroup_id
     * @param string $usergroup name
     * @param string $permissions json object
     * @param int $scope
     * @param int $priority
     * @param string $description Description of group
     * 
     * @return bool 
     */
    function update_usergroup($id, $usergroup, $permissions, $scope, $priority, $description = '')
    {
        $data = array(
            'usergroup' => $usergroup,
            'item_ids' => $permissions,
            'description' => $description,
            'scope_id' => $scope,
            'priority' => $priority,
            'updated_by' => $this->ci->tank_auth->get_user_id(),
        );
        return $this->ci->m_rbac->update_usergroup($id, $data);        
    }
    
    /**
     * Get error message.
     * Can be invoked after any failed operation.
     *
     * @return	string
     */
    function get_error_message()
    {
        return $this->error;
    }

    /**
     * Reset user password by username
     *
     * @param int $managing_id
     * @return	bool
     */
    function reset_password_by_username($username, $newpassword) {
        $this->ci->load->model('tank_auth/users');
        $user = $this->ci->users->get_user_by_username($username);
        $hasher = new PasswordHash(
        $this->ci->config->item('phpass_hash_strength', 'tank_auth'), $this->ci->config->item('phpass_hash_portable', 'tank_auth'));
        if (! is_null($user)) {
            // Hash new password using phpass
            $hashed_password = $hasher->HashPassword($newpassword);
            $this->set_reset($user->id);            
            // Replace old password with new one
            return $this->ci->users->change_password($user->id, $hashed_password);
        }
        return FALSE;
    }
    
    /**
     * scanning files of directory recursively
     * 
     * @author http://www.php.net/manual/en/function.scandir.php
     * @param string $path
     * @param string $name
     * @return array
     */
    function scanFileNameRecursivly($path = '', &$name = array() )
    {
      $path = $path == ''? dirname(__FILE__) : $path;
      $lists=@array_diff(@scandir($path), array('..', '.','index.html'));

      if(!empty($lists))
      {
          foreach($lists as $f)
          {
            if(is_dir($path.DIRECTORY_SEPARATOR.$f))
            {
                $this->scanFileNameRecursivly($path.DIRECTORY_SEPARATOR.$f, $name);
            }
            else
            {
                $name[] = $f;
            }
          }
      }
      return $name;
    }

}

/* End of file Itshchool_rbac.php */
/* Location: ./application/libraries/Itshchool_rbac.php */
