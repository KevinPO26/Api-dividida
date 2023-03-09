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
    
    case 'DELETE':
        require_once 'conexion.php';
        switch($resourceType){
            case 'books':
                $q = 'DELETE FROM books WHERE id=' . $resourceId;
                $query = mysqli_query($con, $q);

                if($query == true){
                    echo 'Libro eliminado correctamente';
                }else{
                    echo 'Error al eliminar';
                }
                break;
            
            case 'authors':
                $q = 'DELETE FROM authors WHERE id=' . $resourceId;
                $query = mysqli_query($con, $q);

                if($query == true){
                    echo 'Autor eliminado correctamente';
                }else{
                    echo 'Error al eliminar';
                }
                break;
            case 'genres':
                $q = 'DELETE FROM genres WHERE id=' . $resourceId;
                $query = mysqli_query($con, $q);

                if($query == true){
                    echo 'Genero eliminado correctamente';
                }else{
                    echo 'Error al eliminar';
                }
                break;
        }
        break;
}