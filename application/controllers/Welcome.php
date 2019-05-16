<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH . 'modules/Administrator.php');

class Welcome extends Administrator {

    public function __construct() {

        parent::__construct();

        $this->load->helper(array('url', 'assets'));
        $this->load->library('encrypt');
        $this->load->library('layout');
    }

    public function index() {
        $data['isAdmin'] = parent::isAdmin();

        $this->layout->view('accueil', $data);
    }
   
    function connexion() {
        $data['isAdmin'] = parent::isAdmin();
        $this->layout->view('administrateur/connexion',$data);
    }
    function fail() {
        $data['isAdmin'] = parent::isAdmin();
        
        $this->layout->views('errors/connexion',$data);
        $this->layout->view('administrateur/connexion',$data);
    }
    public function contact() {
        $data['isAdmin'] = parent::isAdmin();
        $this->layout->view('contact', $data);
    }

}
