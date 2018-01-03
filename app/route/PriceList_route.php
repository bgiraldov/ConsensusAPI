<?php

use App\Model\PriceList;
    
$app->get('/listasPrecios/{nit}/{pagina}/{cantidad}', function ($req, $res, $args) {
    $oRes = new PriceList();
    
    return $res
        ->withJson(
            $oRes->Get($args['nit'], $args['pagina'], $args['cantidad'])
        );
});

$app->get('/listasPrecios/{nit}', function ($req, $res, $args) {
    $oRes = new PriceList();
    
    return $res
        ->withJson(
            $oRes->Count($args['nit'])
        );
});