<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include(APPPATH . 'modules/Administrator.php');

class Tournoi extends Administrator {

    //load library/model/database 
    //nécessaire aux fonctions de tournoi
    public function __construct() {
         //appel du constructeur de Administrator qui vérifie l'authentification et les fonctions accessible sans authentification
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->database();

        $this->load->model('tournoi_model');
        $this->load->library('layout');
    }
//fonction appelée da base 
//appelle la fonction liste()
    public function index() {
        $this->liste();
    }

    public function liste() {
        $data['isAdmin'] = parent::isAdmin();
        $data['tournoi'] = $this->tournoi_model->findAll();
        $this->layout->view('tournoi/liste', $data);
    }

    public function profil($id) {
        $data['isAdmin'] = parent::isAdmin();
        $data['tournoi'] = $this->tournoi_model->find(['numTournoi' => $id]);
        $this->layout->view('tournoi/profil', $data);
    }

    public function create() {
        $data['isAdmin'] = parent::isAdmin();
        $this->form_validation->set_rules('nomTournoi', 'nom du tournoi', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('tournoi/create', $data);
        } else {
            $values = ['nomTournoi' => htmlspecialchars($this->input->post('nomTournoi', TRUE))];
            $test = $this->tournoi_model->create($values);
            if ($test) {
                $this->liste();
            } else {
                $this->layout->view('tournoi/create', $data);
            }
        }
    }

    public function update($id) {
        $data['isAdmin'] = parent::isAdmin();
        $this->form_validation->set_rules('nomTournoi', 'Tournoi', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['tournoi'] = $this->tournoi_model->find(['numTournoi' => $id]);
            $this->layout->view('tournoi/update', $data);
        } else {

            $test = $this->tournoi_model->update(
                    ['numTournoi' => $id], [
                'nomTournoi' => htmlspecialchars($this->input->post('nomTournoi' ,TRUE))
            ]);
            if ($test) {
                $this->liste();
            } else {
                $data['tournoi'] = $this->tournoi_model->find(['numTournoi' => $id]);
                $this->layout->view('tournoi/update', $data);
            }
        }
    }

    public function delete($id) {
        $data['isAdmin'] = parent::isAdmin();
        $test = $this->tournoi_model->delete(['numTournoi' => $id]);
        if ($test) {
            //delete ok
            $this->liste();
        } else {
            //delete fail
            $this->liste();
        }
    }

    public function findAll() {
        $data['isAdmin'] = parent::isAdmin();
        $data = $this->tournoi_model->findAll();
        echo json_encode($data);
    }

}
