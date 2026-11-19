<?php
session_start();

// Valores por defecto
$controlador = "cHorario";
$metodo = "ver";

// Lee el controlador y el método de la URL
if (isset($_GET["controlador"]) && isset($_GET["metodo"])) {
    $controlador = $_GET["controlador"];
    $metodo = $_GET["metodo"];
}

// Comprueba que la ruta esté permitida
$valido = false;

if ($controlador == "cHorario" && $metodo == "ver") {
    $valido = true;
}

if ($controlador == "cSesion" && $metodo == "iniciar") {
    $valido = true;
}

if ($controlador == "cAsignatura" && (
    $metodo == "alta" ||
    $metodo == "guardar" ||
    $metodo == "baja" ||
    $metodo == "borrar"
)) {
    $valido = true;
}

// Si la ruta no es válida, muestra el horario
if ($valido == false) {
    $controlador = "cHorario";
    $metodo = "ver";
}

// Carga y crea el controlador
require_once "Controladores/" . $controlador . ".php";
$objeto = new $controlador();

// Ejecuta el método y recoge los datos para la vista
$datos = $objeto->$metodo();

// Carga la vista indicada por el controlador
require "Vista/" . $objeto->vista;