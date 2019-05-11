<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH . 'modules/ADMINISTRATOR_Controller.php');
class Welcome extends ADMINISTRATOR_Controller {

	public function __construct()
	{
		
		parent::__construct();
		
                $this->load->helper(array('url', 'assets'));
                $this->load->library('encrypt');
                $this->load->library('layout');
                
	}
	public function index()
	{
                $data['isAdmin'] = parent::isAdmin();
                
		$this->layout->view('accueil',$data);
                
	}
        public function deconnexion(){
        $cookieid = parent::getCookieIdName();
        $cookiepwd = parent::getCookiePwdName();
        delete_cookie($cookieid);
        delete_cookie($cookiepwd);
        $data['isAdmin'] = parent::isAdmin();
        redirect(base_url('welcome'));

            
    }
}
