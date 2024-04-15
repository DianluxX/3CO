<?php
// Validación de datos
if (!isset($_POST['nombre']) || !isset($_POST['dni']) || !isset($_POST['oficina']) || !isset($_POST['telefono'])) {
    die('Faltan campos requeridos');
}

$nombre = $_POST['nombre'];
$dni = $_POST['dni'];
$oficina = $_POST['oficina'];
$telefono = $_POST['telefono'];

// Validar que el DNI tenga 8 números
if (!preg_match('/^[0-9]{8}$/', $dni)) {
    die('El DNI debe tener exactamente 8 números');
}

// Validar que el número de oficina tenga 3 números
if (!preg_match('/^[0-9]{3}$/', $oficina)) {
    die('El número de oficina debe tener exactamente 3 números');
}

// Validar que el número de teléfono tenga 9 números
if (!preg_match('/^[0-9]{9}$/', $telefono)) {
    die('El número de teléfono debe tener exactamente 9 números');
}

// Sanitización de datos
$nombre = strip_tags($nombre);
$dni = strip_tags($dni);
$oficina = strip_tags($oficina);
$telefono = strip_tags($telefono);

// Crear una cadena con los datos del formulario
$datos = "Nombre: $nombre\nDNI: $dni\nOficina: $oficina\nTeléfono: $telefono\n";

// Añadir los datos al archivo .txt
file_put_contents('datos.txt', $datos, FILE_APPEND);
?>
