<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Rbac_description
 * 
 * 		Handling usergroups, taskgroup and roles
 *  
 * @package		Itchool_rbac
 * @author		Mohamed Rashid C (https://twitter.com/rashivkp)
 * @based on	Tank_Auth 
 */
class Rbac_description extends CI_Model
{

    private $table_name = 'rbac_items_description'; // roles description in each Task group
    private $type_group = 1;
    private $type_role = 0;

    function __construct()
    {
        parent::__construct();        
    }

    /**
     * insert the description of specified taskgroup-role
     * 
     * @param array
     * @return void
     */
    function insert_description($taskgroup_id, $role_id, $description)
    {
        $this->db->insert($this->table_name, array('class_id' => $taskgroup_id,
            'role_id' => $role_id,
            'description' => $description));
    }

    /**
     * update the description of specified taskgroup-role
     * 
     * @param int $taskgroup_id
     * @param int $role_id
     * @param string $description
     * @return boolean
     */   
    function update_description($taskgroup_id, $role_id, $description)
    {
        $this->db->set('description', $description);
        $this->db->where('class_id', $taskgroup_id);
        $this->db->where('role_id', $role_id);

        $this->db->update($this->table_name);
        return $this->db->affected_rows() > 0;
    }
    
    function get_description($taskgroup_id, $role_id = FALSE)
    {
        if($role_id)
            $this->db->where('role_id', $role_id);
        $this->db->where('class_id', $taskgroup_id);
        $query = $this->db->get($this->table_name);
        if($query->num_rows() > 0) 
            return $query->result();
        return NULL;
    }

    /**
     * check the description already there
     * 
     * @param array
     * @void bool
     */
    function is_description_available($taskgroup_id, $role_id)
    {
        $this->db->select('1', FALSE);
        $this->db->where('class_id', $taskgroup_id);
        $this->db->where('role_id', $role_id);

        $query = $this->db->get($this->table_name);
        return $query->num_rows() == 0;
    }

}

/* End of file rbac_model.php */
/* Location: ./application/models/rbac/rbac_model.php */
