<?php

namespace App\Controllers;

use Exceptions;

use Twig;

use App\Models\Instrument;
use App\Models\InstrumentManager;

class InstrumentController
{
    
    private $templateFolder=__DIR__."/../../../public/templates";
    private $twig = null;
    
    public function __construct()
    {
        $twigloader=new Twig\Loader\FilesystemLoader($this->templateFolder);
        $this->twig=new Twig\Environment($twigloader);
    }


    public function index()
    {
        $manager=new InstrumentManager();
        $entities=$manager->findAll();
        //var_dump($entities);
        $template=$this->twig->load('instruments.twig');        
        
        echo $template->render([
            "title"=>"Instruments",
            "entities"=>$entities
        ]);
    }


    public function add()
    {
        switch($_SERVER['REQUEST_METHOD'])
        {
            case 'GET':
                $template=$this->twig->load('instrument.add.twig');        
                echo $template->render([
                    "title"=>"Ajouter un instrument"
                ]);
                break;
            
        }
    }
	
	
}
