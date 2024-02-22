DROP TABLE IF EXISTS zahtev;

CREATE TABLE zahtev (
                        idZahtev INTEGER PRIMARY KEY AUTOINCREMENT,
                        ime_prezime TEXT,
                        email TEXT,
                        username TEXT,
                        password TEXT,
                        telefon TEXT
);

DROP TABLE IF EXISTS korisnik;

CREATE TABLE korisnik (
                          idKorisnik INTEGER PRIMARY KEY AUTOINCREMENT,
                          ime_prezime TEXT,
                          email TEXT,
                          username TEXT,
                          password TEXT,
                          telefon TEXT,
                          isAdmin BOOLEAN DEFAULT 0
);

DROP TABLE IF EXISTS tip;

CREATE TABLE tip (
                     idTip INTEGER PRIMARY KEY AUTOINCREMENT,
                     naziv TEXT
);

DROP TABLE IF EXISTS grejanje;

CREATE TABLE grejanje (
                          idGrejanja INTEGER PRIMARY KEY AUTOINCREMENT,
                          naziv TEXT
);

DROP TABLE IF EXISTS prodaje;

CREATE TABLE prodaje (
                         idKorisnik INTEGER,
                         idNekretnina INTEGER
);

DROP TABLE IF EXISTS nekretnina;

CREATE TABLE nekretnina(
                           idNekretnina INTEGER PRIMARY KEY AUTOINCREMENT,
                           idTip INTEGER,
                           idStanja INTEGER,
                           kvadratura INTEGER,
                           drzava TEXT,
                           grad TEXT,
                           opstina TEXT,
                           adresa TEXT,
                           idGrejanja INTEGER,
                           opis TEXT,
                           broj_soba INTEGER,
                           cena REAL

);

DROP TABLE IF EXISTS ima_oprema;

CREATE TABLE ima_oprema (
                            idNekretnina INTEGER,
                            idOprema INTEGER
);

DROP TABLE IF EXISTS ima_tag;

CREATE TABLE ima_tag (
                         idTag INTEGER,
                         idNekretnina INTEGER
);

DROP TABLE IF EXISTS je_omiljeni;

CREATE TABLE je_omiljeni (
                             idKorisnik INTEGER,
                             idNekretnina INTEGER
);

DROP TABLE IF EXISTS oprema;

CREATE TABLE oprema (
                        idOprema INTEGER PRIMARY KEY AUTOINCREMENT,
                        naziv TEXT
);

DROP TABLE IF EXISTS slike_nekretnina;

CREATE TABLE slike_nekretnina (
                                  idSlika INTEGER PRIMARY KEY AUTOINCREMENT,
                                  idNekretnina INTEGER,
                                  slika BLOB
);

DROP TABLE IF EXISTS stanje;

CREATE TABLE stanje (
                        idStanja INTEGER PRIMARY KEY AUTOINCREMENT,
                        naziv TEXT
);

DROP TABLE IF EXISTS tag;

CREATE TABLE tag (
                     idTag INTEGER PRIMARY KEY AUTOINCREMENT,
                     naziv TEXT
);