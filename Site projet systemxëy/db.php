<?php
$host = "localhost"; // Change si base en ligne
$user = "root"; // Ton identifiant MySQL
$pass = ""; // Ton mot de passe MySQL (par défaut vide sur XAMPP)
$db = "systemxey";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
} else {
    echo "Connexion réussie à la base de données !";
}
?>
