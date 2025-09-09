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
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Vérifier si l'utilisateur existe
    $sql = "SELECT id, name, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Vérification du mot de passe
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["name"] = $user["name"];

            header("Location: dashboard.php"); // Rediriger après connexion
            exit();
        } else {
            echo "<p style='color:red;'>⚠️ Mot de passe incorrect.</p>";
        }
    } else {
        echo "<p style='color:red;'>⚠️ Email non trouvé.</p>";
    }

    $stmt->close();
}

$conn->close();
?>
