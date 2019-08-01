<?php

require_once __DIR__ . '/vendor/autoload.php';

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

$app = new \Slim\App();

class api
{
    private function conn()
    {
        //    $conn = new mysqli('b-x90akuqk2xpfn7.bch.rds.hkg.baidubce.com', 'b_x90akuqk2xpfn7', 'handaye123', 'b_x90akuqk2xpfn7');
        $conn = new mysqli('localhost', 'root', 'admin1', 'geodb');
        $conn->set_charset("utf8");
        return $conn;
    }

    private function getSQL($type, $param)
    {
        switch ($type) {
            case 'createJSON':
                return "create table json( Id int  primary key auto_increment,  Name varchar(255), Description varchar(255),Lat decimal(9, 7),Lng decimal(10, 7))";
            case 'insert':
                $Name = $param->Name;
                $Description = $param->Description;
                $Lat = $param->Lat;
                $Lng = $param->Lng;
                return "insert into json values (0,'$Name','$Description','$Lat','$Lng')";
            case 'get':
                return "select * from json where id = $param";
            case 'checkExist':
                return "select TABLE_NAME  from information_schema.TABLES where TABLE_SCHEMA ='geodb' and TABLE_NAME = '$param'";
            default:
                return "";
        }

    }

    public function test($param)
    {
        return $param->Lat;
    }

    public function insert($param)
    {

        return $this->conn()->query($this->getSQL('insert', $param));
    }

    public function createJSON()
    {
        return $this->conn()->query($this->getSQL('createJSON', null));
    }

    public function get($id)
    {
        return $this->conn()->query($this->getSQL('get', $id));
    }

    public function checkExist($tableName)
    {
        $this->conn()->query($this->getSQL('checkExist', $tableName));
    }
}

$app->get('/', function ($request, $response, $args) {
//    $param = (object)array(
//        'Lat' => $args->lat,
//        'Lng' => $args->lng,
//        'Name' => "asdsadsa",
//        'Description' => "this is a test latlng"
//    );
//    $result = (new api)->insert($param);

    return $response->withStatus(200)->write('han');
});

// Run application
$app->run();