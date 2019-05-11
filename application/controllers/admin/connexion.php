<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH . 'modules/ADMINISTRATOR_Controller.php'); // chemin vers le controlleur parent
class Connexion extends ADMINISTRATOR_Controller {
    
    function __construct() {
        parent::__construct(); // On appel le constructeur de ADMINISTRATOR_Controller car 
                                       // c'est lui qui va vérifier les données et accepter la page appelée ou non.
    
        
    }
    
    function index() {
        $data['isAdmin'] = parent::isAdmin();
        $this->layout->view('admin/connexion',$data);
    }
    function fail() {
        $data['isAdmin'] = parent::isAdmin();
        
        $this->layout->views('errors/connexion',$data);
        $this->layout->view('admin/connexion',$data);
    }
}