<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrator extends CI_Controller {

    private $_cookie = array(
        // 'name'   => '',
        // 'value'  => '',
        'expire' => '86500',
        // 'domain' => '.some-domain.com',
        'path' => '/',
            // 'prefix' => '',
    );
    private $_cookie_id_name = "189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD"; // nom d'un cookie
    private $_cookie_id_token = "1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS"; // nom d'un cookie

    function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->library('encryption');
        $this->load->model('administrator_model');
        $this->load->model('admin_model');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper(array('url', 'assets'));
        $this->load->model('user_model');
        $this->load->library('layout');
        $key = bin2hex($this->encryption->create_key(16));
        $method = $this->router->fetch_method();
        $class = $this->router->fetch_class();
        if ($this->input->post('identifiant', TRUE) && $this->input->post('password', TRUE)) {
            if ($this->administrator_model->validate($this->input->post('identifiant'), $this->input->post('password'))) {
                $cookies_identifiant = $this->_cookie;
                $cookies_identifiant['name'] = $this->_cookie_id_name;
                $cookies_identifiant['value'] = $this->encryption->encrypt($this->input->post('identifiant'));
                // $cookies_identifiant['domain'] = "";
                $cookies_identifiant['prefix'] = $this->config->item('cookie_prefix');
                set_cookie($cookies_identifiant);
                $random_string = random_bytes(16);
                $cookies_token = $this->_cookie;
                $cookies_token['name'] = $this->_cookie_id_token;
                $cookies_token['value'] = $this->encryption->encrypt($random_string);
                // $cookies_identifiant['domain'] = "";
                $cookies_token['prefix'] = $this->config->item('cookie_prefix');
                set_cookie($cookies_token);
                //enregistrer le Token dans la bd
                $test = $this->admin_model->update(["mail" => $this->input->post('identifiant', TRUE)],["token" => $this->encryption->encrypt($random_string)]);
                var_dump($test);
                // Tout est ok, on redirige vers la page d'accueil de l'admin
                redirect(base_url("welcome"));
            } else {
                // Mauvais identifiant, on redirige vers la page de connexion
                redirect(base_url("welcome/connexion"));
            }
        } elseif (get_cookie($this->config->item('cookie_prefix') . $this->_cookie_id_name, TRUE) &&
                get_cookie($this->config->item('cookie_prefix') . $this->_cookie_id_token, TRUE)) {
            $mail = $this->encryption->decrypt(get_cookie($this->config->item('cookie_prefix') . $this->_cookie_id_name));
            $token = $this->encryption->decrypt(get_cookie($this->config->item('cookie_prefix') . $this->_cookie_id_token));
            if ($this->administrator_model->validateToken($mail, $token) == FALSE){
                delete_cookie($this->_cookie_id_name);
                delete_cookie($this->_cookie_id_token);  
                redirect(base_url("welcome/connexion")); // Mauvais identifiant, ont redirige vers la page de connexion
        
            }
            }
       elseif (($class == 'administrateur') || ($class == 'rencontre') || ($class == 'tournoi')) {
            redirect(base_url('welcome/fail')); //page d'
        } elseif (($method != "connexion" ) && ($method != 'liste') && ($method != 'joueurs') && ($method != 'index') && ($method != 'fail') && ($method != 'profil') && ($method != 'clubs')) {
            redirect(base_url('welcome/fail'));
        }
    }

    public function getCookieTokenName() {
        return $this->_cookie_id_token;
    }

    public function getCookieIdName() {
        return $this->_cookie_id_name;
    }

    public function isAdmin() {
        $test = $this->input->cookie($this->_cookie_id_name);
        if (isset($test)) {

            $mail = $this->encryption->decrypt($this->input->cookie($this->_cookie_id_name));
            $this->load->model("Administrator_model");
            return $this->Administrator_model->isAdmin($mail);
        } else {

            return false;
        }
    }

}
