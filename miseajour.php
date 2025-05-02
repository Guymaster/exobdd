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
    <?php
        require "conn/config.php";
        try {
            $connection = new PDO($dsn, $username, $password);
            $sql = "SELECT * FROM utilisateur";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
        } catch(PDOException $error) {
            echo $sql . "<br>". $error->getMessage();
        }
        ?>
        <h2>Mise à jour d'utilisateur</h2>
        <table>
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Nom</th>
                    <th>Prenoms</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Genre</th>
                    <th>Date</th>
                    <th>Modifier</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) : ?>
                <tr>
                    <td><?php echo $row["id_uti"]; ?></td>
                    <td><?php echo $row["nom_uti"]; ?></td>
                    <td><?php echo $row["penom_uti"]; ?></td>
                    <td><?php echo $row["email_uti"]; ?></td>
                    <td><?php echo $row["age_uti"]; ?></td>
                    <td><?php echo $row["genre_uti"]; ?></td>
                    <td><?php echo $row["date"]; ?></td>
                    <td><a href="miseajour2.php?id_uti=<?php echo $row["id_uti"]; ?>">Modifier</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
</table>
    </main>
    <?php include './templates/footer.php'; ?>
</body>
</html>