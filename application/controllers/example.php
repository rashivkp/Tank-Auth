<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * The controller for testing the Itschool_rbac
 * 
 * @package Itschool_rbac
 * @author Mohamed Rashid C (http://twitter.com/rashivkp)
 */

class Example extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if ( ! $this->tank_auth->is_logged_in()) {
            // if not logged in
            redirect('auth/login');
        }
        $this->template->write_view('menu', 'menu');
    }

    /**
     * sample functions to check is logged user is in role view and in group example
     */
    function index()
    {
        /**
         * if user has any roles provided in second parameter of has_permission() , 
         * then he will be authenticated, else redirected
         */
        $this->itschool_rbac->has_permission( __CLASS__, array('view'));

        $this->template->write('content', 'You have access to this');        
        $this->template->render();
    }

}

?>
