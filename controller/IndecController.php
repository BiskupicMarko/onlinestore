<?php

class IndexController extends Controller
{

    public function prijava()
    {
        $this->view->render('prijava',[
            'poruka'=>'Unesite pristupne podatke',
            'email'=>''
        ]);
    }

    public function era()
    {
        $this->view->render('era');
    }

    public function autorizacija()
    {
        if(!isset($_POST['email']) || 
        !isset($_POST['lozinka'])){
            $this->view->render('prijava',[
                'poruka'=>'Nisu postavljeni pristupni podaci',
                'email' =>''
            ]);
            return;
        }

        if(trim($_POST['email'])==='' || 
        trim($_POST['lozinka'])===''){
            $this->view->render('prijava',[
                'poruka'=>'Pristupni podaci obavezno',
                'email'=>$_POST['email']
            ]);
            return;
        }

        $veza = DB::getInstanca();

        $izraz = $veza->prepare('select * from operater 
                      where email=:email and aktivan=true;');
        $izraz->execute(['email'=>$_POST['email']]);
        $rezultat=$izraz->fetch();
        if($rezultat==null){
            $this->view->render('prijava',[
                'poruka'=>'Ne postojeći korisnik',
                'email'=>$_POST['email']
            ]);
            return;
        }

        if(!password_verify($_POST['lozinka'],$rezultat->lozinka)){
            $this->view->render('prijava',[
                'poruka'=>'Neispravna kombinacija email i lozinka',
                'email'=>$_POST['email']
            ]);
            return;
        }
        unset($rezultat->lozinka);
        $_SESSION['operater']=$rezultat;
        $npc = new NadzornaplocaController();
        $npc->index();
    }

    public function odjava()
    {
        unset($_SESSION['operater']);
        session_destroy();
        $this->index();
    }

    public function index()
    {
            $this->view->render('pocetna',[
            'javascript'=>'<script src="' . APP::config('url') . 
            'public/js/pocetna.js"></script>'
        ]
        );


    }

    public function registracija()
    {
        $this->view->render('registracija');
    }
    public function onama()
    {
        $this->view->render('onama');
    }

    public function json()
    {
        $niz=[];
        $s=new stdClass();
        $s->naziv='PHP programiranje';
        $s->sifra=1;
        $niz[]=$s;
        echo json_encode($niz);
    }

    public function gost()
    {
        $gost=Operater::read(1);
        $_SESSION['operater']=$gost;
        $npc = new NadzornaplocaController();
        $npc->index();
    } 

    public function test()
    {
     echo password_hash('e',PASSWORD_BCRYPT);
    } 

    
    public function registrirajnovi()
    {
        Operater::registrirajnovi();
        $this->view->render('registracijagotova');
    }

    
    public function zavrsiregistraciju()
    {
        Operater::zavrsiregistraciju($_GET['id']);
        $this->view->render('prijava');
    }

    public function email()
    {
        $headers = "From: Tomislav Jakopec <cesar@lin39.mojsite.com>\r\n";
$headers .= "Reply-To: Tomislav Jakopec <cesar@lin39.mojsite.com>\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail('tjakopec@gmail.com','Test','Test poruka <a href="http://predavac01.edunova.hr/">Edunova APP</a>', $headers);
        echo 'GOTOV';
    } 

}