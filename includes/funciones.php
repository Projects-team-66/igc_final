<?php

function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) {
    $s = htmlspecialchars($html);
    return $s;
}

// SI NO ESTA INICIADA LA SESION ESTA MANDA A LA RAIZ
function isAuth() {
    if(!isset($_SESSION['user'])) {
        header('Location: /igc_final');
    }
}

function isAuthApi() {
    getHeadersApi();
    session_start();
    if(!isset($_SESSION['user'])) {
        echo json_encode([    
            "mensaje" => "No esta autenticado",

            "codigo" => 4,
        ]);
        exit;
    }
}
//SI ESTA SE ACTIVA SIGNIFICA QUE ESTAMOS LOGEADOS
function isNotAuth(){
    if(isset($_SESSION['user'])) {
        header('Location: menu');
    }
}


function hasPermission(array $permisos){

    $comprobaciones = [];
    foreach ($permisos as $permiso) {

        $comprobaciones[] = !isset($_SESSION[$permiso]) ? false : true;
      
    }

    if(array_search(true, $comprobaciones) !== false){}else{
        header('Location: /');
    }
}

function hasPermissionApi(array $permisos){
    getHeadersApi();
    $comprobaciones = [];
    foreach ($permisos as $permiso) {

        $comprobaciones[] = !isset($_SESSION[$permiso]) ? false : true;
      
    }

    if(array_search(true, $comprobaciones) !== false){}else{
        echo json_encode([     
            "mensaje" => "No tiene permisos",

            "codigo" => 4,
        ]);
        exit;
    }
}

function getHeadersApi(){
    return header("Content-type:application/json; charset=utf-8");
}

function asset($ruta){
    return "/". $_ENV['APP_NAME']."/public/" . $ruta;
}