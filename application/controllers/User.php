<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH . 'modules/ADMINISTRATOR_Controller.php');
class User extends ADMINISTRATOR_Controller
{
    
        public function __construct()
	{
		
		parent::__construct();
                
		
	}

	public function index()
	{
		$this->liste();
	}
        
        public function liste()
	{       
            $data['isAdmin'] = parent::isAdmin();
            $data['user'] = $this->user_model->findAll();
            $this->layout->view('user/liste',$data);
	}
        
        public function profil($id)
	{           
            $data['isAdmin'] = parent::isAdmin();
            $data['user'] = $this->user_model->find(['idUser' => $id]);
            $this->layout->view('user/profil',$data);
	}
        public function create()
	{   
            $data['isAdmin'] = parent::isAdmin();
            $this->load->model('club_model');
            
            //provide data form all club with a dropdown list
            //
            //faire la form validation des numéro de licence apres dev
            $this->form_validation->set_rules('idUser', 'Licence', 'required');
            $this->form_validation->set_rules('nomUser', 'Nom', 'required');
            $this->form_validation->set_rules('prenomUser', 'Prénom', 'required');
            $this->form_validation->set_rules('classementUser', 'Classement', 'required|greater_than[4]|less_than[16]');
            $this->form_validation->set_rules('classementProvisoireUser', 'Classement provisoire', 'required');
            $this->form_validation->set_rules('nomClub', 'nomClub', 'required');
            if ($this->form_validation->run() == FALSE) {  
                $this->layout->view('user/create',$data);
            }
            else{
                
                //CHERCHER LE NUM CLUB EN FONCTION DU NOM
                $club = $this->club_model->find(['nomClub' => htmlspecialchars($_POST['nomClub'])]);
                $numClub = $club[0]->numClub;
                $values = ['idUser' => htmlspecialchars($_POST['idUser']),
                'nomUser' => htmlspecialchars($_POST['nomUser']),
                'prenomUser' => htmlspecialchars($_POST['prenomUser']),
                'classementUser' => htmlspecialchars($_POST['classementUser']),
                'classementProvisoireUser' => htmlspecialchars($_POST['classementProvisoireUser']),
                'numClub' => $numClub,
                ];
                $test = $this->user_model->create($values);
                if($test){
                    $this->profil($_POST['idUser']);
                }
                else{
                    $this->layout->view('user/create',$data);
                }
            }
           
	}
        
        public function update($id)
	{   
            $this->form_validation->set_rules('nomUser', 'Nom', 'required');
            $this->form_validation->set_rules('prenomUser', 'Prénom', 'required');
            $this->form_validation->set_rules('classementUser', 'Classement', 'required|greater_than[4]|less_than[16]');
            $this->form_validation->set_rules('classementProvisoireUser', 'Classement provisoire', 'required');
            $this->form_validation->set_rules('numClub', 'numClub', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data['user'] = $this->user_model->find(['idUser' => $id]);
                $this->layout->view('user/update',$data);
            }
            else{
                
                $test = $this->user_model->update(['idUser' => $id],
                ['nomUser' => htmlspecialchars($_POST['nomUser']),
                'prenomUser' => htmlspecialchars($_POST['prenomUser']),
                'classementUser' => htmlspecialchars($_POST['classementUser']),
                'classementProvisoireUser' => htmlspecialchars($_POST['classementProvisoireUser']),
                'numClub' => htmlspecialchars($_POST['numClub']),
                ]);
                if($test){
                    $this->profil($id);
                }
                else{
                    $data['user'] = $this->user_model->find(['numUser' => $id]);
                    $this->layout->view('user/update',$data);
                }
            }
           
	}
        
        public function delete($id){
            
            $test = $this->user_model->delete(['idUser' => $id]);
            if($test){
                //delete ok
                $this->liste();
            }
            else{
                //delete fail
                $this->liste();
            }
        }
        
        public function findName(){
            //$term = $_GET['term'];
            
            $term = 'lap';
            $names = $this->user_model->findName($term);
            echo json_encode($names);
            
        }
}
