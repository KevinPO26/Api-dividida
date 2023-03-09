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
    
    case 'POST':
        require_once 'conexion.php';
        switch($resourceType){
            case 'books':

                $q = 'INSERT INTO books(titulo, id_autor, id_genero) VALUES ("' . $_POST['titulo'] . '",' . $_POST['id_autor'] . ',' . $_POST['id_genero'] . ')';
                $query = mysqli_query($con, $q);

                if($query == true){
                    echo 'Libro guardado correctamente';
                }else{
                    echo 'Error al guardar';
                }
                break;
            case 'authors':
                $q = 'INSERT INTO authors(nombres, Apellidos) VALUES ("' . $_POST['nombres'] . '","' . $_POST['Apellidos'] . '")';
                $query = mysqli_query($con, $q);

                if($query == true){
                    echo 'Autor guardado correctamente';
                }else{
                    echo 'Error al guardar';
                }
                break;
            case 'genres':
                $q = 'INSERT INTO genres(nombre) VALUES ("' . $_POST['nombre'] . '")';
                $query = mysqli_query($con, $q);

                if($query == true){
                    echo 'Genero guardado correctamente';
                }else{
                    echo 'Error al guardar';
                }
                break;
        }
        break;
   
}