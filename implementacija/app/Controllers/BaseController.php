<?php

namespace App\Controllers;

use App\Models\GrejanjeModel;
use App\Models\ImaOpremaModel;
use App\Models\JeOmiljeniModel;
use App\Models\NekretninaModel;
use App\Models\OpremaModel;
use App\Models\SlikeNekretninaModel;
use App\Models\StanjeModel;
use App\Models\TipModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Session;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ["url", "form"];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        $this->session = session();
    }

    /**
     * Funckija za prikaz rezultata pretrage
     * @param $header
     * @param $view
     * @param $nekretnine
     * @return void
     *
     */
    protected function prikaziPretragu($header, $view, $nekretnine){
        $nm = new NekretninaModel();
        $snm = new SlikeNekretninaModel();
        $tm = new TipModel();
        $om = new OpremaModel();
        $gm = new GrejanjeModel();
        $sm = new StanjeModel();
        $iom = new ImaOpremaModel();
        $jom = new JeOmiljeniModel();

        $tipovi = $tm->findAll();
        $query = $nm->query('SELECT DISTINCT opstina FROM nekretnina');
        $opstine = $query->getResultArray();
        $opreme = $om->findAll();
        $grejanja = $gm->findAll();
        $stanja = $sm->findAll();
        if(isset($_SESSION['user']))
            $nekretnine_omiljene = $jom->where("idKorisnik", $_SESSION["user"]->idKorisnik)->findAll();
        else
            $nekretnine_omiljene = [];
        $favoriti = [];

        foreach ($nekretnine_omiljene as $n) $favoriti[] = $n->idNekretnina;
        $slike = [];

        foreach ($nekretnine as $nekretnina){
            $slike[] = $snm->where("idNekretnina", $nekretnina->idNekretnina)->findAll()[0];
        }

        echo view("static/$header");
        echo view($view,  ["nekretnine" => $nekretnine, "slike" => $slike, "tipovi"=>$tipovi,
            "opstine"=>$opstine, "opreme"=>$opreme, "grejanja"=>$grejanja, "stanja"=>$stanja, "favoriti"=>$favoriti]);
    }

    protected function generateHtmlCode($nekretnine, $controller){
        $html = "";
        $slike = [];
        $snm = new SlikeNekretninaModel();

        if(sizeof($nekretnine) == 0){
            return "<p>Ne postoje oglasene nekretnine za zadatu pretragu!</p>";
        }


        foreach ($nekretnine as $nekretnina){
            $slikeForNekretnina = $snm->where("idNekretnina", $nekretnina->idNekretnina)->findAll();

            if (!empty($slikeForNekretnina)) {
                $slike[] = $slikeForNekretnina[0];
            }else{
                $slike[] = null;
            }
        }


        $cntRow = 0;
        for ($i = 0; $i < sizeof($nekretnine); $i++) {
            $nekretnina = $nekretnine[$i];
            $slika = $slike[$i];
            if($slika != null){
                $base64Data = base64_encode($slika->slika);
            }else{
                $base64Data = "nema.jpg";
            }

            $dataURL = 'data:image/jpeg;base64,' . $base64Data;
            if ($cntRow % 4 == 0) {
                $html .= "<div class=\"row\" style=\"margin-top: 20px; padding-left: 20px; padding-right: 20px;\">";
            }
            if( isset($_SESSION['user']))
                $nekretnine_omiljene = (new JeOmiljeniModel())->where("idKorisnik", $_SESSION["user"]->idKorisnik)->findAll();
            else
                $nekretnine_omiljene = [];
            $favoriti = [];

            foreach ($nekretnine_omiljene as $n) $favoriti[] = $n->idNekretnina;
            if(in_array($nekretnina, $favoriti)){
                $html .= "
        <div class=\"col-sm-3\" style=\"padding-left: 0px; padding-right: 0px;\">
            <div class=\"card\" style=\"width: 100%; height: 400px;\">
                <a href=\"" . base_url("$controller/prikazOglasa") . "/" . $nekretnina->idNekretnina . "\">
                    <img src=\"$dataURL\" class=\"card-img-top\" alt=\"Slika stana\" height=\"200px\">
                    <div>
                        <img class=\"srce\" src=\"" . base_url("images/srceFull.png") . "\" height=\"30px\" width=\"40px\" style=\"margin-left: 83%; margin-top: 5%; margin-bottom: 2%;\" id=\"$nekretnina->idNekretnina\">
                    </div>
    
                    <div class=\"card-body text-center\" style=\"padding-top: 2%;\">
                        <p class=\"card-text\"> $nekretnina->opis </p>
                        <h6 style=\"margin-left: 2px; margin-bottom: 2px; display: inline;\">$nekretnina->kvadratura m2</h6>
                        <h6 style=\"margin-left: 32%; margin-bottom: 2px; display: inline;\">$nekretnina->cena €</h6>
                    </div>
                </a>
            </div>
        </div>";
            }
            else {
                $html .= "
        <div class=\"col-sm-3\" style=\"padding-left: 0px; padding-right: 0px;\">
            <div class=\"card\" style=\"width: 100%; height: 400px;\">
                <a href=\"" . base_url("$controller/prikazOglasa") . "/" . $nekretnina->idNekretnina . "\">
                    <img src=\"$dataURL\" class=\"card-img-top\" alt=\"Slika stana\" height=\"200px\">
                    <div>
                        <img class=\"srce\" src=\"" . base_url("images/srce.png") . "\" height=\"30px\" width=\"40px\" style=\"margin-left: 83%; margin-top: 5%; margin-bottom: 2%;\" id=\"$nekretnina->idNekretnina\">
                    </div>
    
                    <div class=\"card-body text-center\" style=\"padding-top: 2%;\">
                        <p class=\"card-text\"> $nekretnina->opis </p>
                        <h6 style=\"margin-left: 2px; margin-bottom: 2px; display: inline;\">$nekretnina->kvadratura m2</h6>
                        <h6 style=\"margin-left: 32%; margin-bottom: 2px; display: inline;\">$nekretnina->cena €</h6>
                    </div>
                </a>
            </div>
        </div>";
            }


            $cntRow++;

            if ($cntRow % 4 == 0 || $i == sizeof($nekretnine) - 1) {
                $html .= "</div>";
            }
        }

        return $html;
    }


}
