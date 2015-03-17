<?php
//VihkoController.php
namespace Vihko\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Vihko\Form\LaiteForm;

class VihkoController extends AbstractActionController{
	
	protected $vihkoTable;
	
	public function indexAction(){
            $laitteet = $this->getVihkoTable()->fetchAll();
            $laite = new \Vihko\Model\Vihko();
            $laiteArray = $laite->muodostaArray($laitteet);
		return new ViewModel(array(
			//'laitteet' => $this->getVihkoTable()->fetchAll(),
                        'laitteetform' => new LaiteForm($laiteArray),
			//'laitteet' => $this->getVihkoTable("Vihko\Model\LaitteetTable")->fetchAll(),
		));
	}
	public function tallennalaiteAction(){

		$sessions = new Container('data');
		
		$id = (int) $this->params()->fromRoute('id', 0);

         if($id){
             $laite = $this->getVihkoTable()->getLaite($id);

		
					
		$sessions->id_item = $laite->id;
		$sessions->itemname = $laite->name;
		$sessions->laite_lisatieto = $laite->lisatietoja;
		$sessions->normaali_kuljetus = $laite->normaali_kuljetus;
		$sessions->paikka = $laite->paikka;
					
        $response = $this->getResponse();
		$response->setContent(\Zend\Json\Json::encode(array(
			'response' => true, 
			'lisatietoja' => $laite->lisatietoja, 
			'normaali_kuljetus' => $laite->normaali_kuljetus,
			'paikka' => $laite->paikka
			)));
		}
        
        return $response;
					
	}
	public function getVihkoTable(){
		
		if(!$this->vihkoTable){
			
			$sm = $this->getServiceLocator();
			$this->vihkoTable = $sm->get("Vihko\Model\LaitteetTable");
		}
		return $this->vihkoTable;
	}
} 

?>