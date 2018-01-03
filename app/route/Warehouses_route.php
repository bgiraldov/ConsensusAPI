<?php

use App\Model\Warehouses;
    
$app->get('/bodegas/{nit}/{pagina}/{cantidad}', function ($req, $res, $args) {
    $oRes = new Warehouses();
    
    return $res
        ->withJson(
            $oRes->Get($args['nit'], $args['pagina'], $args['cantidad'])
        );
});

$app->get('/bodegas/{nit}', function ($req, $res, $args) {
    $oRes = new Warehouses();
    
    return $res
        ->withJson(
            $oRes->Count($args['nit'])
        );
});