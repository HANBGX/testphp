<?php

require_once __DIR__ . '/vendor/autoload.php';

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

$app = new \Slim\App();

// Add route callbacks
$app->get('/', function ($request, $response, $args) {

//    $conn = new mysqli('b-x90akuqk2xpfn7.bch.rds.hkg.baidubce.com', 'b_x90akuqk2xpfn7', 'handaye123', 'b_x90akuqk2xpfn7');
    $conn = new mysqli('localhost', 'root', 'admin1', 'world');
    $conn->set_charset("utf8");

//    $sql = "select * from country";
    $sql = "show tables";

    $result = $conn->query($sql);
    $arr = [];
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $arr[] = $row;
    }

    return $response->withStatus(200)->withJson($arr);
});

// Run application
$app->run();