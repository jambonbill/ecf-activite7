<?php

namespace App\Models;

use Exception;

use \Core\Entity;

/**
* Brand Entity
*/

class Brand extends Entity{

	
	protected ?int $id=null;	
	protected ?string $name='';
	protected ?string $updated_at=null;
	
	
	/**
	 * Return true if the id is NOT set
	 *
	 * @return boolean
	 */
	public function isNew():bool
	{		
		return !$this->id;
	}


	/**
	 * Set Entity Id
	 *
	 * @param integer $id
	 * @return self
	 */
	public function setId(int $id): self
	{
		if ($id <= 0) {
			throw new Exception("id must be > 0");
		}
		
		$this->id=$id;
		
		return $this;
	}


	/**
	 * Get the value of id
	 *
	 * @return ?int
	 */
	public function getId(): ?int
	{
		return $this->id;
	}

	/**
	 * Get the value of 
	 *
	 * @return ?string
	 */
	
	public function getName(): ?string
	{
		return $this->name;
	}
	
	public function getUpdated_at(): ?string
	{
		return $this->updated_at;
	}

	
	/**
	 * Set the value of name
	 *
	 * @param ?string $name
	 *
	 * @return self
	 */
	public function setName(?string $name): self
	{
		$this->name = $name;

		return $this;
	}


	/**
	 * Set the value of updated_at
	 *
	 * @param ?string $updated_at
	 *
	 * @return self
	 */
	public function setUpdatedAt(?string $updated_at): self
	{
		//todo : check date format
		$this->updated_at = $updated_at;

		return $this;
	}
}
