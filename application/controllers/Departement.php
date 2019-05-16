<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH . 'modules/Administrator.php');
class Departement extends Administrator
{
	  public function __construct()
	{
		
		parent::__construct();
		
                $this->load->library('form_validation');
		$this->load->database();
                
                $this->load->model('departement_model');
                $this->load->library('layout');
               
                    
	}

	public function index()
	{
		$this->liste();
	}
        
        public function liste()
	{


            $data['isAdmin'] = parent::isAdmin();
            $data['departement'] = $this->departement_model->findAll();
                
            $this->layout->view('departement/liste',$data);
	}
         public function findAll()
	{           
            $data['isAdmin'] = parent::isAdmin();
            $data = $this->departement_model->findAll();
            echo json_encode($data);
	}
        
        public function clubs($id)
	{    
            
            $this->load->model("club_model");
            $data['isAdmin'] = parent::isAdmin();
            $data['departement'] = $this->departement_model->find(['numDepartement' => $id]);
            $data['clubs'] = $this->club_model->find(['numDepartement' => $id]);
            $this->layout->view('departement/profil',$data);
	}
        
        public function create(){
            $data['isAdmin'] = parent::isAdmin();
            $this->form_validation->set_rules('nomDepartement', 'Departement', 'required');
            if ($this->form_validation->run() == FALSE) {           
                $this->layout->view('departement/create',$data);
            }
            else{
                $values = ['nomDepartement' =>htmlspecialchars($_POST['nomDepartement']),
                            'numeroDepartement' =>htmlspecialchars($_POST['numeroDepartement'])
                            ];
                $test = $this->departement_model->create($values);
                if($test){
                    $this->liste();
                }
                else{
                    $this->layout->view('departement/create',$data);
                }
            }
            
        }
        public function update($id)
	{       
            $data['isAdmin'] = parent::isAdmin();
            $this->form_validation->set_rules('nomDepartement', 'Departement', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data['departement'] = $this->departement_model->find(['numDepartement' => $id]);
                $this->layout->view('departement/update',$data);
            }
            else{
                
                $test = $this->departement_model->update(
                ['numDepartement' => $id], [
                'nomDepartement' => htmlspecialchars($_POST['nomDepartement']),
                'numeroDepartement' => htmlspecialchars($_POST['numeroDepartement']),
                ]);
                if($test){
                    $this->liste();
                }
                else{
                    $data['departement'] = $this->departement_model->find(['numDepartement' => $id]);
                    $this->layout->view('departement/update',$data);
                }
            }
            
	}
        
        public function delete($id){
            $data['isAdmin'] = parent::isAdmin();
            $test = $this->departement_model->delete(['numDepartement' => $id]);
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