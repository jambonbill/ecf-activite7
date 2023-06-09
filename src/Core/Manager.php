<?php
//unused...
namespace Core;

class Manager
{
	
	private $pdo=null;
	
	public function __construct()
	{
		$this->pdo=\Core\Database::getInstance();
	}
    
}

