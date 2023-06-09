<?php

namespace App\Models;

use Core\BDD\Database;

use Exceptions;

use PDO;
use PDOException;

class InstrumentManager
{
	
	private $pdo=null;
	
	public function __construct()
	{
		$this->pdo=\Core\Database::getInstance();
	}
	

	/**
	 * Search by id and return Entity
	 *
	 * @param integer $id
	 * @return Instrument
	 */
	public function find(int $id):Instrument|bool
	{
		if ($id<=0) {
			throw new Exception("id must be > 0");
			return false;
		}
		
		$sql="SELECT * FROM instruments.instruments WHERE id=:id LIMIT 1;";
		$q=$this->pdo->prepare($sql);
		$q->execute([':id'=>$id]);
		
		return $q->fetchAll(PDO::FETCH_CLASS, '\App\Models\Instrument')[0];
	}
	
	
	
	/**
	 * Return every DB records
	 *
	 * @return void
	 */
	public function findAll()
	{
		$sql="SELECT * FROM instruments.instruments WHERE id>0;";
		$q=$this->pdo->prepare($sql);
		$q->execute();
		
		return $q->fetchAll(PDO::FETCH_CLASS, '\App\Models\Instrument');
    }
	
	
	/**
	 * Create a new record for a given entity
	 *
	 * @param Instrument $instrument
	 * @return Instrument
	 */	
	public function create(Instrument $instrument):Instrument|bool
	{
        
		$sql="INSERT INTO instruments.instruments (todo) VALUES (:todo);";
		$q=$this->pdo->prepare($sql);

		try{
			$q->execute([':name'=>strip_tags($instrument->getName())]);
		}
		catch(PDOException $e){
			//echo "..."
			return false;
		}
		

		$id=$this->pdo->lastInsertId();
		return $this->find($id);
	}   

}
