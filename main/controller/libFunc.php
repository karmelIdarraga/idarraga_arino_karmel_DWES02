<?php
//  Constantes para probar en local
//define('FICHERO', '../../resources/datos.json');

// Constantes cuando se prueba desde el index.php
define('FICHERO', 'resources/datos.json');

// Variables
$path = FICHERO;
$jsonString = file_get_contents($path);
$datos = json_decode($jsonString,true);

//print_r($datos);

function validate_DNI ($dni){
    $letras = array('T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E');
    $letra = substr($dni, -1);
    $numero = substr($dni, 0, -1);

    $pos = $numero % 23;
    if ($letras[$pos] == $letra){
        return true;
    }else {
        return false;
    }    
}


function calcular_letra_DNI ($dni){
    $letras = array('T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E');
    $numero = substr($dni, 0, -1);

    $pos = $numero % 23;
    return $letras[$pos];
}

/* $es_dni_valido = validate_DNI ('16071765p');
if ($es_dni_valido){
    echo "El DNI es correcto"; 
} else {
    echo "El DNI es incorrecto";
} */

function comprobar_libro ($id_libro, $fecha_solicitud, $datos){
    $libre = false;
    $fecha_devolucion = $fecha_solicitud;
    foreach ($datos[0]['libros'] as $libro) {
        if ($libro['ID_Libro']==$id_libro){
            $libre = $libro['Libre'];
            break;
        }
    }
    if (!$libre){
        foreach ($datos[0]['usuarios'] as $usuario) {
            foreach ($usuario['Alquileres'] as $alquiler) {
                if ($alquiler['ID_Libro']==$id_libro && is_null($alquiler['Fecha_devolucion'])){
                    $fecha_solicitud_libro = strtotime($alquiler['Fecha_alquiler']);
                    $fecha_devolucion = strtotime("+10 days", $fecha_solicitud_libro);
                    break;
                }
            }
        }
    }
    return $fecha_devolucion;
}

?>