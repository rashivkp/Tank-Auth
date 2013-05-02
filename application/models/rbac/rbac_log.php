<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Rbac_log
 * 
 * 		Handling the logs
 *  
 * @package		Itchool_rbac
 * @author		Mohamed Rashid C (https://twitter.com/rashivkp)
 * @based on	Tank_Auth 
 */
class Rbac_log extends CI_Model
{

    private $table_name = 'log_rbac'; // rbac log table
    private $type_group = 1;
    private $type_role = 0;

    function __construct()
    {
        parent::__construct();

        $ci = & get_instance();
    }

    /**
     * inserting to log table
     * 
     * @param array containing user_id, action_identifier
     * @return bool
     */
    function insert($data = NULL)
    {
        $this->db->insert($this->table_name, $data);
    }

}

/* End of file rbac_log.php */
/* Location: ./application/models/rbac/rbac_log.php */
