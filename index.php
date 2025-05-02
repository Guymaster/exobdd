<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
    <?php include './templates/header.php'; ?>
    <main>
        <ul>
            <li>
                <a href="creer.php">
                    <strong>Création</strong>
                </a>
                - Ajouter un utilisateur
            </li>
            <li>
                <a href="lecture.php">
                    <strong>Rechercher</strong>
                </a>
                - Rechercher un utilisateur
            </li>
            <li>
                <a href="miseajour.php">
                    <strong>Mise à jour</strong>
                </a>
                - Modifier un utilisateur
            </li>
            <li>
                <a href="supprimer.php">
                    <strong>Suppression</strong>
                </a>
                - Supprimer un utilisateur
            </li>
            <li>
                <a href="liste.php">
                    <strong>Liste</strong>
                </a>
                - Liste des utilisateurs
            </li>
        </ul>
    </main>
    <?php include './templates/footer.php'; ?>
</body>
</html>