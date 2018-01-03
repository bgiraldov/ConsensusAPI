<?php

use App\Model\SalesPerson;
    
$app->get('/vendedores/{nit}/{pagina}/{cantidad}', function ($req, $res, $args) {
    $oRes = new SalesPerson();
    
    return $res
        ->withJson(
            $oRes->Get($args['nit'], $args['pagina'], $args['cantidad'])
        );
});

$app->get('/vendedores/{nit}', function ($req, $res, $args) {
    $oRes = new SalesPerson();
    
    return $res
        ->withJson(
            $oRes->Count($args['nit'])
        );
});