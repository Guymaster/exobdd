<?php include("conn/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include './templates/header.php'; ?>
    <main>
        <?php
            require "conn/config.php";
            $success = null;
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
        <h2>Liste des utilisateurs</h2>
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
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <?php include './templates/footer.php'; ?>
</body>
</html>