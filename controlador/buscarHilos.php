<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include ("../modelo/DB.php");
session_start();

$categoria = $_REQUEST['categoria'];
$creador = $_REQUEST['creador'];
$asunto = $_REQUEST['asunto'];
$likes1 = $_REQUEST['likes1'];
$likes2 = $_REQUEST['likes2'];
$query = "select * from hilo";
$primer = true;

if($categoria != ""){
    
    if($primer == true){
        
        $query .= " where categoria = '$categoria'";
        
        $primer = false;
    }else{
        
        $query .= " and categoria = '$categoria'";
        
    }
    
}
if($creador != ""){
    
    if($primer == true){
        
         $query .= " where admin = '$creador'";
        
        $primer = false;
    }else{
        
        $query .= " and admin = '$creador'";
       
        
    }
    
}
if($asunto != ""){
    
    if($primer == true){
        
         $query .= " where asunto LIKE '%$asunto%'";
        
        $primer = false;
    }else{
        
        $query .= " and asunto LIKE '%$asunto%'";
       
    };
    
}
if($likes1 != ""){
    
    if($primer == true){
        
        $query .= " where likes > '$likes1'";

        $primer = false;
    }else{
        
        $query .= " and likes > '$likes1'";
        
    }
    
}
if($likes2 != ""){
    
    if($primer == true){
        
        $query .= " where likes > '$likes2'";

        $primer = false;
    }else{
        
        $query .= " and likes < '$likes2'";
        
    }
    
}

$hilos = buscarHilo($mysqli, $query);
$_SESSION['hilosBuscados'] = $hilos;
header('Location: ../vista/buscarHilosForm.php');