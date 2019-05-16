<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrator_model extends CI_Model {

    private $_table = "admin";

    function __construct() {
        $this->load->library('encryption');
    }

    public function validate($mail, $password) {
        if (($passwd_crypt = $this->_getAdmin($mail)) !== FALSE)
            return (bool) ($password == $passwd_crypt);
        return false;
    }

    private function _getAdmin($mail) {
        $admin = $this->db->select(array('mail', 'password'))->get_where($this->_table, array('mail' => $mail))->row();
        if (isset($admin->password))
            return $this->encryption->decrypt($admin->password);
        return false;
    }

    // Faire un select count pour isAdmin
    public function isAdmin($mail) {
        $user = $this->db->select(array('mail'))->get_where($this->_table, array('mail' => $mail))->row();
        if (isset($user)) {
            return true;
        } else {
            return false;
        }
    }

}
