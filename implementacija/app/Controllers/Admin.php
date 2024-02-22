<?php
/**
 * AUTORI:
 * Sofija Markovic ms200350d@student.etf.bg.ac.rs
 * Petar Markovic mp200122d@student.etf.bg.ac.rs
 * Bogdan Mihajlovic mb200207d@student.etf.bg.ac.rs
 */
namespace App\Controllers;

use App\Models\KorisnikModel;
use App\Models\ZahtevModel;
use PHPMailer\PHPMailer\PHPMailer;

class Admin extends BaseController
{
    /**
     * Pocetna stranica
     */
    public function index(){
        $zm = new ZahtevModel();
        $zahtevi = $zm->findAll();
        return view("admin/index", ["zahtevi"=>$zahtevi]);
    }

    /**
     * Odobrava kreiranje korisnickog naloga i dodaje ga u bazu podataka
     */
    public function odobri(){
        $zm = new ZahtevModel();
        $id = $this->request->getVar("zahtev");
        $zahtev = $zm->where("idZahtev", $id)->findAll()[0];
        $km = new KorisnikModel();
        $km->save([
            'ime_prezime' => $zahtev->ime_prezime,
            'email' => $zahtev->email,
            'telefon' => $zahtev->telefon,
            'username' => $zahtev->username,
            'password' => $zahtev->password
        ]);
        $zm->delete($id);
        return $this->index();
    }

    /**
     * Odbija kreiranje korisnickog
     */
    public function odbij(){
        $zm = new ZahtevModel();
        $id = $this->request->getVar("zahtev");
        $zahtev = $zm->where("idZahtev", $id)->findAll()[0];
        $zm->delete($id);
        return $this->index();
    }
}