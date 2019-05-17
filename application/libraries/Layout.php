<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layout {

    private $CI;
    private $var = array();

    /*
      |===============================================================================
      | Constructeur
      |===============================================================================
     */

    public function __construct() {
        $this->CI = get_instance();
        $this->var['output'] = '';
        $this->var['footer'] = false;
    }

    /*
      |===============================================================================
      | Méthodes pour charger les vues
      |	. view
      |	. views
      |===============================================================================
     */

    public function view($name, $data = array()) {
        $this->var['output'] .= $this->CI->load->view($name, $data, true);
        
        if($name == "accueil"){
            $this->var['footer'] = true;
        }
        $this->CI->load->view('../themes/default', $this->var);
    }

    public function views($name, $data = array()) {
        $this->var['output'] .= $this->CI->load->view($name, $data, true);
        return $this;
    }
    public function footer(){
        $this->var['footer'] .= $this->load->view('footer',true);
        return $this;
    }

}
