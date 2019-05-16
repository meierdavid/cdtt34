<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
    public function findLastName(){
        return $this->db->select('nomUser')->from($this->table)->get()->result();
   
    }
    public function findFirstName(){
       return $this->db->select('prenomUser')->from($this->table)->get()->result(); 
       
    }
    public function valid_lastName($nom){
        $nom =  $this->db->get_where($this->table, ['nomUser' => $nom])->result();
        if($nom != NULL){
            return true;
        }
        else{
            return false;
        } 
    }
    public function valid_firstName($prenom){
        $prenom =  $this->db->get_where($this->table, ['prenomUser' => $prenom])->result();
        if($prenom != NULL){
            return true;
        }
        else{
            return false;
        } 
    }
    
        
}
?>
