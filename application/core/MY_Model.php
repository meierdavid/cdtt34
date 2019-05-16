<?php

class MY_Model extends CI_Model {

    protected $table = '';

    //insert $values dans la table sur laquelle la fonction est appellé
    public function create($values) {
        if ($this->db->set($values)->insert($this->table))
            return $this->db->insert_id();
        return false;
    }

    public function find($where = array()) {
        $req = $this->db->get_where($this->table, $where);
        return $req->result();
    }

    public function findAll() {
        return $this->db->select('*')->from($this->table)->get()->result();
    }

    public function update($where, $value) {
        return $this->db->where($where)->update($this->table, $value);
    }

    public function delete($where) {
        return $this->db->where($where)->delete($this->table);
    }

}
