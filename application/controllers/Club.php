<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH . 'modules/ADMINISTRATOR_Controller.php');
class Club extends ADMINISTRATOR_Controller
{
	  public function __construct()
	{
		
		parent::__construct();
		
                $this->load->library('form_validation');
		$this->load->database();
                
                $this->load->model('club_model');
                $this->load->library('layout');
               
                    
	}

	public function index()
	{
		$this->liste();
	}
        
        public function liste()
	{           
            $data['isAdmin'] = parent::isAdmin();
            $data['club'] = $this->club_model->findAll();
            $this->layout->view('club/liste',$data);
	}
         public function findAll()
	{           
            $data['isAdmin'] = parent::isAdmin();
            $data = $this->club_model->findAll();
            echo json_encode($data);
	}
        
        public function profil($id)
	{    
            $data['isAdmin'] = parent::isAdmin();
            $data['club'] = $this->club_model->find(['numClub' => $id]);
            $this->layout->view('club/profil',$data);
	}
        
        public function create(){
            $data['isAdmin'] = parent::isAdmin();
            $this->form_validation->set_rules('nomClub', 'Club', 'required');
            if ($this->form_validation->run() == FALSE) {           
                $this->layout->view('club/create',$data);
            }
            else{
                $values = ['nomClub' =>htmlspecialchars($_POST['nomClub'])];
                $test = $this->club_model->create($values);
                if($test){
                    $this->liste();
                }
                else{
                    $this->layout->view('club/create',$data);
                }
            }
            
        }
        public function update($id)
	{       
            $data['isAdmin'] = parent::isAdmin();
            $this->form_validation->set_rules('nomClub', 'Club', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data['club'] = $this->club_model->find(['numClub' => $id]);
                $this->layout->view('club/update',$data);
            }
            else{
                
                $test = $this->club_model->update(
                ['numClub' => $id], [
                'nomClub' => htmlspecialchars($_POST['nomClub'])
                ]);
                if($test){
                    $this->liste();
                }
                else{
                    $data['club'] = $this->club_model->find(['numClub' => $id]);
                    $this->layout->view('club/update',$data);
                }
            }
            
	}
        
        public function delete($id){
            $data['isAdmin'] = parent::isAdmin();
            $test = $this->club_model->delete(['numClub' => $id]);
            if($test){
                //delete ok
                $this->liste();
            }
            else{
                //delete fail
                $this->liste();
            }
        }
        
        
}