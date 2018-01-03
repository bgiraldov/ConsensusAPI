<?php

use App\Model\BusinessPartners;
    
$app->get('/socios/{nit}/{pagina}/{cantidad}', function ($req, $res, $args) {
    $oRes = new BusinessPartners();
    
    return $res
        ->withJson(
            $oRes->Get($args['nit'], $args['pagina'], $args['cantidad'])
        );
});

$app->get('/socios/{nit}', function ($req, $res, $args) {
    $oRes = new BusinessPartners();
    
    return $res
        ->withJson(
            $oRes->Count($args['nit'])
        );
});

$app->post('/socios/{nit}', function ($req, $res, $args) {
    $oRes = new BusinessPartners();
    
    return $res
        ->withJson(
            $oRes->Post($args['nit'], $req->getParsedBody())
        );
});

$app->patch('/socios/{nit}', function ($req, $res, $args) {
    $oRes = new BusinessPartners();
    
    return $res
        ->withJson(
            $oRes->Update($args['nit'], $req->getParsedBody())
        );
});