<?php

use App\Model\Items;
    
$app->get('/articulos/{nit}/{pagina}/{cantidad}', function ($req, $res, $args) {
    $oRes = new Items();
    
    return $res
        ->withJson(
            $oRes->GetArticulo($args['nit'], $args['pagina'], $args['cantidad'])
        );
});

$app->get('/articulos/{nit}', function ($req, $res, $args) {
    $oRes = new Items();
    
    return $res
        ->withJson(
            $oRes->CountArticulo($args['nit'])
        );
});

$app->get('/grupoArticulos/{nit}/{pagina}/{cantidad}', function ($req, $res, $args) {
    $oRes = new Items();
    
    return $res
        ->withJson(
            $oRes->GetGruposArticulo($args['nit'], $args['pagina'], $args['cantidad'])
        );
});

$app->get('/grupoArticulos/{nit}', function ($req, $res, $args) {
    $oRes = new Items();
    
    return $res
        ->withJson(
            $oRes->CountGruposArticulo($args['nit'])
        );
});