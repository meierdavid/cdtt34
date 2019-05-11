<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH . 'modules/ADMINISTRATOR_Controller.php');
class Rencontre extends ADMINISTRATOR_Controller
{
	  public function __construct()
	{
		
		parent::__construct();
		
                $this->load->library('form_validation');
		$this->load->database();
                
                $this->load->model('rencontre_model');
                $this->load->library('layout');
                
               
	}

	public function index()
	{
		$this->liste();
	}
        
        public function liste()
	{           
            $data['rencontre'] = $this->rencontre_model->findAll();
            $this->layout->view('rencontre/liste',$data);
	}
        
        public function profil($id)
	{           
            $data['isAdmin'] = parent::isAdmin();
            $data['rencontre'] = $this->rencontre_model->find(['numRencontre' => $id]);
            $this->layout->view('rencontre/profil',$data);
	}
        
        public function create(){
            $data['isAdmin'] = parent::isAdmin();
            $this->load->model('tournoi_model');
            $coeff = 1; // coefficient des points suivant le tournoi
            if(isset($_POST['tournoi'])){
                $values = ['numGagnant' =>htmlspecialchars($_POST['numGagnant']),
                            'numPerdant' => htmlspecialchars($_POST['numPerdant']),
                            'date' => htmlspecialchars($_POST['date']),
                    ];
                switch ($_POST['nomTournoi']):
                    case 'nationaux':
                        $coeff = 3;
                        break;
                    case 'interdépartementaux':
                        $coeff = 2;
                        break;
                    default:
                        $coeff = 1;
                endswitch;
                
            }
            $this->form_validation->set_rules('date', 'date', 'required');
            if ($this->form_validation->run() == FALSE) {           
                $this->layout->view('rencontre/create',$data);
            }
            else{
                
                $values = ['numGagnant' =>htmlspecialchars($_POST['numGagnant']),
                            'numPerdant' => htmlspecialchars($_POST['numPerdant']),
                            'date' => htmlspecialchars($_POST['date']),
                ];
                $points = $this->CalculPoints($_POST['numGagnant'],$_POST['numPerdant'],$coeff);
                $values['pointGagnant'] = $points['pointGagnant'];
                $values['pointPerdant'] = $points['pointPerdant'];
                $values['numTournoi'] = $this->tournoi_model->find(['nomTournoi' => htmlspecialchars($_POST['nomTournoi'])])[0]->numTournoi;
                
                //MODIFIER LES POINTS DES JOUEURS
                
                $test = $this->rencontre_model->create($values);
                if($test){
                    $this->liste();
                }
                else{
                    $this->layout->view('rencontre/create',$data);
                }
            }
            
        }
        public function update($id)
	{       
            $data['isAdmin'] = parent::isAdmin();
            $this->form_validation->set_rules('nomRencontre', 'Rencontre', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data['rencontre'] = $this->rencontre_model->find(['numRencontre' => $id]);
                $this->layout->view('rencontre/update',$data);
            }
            else{
                
                $test = $this->rencontre_model->update(
                ['numRencontre' => $id], [
                'nomRencontre' => htmlspecialchars($_POST['nomRencontre'])
                ]);
                if($test){
                    $this->liste();
                }
                else{
                    $data['rencontre'] = $this->rencontre_model->find(['numRencontre' => $id]);
                    $this->layout->view('rencontre/update',$data);
                }
            }
            
	}
        
        public function delete($id){
            $data['isAdmin'] = parent::isAdmin();
            $test = $this->rencontre_model->delete(['numRencontre' => $id]);
            if($test){
                //delete ok
                $this->liste();
            }
            else{
                //delete fail
                $this->liste();
            }
        }
        
        public function calculPoints($idGagnant, $idPerdant, $coeff){
            $this->load->model('user_model');
            $gagnant = $this->user_model->find(['idUser' => $idGagnant]);
            $perdant = $this->user_model->find(['idUser' => $idPerdant]);
            
            // $PointsGagnant[5][6] = 5
            //$PointsGagnant[6][5] = 2
            $PointsGagnant = [
                [3,5,10,14,14,14,14,14,14,14],
                [2,3,5,10,14,14,14,14,14,14],
                [1,2,3,5,10,14,14,14,14,14],
                [0,1,2,3,5,10,14,14,14,14],
                [0,0,1,2,3,5,10,14,14,14],
                [0,0,0,1,2,3,5,10,14,14],
                [0,0,0,0,1,2,3,5,10,14],
                [0,0,0,0,0,1,2,3,5,10],
                [0,0,0,0,0,0,1,2,3,5],
                [0,0,0,0,0,0,0,1,2,3],
            ];
            $PointsPerdant = [
                [-4,-2,-1,0,0,0,0,0,0,0],
                [-6,-4,-2,-1,0,0,0,0,0,0],
                [-8,-6,-4,-2,-1,0,0,0,0,0],
                [-10,-8,-6,-4,-2,-1,0,0,0,0],
                [-12,-10,-8,-6,-4,-2,-1,0,0,0],
                [-14,-12,-10,-8,-6,-4,-2,-1,0,0],
                [-14,-14,-12,-10,-8,-6,-4,-2,-1,0],
                [-14,-14,-14,-12,-10,-8,-6,-4,-2,-1],
                [-14,-14,-14,-14,-12,-10,-8,-6,-4,-2],
                [-14,-14,-14,-14,-14,-12,-10,-8,-6,-4],
            ];
            $pointGagné = $PointsGagnant[$gagnant[0]->classementUser][$perdant[0]->classementUser] * $coeff;
            $pointPerdu = $PointsPerdant[$perdant[0]->classementUser][$gagnant[0]->classementUser] * $coeff;
            
            $gagnantNouveauClassement =$gagnant[0]->classementProvisoireUser + $pointGagné;
            
            $perdantNouveauClassement =$perdant[0]->classementProvisoireUser + $pointPerdu;
            $this->user_model->update(['idUser' => $gagnant[0]->idUser],['classementProvisoireUser' => $gagnantNouveauClassement]);
            $this->user_model->update(['idUser' => $perdant[0]->idUser],['classementProvisoireUser' => $perdantNouveauClassement]);
            //tableau [point du gagnant supplémentaire * coeff , point du perdant en moins * coeff ]
           $points = ["pointGagnant" => $pointGagné, "pointPerdant" => $pointPerdu ];
           return $points;
        }
        
       
        
}