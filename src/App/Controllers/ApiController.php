<?php

namespace App\Controllers;

use Exceptions;
use PDO;

use Twig;

use App\Models\BrandManager;
use App\Models\InstrumentManager;

class ApiController
{
    
    public function __construct(?string $action='')
    {
        
        switch($action){
            
            case 'instruments':
                $manager=new InstrumentManager();
                $this->encode($manager->findAll(PDO::FETCH_ASSOC));
                break;
            
            case 'types':
                $msg=['error'=>'not implemented yet'];
                $this->encode($msg);
                break;
            
            case 'brands':
                $manager=new BrandManager();
                $this->encode($manager->findAll(PDO::FETCH_ASSOC));
                break;
            
            default://wrong route / no route
                break;
        }
        
    }
	
	/**
     * Encode given data to JSON, and send with appropriate header
     *
     * @param array $data
     * @return void
     */
    private function encode(array $data)
    {
        sleep(2);//simulate slow internet
        header('Content-Type: application/json; charset=utf-8');
        
        $payload=[];
        $payload['date']=date('c');
        $payload['data']=$data;
        
        $str=json_encode($payload, JSON_PRETTY_PRINT);
        $err=json_last_error();
        
        if ($err) {
            $msg=['error'=>json_last_error_msg()];
            exit(json_encode($msg));
        } else {
            exit($str);
        }
    }

    /**
     * Show list of API endpoints as a webpage
     *
     * @return void
     */
    public function index()
    {
        //todo
    }

    public function demo()
    {
        // javascript implementation demo
        $templateFolder=__DIR__."/../../../public/templates";
        $twigloader=new Twig\Loader\FilesystemLoader($templateFolder);
        $twig=new Twig\Environment($twigloader);
        $template=$twig->load('apidemo.twig');
        echo $template->render();
    }

    
}
