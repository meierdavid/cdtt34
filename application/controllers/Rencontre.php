<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include(APPPATH . 'modules/Administrator.php');

class Rencontre extends Administrator {
    
    //load library/model/database 
    //nécessaire aux fonctions de rencontre
    public function __construct() {
         //appel du constructeur de Administrator qui vérifie l'authentification et les fonctions accessible sans authentification
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->database();

        $this->load->model('rencontre_model');
        $this->load->library('layout');
    }
//fonction appelée da base 
//appelle la fonction liste()
    public function index() {
        $this->liste();
    }

    //affiche la liste de toutes les rencontres
    // pour chaque rencontre on enregistre les noms des joueurs plutôt que leurs identifiants
    //pour que l'affichage soit plus clair pour l'admin
    public function liste($message = NULL) {
        $data['isAdmin'] = parent::isAdmin();
        $data['rencontre'] = $this->rencontre_model->findAll();
        $i = 0;
        foreach ($data['rencontre'] as $item) {
            $perdant = $this->user_model->find(['idUser' => $item->numPerdant]);
            $vainqueur = $this->user_model->find(['idUser' => $item->numGagnant]);
            $data['historique'][$i]['numRencontre'] = $item->numRencontre;
            $data['historique'][$i]['date'] = $item->date;
            $data['historique'][$i]['nomPerdant'] = $perdant[0]->prenomUser . " " . $perdant[0]->nomUser;
            $data['historique'][$i]['nomGagnant'] = $vainqueur[0]->prenomUser . " " . $vainqueur[0]->nomUser;
            $data['historique'][$i]['pointGagnant'] = $item->pointGagnant;
            $data['historique'][$i]['pointPerdant'] = $item->pointPerdant;
            $data['historique'][$i]['numPerdant'] = $item->numPerdant;
            $data['historique'][$i]['numGagnant'] = $item->numGagnant;
            $i++;
        }
        if(isset($message)){
            $date['message'] = $message;
        }
        $this->layout->view('rencontre/liste', $data);
    }
 /*   
//cherche la rencontre qui a pour id celui passé en paramètre
// affiche son profil
    public function profil($id) {
        $data['isAdmin'] = parent::isAdmin();
        $data['rencontre'] = $this->rencontre_model->find(['numRencontre' => $id]);
        $this->layout->view('rencontre/profil', $data);
    }
*/
    
    //créer une rencontre entre deux joueurs
    public function create() {
        $data['isAdmin'] = parent::isAdmin();
        $this->load->model('tournoi_model');
        $this->load->model('user_model');
        $coeff = 1; // coefficient des points suivant le tournoi

        if ( $this->input->post('nomTournoi', TRUE) != NULL) {
            $values['numTournoi'] = $this->tournoi_model->find(['nomTournoi' => htmlspecialchars($this->input->post('nomTournoi', TRUE))])[0]->numTournoi;

            switch ($this->input->post('nomTournoi', TRUE)):
                case 'Criterium National':
                    $coeff = 3;
                    break;
                case 'Inter-départemental':
                    $coeff = 2;
                    break;
                default:
                    $coeff = 1;
            endswitch;
        }
        $this->form_validation->set_rules('date', 'date', 'required');     
        //form validation pour ne par rentrer un nom ou un prénom qui n'existe pas
        $this->form_validation->set_rules('nomGagnant', 'nomGagnant', array('required',
            array('mauvaisNomGagnant', array($this->user_model, 'valid_lastName'))),
            array('mauvaisNomGagnant' => 'Ce nom n\'existe pas. '));

        $this->form_validation->set_rules('prenomGagnant', 'prenomGagnant', array('required',
            array('mauvaisPrenomGagnant', array($this->user_model, 'valid_firstName'))),
            array('mauvaisPrenomGagnant' => 'Ce prénom n\'existe pas.  '));

        $this->form_validation->set_rules('nomPerdant', 'nomPerdant', array('required',
            array('mauvaisNomPerdant', array($this->user_model, 'valid_lastName'))),
            array('mauvaisNomPerdant' => 'Ce nom n\'existe pas. '));

        $this->form_validation->set_rules('prenomPerdant', 'prenomPerdant', array('required',
            array('mauvaisPrenomPerdant', array($this->user_model, 'valid_firstName'))),
            array('mauvaisPrenomPerdant' => 'Ce prénom n\'existe pas.  '));
        
        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('rencontre/create', $data);
        } else {
            $values = ['numGagnant' => htmlspecialchars($this->input->post('numGagnant', TRUE)),
                'numPerdant' => htmlspecialchars($this->input->post('numPerdant', TRUE)),
                'date' => htmlspecialchars($this->input->post('date', TRUE)),
            ];
            //calcule les points gagné par le vainqueur et perdu par l'autre joueur
            $points = $this->CalculPoints($this->input->post('numGagnant', TRUE), $this->input->post('numPerdant', TRUE), $coeff);
            
            $values['pointGagnant'] = $points['pointGagnant'];
            $values['pointPerdant'] = $points['pointPerdant'];
            $test = $this->rencontre_model->create($values);
            if ($test) {
                $this->liste();
            } else {
                $this->layout->view('rencontre/create', $data);
            }
        }
    }
    
    //Pour le moment il a été décidé avec le demandeur qu'une rencontre ne pouvait pas être modifié
    //Il faut donc la supprimer et la créer à nouveau si elle à été créée par erreur
    /*
    public function update($id) {
        $data['isAdmin'] = parent::isAdmin();
        $this->form_validation->set_rules('nomRencontre', 'Rencontre', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['rencontre'] = $this->rencontre_model->find(['numRencontre' => $id]);
            $this->layout->view('rencontre/update', $data);
        } else {

            $test = $this->rencontre_model->update(
                    ['numRencontre' => $id], [
                'nomRencontre' => htmlspecialchars($this->input->post('nomRencontre', TRUE))
            ]);
            if ($test) {
                $this->liste();
            } else {
                $data['rencontre'] = $this->rencontre_model->find(['numRencontre' => $id]);
                $this->layout->view('rencontre/update', $data);
            }
        }
    }
    */
    
    //supprime une rencontre
    public function delete($id) {
        $data['isAdmin'] = parent::isAdmin();
        $rencontre = $this->rencontre_model->find(['numRencontre' => $id]);
        
        //La modification des classements des joueurs avant suppression d'une rencontre
        // est actuellement géré par des triggers.
        
        //upload des points du classement des joueurs de cette rencontre
        /*
        $gagnant = $this->user_model->find(['idUser' => $rencontre[0]->numGagnant]);
        $perdant = $this->user_model->find(['idUser' => $rencontre[0]->numPerdant]);
        $gagnant[0]->classementProvisoireUser -= $rencontre[0]->pointGagnant;
        $perdant[0]->classementProvisoireUser -= $rencontre[0]->pointPerdant;       
        $test = $this->user_model->update(
                ['idUser' => $rencontre[0]->numGagnant], ['classementProvisoireUser' => $gagnant[0]->classementProvisoireUser
        ]);
        $test = $this->user_model->update(
                ['idUser' => $rencontre[0]->numPerdant], ['classementProvisoireUser' => $perdant[0]->classementProvisoireUser
        ]);
        */
        $test = $this->rencontre_model->delete(['numRencontre' => $id]);
        if ($test) {
            $message = "La rencontre a bien été supprimée";
            $this->liste($message);
        } else {
            $message_erreur = "La suppression n'a pas fonctionné";
            $this->liste($message_erreur);
        }
    }
    //calcul les point gagné et perdu par les joueurs ayant effectué une rencontre
    //on regarde les classemens des deux joueurs 
    // Et on attributs les points suivant les deux matrices correspondantes
    public function calculPoints($idGagnant, $idPerdant, $coeff) {
        $this->load->model('user_model');      
        $gagnant = $this->user_model->find(['idUser' => $idGagnant]);
        $perdant = $this->user_model->find(['idUser' => $idPerdant]);
        //exemples: $PointsGagnant[5][6] = 5
        //          $PointsGagnant[6][5] = 2
        //Ces matrices correspondent aux calculs officiels des classements
        // du ping pong en Foyer Rural
        $PointsGagnant = [
            [3, 5, 10, 14, 14, 14, 14, 14, 14, 14],
            [2, 3, 5, 10, 14, 14, 14, 14, 14, 14],
            [1, 2, 3, 5, 10, 14, 14, 14, 14, 14],
            [0, 1, 2, 3, 5, 10, 14, 14, 14, 14],
            [0, 0, 1, 2, 3, 5, 10, 14, 14, 14],
            [0, 0, 0, 1, 2, 3, 5, 10, 14, 14],
            [0, 0, 0, 0, 1, 2, 3, 5, 10, 14],
            [0, 0, 0, 0, 0, 1, 2, 3, 5, 10],
            [0, 0, 0, 0, 0, 0, 1, 2, 3, 5],
            [0, 0, 0, 0, 0, 0, 0, 1, 2, 3],
        ];
        $PointsPerdant = [
            [-4, -2, -1, 0, 0, 0, 0, 0, 0, 0],
            [-6, -4, -2, -1, 0, 0, 0, 0, 0, 0],
            [-8, -6, -4, -2, -1, 0, 0, 0, 0, 0],
            [-10, -8, -6, -4, -2, -1, 0, 0, 0, 0],
            [-12, -10, -8, -6, -4, -2, -1, 0, 0, 0],
            [-14, -12, -10, -8, -6, -4, -2, -1, 0, 0],
            [-14, -14, -12, -10, -8, -6, -4, -2, -1, 0],
            [-14, -14, -14, -12, -10, -8, -6, -4, -2, -1],
            [-14, -14, -14, -14, -12, -10, -8, -6, -4, -2],
            [-14, -14, -14, -14, -14, -12, -10, -8, -6, -4],
        ];
        $pointGagné = $PointsGagnant[$gagnant[0]->classementUser][$perdant[0]->classementUser] * $coeff;
        $pointPerdu = $PointsPerdant[$perdant[0]->classementUser][$gagnant[0]->classementUser] * $coeff;
        $gagnantNouveauClassement = $gagnant[0]->classementProvisoireUser + $pointGagné;
        $perdantNouveauClassement = $perdant[0]->classementProvisoireUser + $pointPerdu;
        $this->user_model->update(['idUser' => $gagnant[0]->idUser], ['classementProvisoireUser' => $gagnantNouveauClassement]);
        $this->user_model->update(['idUser' => $perdant[0]->idUser], ['classementProvisoireUser' => $perdantNouveauClassement]);
        //tableau [point du gagnant supplémentaire * coeff , point du perdant en moins * coeff ]
        $points = ["pointGagnant" => $pointGagné, "pointPerdant" => $pointPerdu];
        return $points;
    }

}
