<?php

namespace App\Models;

use Core\BDD\Database;

use Exceptions;

use PDO;
use PDOException;

class BrandManager
{
	
	private $pdo=null;
	
	public function __construct()
	{
		$this->pdo=\Core\Database::getInstance();
	}
	

	/**
	 * Search by id and return Brand Entity
	 *
	 * @param integer $id
	 * @return Brand
	 */
	public function find(int $id):Brand|bool
	{
		if ($id<=0) {
			throw new Exception("id must be > 0");
			return false;
		}
		
		$sql="SELECT id, marque AS `name`, date_modif AS updated_at FROM instruments.marques WHERE id=:id LIMIT 1;";
		$q=$this->pdo->prepare($sql);
		$q->execute([':id'=>$id]);
		
		return $q->fetchAll(PDO::FETCH_CLASS, '\App\Models\Brand')[0];
	}
	
	
	
	/**
	 * Return every Brand in DB
	 *
	 * @return void
	 */
	public function findAll(int $mode=PDO::FETCH_CLASS)
	{
		$sql="SELECT id, marque AS name, date_modif AS updated_at  FROM instruments.marques WHERE id>0;";
		$q=$this->pdo->prepare($sql);
		$q->execute();
		
		switch($mode) {
			case PDO::FETCH_ASSOC:
				$brands=$q->fetchAll(PDO::FETCH_ASSOC);
				break;
			
			default:
			case PDO::FETCH_CLASS:
				$brands=$q->fetchAll(PDO::FETCH_CLASS, '\App\Models\Brand');
				break;
		}
		
		return $brands;
    }
	
	
	/**
	 * Create a new record for a given Brand entity
	 *
	 * @param Brand $brand
	 * @return Brand
	 */	
	public function create(Brand $brand):Brand|bool
	{
		$sql="INSERT INTO instruments.marques (marque) VALUES (:name);";
		$q=$this->pdo->prepare($sql);

		try{
			$q->execute([':name'=>strip_tags($brand->getName())]);
		}
		catch(PDOException $e){
			//echo "..."
			return false;
		}
		

		$id=$this->pdo->lastInsertId();
		return $this->find($id);
	}   

}
