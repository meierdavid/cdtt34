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
        $this->var['css'] = array();
        $this->var['js'] = array();
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
        $this->CI->load->view('../themes/default', $this->var);
    }

    public function views($name, $data = array()) {
        $this->var['output'] .= $this->CI->load->view($name, $data, true);
        return $this;
    }

    public function ajouter_css($nom) {
        if (is_string($nom) AND ! empty($nom) AND file_exists(base_url('../assets/css/' . $nom . '.css'))) {
            $this->var['css'][] = css_url($nom);

            return true;
        }
        return false;
    }

    public function ajouter_js($nom) {
        if (is_string($nom) AND ! empty($nom) AND file_exists('./assets/javascript/' . $nom . '.js')) {
            $this->var['js'][] = js_url($nom);
            return true;
        }
        return false;
    }

}
