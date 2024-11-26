<?php
//Datos que requiere la base de Datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "papeleria_cetis84";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>