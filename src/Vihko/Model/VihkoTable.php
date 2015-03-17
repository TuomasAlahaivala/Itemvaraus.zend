<?php
//VihkoTable.php
namespace Vihko\Model; 

use Zend\Db\TableGateway\TableGateway;

class VihkoTable{
	
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway){

		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAll(){
		
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}
	
	public function getLaite($id){
		
		$id = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if(!$row){
			
			throw \Exception("Could not find row $id");
		}
		return $row;
	}
	public function saveLaite(Laite $laite){
		
		$data = array(
			'name' => $laite->name,
			'lisatietoja' => $laite->lisatietoja,
			'normaali_kuljetus' =>  $laite->normaali_kuljetus,
			'id_user' => '1',
			'paikka' => $laite->paikka,
		);
		$id = (int) $laite->id;
		if($id == 0){
			
			$this->tableGateway->insert($data);
		}else{
			
			if($this->getLaite($id)){
				$this->tableGateway->update($data, array('id' => $id));
			}else{
				throw new \Exception ('Laite id ei ole olemassa');
			}
		}
	}
	
	public function deleteLaite($id){
		
		$this->tableGateway->delete(array('id' => (int) $id));
	}
}
?>