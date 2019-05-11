<?php
class User_model extends MY_Model{
    
    protected $table ='user';
    public function create($values) {
        if ($this->db->set($values)->insert($this->table)){
            return true;
        }
        else{
           return false; 
        }
        
        
    }
    public function findName($term){
        return $this->db->select('nomUser')->from($this->table)->like('nomUser', $term)->get()->result();
    }
        
}
?>
