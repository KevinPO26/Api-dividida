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
    case 'GET':
        require_once 'conexion.php';
        $json= array();
        
        switch($resourceType){
            case 'books':
                if($resourceId != ''){
                    $q = 'SELECT * FROM books WHERE id =' . $resourceId;
                    $query = mysqli_query($con, $q);
                }else{
                    $q = 'SELECT * FROM books';
                    $query = mysqli_query($con, $q);
                }

                while($row = $query->fetch_array()){
                    $json[] = array('id'=> $row['id'], 'titulo'=>$row['titulo'], 'id_autor'=>$row['id_autor'], 'id_genero'=>$row['id_genero']);
                }
                break;
            case 'authors':
                if($resourceId != ''){
                    $q = 'SELECT * FROM authors WHERE id =' . $resourceId;
                    $query = mysqli_query($con, $q);
                }else{
                    $q = 'SELECT * FROM authors';
                    $query = mysqli_query($con, $q);
                }

                while($row = $query->fetch_array()){
                    $json[] = array('id'=> $row['id'], 'nombres'=>$row['nombres'], 'Apellidos'=>$row['Apellidos']);
                }
                break;
            case 'genres':
                if($resourceId != ''){
                    $q = 'SELECT * FROM genres WHILE id=' . $resourceId;
                    $query = mysqli_query($con, $q);
                }else{
                    $q = 'SELECT * FROM genres';
                    $query = mysqli_query($con, $q);
                }

                while($row = $query->fetch_array()){
                    $json[] = array('id'=>$row['id'], 'nombre'=>$row['nombre']);
                }
                break;
        }
        echo json_encode($json);
        break;
    }