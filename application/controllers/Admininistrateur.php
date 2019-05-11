<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH . 'modules/ADMINISTRATOR_Controller.php');

class Administrateur extends ADMINISTRATOR_Controller
{
    
          public function __construct()
	{
		
		parent::__construct();
		
                $this->load->library('form_validation');
		$this->load->database();
                
                $this->load->model('admin_model');
                $this->load->library('layout');
                
                
	}
        
        
        public function index()
	{
                $data['isAdmin'] = parent::isAdmin();
		$this->liste();
	}
       
        public function liste()
	{    
            $data['isAdmin'] = parent::isAdmin();
            $data['admin'] = $this->admin_model->findAll();
            $this->layout->view('admin/index',$data);
	}
        /*
        public function connexion()
        {
                //	Chargement de la bibliothèque
                $this->load->library('form_validation');
                $this->form_validation->set_rules('pseudo', '"Nom d\'utilisateur"', 'trim|required|min_length[5]|max_length[52]|encode_php_tags');
                $this->form_validation->set_rules('mdp',    '"Mot de passe"',       'trim|required|min_length[5]|max_length[52]|encode_php_tags');
                $pseudo = $this->input->post('pseudo');
                $mdp = $this->input->post('mdp');
                if($this->form_validation->run())
                {
                        //	Le formulaire est valide
                        $this->load->view('connexion_reussi');
                }
                else
                {
                        //	Le formulaire est invalide ou vide
                        $this->layout->view('admin/connexion');
                }
        }*/
}