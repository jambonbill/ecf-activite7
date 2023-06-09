<?php

namespace App\Controllers;

use Exceptions;

use Twig;

use App\Models\Brand;
use App\Models\BrandManager;

//class BrandController extends Controller
class BrandController
{
    private $templateFolder=__DIR__."/../../../public/templates";
    //private $twigloader = null;
    private $twig = null;
    
    public function __construct()
    {
        $twigloader=new Twig\Loader\FilesystemLoader($this->templateFolder);
        $this->twig=new Twig\Environment($twigloader);
    }
	
	public function add()
    {
        //echo __CLASS__.__FUNCTION__."()\n";
        
        switch($_SERVER['REQUEST_METHOD'])
        {
            case 'GET':
                //load view
                //require_once(__DIR__."/../../../view/brand.add.php");
                $template=$this->twig->load('brand.add.twig');        
                echo $template->render([
                    "title"=>"Ajouter une marque"
                ]);
                break;
            
            case 'POST':
                //deal with brandManager
                $manager=new BrandManager();
                
                //echo "This is POST:";
                //var_dump($_POST);
                $brand=new Brand(['name'=>$_POST['brandname']]);
                
                if($manager->create($brand)){                
                    // redirect on success
                    header('Location: /brands');
                }else{
                    // handle error here
                    die("ca deconne");
                }                
                break;
        }
        
        
    }
	

    /**
     * récupère la liste des marques depuis le model
     * et appelle un fichier brand.index.php dans un dossier view (un var_dump | autre affiche dans la vue)
     *
     * @return void
     */
    public function index()
    {
        //echo __FILE__.__FUNCTION__."()\n";
        $manager=new BrandManager();
        $brands=$manager->findAll();
        
        $template=$this->twig->load('brands.twig');        
        
        echo $template->render([
            "title"=>"Les marques",
            "brands"=>$brands
        ]);
    }

    public function landingPage()
    {
        
        $template=$this->twig->load('home.twig');        
        echo $template->render(["title"=>"landing page"]);
    }
    
}
