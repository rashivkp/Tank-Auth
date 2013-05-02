<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Rbac_model
 * 
 * 		Handling description of groups , taskgroup, roles
 *  
 * @package		Itchool_rbac
 * @author		Mohamed Rashid C (https://twitter.com/rashivkp)
 * @based on	Tank_Auth 
 */
class Rbac_model extends CI_Model
{

    private $table_name = 'rbac_group'; // user group	
    private $item_table_name = 'rbac_items'; // task groups and roles
    private $detils_table_name = 'rbac_items_description'; // roles description in each Task group
    private $scope_table_name = 'rbac_scope'; // roles description in each Task group
    private $type_group = 1;
    private $type_role = 0;

    function __construct()
    {
        parent::__construct();
    }

    /**
     * creating new usergroup
     * 
     * @param array containing taskgroup and their corresponding roles
     * @return bool
     */
    function new_usergroup($data = NULL)
    {
        return $this->db->insert($this->table_name, $data);
    }
    
    /**
     * Updating usergroup
     * 
     * @param int $id usergroup_id
     * @param array $data containing taskgroup and their corresponding roles
     * @return bool
     */
    function update_usergroup($id, $data = array())
    {
        $this->db->where($this->table_name.'.id', $id);
        $this->db->update($this->table_name, $data);
        return $this->db->affected_rows() == 1;
    }

    /**
     * creating new taskgroup
     * 
     * @param string name of taskgroup
     * @return bool
     */
    function new_taskgroup($taskgroup)
    {
        return $this->db->insert($this->item_table_name, array('item'=> $taskgroup, 'type' => $this->type_group ));
    }

    /**
     * creating new role
     * 
     * @param string name of role
     * @return void
     */
    function new_role($role)
    {
        return $this->db->insert($this->item_table_name, array('item'=> $role, 'type' => $this->type_role ));
    }
    
    /**
     * creating new scope
     * 
     * @param string name of scope
     * @return void
     */
    function new_scope($scope)
    {
        return $this->db->insert($this->scope_table_name, array('scope'=> $scope));
    }

    /**
     * check if the usergroup is already there
     * 
     * @param string
     * @return bool
     */
    function is_usergroup_available($usergroup)
    {
        $this->db->select('1', FALSE);
        $this->db->where('LOWER(usergroup)=', strtolower($usergroup));

        $query = $this->db->get($this->table_name);
        return $query->num_rows() == 0;
    }

    /**
     * Check if taskgroup is already there
     *
     * @param	string
     * @return	bool
     */
    function is_taskgroup_available($taskgroup)
    {
        $this->db->select('1', FALSE);
        $this->db->where('LOWER(item)=', strtolower($taskgroup));
        $this->db->where('type', $this->type_group);

        $query = $this->db->get($this->item_table_name);
        return $query->num_rows() == 0;
    }

    /**
     * check if the role is already there
     * 
     * @param string
     * @return bool
     */
    function is_role_available($role)
    {
        $this->db->select('1', FALSE);
        $this->db->where('LOWER(item)=', strtolower($role));
        $this->db->where('type', $this->type_role);

        $query = $this->db->get($this->item_table_name);
        return $query->num_rows() == 0;
    }
    
    /**
     * check if the scope is already there
     * 
     * @param string
     * @return bool
     */
    function is_scope_available($scope)
    {
        $this->db->select('1', FALSE);
        $this->db->where('scope', $scope);

        $query = $this->db->get($this->scope_table_name);
        return $query->num_rows() == 0;
    }
    
    /**
     * get usergroups
     * 
     * @param int $usergroup_id if given, returns the requested usergroup details
     * @return object db::result 
     */
    function get_usergroups($usergroup_id = FALSE)
    {
        if($usergroup_id) 
            $this->db->where($this->table_name.'.id',$usergroup_id);
        else {
            $this->db->where($this->table_name.'.priority > '.$this->get_priority());
            $this->db->order_by($this->table_name.'.priority');
        }
        $this->db->select($this->table_name.'.*, '. $this->scope_table_name.'.scope');  
        $this->db->join($this->scope_table_name, $this->scope_table_name.'.id ='.$this->table_name.'.scope_id');
        $query = $this->db->get($this->table_name);
        if($query->num_rows() > 0)
            return $query->result();
        return NULL;
    }
    
    /**
     * get all taskgroups
     * @param int $taskgroup_id if given, returns the requested taskgroup details
     * @return object db::result
     */
    function get_taskgroups($id = FALSE)
    {
        if ($id)
            $this->db->where($this->item_table_name . '.id', $id);
        $this->db->where('type', $this->type_group);
        $query = $this->db->get($this->item_table_name);
        if($query->num_rows() > 0)
            return $query->result();
        return NULL;
    }
    
    /**
     * get all roles
     * @return object  db::result
     */
    function get_roles($id = FALSE)
    {
        if ($id)
            $this->db->where($this->item_table_name . '.id', $id);
        $this->db->where('type', $this->type_role);
        $query = $this->db->get($this->item_table_name);
        if($query->num_rows() > 0)
            return $query->result();
        return NULL;
    }
    
    /**
     * get user scopes
     * @return object
     */
    function get_scopes()
    {
        return $this->db->get($this->scope_table_name)->result();
    }
    
    /**
     * get current user's usergroup priority
     * @return int
     */
    function get_priority()
    {
        $this->db->select('priority');
        $this->db->where('id',$this->itschool_rbac->get_usergroup_id());
        return $this->db->get($this->table_name)->row()->priority;
    }
    
    function is_priority_assigned($priority)
    {
        $this->db->select('1', FALSE);
        $this->db->where('priority',$priority);
        $query=$this->db->get($this->table_name);
        return $query->num_rows() == 1;
    }

}

/* End of file rbac_model.php */
/* Location: ./application/models/rbac/rbac_model.php */
