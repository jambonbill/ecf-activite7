<?php

namespace Core;

class Entity
{

    public function __construct(array $data=[])
    {
        $this->hydrate($data);
    }    

    /**
     * Generic hydrate function 
     *
     * @param array $data
     * @return void
     */
    public function hydrate(array $data)
    {
      
      foreach ($data as $key => $value)
      {
        
        $method = 'set'.ucfirst($key);
        
        if (method_exists($this, $method))
        {
            $this->$method($value);
        }
      
      }
    }
}