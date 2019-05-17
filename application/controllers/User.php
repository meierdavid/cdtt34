<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include(APPPATH . 'modules/Administrator.php');

class User extends Administrator {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        $this->liste();
    }

    public function liste( $message = NULL) {
        //afficher le nom du club ( clickable )
        $data['isAdmin'] = parent::isAdmin();
        $data['user'] = $this->user_model->findAll();
        $this->load->model('club_model');
        if(isset($message)){
          $data['message']= $message;
        }

        $i = 0;
        foreach ($data['user'] as $item) {
            $club = $this->club_model->find(['numClub' => $item->numClub]);
            $data['clubs'][$i]['nomClub'] = $club[0]->nomClub;
            $data['clubs'][$i]['numClub'] = $club[0]->numClub;

            $i++;
        }

        $this->layout->view('user/liste', $data);
    }

    public function profil($id) {
        $data['isAdmin'] = parent::isAdmin();
        $data['user'] = $this->user_model->find(['idUser' => $id]);
        $this->load->model('rencontre_model');

        $this->load->model('club_model');
        $data['club'] = $this->club_model->find(['numClub' => $data['user'][0]->numClub]);

        $match = $this->rencontre_model->selectById($id);
        $i = 0;
        foreach ($match as $item) {
            $perdant = $this->user_model->find(['idUser' => $item->numPerdant]);
            $vainqueur = $this->user_model->find(['idUser' => $item->numGagnant]);
            $data['historique'][$i]['date'] = $item->date;
            $data['historique'][$i]['nomPerdant'] = $perdant[0]->prenomUser . " " . $perdant[0]->nomUser;
            $data['historique'][$i]['nomGagnant'] = $vainqueur[0]->prenomUser . " " . $vainqueur[0]->nomUser;
            $data['historique'][$i]['pointGagnant'] = $item->pointGagnant;
            $data['historique'][$i]['pointPerdant'] = $item->pointPerdant;
            $data['historique'][$i]['numPerdant'] = $item->numPerdant;
            $data['historique'][$i]['numGagnant'] = $item->numGagnant;
            $i++;
        }


        // faire une seule requete pour trouver tous les match et les sort par date 
        //pour ensuite les afficher dans la vue correctement 
        //avec Date nomGagnant pointGagnant point Perdant Perdant
        // chaque joueurs est clickable
        //voir si on affiche les tournoi ou pas ...




        $this->layout->view('user/profil', $data);
    }

    public function create() {
        $data['isAdmin'] = parent::isAdmin();
        $this->load->model('club_model');

        //provide data form all club with a dropdown list
        //
            //faire la form validation des numéro de licence apres dev
        $this->form_validation->set_rules('idUser', 'Licence', 'required');
        $this->form_validation->set_rules('nomUser', 'Nom', 'required');
        $this->form_validation->set_rules('prenomUser', 'Prénom', 'required');
        $this->form_validation->set_rules('classementUser', 'Classement', 'required|greater_than[4]|less_than[16]');
        $this->form_validation->set_rules('classementProvisoireUser', 'Classement provisoire', 'required');
        $this->form_validation->set_rules('nomClub', 'nomClub', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('user/create', $data);
        } else {

            //CHERCHER LE NUM CLUB EN FONCTION DU NOM
            $club = $this->club_model->find(['nomClub' => htmlspecialchars($this->input->post('nomClub', TRUE))]);
            $numClub = $club[0]->numClub;
            $values = ['idUser' => htmlspecialchars($this->input->post('idUser', TRUE)),
                'nomUser' => htmlspecialchars($this->input->post('nomUser', TRUE)),
                'prenomUser' => htmlspecialchars($this->input->post('prenomUser', TRUE)),
                'classementUser' => htmlspecialchars($this->input->post('classementUser', TRUE)),
                'classementProvisoireUser' => htmlspecialchars($this->input->post('classementProvisoireUser', TRUE)),
                'numClub' => $numClub,
                'dateDeNaissance' => htmlspecialchars($this->input->post('dateDeNaissance', TRUE)),
            ];
            $test = $this->user_model->create($values);
            if ($test) {
                $this->profil($this->input->post('idUser', TRUE));
            } else {
                $this->layout->view('user/create', $data);
            }
        }
    }

    public function update($id) {
        $data['isAdmin'] = parent::isAdmin();
        $this->load->model('club_model');
        $this->form_validation->set_rules('nomUser', 'Nom', 'required');
        $this->form_validation->set_rules('prenomUser', 'Prénom', 'required');
        $this->form_validation->set_rules('classementUser', 'Classement', 'required|greater_than[4]|less_than[16]');
        $this->form_validation->set_rules('classementProvisoireUser', 'Classement provisoire', 'required');
        $this->form_validation->set_rules('nomClub', 'nomClub', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['user'] = $this->user_model->find(['idUser' => $id]);
            $data['club'] = $this->club_model->find(['numClub' =>  $data['user'][0]->numClub]);
            $this->layout->view('user/update', $data);
        } else {
            $club = $this->club_model->find(['nomClub' =>  $this->input->post('nomClub', TRUE)]);
            $numClub = $club[0]->numClub;
            $test = $this->user_model->update(['idUser' => $id], [
                'idUser' => htmlspecialchars($this->input->post('idUser',TRUE)),
                'nomUser' => htmlspecialchars($this->input->post('nomUser',TRUE)),
                'prenomUser' => htmlspecialchars($this->input->post('prenomUser',TRUE)),
                'classementUser' => htmlspecialchars($this->input->post('classementUser',TRUE)),
                'classementProvisoireUser' => htmlspecialchars($this->input->post('classementProvisoireUser', TRUE)),
                'numClub' => htmlspecialchars($numClub),
                'dateDeNaissance' => htmlspecialchars($this->input->post('dateDeNaissance', TRUE)),
            ]);
            if ($test) {
                $this->profil($id);
            } else {
                $data['user'] = $this->user_model->find(['numUser' => $id]);
                $data['club'] = $this->club_model->find(['numClub' =>  $data['user'][0]->numClub]);
                $this->layout->view('user/update', $data);
            }
        }
    }

    public function delete($id) {
        $this->load->model('rencontre_model');
        $rencontres = $this->rencontre_model->selectById($id);
        if($rencontres == null ){
             $message_erreur = "Vous ne pouvez pas supprimer un joueur qui à déja réalisé des rencontres";
             $this->liste($message_erreur);
        }
        $test = $this->user_model->delete(['idUser' => $id]);
        if ($test) {
            $message = "Le joueur à bien été supprimé";
            $this->liste($message);
        } else {
            $message_erreur = "La suppression n'a pas fonctionné";
            $this->liste($message_erreur);
        }
    }

    public function findLastName() {

        $names = $this->user_model->findLastName();
        echo json_encode($names);
    }

    public function findFirstName() {
        $names = $this->user_model->findFirstName();
        echo json_encode($names);
    }

}
