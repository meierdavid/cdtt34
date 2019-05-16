<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include(APPPATH . 'modules/Administrator.php');

class Administrateur extends Administrator {

    public function __construct() {

        parent::__construct();

        $this->load->library('form_validation');
        $this->load->database();

        $this->load->model('admin_model');
        $this->load->library('layout');
    }

    public function index() {
        $data['isAdmin'] = parent::isAdmin();
        $this->liste();
    }

    public function liste() {
        $data['isAdmin'] = parent::isAdmin();
        $data['administrateur'] = $this->admin_model->findAll();
        $this->layout->view('administrateur/liste', $data);
    }

    public function profil() {
        $data['isAdmin'] = parent::isAdmin();
        $mail = $this->encrypt->decode($this->input->cookie("189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD"));
        $data['administrateur'] = $this->admin_model->find(['mail' => $mail]);

        $this->layout->view('administrateur/profil', $data);
    }
    public function delete($id){
            $data['isAdmin'] = parent::isAdmin();
            $test = $this->admin_model->delete(['id' => $id]);
            if($test){
                //delete ok
                $this->liste();
            }
            else{
                //delete fail
                $this->liste();
            }
        }
    public function create(){
        $data['isAdmin'] = parent::isAdmin();
        
        $this->form_validation->set_rules("newPassword", "New Password", "required");
        $this->form_validation->set_rules("newPasswordConfirm", "Confirm Password", "matches[newPassword]|required");
        if ($this->form_validation->run() == FALSE) {  
            $this->layout->view('administrateur/create',$data);
        }
        else{
            $values = ['mail' => htmlspecialchars($_POST['mail']),
            'password' => $this->encrypt->encode(htmlspecialchars($_POST['newPassword'])),
            ];
            $test = $this->admin_model->create($values);
            if($test){
                $this->liste();
            }
            else{
                $this->layout->view('administrateur/create',$data);
            }
        }
    }
    
    public function updateMdp(){
        $data['isAdmin'] = parent::isAdmin();
        $mail = $this->encrypt->decode($this->input->cookie("189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD"));
        $data['administrateur'] = $this->admin_model->find(['mail' => $mail]);

        $this->layout->view('administrateur/modifmdp', $data);
    }

    public function modifMdp() {
        
        $this->form_validation->set_rules("oldPassword", "Old Password", "required|callback_passwordCheck");
        $this->form_validation->set_rules("newPassword", "New Password", "required");
        $this->form_validation->set_rules("newPasswordConfirm", "Confirm Password", "matches[newPassword]|required");
        
        if ($this->form_validation->run() == false) {
            $this->updateMdp();
        } else {
            
            $data['isAdmin'] = parent::isAdmin();
            $mail = $this->encrypt->decode($this->input->cookie("189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD"));
            $password = htmlspecialchars($this->input->post('newPassword'));
            $password = $this->encrypt->encode($password);
            $this->admin_model->update(['mail'=> $mail], ['password' => $password]);
            $this->deconnexion();
         
        }
    }

    public function passwordCheck() {
        $mail = $this->encrypt->decode($this->input->cookie("189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD"));
        $Oldpass = $this->input->post('oldPassword');
        $results = $this->admin_model->getOldPassword($mail);
        $currentPass = $results[0]->password;
        $currentPass = $this->encrypt->decode($currentPass);
        if ($Oldpass == $currentPass) {
            return true;
        } else {
            $this->form_validation->set_message('passwordCheck', 'Invalid current password, please try again');
            return false;
        }
    }
    public function deconnexion(){
        $cookieid = parent::getCookieIdName();
        $cookiepwd = parent::getCookiePwdName();
        delete_cookie($cookieid);
        delete_cookie($cookiepwd);
        $data['isAdmin'] = parent::isAdmin();
        redirect(base_url('welcome'));
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
      } */
}
