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
    private $_cookie_id_password = "1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS"; // nom d'un cookie

    function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->library('encryption');
        $this->load->library('encrypt');
        $this->load->model('administrator_model');
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

                $cookies_password = $this->_cookie;
                $cookies_password['name'] = $this->_cookie_id_password;
                $cookies_password['value'] = $this->encryption->encrypt($this->input->post('password'));
                // $cookies_identifiant['domain'] = "";
                $cookies_password['prefix'] = $this->config->item('cookie_prefix');
                set_cookie($cookies_password);

                // Tout est ok, ont redirige vers la page d'accueil de l'admin
                redirect(base_url("welcome"));
            } else {
                // Mauvais identifiant, ont redirige vers la page de connexion
                redirect(base_url("welcome/connexion"));
            }
        } elseif (get_cookie($this->config->item('cookie_prefix') . $this->_cookie_id_name, TRUE) &&
                get_cookie($this->config->item('cookie_prefix') . $this->_cookie_id_password, TRUE)) {
            $mail = $this->encryption->decrypt(get_cookie($this->config->item('cookie_prefix') . $this->_cookie_id_name));
            $password = $this->encryption->decrypt(get_cookie($this->config->item('cookie_prefix') . $this->_cookie_id_password));
            if ($this->administrator_model->validate($mail, $password) == FALSE)
                redirect(base_url("admin/connexion")); // Mauvais identifiant, ont redirige vers la page de connexion
        }
        elseif (($class == 'administrateur') || ($class == 'rencontre')) {
            redirect(base_url('welcome/fail')); //page d'
        } elseif (($method != "connexion" ) && ($method != 'liste') && ($method != 'index') && ($method != 'fail') && ($method != 'profil') && ($method != 'clubs')) {
            redirect(base_url('admin/connexion/fail'));
        }
    }

    public function getCookiePwdName() {
        return $this->_cookie_id_password;
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
