<?php
class Rencontre_model extends MY_Model{

	protected $table ='rencontre';

        public function selectById($id){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('numGagnant =' , $id);
            $this->db->or_where(['numPerdant' => $id]);
            $this->db->order_by('date','DESC');

            return  $this->db->get()->result();
         
        }
    }
    ?>
