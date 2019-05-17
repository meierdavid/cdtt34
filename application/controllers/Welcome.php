<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH . 'modules/Administrator.php');

class Welcome extends Administrator {

    //load library/model/database 
    //nécessaire aux fonctions de département
    public function __construct() {
         //appel du constructeur de Administrator qui vérifie l'authentification et les fonctions accessible sans authentification
        parent::__construct();

        $this->load->helper(array('url', 'assets'));
        $this->load->library('layout');
    }
    
//fonction appelée da base 
//appelle la fonction liste()
    public function index() {
        $data['isAdmin'] = parent::isAdmin();

        $this->layout->view('accueil', $data);
    }

    function connexion() {
        $data['isAdmin'] = parent::isAdmin();
        $this->layout->view('administrateur/connexion', $data);
    }

    function fail() {
        $data['isAdmin'] = parent::isAdmin();

        $this->layout->views('errors/connexion', $data);
        $this->layout->view('administrateur/connexion', $data);
    }

}
