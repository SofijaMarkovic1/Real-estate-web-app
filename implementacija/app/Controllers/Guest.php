<?php
/**
 * AUTORI:
 * Sofija Markovic ms200350d@student.etf.bg.ac.rs
 * Petar Markovic mp200122d@student.etf.bg.ac.rs
 * Bogdan Mihajlovic mb200207d@student.etf.bg.ac.rs
 */
namespace App\Controllers;

use App\Models\GrejanjeModel;
use App\Models\ImaOpremaModel;
use App\Models\ImaTagModel;
use App\Models\JeOmiljeniModel;
use App\Models\KorisnikModel;
use App\Models\NekretninaModel;
use App\Models\OpremaModel;
use App\Models\ProdajeModel;
use App\Models\SlikeNekretninaModel;
use App\Models\StanjeModel;
use App\Models\TagModel;
use App\Models\TipModel;
use App\Models\ZahtevModel;
use CodeIgniter\HTTP\URI;

class Guest extends BaseController
{

    /**
     * Pocetna stranica
     */
    public function index()
    {
        echo view('static/headerGuest');
        return view('guest/index');
    }

    /**
     * Stranica za prijavu
     */
    public function login(){
        return view("login", ["errorMsg"=>""]);
    }

    /**
     * Stranica za registraciju
     */
    public function registracija(){
        //echo view('static/headerGuest');
        return view('guest/registracija', ["errorMsg"=>""]);
    }

    /**
     * Prikazuje oglase na strani pretraga
     */
    public function pretragaGost()
    {
        $jom = new JeOmiljeniModel();
        $nm = new NekretninaModel();
        $snm = new SlikeNekretninaModel();
        $tm = new TipModel();
        $om = new OpremaModel();
        $gm = new GrejanjeModel();
        $sm = new StanjeModel();
        $iom = new ImaOpremaModel();


        $tipovi = $tm->findAll();
        $query = $nm->query('SELECT DISTINCT opstina FROM nekretnina');
        $opstine = $query->getResultArray();
        $opreme = $om->findAll();
        $grejanja = $gm->findAll();
        $stanja = $sm->findAll();

        $checkedOpstine = [];
        foreach ($opstine as $row) {
            $opstina = $row['opstina'];
            $checkedOpstine[] = $opstina;
        }
        $checkedOprema = [];
        foreach ($opreme as $oprema) {
            //$checkedOprema[] = $om->where("naziv", $oprema->naziv)->find()->id;
            $checkedOprema[] = $oprema->idOprema;
        }
        $checkedGrejanje = [];
        foreach ($grejanja as $grejanje) {
            //$checkedGrejanje[] = $gm->where("naziv", $grejanje->naziv)->find()->id;
            $checkedGrejanje[] = $grejanje->idGrejanja;
        }
        $checkedTip = [];
        foreach ($tipovi as $tip) {
            //$checkedTip[] = $tm->where("naziv", $tip->naziv)->find()->id;
            $checkedTip[] = $tip->idTip;
        }
        $checkedStanje = [];
        foreach ($stanja as $stanje) {
            //$checkedStanje[] = $sm->where("naziv", $stanje->naziv)->find()->id;
            $checkedStanje[] = $stanje->idStanja;
        }
        $minCena = $nm->query("SELECT MIN(cena) AS minCena FROM nekretnina")->getResultArray()[0]["minCena"];
        $maxCena = $nm->query("SELECT MAX(cena) AS maxCena FROM nekretnina")->getResultArray()[0]["maxCena"];

        $minKvadratura = $nm->select("*")->orderBy("kvadratura", "ASC")->first()->kvadratura;
        $maxKvadratura = $nm->select("*")->orderBy("kvadratura", "DESC")->first()->kvadratura;

        $minRangeCena = $minCena;
        $maxRangeCena = $maxCena;
        $minRangeKvadratura = $minKvadratura;
        $maxRangeKvadratura = $maxKvadratura;

        $sortiranje = 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['minCenaHidden'])) {
                $minCena = $_POST['minCenaHidden'];
            }
            if (isset($_POST['maxCenaHidden'])) {
                $maxCena = $_POST['maxCenaHidden'];
            }
            if (isset($_POST['minKvHidden'])) {
                $minKvadratura = $_POST['minKvHidden'];
            }
            if (isset($_POST['minCenaHidden'])) {
                $maxKvadratura = $_POST['maxKvHidden'];
            }
            if (isset($_POST['selectBar'])) {
                $sortiranje = $_POST['selectBar'];
            }

            //OPSTINE
            if (isset($_POST['opstine'])) {
                $x = $_POST['opstine'];
                // Process the checked checkboxes
                $checkedOpstine = [];
                foreach ($x as $opstina) {
                    $s = str_replace("opstina", "", $opstina);
                    $index = intval($s);
                    //echo $index;
                    $checkedOpstine[] = ($opstine[$index])["opstina"];
                }
            } else {
                foreach ($opstine as $row) {
                    $opstina = $row['opstina'];
                    $checkedOpstine[] = $opstina;
                }
            }


            //OPREMA
            if (isset($_POST['opreme'])) {
                $x = $_POST['opreme'];
                $checkedOprema = [];
                // Process the checked checkboxes
                foreach ($x as $oprema) {
                    //$checkedOprema[] = $om->where("naziv", $oprema)->find()->id;
                    $s = str_replace("oprema", "", $oprema);
                    $index = intval($s);
                    $o = $opreme[$index];
                    $checkedOprema[] = $o->idOprema;
                }
            } else {
                foreach ($opreme as $oprema) {
                    //$checkedOprema[] = $om->where("naziv", $oprema->naziv)->find()->id;
                    $checkedOprema[] = $oprema->idOprema;
                }
            }


            //GREJANJE
            if (isset($_POST['grejanja'])) {
                $x = $_POST['grejanja'];
                $checkedGrejanje = [];
                // Process the checked checkboxes
                foreach ($x as $grejanje) {
                    //$checkedGrejanje[] = $gm->where("naziv", $grejanje)->find()->id;
                    $s = str_replace("grejanje", "", $grejanje);
                    $index = intval($s);
                    $g = $grejanja[$index];
                    //echo $g->idGrejanja;
                    $checkedGrejanje[] = $g->idGrejanja;
                }
            } else {
                foreach ($grejanja as $grejanje) {
                    //$checkedGrejanje[] = $gm->where("naziv", $grejanje->naziv)->find()->id;
                    $checkedGrejanje[] = $grejanje->idGrejanja;
                }
            }


            //TIPOVI
            if (isset($_POST['tipovi'])) {
                $x = $_POST['tipovi'];
                $checkedTip = [];
                // Process the checked checkboxes
                foreach ($x as $tip) {
                    //$checkedTip[] = $tm->where("naziv", $tip)->find()->id;
                    $s = str_replace("tip", "", $tip);
                    $index = intval($s);
                    $t = $tipovi[$index];
                    $checkedTip[] = $t->idTip;
                }
            } else {
                foreach ($tipovi as $tip) {
                    //$checkedTip[] = $tm->where("naziv", $tip->naziv)->find()->id;
                    $checkedTip[] = $tip->idTip;
                }
            }


            //STANJA
            if (isset($_POST['stanja'])) {
                $x = $_POST['stanja'];
                $checkedStanje = [];
                // Process the checked checkboxes
                foreach ($x as $stanje) {
                    //$checkedStanje[] = $sm->where("naziv", $stanje)->find()->id;
                    $s = str_replace("stanje", "", $stanje);
                    $index = intval($s);
                    $st = $stanja[$index];
                    $checkedStanje[] = $st->idStanja;
                }
            } else {
                foreach ($stanja as $stanje) {
                    //$checkedStanje[] = $sm->where("naziv", $stanje->naziv)->find()->id;
                    $checkedStanje[] = $stanje->idStanja;
                }
            }

        }
        $minCena--;
        $maxCena++;
        $minKvadratura--;
        $maxKvadratura++;
        $idNek = $iom->imaOpreme($checkedOprema);
        $nekretnineQuery = $nm->whereIn("opstina", $checkedOpstine)
            ->whereIn("idGrejanja", $checkedGrejanje)
            ->whereIn("idTip", $checkedTip)
            ->whereIn("idStanja", $checkedStanje)
            ->whereIn("idNekretnina", $idNek)
            ->where("cena >=", $minCena)
            ->where("cena <=", $maxCena)
            ->where("kvadratura >=", $minKvadratura)
            ->where("kvadratura <=", $maxKvadratura);
        $nekretnine = [];
        switch ($sortiranje){
            case "0":
                $nekretnine = $nekretnineQuery->findAll();
                break;
            case "1":
                $nekretnine = $nekretnineQuery->orderBy("cena", "ASC")->findAll();
                break;
            case "2":
                $nekretnine = $nekretnineQuery->orderBy("cena", "DESC")->findAll();
                break;
            case "3":
                $nekretnine = $nekretnineQuery->orderBy("kvadratura", "ASC")->findAll();
                break;
            case "4":
                $nekretnine = $nekretnineQuery->orderBy("kvadratura", "DESC")->findAll();
                break;

        }
        //$nekretnine = $nm->findAll();

        $slike = [];
        foreach ($nekretnine as $nekretnina){
            $slike[] = $snm->where("idNekretnina", $nekretnina->idNekretnina)->findAll()[0];
        }

        $maxRangeCena = ceil($maxRangeCena/10000)*10000;
        $maxRangeKvadratura= ceil($maxRangeKvadratura/10)*10;
        echo view('static/headerGuest');
        echo view('guest/pretragaGost',  ["nekretnine" => $nekretnine, "slike" => $slike, "tipovi"=>$tipovi,
            "opstine"=>$opstine, "opreme"=>$opreme, "grejanja"=>$grejanja, "stanja"=>$stanja, "minRangeCena" => $minRangeCena, "maxRangeCena"=>$maxRangeCena, "minRangeKvadratura"=>$minRangeKvadratura, "maxRangeKvadratura"=>$maxRangeKvadratura]);
    }

    /**
     * Prikazuje sve nekretnine ciji opis sadrzi tekst unet u search baru
     */
    public function pretragaPoNazivu(){
        $search = $this->request->getVar("searchBar");
        $nekretninaModel = new NekretninaModel();
        $tagModel = new TagModel();
        $imaTagModel = new ImaTagModel();

        $nekretnine = $nekretninaModel->findByDesc($search);
        $tagovi = [];

        foreach (explode(" ", $search) as $txt){
            $tagovi = array_merge($tagModel->likeByName($txt), $tagovi);
        }

        foreach ($tagovi as $tag){
            $nekretnineId = $imaTagModel->findByTagId($tag->idTag);
            foreach ($nekretnineId as $id){
                $nekretnine[] = $nekretninaModel->find($id->idNekretnina);
            }
        }
        $this->prikaziPretragu("headerGuest", "guest/pretragaGost", $nekretnine);
    }

    /**
     * Kreiranje zahteva za registraciju
     */
    public function registrujSe(){
        $imePrezime = $this->request->getVar("imeprezime");
        $email = $this->request->getVar("email");
        $brojTelefona = $this->request->getVar("telefon");
        $korIme = $this->request->getVar("korime");
        $lozinka = $this->request->getVar("lozinka");
        $ponovljenaLozinka = $this->request->getVar("ponovolozinka");

        if(!$this->validate([
            'imeprezime' => 'required|min_length[6]',
            'email' => 'required',
            'telefon' => 'required',
            'lozinka' => 'required|min_length[6]',
            'ponovolozinka' => 'required',
            'korime' => 'required'
        ])){
            return view("guest/registracija", ["errorMsg" => $this->validator->listErrors()]);
        }

        $korisnikModel = new KorisnikModel();

        $korisnik = $korisnikModel->findByEmail($email);
        if($korisnik != null){
            return view("guest/registracija", ["errorMsg" => "E-mail je zauzet", "imeprezime" => $imePrezime]);
        }

        $korisnik = $korisnikModel->findByPhoneNumber($brojTelefona);
        if($korisnik != null){
            return view("guest/registracija", ["errorMsg" => "Broj telefona je zauzet", "imeprezime" => $imePrezime, "email" => $email]);
        }

        $korisnik = $korisnikModel->findByUsername($korIme);
        if($korisnik != null){
            return view("guest/registracija", ["errorMsg" => "Korisnicko ime je zauzeto", "imeprezime" => $imePrezime, "email" => $email, "brojTelefona" => $brojTelefona]);
        }

        if($ponovljenaLozinka != $lozinka){
            return  view("guest/registracija", ["errorMsg" => "Lozinke se ne podudaraju", "imeprezime" => $imePrezime, "email" => $email, "brojTelefona" => $brojTelefona, "korIme" => $korIme]);
        }

        $zahtevModel = new ZahtevModel();


        if($zahtevModel->where("email", $email)->find()!=null){
            echo view("login", ["errorMsg"=>"Vaš zahtev za registracijom je u obradi!"]);
            return;
        }
        $zahtevModel->save([
           'ime_prezime' => $imePrezime,
           'email' => $email,
           'telefon' => $brojTelefona,
           'username' => $korIme,
           'password' => $lozinka
        ]);
        return  redirect()->to(site_url("Guest/login"));
    }

    /**
     * Prikaz pojedinacnog oglasa
     */
    public function prikazOglasa(){
        $uri = new URI(current_url()); // Assuming you have the URL helper loaded

        $segments = $uri->getSegments();
        $idNekretnine = end($segments);

        $nm = new NekretninaModel();
        $pm = new ProdajeModel();
        $om = new OpremaModel();
        $gm = new GrejanjeModel();
        $tm = new TipModel();
        $sm = new StanjeModel();
        $snm = new SlikeNekretninaModel();
        $iom = new ImaOpremaModel();
        $nekretnina = $nm->find($idNekretnine);
        $prodavac = $pm->prodavac($idNekretnine);

        $query = $nm->query('SELECT DISTINCT opstina FROM nekretnina');
        $opstine = $query->getResultArray();

        $opreme = $om->findAll();
        $grejanja = $gm->findAll();
        $tipovi = $tm->findAll();
        $stanja = $sm->findAll();
        $slike = $snm->where("idNekretnina", $nekretnina->idNekretnina)->findAll();

        $nazivTipa = $tm->where("idTip", $nekretnina->idTip)->findAll()[0]->naziv;
        $nazivGrejanja = $gm->where("idGrejanja", $nekretnina->idGrejanja)->findAll()[0]->naziv;
        $nazivStanja = $sm->where("idStanja", $nekretnina->idStanja)->findAll()[0]->naziv;

        $imaOpremu = $iom->where("idNekretnina", $nekretnina->idNekretnina)->findAll();
        $ids = [];
        $opremaNekretnine = [];
        foreach($imaOpremu as $io){
            $ids[] = $io->idOprema;
        }
        foreach ($opreme as $oprema){
            if(in_array($oprema->idOprema, $ids)) $opremaNekretnine[] = $oprema;
        }


        echo view('static/headerGuest');
        echo view('guest/prikazOglasa', ["nekretnina"=>$nekretnina, "prodavac"=>$prodavac, "opstine"=>$opstine, "opreme"=>$opreme,
            "grejanja"=>$grejanja, "tipovi"=>$tipovi, "nazivTipa"=>$nazivTipa, "nazivGrejanja"=>$nazivGrejanja, "nazivStanja"=>$nazivStanja,
            "stanja"=>$stanja, "slike"=>$slike, "opremaNekretnine"=>$opremaNekretnine]);
    }


    public function get_nekretnine(){

        $search = $this->request->getVar("keyword");

        $nekretninaModel = new NekretninaModel();
        $tagModel = new TagModel();
        $imaTagModel = new ImaTagModel();

        $nekretnine = $nekretninaModel->findByDesc($search);
        $tagovi = [];

        foreach (explode(" ", $search) as $txt){
            $tagovi = array_merge($tagModel->likeByName($txt), $tagovi);
        }

        foreach ($tagovi as $tag){
            $nekretnineId = $imaTagModel->findByTagId($tag->idTag);
            foreach ($nekretnineId as $id){
                $nekretnine[] = $nekretninaModel->find($id->idNekretnina);
            }
        }

        return $this->generateHtmlCode($nekretnine, "Guest");
    }

    
}
