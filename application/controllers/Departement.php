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
    public function liste($message = NULL) {
        if(isset($message)){
            $data['message'] = $message;
        }
        $data['isAdmin'] = parent::isAdmin();
        $data['departement'] = $this->departement_model->findAll();

        $this->layout->view('departement/liste', $data);
    }

//cherche tous les Departements et formate les données en Json
    public function findAll() {
        $data['isAdmin'] = parent::isAdmin();
        $data = $this->departement_model->findAll();
        echo json_encode($data);
    }

    //cherche les clubs dans un département dont l'id est passé en paramètres
    public function clubs($id) {

        $this->load->model("club_model");
        $data['isAdmin'] = parent::isAdmin();
        $data['departement'] = $this->departement_model->find(['numDepartement' => $id]);
        $data['clubs'] = $this->club_model->find(['numDepartement' => $id]);
        $this->layout->view('departement/profil', $data);
    }

//créer un nouveau département 
// si la création est réussi, renvoie vers la liste des départements
// Sinon renvoie sur la page de création
    public function create() {
        $data['isAdmin'] = parent::isAdmin();
        $this->form_validation->set_rules('nomDepartement', 'Departement', 'required');
        $this->form_validation->set_rules('numeroDepartement', ' Numero du Departement', 'required');
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

    // modifie le département dont l'id est passé en paramètre
    // apres modification affiche la liste des départements
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
    
     //supprime le département dont l'id est passé en paramètre
    // si des clubs sont dans ce département alors on affiche un message d'erreur
    // sinon on le supprime et on affiche la liste des clubs   
    public function delete($id) {
        $data['isAdmin'] = parent::isAdmin();
        $this->load->model("club_model");
        $clubs = $this->club_model->find(['numDepartement' => $id]);
        if ($clubs != null) {
            $message_erreur = "Vous ne pouvez pas supprimer un Departement où se trouvent des clubs";
            $this->liste($message_erreur);
        } else {
            $test = $this->departement_model->delete(['numDepartement' => $id]);
            if ($test) {
                $message = "Le club a bien été supprimé";
                $this->liste($message);
            } else {
                $message_erreur = "La suppression n'a pas fonctionné";
                $this->liste($message_erreur);
            }
        }
    }
}
