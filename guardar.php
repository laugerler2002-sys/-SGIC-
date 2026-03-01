<?php
$conexion = new mysqli("localhost", "root", "", "census_system");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$nombre    = trim($_POST['nombre']);
$edad      = trim($_POST['edad']);
$fecha_nac = trim($_POST['fecha_nacimiento']);
$telefono  = trim($_POST['telefono']);
$direccion = trim($_POST['direccion']);

function redirigirConError($mensaje) {
    header("Location: index.php?status=error&msg=" . urlencode($mensaje));
    exit();
}

if ($nombre === "" || $edad === "" || $fecha_nac === "" || $telefono === "" || $direccion === "") {
    redirigirConError("Todos los campos son obligatorios.");
}

if (!is_numeric($edad) || $edad <= 0) {
    redirigirConError("La edad debe ser un número positivo.");
}

$anio = date('Y', strtotime($fecha_nac));
$anioActual = date("Y");

if ($anio < 1900 || $anio > $anioActual) {
    redirigirConError("La fecha de nacimiento no es válida.");
}

if (!preg_match("/^[0-9]{10}$/", $telefono)) {
    redirigirConError("El teléfono debe contener exactamente 10 números.");
}

$sql = "INSERT INTO people (nombre, edad, anio_nacimiento, telefono, direccion)
        VALUES ('$nombre', '$edad', '$anio', '$telefono', '$direccion')";

if ($conexion->query($sql) === TRUE) {
    header("Location: index.php?status=success");
} else {
    redirigirConError("Error al guardar: " . $conexion->error);
}

$conexion->close();
?>