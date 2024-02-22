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
use CodeIgniter\Entity\Cast\IntegerCast;
use CodeIgniter\HTTP\URI;
use http\Env\Request;
use mysqli;
use PHPUnit\Exception;

class Login extends BaseController
{
    /**
     * Prikazuje stranicu za login
     */
    public function login(){
        return view('login', ["errorMsg"=>""]);
    }


    /**
     * Prikazuje stranicu za registraciju
     */
    public function signup(){
        return view('guest/registracija.php', ["errorMsg" => ""]);
    }


    /**
     * Poziva se prilikom loginovanja radi provere kredencijala
     */
    public function login_check(){

        $korime = $this->request->getVar("korime");
        $lozinka = $this->request->getVar("lozinka");

        $km = new KorisnikModel();
        $zm = new ZahtevModel();
        $results = $km->where("username", $korime)->where("password", $lozinka)->findAll();
        if(!$korime || !$lozinka){
            return view('login', ["errorMsg"=>"Morate uneti sva polja forme."]);
        }
        if(sizeof($results)!=1){
            $results = $zm->where("username", $korime)->where("password", $lozinka)->findAll();
            if(sizeof($results)!=1) return view('login', ["errorMsg"=>"Pogrešni kredencijali."]);
            else return view('login', ["errorMsg"=>"Vaš zahtev za registracijom je u obradi!"]);
        }
        else{
            if(session_status() == PHP_SESSION_NONE)
                session_start();
            $_SESSION["user"] = $results[0];
            if($results[0]->isAdmin){
                return redirect()->to(site_url("/Admin/index"));
            }
            else return $this->index();
        }
    }


    /**
     * Poziva se prilikom odjavljivanja i tada unistava sesiju i postavlja user-a na null
     */
    public function odjaviSe(){
        $_SESSION["user"]=null;
        session_destroy();
        return $this->login();
    }


    /**
     * Prikazuje pocetnu stranicu za ulogovanog korisnika
     */
    public function index(){
        echo view('static/headerUser');
        echo view('user/indexUser');
    }


    /**
     * Prikazuje stranicu za oglasavanje nove nekretnine ulogovanog korisnika
     */
    public function oglasiNekretninu($msg = []){
        $tipovi = (new TipModel())->findAll();
        $stanja = (new StanjeModel())->findAll();
        $grejanja = (new GrejanjeModel())->findAll();
        $msg["tipovi"] = $tipovi;
        $msg["stanja"] = $stanja;
        $msg["grejanja"] = $grejanja;
        echo view('static/headerUser');
        return view('user/oglasiNekretninu', $msg);
    }

    /**
     * Proverava podatke dobijene preko forme oglasiNekretninu.php i dodaje novu nekretninu u bazu
     * i prebacuje na stranicu mojiOglasi.php
     */
    public function oglasiNekretninuPotvrda(){
        try{
            $naziv = $this->request->getVar("nazivoglasa");
            $tip = $this->request->getVar("tip");
            $stanje = $this->request->getVar("stanje");
            $kvadratura = $this->request->getVar("kvadratura");
            $brojSoba = $this->request->getVar("brojsoba");
            $drzava = $this->request->getVar("drzava");
            $opstina = $this->request->getVar("opstina");
            $grad = $this->request->getVar("grad");
            $adresa = $this->request->getVar("adresa");
            $grejanje = $this->request->getVar("grejanje");
            $cena = $this->request->getVar("cena");
            $opis = $this->request->getVar("opis");

            if(isset($_POST["dodajTag"])){
                $tag = $this->request->getVar("nazivtag");
                $tagovi = $this->dodajTag($tag);
                return $this->oglasiNekretninu([
                        "grad" => $grad,
                        "opstina" => $opstina,
                        "cena" => $cena,
                        "opis" => $opis,
                        "naziv" => $naziv,
                        "kvadratura" => $kvadratura,
                        "tagovi" => $tagovi,
                        "brojsoba" => $brojSoba,
                        "adresa" => $adresa,
                        "tip"=>$tip,
                        "stanje"=>$stanje,
                        "drzava"=>$drzava,
                        "grejanje"=>$grejanje

                    ]
                );
            }

            if(isset($_POST["ukloniTag"])){
                $tag = $this->request->getVar("nazivtag");
                $tagovi = $this->ukloniTag($tag);
                return $this->oglasiNekretninu([
                        "grad" => $grad,
                        "opstina" => $opstina,
                        "cena" => $cena,
                        "opis" => $opis,
                        "naziv" => $naziv,
                        "kvadratura" => $kvadratura,
                        "tagovi" => $tagovi,
                        "brojsoba" => $brojSoba,
                        "adresa" => $adresa,
                        "tip"=>$tip,
                        "stanje"=>$stanje,
                        "drzava"=>$drzava,
                        "grejanje"=>$grejanje
                    ]
                );
            }

            $tagovi = $this->session->has('tagovi') ? $this->session->get('tagovi') : [];
            // obevezna polja
            if(!$this->validate([
                'nazivoglasa' => 'required',
                'kvadratura' => 'required|numeric',
                'grad' => 'required',
                'opstina' => 'required',
                'cena' => 'required|numeric',
                'brojsoba' => 'required'
            ])){
                return $this->oglasiNekretninu([
                        "errorMsg" => $this->validator->listErrors(),
                        "grad" => $grad,
                        "opstina" => $opstina,
                        "cena" => $cena,
                        "opis" => $opis,
                        "naziv" => $naziv,
                        "kvadratura" => $kvadratura,
                        "tagovi" => $tagovi,
                        "brojsoba" => $brojSoba,
                        "adresa" => $adresa,
                        "tip"=>$tip,
                        "stanje"=>$stanje,
                        "drzava"=>$drzava,
                        "grejanje"=>$grejanje
                    ]
                );
            }

            $imageFile = $this->request->getFiles();
            $uploadedImages = $imageFile['images'];

            if(!$this->proveriSlike($uploadedImages)){
                return $this->oglasiNekretninu([
                        "errorMsg" => "Moras postaviti barem jednu sliku",
                        "grad" => $grad,
                        "opstina" => $opstina,
                        "cena" => $cena,
                        "opis" => $opis,
                        "naziv" => $naziv,
                        "kvadratura" => $kvadratura,
                        "tagovi" => $tagovi,
                        "brojsoba" => $brojSoba,
                        "adresa" => $adresa,
                        "tip"=>$tip,
                        "stanje"=>$stanje,
                        "drzava"=>$drzava,
                        "grejanje"=>$grejanje
                    ]
                );

            }

            $cena = floatval($cena);
            // nisu obavezna polja
            $adresa = $adresa ?? "-";
            $opis = $opis ?? "-";
            $tipModel = new TipModel();
            $stanjeModel = new StanjeModel();
            $grejanjeModel = new GrejanjeModel();
            $idTip = $tipModel->select("idTip")->like("naziv", $tip)->first();
            $idStanja = $stanjeModel->select("idStanja")->like("naziv", $stanje)->first();
            $idGrejanja= $grejanjeModel->select("idGrejanja")->like("naziv", $grejanje)->first();
            // cuvanje nekretnine
            $nekretninaModel = new NekretninaModel();
            $nekretninaModel->save([
                "idTip" => $idTip->idTip,
                "idStanja" => $idStanja->idStanja,
                "kvadratura" => $kvadratura,
                "drzava" => $drzava,
                "opstina" => $opstina,
                "grad" => $grad,
                "adresa" => $adresa,
                "idGrejanja" => $idGrejanja->idGrejanja,
                "cena" => $cena,
                "broj_soba" => $brojSoba,
                "opis" => $opis
            ]);

            $idNekretnina = $nekretninaModel->getInsertID();

            $this->dodajImaTag($tagovi, $idNekretnina);
            $this->dodajSlikeNekretnina($idNekretnina);
            $this->dodajProdaje($idNekretnina);
            $_SESSION['tagovi'] = null; // brisanje sacuvanih tagova
            return redirect()->to(site_url("/Login/mojiOglasi"));
        }catch (\Exception $e){
            $file = $e->getTrace()[0]['file'];
            $line = $e->getTrace()[0]['line'];
            return "Error occurred in file: $file, line: $line";
        }
    }

    /**
     * proverava slike unete preko forme oglasiNekretninu.php
     */
    protected function proveriSlike($uploadedImages){
        $hasUploads = false;
        foreach ($uploadedImages as $img) {
            if ($img->isValid() && !$img->hasMoved() && $img->getError() === UPLOAD_ERR_OK) {
                // File is valid and uploaded
                $hasUploads = true;
            }
        }

        if (!$hasUploads) {
            return false;
        }
        return true;
    }


    /**
     * dodaje objekat prodaje za kreiranu nekretninu i trenutno ulogovanog korisnika u bazu podataka
     */
    protected function dodajProdaje($idNekretnina){
        $user = $this->session->get('user');
        $prodajeModel = new ProdajeModel();
        $idKorisnik = intval($user->idKorisnik);
        try {

            $vecProdaje = $prodajeModel->where('idNekretnina', $idNekretnina)
                ->where('idKorisnik', $idKorisnik)->first();
            if($vecProdaje != null){
                var_dump("Greska");
                return "GREskA";
            }
            $prodajeModel->insert([
                "idNekretnina" => $idNekretnina,
                "idKorisnik" => $idKorisnik
            ]);
        } catch (\Exception $e) {
            $file = $e->getTrace()[0]['file'];
            $line = $e->getTrace()[0]['line'];
            return "Error occurred in file: $file, line: $line";
        }
    }
    protected function dodajSlikeNekretnina($idNekretnina){

        $slikeNekreninaModel = new SlikeNekretninaModel();
        if($imagefile = $this->request->getFiles()) {
            foreach($imagefile['images'] as $img) {
                if ($img->isValid() && ! $img->hasMoved()) {

                    ini_set('upload_max_filesize', '10M');
                    ini_set('post_max_size', '10M');
                    ini_set('memory_limit', '256M');

                    $imageData = file_get_contents($img->getPathname());
                    try {
                        $slikeNekreninaModel->save([
                            "slika" => $imageData,
                            "idNekretnina" => $idNekretnina
                        ]);
                    } catch (\Exception $e) {
                        $file = $e->getTrace()[0]['file'];
                        $line = $e->getTrace()[0]['line'];
                        return "Error occurred in file: $file, line: $line";
                    }
                }
            }
        }
    }

    /**
     * dodaje objekte imaTag u bazu podataka za novokreiranu nekretninu i tagove dobijene preko forme
     */
    protected function dodajImaTag($tagovi, $idNekretnina){
        $tagModel = new TagModel();
        $imaTagModel = new ImaTagModel();

        foreach ($tagovi as $tag){
            if(!isset($tag) || strlen($tag) == 0)continue;
            $idTag = $tagModel->findByName($tag);


            if($idTag == null){
                $tagModel->save(["naziv" => $tag]);
                $idTag = $tagModel->findByName($tag);
            }

            $vecIma = $imaTagModel->where("idTag", $idTag->idTag)->where("idNekretnina", $idNekretnina)->first();
            if($vecIma != null)
                continue;

            try {
                $imaTagModel->insert([
                    "idTag" => $idTag->idTag,
                    "idNekretnina" => $idNekretnina
                ]);
            } catch (\Exception $e) {
                continue;
            }

        }
    }


    protected function dodajTag($tagNaziv){
        $tagovi = [];
        if($this->session->has('tagovi')){
            $tagovi = $this->session->get('tagovi');
        }
        if(isset($tagNaziv)){
            $tagovi[] = $tagNaziv;
            $this->session->set('tagovi', $tagovi);
        }
        return $tagovi;
    }

    private function ukloniTag($tagNaziv){
        $tagovi = [];
        if($this->session->has("tagovi")){
            $tagovi = $this->session->get('tagovi');
        }
        $tagovi = array_diff($tagovi, [$tagNaziv]);
        $this->session->set('tagovi', $tagovi);
        return $tagovi;
    }

    /**
     * Prikazuje sve nekretnine
     *
     */
    public function pretraga()
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
            $checkedOprema[] = $oprema->idOprema;
        }
        $checkedGrejanje = [];
        foreach ($grejanja as $grejanje) {
            $checkedGrejanje[] = $grejanje->idGrejanja;
        }
        $checkedTip = [];
        foreach ($tipovi as $tip) {
            $checkedTip[] = $tip->idTip;
        }
        $checkedStanje = [];
        foreach ($stanja as $stanje) {
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
                $checkedOpstine = [];
                foreach ($x as $opstina) {
                    $s = str_replace("opstina", "", $opstina);
                    $index = intval($s);
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
                foreach ($x as $oprema) {
                    $s = str_replace("oprema", "", $oprema);
                    $index = intval($s);
                    $o = $opreme[$index];
                    $checkedOprema[] = $o->idOprema;
                }
            } else {
                foreach ($opreme as $oprema) {
                    $checkedOprema[] = $oprema->idOprema;
                }
            }


            //GREJANJE
            if (isset($_POST['grejanja'])) {
                $x = $_POST['grejanja'];
                $checkedGrejanje = [];
                foreach ($x as $grejanje) {
                    $s = str_replace("grejanje", "", $grejanje);
                    $index = intval($s);
                    $g = $grejanja[$index];
                    $checkedGrejanje[] = $g->idGrejanja;
                }
            } else {
                foreach ($grejanja as $grejanje) {
                    $checkedGrejanje[] = $grejanje->idGrejanja;
                }
            }


            //TIPOVI
            if (isset($_POST['tipovi'])) {
                $x = $_POST['tipovi'];
                $checkedTip = [];
                foreach ($x as $tip) {
                    $s = str_replace("tip", "", $tip);
                    $index = intval($s);
                    $t = $tipovi[$index];
                    $checkedTip[] = $t->idTip;
                }
            } else {
                foreach ($tipovi as $tip) {
                    $checkedTip[] = $tip->idTip;
                }
            }


            //STANJA
            if (isset($_POST['stanja'])) {
                $x = $_POST['stanja'];
                $checkedStanje = [];
                foreach ($x as $stanje) {
                    $s = str_replace("stanje", "", $stanje);
                    $index = intval($s);
                    $st = $stanja[$index];
                    $checkedStanje[] = $st->idStanja;
                }
            } else {
                foreach ($stanja as $stanje) {
                    $checkedStanje[] = $stanje->idStanja;
                }
            }

        }
        //$minCena--;
        //$maxCena++;
        //$minKvadratura--;
        //$maxKvadratura++;
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

        $slike = [];
        foreach ($nekretnine as $nekretnina){
            $slike[] = $snm->where("idNekretnina", $nekretnina->idNekretnina)->findAll()[0];
        }

        $maxRangeCena = ceil($maxRangeCena/10000)*10000;
        $maxRangeKvadratura= ceil($maxRangeKvadratura/10)*10;
        $nekretnine_omiljene = $jom->where("idKorisnik", $_SESSION["user"]->idKorisnik)->findAll();
        $favoriti = [];
        foreach ($nekretnine_omiljene as $n) $favoriti[] = $n->idNekretnina;
        echo view('static/headerUser');
        echo view('user/pretraga',  ["nekretnine" => $nekretnine, "favoriti"=>$favoriti, "slike" => $slike, "tipovi"=>$tipovi,
            "opstine"=>$opstine, "opreme"=>$opreme, "grejanja"=>$grejanja, "stanja"=>$stanja, "minRangeCena" => $minRangeCena, "maxRangeCena"=>$maxRangeCena, "minRangeKvadratura"=>$minRangeKvadratura, "maxRangeKvadratura"=>$maxRangeKvadratura]);
    }

    /**
     * Prikazuje sve nekretnine ciji opis sadrzi tekst unet u search baru
     */
    public function pretragaPoNazivu()
    {
        try {
            $search = $this->request->getVar("searchBar");
            $nekretninaModel = new NekretninaModel();
            $tagModel = new TagModel();
            $imaTagModel = new ImaTagModel();

            $nekretnine = $nekretninaModel->findByDesc($search);
            $tagovi = [];

            foreach (explode(" ", $search) as $txt) {
                $tagovi = array_merge($tagModel->likeByName($txt), $tagovi);
            }

            foreach ($tagovi as $tag) {
                $nekretnineId = $imaTagModel->findByTagId($tag->idTag);
                foreach ($nekretnineId as $id) {
                    $nekretnine[] = $nekretninaModel->find($id->idNekretnina);
                }
            }
            return $this->prikaziPretragu("headerUser", "user/pretraga", $nekretnine);
        } catch (\Exception $e){
            $file = $e->getTrace()[0]['file'];
            $line = $e->getTrace()[0]['line'];
            echo "Error occurred in file: $file, line: $line";
        }
    }



    /**
     * Prikazuje sve oglase koje je oglasio ulogovani korisnik
     */
    public function mojiOglasi(){
        $jom = new JeOmiljeniModel();
        $nm = new NekretninaModel();
        $snm = new SlikeNekretninaModel();
        $tm = new TipModel();
        $om = new OpremaModel();
        $gm = new GrejanjeModel();
        $sm = new StanjeModel();
        $pm = new ProdajeModel();
        $minRangeCena = $nm->query("SELECT MIN(cena) AS minCena FROM nekretnina")->getResultArray()[0]["minCena"];
        $maxRangeCena = $nm->query("SELECT MAX(cena) AS maxCena FROM nekretnina")->getResultArray()[0]["maxCena"];

        $minRangeKvadratura = $nm->select("*")->orderBy("kvadratura", "ASC")->first()->kvadratura;
        $maxRangeKvadratura = $nm->select("*")->orderBy("kvadratura", "DESC")->first()->kvadratura;

        $maxRangeCena = ceil($maxRangeCena/10000)*10000;
        $maxRangeKvadratura= ceil($maxRangeKvadratura/10)*10;
        $nekretnine = [];
        $slike = [];
        $prodaje = $pm->where("idKorisnik", $_SESSION["user"]->idKorisnik)->findAll();

        foreach ($prodaje as $p){
            $nekretnine[] = $nm->where("idNekretnina", $p->idNekretnina)->findAll()[0];
            $slike[] = $snm->where("idNekretnina", $p->idNekretnina)->findAll()[0];
        }
        $tipovi = $tm->findAll();
        $query = $nm->query('SELECT DISTINCT opstina FROM nekretnina');
        $opstine = $query->getResultArray();
        $opreme = $om->findAll();
        $grejanja = $gm->findAll();
        $stanja = $sm->findAll();
        echo view('static/headerUser');
        return view('user/mojiOglasi',  ["nekretnine" => $nekretnine, "slike" => $slike, "tipovi"=>$tipovi,
            "opstine"=>$opstine, "opreme"=>$opreme, "grejanja"=>$grejanja, "stanja"=>$stanja, "minRangeCena" => $minRangeCena, "maxRangeCena"=>$maxRangeCena, "minRangeKvadratura"=>$minRangeKvadratura, "maxRangeKvadratura"=>$maxRangeKvadratura]);
    }


    /**
     * Izmena licnih podataka ulogovanog korisnika
     */
    public function izmeniPodatke(){
        $imePrezime = $this->request->getVar("imeprezime");
        $email = $this->request->getVar("email");
        $brojTelefona = $this->request->getVar("telefon");
        $korIme = $this->request->getVar("korime");
        $lozinka = $this->request->getVar("lozinka");
        $ponovljenaLozinka = $this->request->getVar("ponovolozinka");

        echo view('static/headerUser');
        return view('user/izmeniPodatke');
    }


    /**
     * provera novih podataka i update podataka u bazi
     */
    public function izmeniPodatkePotvrda(){
        try {
            if(isset($_POST["odustaniButton"])){
                return $this->index();
            }

            $korisnikModel = new KorisnikModel();
            $email = $this->request->getVar("email");
            $brojTelefona = $this->request->getVar("telefon");
            $korIme = $this->request->getVar("korime");
            $lozinka = $this->request->getVar("lozinka");
            $ponovljenaLozinka = $this->request->getVar("ponovolozinka");

            $user = $_SESSION["user"];
            $errorMsg = "";
            $succMsg = "";

            if($korIme){
                if($korIme == $user->username)
                    $errorMsg  = $errorMsg . "Korisnicko ime je isto<br>";
                else{
                    $user1 = $korisnikModel->findByUsername($korIme);
                    if($user1)
                        $errorMsg  = $errorMsg . "Korisnicko ime je zauzeto<br>";
                    else
                    {$user->username = $korIme; $succMsg = $succMsg . "Korisnicko ime je promenjeno<br>";}
                }
            }



            if($email){
                if($email == $user->email)
                    $errorMsg  = $errorMsg . "Email je isti<br>";
                else{
                    $user1 = $korisnikModel->findByEmail($email);
                    if($user1)
                        $errorMsg  = $errorMsg . "Email je zauzet<br>";
                    else
                    {$user->email = $email; $succMsg = $succMsg . "Email je promenjen<br>";}
                }

            }

            if($brojTelefona){
                if($brojTelefona == $user->telefon)
                    $errorMsg  = $errorMsg . "Broj telefona je isti<br>";
                else{
                    $user1 = $korisnikModel->findByPhoneNumber($brojTelefona);
                    if($user1)
                        $errorMsg  = $errorMsg . "Broj telefona je zauzet<br>";
                    else
                    {$user->telefon = $brojTelefona; $succMsg = $succMsg . "Broj telefona je promenjen<br>";}
                }
            }

            if($lozinka){
                if(!$this->validate([ "lozinka" => "min_length[6]" ]))
                    $errorMsg  = $errorMsg . "Minimalna duzina lozinke je 6 karaktera<br>";
                else {
                    if ($lozinka != $ponovljenaLozinka)
                        $errorMsg = $errorMsg . "Lozinke se ne podudaraju<br>";
                    else
                    {$user->password = $lozinka;$succMsg = $succMsg . "Lozinka je promenjena<br>";}
                }
            }

            echo $errorMsg;
            $korisnikModel->save($user);
            echo view('static/headerUser');
            return view("user/izmeniPodatke", ["errorMsg" => $errorMsg, "succMsg" => $succMsg]);
        }catch (\Exception $e){
            return $e->getMessage();
        }


    }


    /**
     * Prikazuje licne podatke ulogovanog korisnika
     */
    public function mojProfil(){
        $user = $_SESSION["user"];
        echo view('static/headerUser');
        return view('user/mojProfil', ["user" => $user]);
    }


    /**
     * Prikazuje sve nekretnine koje je ulogovani korisnik oznacio kao omiljene
     */
    public function mojiFavoriti(){
        $jom = new JeOmiljeniModel();
        $nm = new NekretninaModel();
        $snm = new SlikeNekretninaModel();
        $tm = new TipModel();
        $om = new OpremaModel();
        $gm = new GrejanjeModel();
        $sm = new StanjeModel();
        $minRangeCena = $nm->query("SELECT MIN(cena) AS minCena FROM nekretnina")->getResultArray()[0]["minCena"];
        $maxRangeCena = $nm->query("SELECT MAX(cena) AS maxCena FROM nekretnina")->getResultArray()[0]["maxCena"];

        $minRangeKvadratura = $nm->select("*")->orderBy("kvadratura", "ASC")->first()->kvadratura;
        $maxRangeKvadratura = $nm->select("*")->orderBy("kvadratura", "DESC")->first()->kvadratura;

        $maxRangeCena = ceil($maxRangeCena/10000)*10000;
        $maxRangeKvadratura= ceil($maxRangeKvadratura/10)*10;

        $nekretnine_omiljene = $jom->where("idKorisnik", $_SESSION["user"]->idKorisnik)->findAll();
        $nekretnine = [];
        $slike = [];
        foreach($nekretnine_omiljene as $nekretnina){
            $nekretnine[] = $nm->where("idNekretnina", $nekretnina->idNekretnina)->findAll()[0];
            $slike[] = $snm->where("idNekretnina", $nekretnina->idNekretnina)->findAll()[0];
        }
        $tipovi = $tm->findAll();
        $query = $nm->query('SELECT DISTINCT opstina FROM nekretnina');
        $opstine = $query->getResultArray();
        $opreme = $om->findAll();
        $grejanja = $gm->findAll();
        $stanja = $sm->findAll();
        echo view('static/headerUser');
        return view('user/mojiFavoriti', ["nekretnine" => $nekretnine, "slike" => $slike, "tipovi"=>$tipovi,
            "opstine"=>$opstine, "opreme"=>$opreme, "grejanja"=>$grejanja, "stanja"=>$stanja, "minRangeCena" => $minRangeCena, "maxRangeCena"=>$maxRangeCena, "minRangeKvadratura"=>$minRangeKvadratura, "maxRangeKvadratura"=>$maxRangeKvadratura]);
    }

    /**
     * Dodaje izabrani oglas u omiljene oglase ulogovanog korisnika u bazi podataka
     */
    public function dodajFavorit(){
        $jom = new JeOmiljeniModel();
        if($jom->where('idKorisnik',  $_SESSION['user']->idKorisnik)
            ->where('idNekretnina', $this->request->getVar('id'))->find() != null){
            return $this->mojiFavoriti();
        }
        $jom->set('idKorisnik', $_SESSION['user']->idKorisnik);
        $jom->set('idNekretnina', $this->request->getVar('id'));
        $jom->insert();
        return $this->mojiFavoriti();
    }

    /**
     * Uklanja izabrani oglas iz omiljenih oglasa ulogovanog korisnika u bazi podataka
     */
    public function ukloniFavorit(){
        $jom = new JeOmiljeniModel();
        if($jom->where('idKorisnik',  $_SESSION['user']->idKorisnik)
                ->where('idNekretnina', $this->request->getVar('id'))->find() == null){
            return $this->mojiFavoriti();
        }
        $jom->where('idKorisnik',  $_SESSION['user']->idKorisnik)
            ->where('idNekretnina', $this->request->getVar('id'))
            ->delete();
        return $this->mojiFavoriti();
    }

    /**
     * Prikazuje pojedinacni oglas
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


        echo view('static/headerUser');
        return view('user/prikazOglasa', ["nekretnina"=>$nekretnina, "prodavac"=>$prodavac, "opstine"=>$opstine, "opreme"=>$opreme,
            "grejanja"=>$grejanja, "tipovi"=>$tipovi, "nazivTipa"=>$nazivTipa, "nazivGrejanja"=>$nazivGrejanja, "nazivStanja"=>$nazivStanja,
            "stanja"=>$stanja, "slike"=>$slike, "opremaNekretnine"=>$opremaNekretnine]);
    }


    /**
     * Brise nekretninu iz baze podataka
     */
    public function obrisiNekretninu(){
        $idNekretnine = $this->request->getVar("id");
        $nm = new NekretninaModel();
        $pm = new ProdajeModel();
        $snm = new SlikeNekretninaModel();
        $iom = new ImaOpremaModel();
        $it = new ImaTagModel();
        $jo = new JeOmiljeniModel();

        $pm->where("idNekretnina", $idNekretnine)->delete();
        $snm->where("idNekretnina", $idNekretnine)->delete();
        $iom->where("idNekretnina", $idNekretnine)->delete();
        $it->where("idNekretnina", $idNekretnine)->delete();
        $jo->where("idNekretnina", $idNekretnine)->delete();
        $nm->delete($idNekretnine);
        return $this->mojiOglasi();

    }


    /**
     * Vraca predlog cene za novu nekretninu
     */
    public function predlogCene(){
        $grad = $this->request->getVar("grad");
        $nm = new NekretninaModel();
        $query = $nm->selectAvg("cena")->where("grad", $grad)->get();
        $row = $query->getRow();
        $predlogCene = $row->cena;
        if($predlogCene==0) $predlogCene = "Ne postoji dovoljno podataka u bazi.";
        else $predlogCene = $predlogCene."€";
        $tipovi = (new TipModel())->findAll();
        $stanja = (new StanjeModel())->findAll();
        $grejanja = (new GrejanjeModel())->findAll();
        $msg["tipovi"] = $tipovi;
        $msg["stanja"] = $stanja;
        $msg["grejanja"] = $grejanja;
        $msg["predlogCene"] = $predlogCene;
        echo view('static/headerUser');
        echo view('user/oglasiNekretninu', $msg);

    }

    public function get_nekretnine(){
        try{
            $search = $this->request->getVar("keyword");

            $user = $this->session->get('user');
            $idKorisnik = $user->idKorisnik;


            $nekretninaModel = new NekretninaModel();
            $tagModel = new TagModel();
            $imaTagModel = new ImaTagModel();

            if($search == ""){
                $nekretnine = $nekretninaModel->findAll();
            }else{
                $nekretnine = $nekretninaModel->findByDesc($search);
            }
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
            $prodajeModel = new ProdajeModel();
            $without = [];
            foreach ($nekretnine as $nekretnina){
                $idNekretnina = $nekretnina->idNekretnina;
                $prodaja = $prodajeModel->where('idNekretnina', $idNekretnina)
                    ->where('idKorisnik', $idKorisnik)->first();

                if($prodaja == null){
                    $without[] = $nekretnina;
                }
            }
            return $this->generateHtmlCode($without, "Login");
        }catch (\Exception $e){
            $file = $e->getTrace()[0]['file'];
            $line = $e->getTrace()[0]['line'];
            echo "Error occurred in file: $file, line: $line";
        }
    }


}