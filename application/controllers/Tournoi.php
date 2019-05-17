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

//load la view tournoi/liste avec toutes les données de la table departement
    public function liste($message = NULL) {
        $data['isAdmin'] = parent::isAdmin();
        $data['tournoi'] = $this->tournoi_model->findAll();
        if(isset($message)){
            $data['message'] = $message;
        }
        $this->layout->view('tournoi/liste', $data);
    }
    
//cherche le tournoi qui a pour id celui passé en paramètre
// affiche son profil
    /*
    public function profil($id) {
        $data['isAdmin'] = parent::isAdmin();
        $data['tournoi'] = $this->tournoi_model->find(['numTournoi' => $id]);
        $this->layout->view('tournoi/profil', $data);
    }
    */
    
    //créer un nouveau tournoi 
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
    
    // modifie le tournoi dont l'id est passé en paramètre
    // apres modification affiche la liste des tournoi
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

//supprime un tournoi si aucune rencontre n'a eu lieu pendant le tournoi
    public function delete($id) {
        $data['isAdmin'] = parent::isAdmin();
        $this->load->model('rencontre_model');
        $rencontres = $this->rencontre_model->find(['numTournoi' => $id]);    
        if($rencontres != null ){
             $message_erreur = "Vous ne pouvez pas supprimer un tournoi où s'est déja réalisé des rencontres";
             $this->liste($message_erreur);
        }
        else{
          $test = $this->tournoi_model->delete(['numTournoi' => $id]);
          if ($test) {
              $message = "Le tournoi à bien été supprimé";
              $this->liste($message);
          } else {
              $message_erreur = "La suppression n'a pas fonctionné";
              $this->liste($message_erreur);
          }
      }
    }

    //cherche tous les tournoi et formate les données en Json
    public function findAll() {
        $data['isAdmin'] = parent::isAdmin();
        $data = $this->tournoi_model->findAll();
        echo json_encode($data);
    }
}
