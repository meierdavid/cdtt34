<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH . 'modules/Administrator.php');
class Club extends Administrator
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
            $this->load->model('departement_model');
            $data['isAdmin'] = parent::isAdmin();
            $data['club'] = $this->club_model->findAll();
            $i=0;
            foreach ($data['club'] as $item){
                $departement = $this->departement_model->find(['numDepartement' => $item->numDepartement]);
                $data['departements'][$i]['nomDepartement'] = $departement[0]->nomDepartement;
                $data['departements'][$i]['numDepartement'] = $departement[0]->numDepartement;
                
                $i++;
            }
            
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
            $this->load->model('departement_model');
            $data['isAdmin'] = parent::isAdmin();
            $this->form_validation->set_rules('nomClub', 'Club', 'required');
            if ($this->form_validation->run() == FALSE) {           
                $this->layout->view('club/create',$data);
            }
            
            else{
                $departement = $this->departement_model->find(['nomDepartement' => htmlspecialchars($_POST['nomDepartement'])]);
                $numDepartement = $departement[0]->numDepartement;
                $values = ['nomClub' =>htmlspecialchars($_POST['nomClub']),
                            'numDepartement' => $numDepartement,
                           ];
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
        
     public function joueurs($id)
	{    
            
            $this->load->model("user_model");
            $data['isAdmin'] = parent::isAdmin();
            $data['club'] = $this->club_model->find(['numClub' => $id]);
            $data['joueurs'] = $this->user_model->find(['numClub' => $id]);
            $this->layout->view('club/profil',$data);
	}
}