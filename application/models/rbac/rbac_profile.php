<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Rbac_profile
 * 
 * 		Profile information handling
 *  
 * @package		Itchool_rbac
 * @author		Mohamed Rashid C (https://twitter.com/rashivkp)
 * @based on	Tank_Auth 
 */
class Rbac_profile extends CI_Model
{

    private $table_name = 'users'; // user accounts
    private $profile_table_name = 'user_profiles'; // user profiles
    private $group_table_name = 'rbac_group'; // user groups
    private $scope_table_name = 'rbac_scope'; // user scope

    function __construct()
    {
        parent::__construct();
    }

    /**
     * geting profile data
     * 
     * @param int $user_id
     * @return object db::row
     */
    function get_profile($user_id)
    {
        $this->db->select($this->table_name . '.email');
        $this->db->select($this->table_name . '.username');
        $this->db->select($this->profile_table_name . '.name');
        $this->db->select($this->profile_table_name . '.website');
        $this->db->select($this->profile_table_name . '.phone');

        $this->db->join($this->table_name, $this->table_name . '.id = ' . $this->profile_table_name . '.user_id');
        $this->db->where($this->table_name . '.id', $user_id);
        $this->db->from($this->profile_table_name);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->row();
        return NULL;
    }

    /**
     * is reset 
     * @param int $user_id 
     * @return bool 
     */
    function is_reset($user_id)
    {
        $this->db->select('1',FALSE);
        $this->db->where('reset_flag', 1);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->profile_table_name);
        if ($query->num_rows() > 0)
            return TRUE;
        return FALSE;
    }

    /**
     * set reset flag off
     * @param int #user_id
     */
    function set_reset_off($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->set('reset_flag', 0);
        $this->db->update($this->profile_table_name);
        return $this->db->affected_rows() > 0;
    }
    
    /**
     * set reset flag off
     * @param int #user_id
     */
    function set_reset($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->set('reset_flag', 1);
        $this->db->update($this->profile_table_name);
        return $this->db->affected_rows() > 0;
    }

    /**
     * update profile
     * @param int $user_id 
     * @param array $data
     * @return void
     */
    function update_profile($user_id, $data)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update($this->profile_table_name, $data);
        return $this->db->affected_rows() > 0;
    }

    /**
     * change email, but its breakig the rule of validation
     *
     * @param	int
     * @param	string
     * @return	bool
     */
    function change_email($user_id, $email)
    {
        $this->db->set('email',$email);
        $this->db->where('id', $user_id);
        $this->db->update($this->table_name);
        return $this->db->affected_rows() > 0;
    }

}