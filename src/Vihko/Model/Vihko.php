<?php
//Vihko.php
namespace Vihko\Model;

class Vihko{
	
	public $id;
	public $name;
	public $paikka;
	public $lisatietoja;
	public $normaali_kuljetus;
        
	public function exchangeArray($data){
		
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->name = (!empty($data['name'])) ? $data['name'] : null;
		$this->paikka = (!empty($data['paikka'])) ? $data['paikka'] : null;
		$this->lisatietoja = (!empty($data['lisatietoja'])) ? $data['lisatietoja'] : null;
		$this->normaali_kuljetus = (!empty($data['normaali_kuljetus'])) ? $data['normaali_kuljetus'] : null;
	}
        public function muodostaArray($laitteet){
            if($laitteet){
                $laiteetArray = array();
                foreach($laitteet as $item){
                    
                    $laiteetArray[$item->paikka]['options'][$item->id] = $item->name;
                    $laiteetArray[$item->paikka]['label'] = $item->paikka;
                }
                //print_r($laiteetArray);
                return $laiteetArray;
            }
        }
}
?>