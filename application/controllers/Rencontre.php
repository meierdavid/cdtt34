<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include(APPPATH . 'modules/Administrator.php');

class Rencontre extends Administrator {

    public function __construct() {

        parent::__construct();

        $this->load->library('form_validation');
        $this->load->database();

        $this->load->model('rencontre_model');
        $this->load->library('layout');
    }

    public function index() {
        $this->liste();
    }

    public function liste() {
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

        $this->layout->view('rencontre/liste', $data);
    }

    public function profil($id) {
        $data['isAdmin'] = parent::isAdmin();
        $data['rencontre'] = $this->rencontre_model->find(['numRencontre' => $id]);
        $this->layout->view('rencontre/profil', $data);
    }

    public function create() {
        $data['isAdmin'] = parent::isAdmin();
        $this->load->model('tournoi_model');
        $this->load->model('user_model');
        $coeff = 1; // coefficient des points suivant le tournoi

        if ( $this->input->post('nomTournoi', TRUE) != NULL) {
            $values['numTournoi'] = $this->tournoi_model->find(['nomTournoi' => htmlspecialchars($this->input->post('nomTournoi', TRUE))])[0]->numTournoi;

            switch ($this->input->post('nomTournoi', TRUE)):
                case 'nationaux':
                    $coeff = 3;
                    break;
                case 'interdépartementaux':
                    $coeff = 2;
                    break;
                default:
                    $coeff = 1;
            endswitch;
        }

        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules(
                'nomGagnant', 'nomGagnant', array(
            'required',
            array('mauvaisNomGagnant', array($this->user_model, 'valid_lastName'))
                ), array('mauvaisNomGagnant' => 'Ce nom n\'existe pas. '));

        $this->form_validation->set_rules(
                'prenomGagnant', 'prenomGagnant', array(
            'required',
            array('mauvaisPrenomGagnant', array($this->user_model, 'valid_firstName'))
                ), array('mauvaisPrenomGagnant' => 'Ce prénom n\'existe pas.  '));

        $this->form_validation->set_rules(
                'nomPerdant', 'nomPerdant', array(
            'required',
            array('mauvaisNomPerdant', array($this->user_model, 'valid_lastName'))
                ), array('mauvaisNomPerdant' => 'Ce nom n\'existe pas. '));

        $this->form_validation->set_rules(
                'prenomPerdant', 'prenomPerdant', array(
            'required',
            array('mauvaisPrenomPerdant', array($this->user_model, 'valid_firstName'))
                ), array('mauvaisPrenomPerdant' => 'Ce prénom n\'existe pas.  '));

        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('rencontre/create', $data);
        } else {

            $values = ['numGagnant' => htmlspecialchars($this->input->post('numGagnant', TRUE)),
                'numPerdant' => htmlspecialchars($this->input->post('numPerdant', TRUE)),
                'date' => htmlspecialchars($this->input->post('date', TRUE)),
            ];
            $points = $this->CalculPoints($this->input->post('numGagnant', TRUE), $this->input->post('numPerdant', TRUE), $coeff);
            $values['pointGagnant'] = $points['pointGagnant'];
            $values['pointPerdant'] = $points['pointPerdant'];

            //MODIFIER LES POINTS DES JOUEURS

            $test = $this->rencontre_model->create($values);
            if ($test) {
                $this->liste();
            } else {
                $this->layout->view('rencontre/create', $data);
            }
        }
    }

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

    public function delete($id) {
        $data['isAdmin'] = parent::isAdmin();
        $rencontre = $this->rencontre_model->find(['numRencontre' => $id]);

        //upload des points du classement des joueurs de cette rencontre
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


        $test = $this->rencontre_model->delete(['numRencontre' => $id]);
        if ($test) {
            //delete ok
            $this->liste();
        } else {
            //delete fail
            $this->liste();
        }
    }

    public function calculPoints($idGagnant, $idPerdant, $coeff) {
        $this->load->model('user_model');
        $gagnant = $this->user_model->find(['idUser' => $idGagnant]);
        $perdant = $this->user_model->find(['idUser' => $idPerdant]);

        // $PointsGagnant[5][6] = 5
        //$PointsGagnant[6][5] = 2
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
