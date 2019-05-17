<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include(APPPATH . 'modules/Administrator.php');

class Departement extends Administrator {
    
    //load library/model/database 
    //nécessaire aux fonctions de département  
    public function __construct() {
        //appel du constructeur de Administrator qui vérifie l'authentification et les fonctions accessible sans authentification
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->database();

        $this->load->model('departement_model');
        $this->load->library('layout');
    }
    
//fonction appelée da base 
//appelle la fonction liste()
    public function index() {
        $this->liste();
    }

//load la view departement/liste avec toutes les données de la table departement
    public function liste() {


        $data['isAdmin'] = parent::isAdmin();
        $data['departement'] = $this->departement_model->findAll();

        $this->layout->view('departement/liste', $data);
    }
//cherche tous les Departements et encode les données en Json
    public function findAll() {
        $data['isAdmin'] = parent::isAdmin();
        $data = $this->departement_model->findAll();
        echo json_encode($data);
    }

    public function clubs($id) {

        $this->load->model("club_model");
        $data['isAdmin'] = parent::isAdmin();
        $data['departement'] = $this->departement_model->find(['numDepartement' => $id]);
        $data['clubs'] = $this->club_model->find(['numDepartement' => $id]);
        $this->layout->view('departement/profil', $data);
    }

    public function create() {
        $data['isAdmin'] = parent::isAdmin();
        $this->form_validation->set_rules('nomDepartement', 'Departement', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('departement/create', $data);
        } else {
            $values = ['nomDepartement' => htmlspecialchars($this->input->post('nomDepartement', TRUE)),
                'numeroDepartement' => htmlspecialchars($this->input->post('numeroDepartement', TRUE))
            ];
            $test = $this->departement_model->create($values);
            if ($test) {
                $this->liste();
            } else {
                $this->layout->view('departement/create', $data);
            }
        }
    }

    public function update($id) {
        $data['isAdmin'] = parent::isAdmin();
        $this->form_validation->set_rules('nomDepartement', 'Departement', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['departement'] = $this->departement_model->find(['numDepartement' => $id]);
            $this->layout->view('departement/update', $data);
        } else {

            $test = $this->departement_model->update(
                    ['numDepartement' => $id], [
                'nomDepartement' => htmlspecialchars($this->input->post('nomDepartement', TRUE)),
                'numeroDepartement' => htmlspecialchars($this->input->post('numeroDepartement', TRUE)),
            ]);
            if ($test) {
                $this->liste();
            } else {
                $data['departement'] = $this->departement_model->find(['numDepartement' => $id]);
                $this->layout->view('departement/update', $data);
            }
        }
    }

    public function delete($id) {
        $data['isAdmin'] = parent::isAdmin();
        $test = $this->departement_model->delete(['numDepartement' => $id]);
        if ($test) {
            //delete ok
            $this->liste();
        } else {
            //delete fail
            $this->liste();
        }
    }

}
