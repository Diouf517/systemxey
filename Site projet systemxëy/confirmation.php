<?php
session_start(); // Démarrer la session

// Connexion à la base de données
$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$db = "systemxey"; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("⚠️ Connexion échouée : " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Sécurisation du mot de passe
    $role = $_POST["userType"]; 

    // Vérifier si l'email existe déjà
    $checkEmail = $conn->query("SELECT id FROM users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        echo "⚠️ Cet email est déjà utilisé !";
        exit();
    }

    // Insertion des données dans la base
    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION["user_id"] = $conn->insert_id;
        $_SESSION["name"] = $name;
        $_SESSION["role"] = $role;

        header("Location: confirmation.php"); // Redirection après l'inscription
        exit();
    } else {
        echo "⚠️ Erreur lors de l'inscription : " . $conn->error;
    }
}

$conn->close();
?>
