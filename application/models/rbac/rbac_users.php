<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Rbac_users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Rbac_users extends CI_Model
{
	private $table_name					= 'users';	// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles
	private $group_table_name	= 'rbac_group';	// user groups
	private $scope_table_name	= 'rbac_scope';	// user scope

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name					= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		$this->profile_table_name	= $ci->config->item('db_table_prefix', 'tank_auth').$this->profile_table_name;
	}
    
    /**
     * get users of given group_id
     * @param int $group_id
     * @return object db::result
     */
    function get_users_by_group($group_id)
    {
        $this->db->select($this->table_name . '.id');
        $this->db->select($this->table_name . '.email');
        $this->db->select($this->table_name . '.username');
        $this->db->where($this->table_name . '.user_group_id', $group_id);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0)
            return $query->result();
        return NULL;
    }
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */
