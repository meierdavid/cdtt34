<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include(APPPATH . 'modules/Administrator.php');

class Club extends Administrator {

    //load library/model/database 
    //nécessaire aux fonctions de club
    public function __construct() {
         //appel du constructeur de Administrator qui vérifie l'authentification et les fonctions accessible sans authentification
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->database();

        $this->load->model('club_model');
        $this->load->library('layout');
    }

//fonction appelée da base 
//appelle la fonction liste()
    public function index() {
        $this->liste();
    }

//load la view club/liste avec toutes les données de la table club
// et le département qui correspond à chaque club
    public function liste( $message = NULL) {
        $this->load->model('departement_model');
        $data['isAdmin'] = parent::isAdmin();
        $data['club'] = $this->club_model->findAll();
        if(isset($message)){
            $data['message'] = $message;
        }
        $i = 0;
        foreach ($data['club'] as $item) {
            $departement = $this->departement_model->find(['numDepartement' => $item->numDepartement]);
            $data['departements'][$i]['nomDepartement'] = $departement[0]->nomDepartement;
            $data['departements'][$i]['numDepartement'] = $departement[0]->numDepartement;

            $i++;
        }

        $this->layout->view('club/liste', $data);
    }

//cherche tous les clubs et formate les données en Json
    public function findAll() {
        $data['isAdmin'] = parent::isAdmin();
        $data = $this->club_model->findAll();
        echo json_encode($data);
    }

//cherche le club qui a pour id celui passé en paramètre
// affiche son profil
    public function profil($id) {
        $data['isAdmin'] = parent::isAdmin();
        $data['club'] = $this->club_model->find(['numClub' => $id]);
        $this->layout->view('club/profil', $data);
    }

    // créer un club avec son nom et le département où il se trouve
    // apres ajout affiche la liste des clubs
    //
    public function create() {
        $this->load->model('departement_model');
        $data['isAdmin'] = parent::isAdmin();
        $this->form_validation->set_rules('nomClub', 'Club', 'required');
        $this->form_validation->set_rules('nomDepartement', 'Département', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('club/create', $data);
        } else {
            $departement = $this->departement_model->find(['nomDepartement' => htmlspecialchars($this->input->post('nomDepartement', TRUE))]);
            $numDepartement = $departement[0]->numDepartement;
            $values = ['nomClub' => htmlspecialchars($this->input->post('nomClub', TRUE)),
                'numDepartement' => $numDepartement,
            ];
            $test = $this->club_model->create($values);
            if ($test) {
                $this->liste();
            } else {
                $this->layout->view('club/create', $data);
            }
        }
    }
    // modifie le club dont l'id est passé en paramètre
    // apres modification affiche la liste des clubs
    
    public function update($id) {
        $data['isAdmin'] = parent::isAdmin();
        $this->form_validation->set_rules('nomClub', 'Club', 'required');
        $this->form_validation->set_rules('nomDepartement', 'Département', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['club'] = $this->club_model->find(['numClub' => $id]);
            $this->layout->view('club/update', $data);
        } else {

            $test = $this->club_model->update(
                    ['numClub' => $id], [
                'nomClub' => htmlspecialchars($this->input->post('nomClub', TRUE))
            ]);
            if ($test) {
                $this->liste();
            } else {
                $data['club'] = $this->club_model->find(['numClub' => $id]);
                $this->layout->view('club/update', $data);
            }
        }
    }
    //supprime le club dont l'id est passé en paramètre
    // si des joueurs sont dans ce club alors on montre un message d'erreur
    // sinon on le supprime et on affiche la liste des clubs
    public function delete($id) {
        $data['isAdmin'] = parent::isAdmin();
        $this->load->model("user_model");
        $joueurs = $this->user_model->find(['numClub' => $id]);
        if($joueurs != null ){
             $message_erreur = "Vous ne pouvez pas supprimer un club où se trouvent des joueurs";
             $this->liste($message_erreur);
        }
        else{
            $test = $this->club_model->delete(['numClub' => $id]);
            if ($test) {
                $message = "Le joueur a bien été supprimé";
                $this->liste($message);
            } else {
                $message_erreur = "La suppression n'a pas fonctionné";
                $this->liste($message_erreur);
            }
        }
    }
    // recupère toutes les données du clubs et de tous les joueurs du club
    // affiche le profil du clubs avec ces données
    public function joueurs($id) {
        $this->load->model("user_model");
        $data['isAdmin'] = parent::isAdmin();
        $data['club'] = $this->club_model->find(['numClub' => $id]);
        $data['joueurs'] = $this->user_model->find(['numClub' => $id]);
        $this->layout->view('club/profil', $data);
    }
}
