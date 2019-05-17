<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include(APPPATH . 'modules/Administrator.php');

class Administrateur extends Administrator {

    
    //load library/model/database 
    //nécessaire aux fonctions d'administrateur
    
    public function __construct() {
         //appel du constructeur de Administrator qui vérifie l'authentification et les fonctions accessible sans authentification
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->database();

        $this->load->model('admin_model');
        $this->load->library('layout');
    }
    
//fonction appelée da base 
//appelle la fonction liste()
    public function index() {
        $this->liste();
    }
    
//load la view administrateur/liste avec toutes les données de la table admin
    public function liste($message = NULL) {
        $data['isAdmin'] = parent::isAdmin();
        $data['administrateur'] = $this->admin_model->findAll();
        if(isset($message)){
            $data['message'] = $message;
        }
        $this->layout->view('administrateur/liste', $data);
    }

//load la view administrateur profil avec les données
//qui correspondent au mail encrypté dans le cookie du client

    public function profil() {
        $data['isAdmin'] = parent::isAdmin();
        $mail = $this->encryption->decrypt($this->input->cookie("189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD"));
        $data['administrateur'] = $this->admin_model->find(['mail' => $mail]);

        $this->layout->view('administrateur/profil', $data);
    }

//delete l'admin qui à pour id celui passé en parametre
    public function delete($id) {
        $data['isAdmin'] = parent::isAdmin();
        $test = $this->admin_model->delete(['id' => $id]);
        if ($test) {
            $message = "l'admin à bien été supprimé";
            $this->liste($message);
        } else {
            $message_erreur = "La suppression n'a pas fonctionné";
            $this->liste($message_erreur);
        }
    }

//créer un admin ave un mail et un password
//encrypte le password dans la bd
    public function create() {
        $data['isAdmin'] = parent::isAdmin();

        $this->form_validation->set_rules("newPassword", "New Password", "required");
        $this->form_validation->set_rules("newPasswordConfirm", "Confirm Password", "matches[newPassword]|required");
        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('administrateur/create', $data);
        } else {
            $password = htmlspecialchars($this->input->post('newPassword', TRUE));
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $values = ['mail' => htmlspecialchars($this->input->post('mail', TRUE)),
                'password' => $hashed_password,
            ];
            $test = $this->admin_model->create($values);
            if ($test) {
                $this->liste();
            } else {
                $this->layout->view('administrateur/create', $data);
            }
        }
    }

//affiche la vue administrateur/modifmdp pour l'admin connecté
    public function updateMdp() {
        $data['isAdmin'] = parent::isAdmin();
        $mail = $this->encryption->decrypt($this->input->cookie("189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD"));
        $data['administrateur'] = $this->admin_model->find(['mail' => $mail]);
        $this->layout->view('administrateur/modifmdp', $data);
    }

 // vérfie que le champ oldPassword est le mdp actuel de l'admin connecté avec la fonction passwordCheck
 // vérifie que les champs newPassword et newPasswordConfirm sont identiques
 // Si les form_validation sont vérifié :
 // encrypte et update le nouveau mot de passe
 // sinon
 // rappel la fonction updateMdp
    public function modifMdp() {

        $this->form_validation->set_rules("oldPassword", "Old Password", "required|callback_passwordCheck");
        $this->form_validation->set_rules("newPassword", "New Password", "required");
        $this->form_validation->set_rules("newPasswordConfirm", "Confirm Password", "matches[newPassword]|required");

        if ($this->form_validation->run() == false) {
            $this->updateMdp();
        } else {

            $data['isAdmin'] = parent::isAdmin();
            $mail = $this->encryption->decrypt($this->input->cookie("189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD"));
            $password = htmlspecialchars($this->input->post('newPassword', TRUE));
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $this->admin_model->update(['mail' => $mail], ['password' => $password]);
            $this->deconnexion();
        }
    }

    //vérifie que le password actuel correspond à oldPassword 
    public function passwordCheck() {
        $mail = $this->encryption->decrypt($this->input->cookie("189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD"));
        $Oldpass = $this->input->post('oldPassword', TRUE);
        $results = $this->admin_model->getOldPassword($mail);
        $currentPass = $results[0]->password;
        if(password_verify($Oldpass, $currentPass)) {
            return true;
        } else {
            $this->form_validation->set_message('passwordCheck', 'Invalid current password, please try again');
            return false;
        }
    }
   // supprime les cookies de l'admin connecté
    public function deconnexion() {
        $cookieid = parent::getCookieIdName();
        $cookieToken = parent::getCookieTokenName();
        $this->admin_model->update(["mail" => $this->encryption->decode($cookieid)],["token" => NULL]); 
        delete_cookie($cookieid);
        delete_cookie($cookieToken);     
        $data['isAdmin'] = parent::isAdmin();
        redirect(base_url('welcome'));
    }

}
