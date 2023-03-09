<?php

//Definimos los recursos disponibles
$allowedResourceTypes = [
          'books',
          'authors',
          'genres',
        ];

//Validamos que el recurso esté disponible
$resourceType = $_GET['resourceType'];

if(!in_array($resourceType, $allowedResourceTypes)){
    die;
}

header('Content-Type: application/json');

$resourceId = array_key_exists('resource_id', $_GET) ? $_GET['resource_id'] : '';

//Generamos la respuesta asumiendo que el pedido es correcto
switch(strtoupper($_SERVER['REQUEST_METHOD'])){
    
    case 'PUT':
        require_once 'conexion.php';
        switch($resourceType){
            case 'books':
                $titulo = $_GET['titulo'];
                $id_autor = $_GET['id_autor'];
                $id_genero = $_GET['id_genero'];
    
    
                $q = "UPDATE books SET titulo= '$titulo', id_autor= '$id_autor', id_genero= '$id_genero' WHERE id=$resourceId";
                $query = mysqli_query($con, $q);
    
                if($query == true){
                    echo 'Libro actualizado correctamente';
                }else{
                    echo 'Error al actualizar';
                }
                break;
            case 'authors':
                $nombres = $_GET['nombres'];
                $apellidos = $_GET['Apellidos'];
        
        
                $q = "UPDATE authors SET nombres= '$nombres', Apellidos= '$apellidos' WHERE id=$resourceId";
                $query = mysqli_query($con, $q);
        
                if($query == true){
                    echo 'Actor actualizado correctamente';
                 }else{
                    echo 'Error al actualizar';
                }
                break;

            case 'genres':
                $nombre = $_GET['nombre'];
                $q = "UPDATE genres SET nombre= '$nombre' WHERE id=$resourceId";
                $query = mysqli_query($con, $q);
        
                if($query == true){
                    echo 'Genero actualizado correctamente';
                 }else{
                    echo 'Error al actualizar';
                }
                break;
        }
        break;
        

       
    
}