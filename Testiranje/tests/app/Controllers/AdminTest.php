<?php

namespace app\Controllers;

use App\Models\ZahtevModel;
use CodeIgniter\Test\ControllerTester;
use PHPUnit\Framework\TestCase;
use Tests\Support\DbTestCase;

class AdminTest extends DbTestCase
{
    use ControllerTester;

    protected $seed = 'Tests\Support\Database\Seeds\AdminSeeder';

    public function test_odbij_when_one_request(){
        $zahtev = 1;

        $result = $this->controller('\App\Controllers\Admin')->execute('index');

        $this->assertTrue($result->isOK()); // Assert that the response is successful (HTTP 200)

        $this->assertTrue($result->see('Odbij', 'button')); // Assert that the response contains the "Odbij" button

        // Simulate clicking the "Odbij" button by making a POST request to the appropriate URL
        $_REQUEST["zahtev"] = $zahtev;
        $result = $this->controller('\App\Controllers\Admin')->execute('odbij'); // Adjust the 'zahtev' parameter according to your scenario

        $model = new ZahtevModel();

        $entries = $model->findAll();

        $this->assertCount(1, $entries);

        unset($_REQUEST["zahtev"]);
    }


    public function test_odobri_when_one_request(){
        $zahtev = 2;

        $result = $this->controller('\App\Controllers\Admin')->execute('index');

        $this->assertTrue($result->isOK()); // Assert that the response is successful (HTTP 200)

        $this->assertTrue($result->see('Odbij', 'button')); // Assert that the response contains the "Odbij" button

        // Simulate clicking the "Odbij" button by making a POST request to the appropriate URL
        $_REQUEST["zahtev"] = $zahtev;
        $result = $this->controller('\App\Controllers\Admin')->execute('odobri'); // Adjust the 'zahtev' parameter according to your scenario

        $model = new ZahtevModel();

        $entries = $model->findAll();

        $this->assertCount(1, $entries);
        
        unset($_REQUEST["zahtev"]);
    }

    public function test_when_no_requests(){
        $results = $this->controller("\App\Controllers\Admin")->execute("index");

        $model = new ZahtevModel();

        $entries = $model->findAll();

        if(empty($entries)){
            $this->assertTrue($results->see("Nema novih zahteva!"));
        }
        else{
            $this->assertCount(2, $entries);
        }
    }
}