<?php
class Admin_model extends MY_Model{

	protected $table ='admin';

	public function getOldPassword($mail){
           return $this->db->get_where($this->table, ['mail' => $mail])->result();
        }
}
?>
