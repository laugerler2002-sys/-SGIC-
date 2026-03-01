<?php
$conexion = new mysqli("localhost", "root", "", "census_system");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos
$nombre    = trim($_POST['nombre']);
$edad      = trim($_POST['edad']);
$fecha_nac = trim($_POST['fecha_nacimiento']); // Nueva variable para la fecha completa
$telefono  = trim($_POST['telefono']);
$direccion = trim($_POST['direccion']);

// Función para redirigir con error
function redirigirConError($mensaje) {
    header("Location: index.php?status=error&msg=" . urlencode($mensaje));
    exit();
}

// 1. Campos vacíos (Validamos que la fecha no venga vacía)
if ($nombre === "" || $edad === "" || $fecha_nac === "" || $telefono === "" || $direccion === "") {
    redirigirConError("Todos los campos son obligatorios.");
}

// 2. Edad positiva
if (!is_numeric($edad) || $edad <= 0) {
    redirigirConError("La edad debe ser un número positivo.");
}

// 3. Procesar Fecha y validar Año
// Convertimos la fecha (YYYY-MM-DD) a una marca de tiempo y extraemos solo el año
$anio = date('Y', strtotime($fecha_nac));
$anioActual = date("Y");

if ($anio < 1900 || $anio > $anioActual) {
    redirigirConError("La fecha de nacimiento no es válida.");
}

// 4. Teléfono EXACTAMENTE 10 números
if (!preg_match("/^[0-9]{10}$/", $telefono)) {
    redirigirConError("El teléfono debe contener exactamente 10 números.");
}

// Insertar datos
// Nota: Seguimos enviando '$anio' a la columna 'anio_nacimiento' para no romper tu tabla
$sql = "INSERT INTO people (nombre, edad, anio_nacimiento, telefono, direccion)
        VALUES ('$nombre', '$edad', '$anio', '$telefono', '$direccion')";

if ($conexion->query($sql) === TRUE) {
    // ÉXITO
    header("Location: index.php?status=success");
} else {
    // ERROR DE SQL
    redirigirConError("Error al guardar: " . $conexion->error);
}

$conexion->close();
?>