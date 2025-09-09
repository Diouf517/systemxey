<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html"); // Redirige vers la page de connexion
    exit();
}

// Connexion à la base de données
$host = "localhost";
$user = "root";
$pass = "";
$db = "systemxey";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("⚠️ Connexion échouée : " . $conn->connect_error);
}

// Récupérer les informations de l'utilisateur
$user_id = $_SESSION["user_id"];
$sql = "SELECT name, role FROM users WHERE id='$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $name = $user["name"];
    $role = $user["role"];
} else {
    $name = "Utilisateur";
    $role = "Indéfini";
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SystemXëy</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <h1>Bienvenue, <?php echo htmlspecialchars($name); ?> !</h1>
        <p>Votre rôle : <?php echo ucfirst(htmlspecialchars($role)); ?></p>
        <a href="logout.php"><button>Se déconnecter</button></a>
    </header>

    <main>
        <h2>Tableau de bord</h2>
        <p>Accédez à vos fonctionnalités :</p>
        <ul>
            <li><a href="#">Modifier votre profil</a></li>
            <li><a href="#">Consulter les offres</a></li>
            <li><a href="#">Messagerie</a></li>
        </ul>
    </main>
</body>
</html>
