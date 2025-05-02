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

        if (isset($_POST["submit"])) {
            try {
                $connection = new PDO($dsn, $username, $password);
                $id = $_POST["submit"];
                $sql = "DELETE FROM utilisateur WHERE id_uti = :id";
                $statement = $connection->prepare($sql);
                $statement->bindValue(':id', $id);
                $statement->execute();
                $success = "Utilisateur supprimé avec succès";
            } catch(PDOException $error) {
                echo $sql . "<br>". $error->getMessage();
            }
        }

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

        <?php require "templates/header.php"; ?>
        <h2>Suppression d'utilisateur</h2>

        <?php if ($success) echo $success; ?>

        <form method="post">
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
                        <th>Supprimer</th>
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
                        <td><button type="submit" name="submit" value="<?php echo $row["id_uti"]; ?>">Supprimer</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </main>
    <?php include './templates/footer.php'; ?>
</body>
</html>