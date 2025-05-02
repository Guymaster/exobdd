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

        $sql = null;
        $result = null;

        if (isset($_POST['submit'])) {
            try {
                $connection = new PDO($dsn, $username, $password);
                $sql = "SELECT * FROM utilisateur WHERE id_uti = :id_uti";
                $id_uti = $_POST['id_uti'];
                $statement = $connection->prepare($sql);
                $statement->bindParam(':id_uti', $id_uti, PDO::PARAM_STR);
                $statement->execute();
                $result = $statement->fetchAll();
            } catch(PDOException $error) {
                echo $sql . "<br>". $error->getMessage();
            }
        }
        ?>

        <h2>Trouver un utilisateur à partir de son identifiant</h2>

        <form method="post">
            <label for="id_uti">Identifiant</label>
            <input type="text" id="id_uti" name="id_uti">
            <input type="submit" name="submit" value="View Results">
        </form>

        <?php if (isset($_POST['submit'])) : ?>
            <?php if ($result && $statement->rowCount() > 0) : ?>
                <h2>Résultats</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Nom</th>
                            <th>Prenom</th>
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
            <?php else : ?>
                <blockquote>Aucun résultat trouvé pour l'utilisateur N° <?php echo $_POST['id_uti']; ?>.</blockquote>
            <?php endif; ?>
        <?php endif; ?>
    </main>
    <?php include './templates/footer.php'; ?>
</body>
</html>