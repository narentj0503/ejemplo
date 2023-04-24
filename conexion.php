<?php
//en todas las conexiones se necesitan los siguientes campos
//1.localhost => servidor
//2.usuario de la base de datos, si no hay in usuario programado por defecto es root(publico)
//3.contraseña de la base de datos,si no hay contraseña este campo se deja vacio
//4.el nombre de la base de datos que se va a utilizar

//declarar las variables que se necesitan para crear una conexion

$servidor="localhost";
$usuario="root";
$password="";
$basededatos="db_primera_base";

//crear la conexion por medio de un objeto de una clase de php que ya esta programada para generar una conexion, es una clase
//establecida dese el mismo lenguaje php

$conexion= new mysqli($servidor,$usuario,$password,$basededatos);//YA TENEMOS LISTA LA CONEXION

//comprobar si existe un error a  la hora de conectar a la base de datos
//asi mismo si hay un error,vamos a romper esa conexion para que el navegador no se quede intentando buscar esa conexion

if($conexion->connect_errno)
{
    //conect_errno verifica errores de conectividad
    echo"nuestra conexion presenta fallas";
    //cerrar la conexion
    exit();
}
?>