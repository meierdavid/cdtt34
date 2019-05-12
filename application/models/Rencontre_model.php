<?php
class Rencontre_model extends MY_Model{

	protected $table ='rencontre';

        public function selectById($id){
        var_dump($id); 
        $this->db->select('*');
        $this->db->from('rencontre');
        $this->db->where(['numGagnant' => $id]);
        $nom = $this->db->get();
        var_dump($nom);
        die;
    }
}
?>
