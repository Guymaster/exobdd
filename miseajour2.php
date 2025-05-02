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

        if (isset($_POST['submit'])) {
            try {
                $connection = new PDO($dsn, $username, $password);
                $user = [
                    "id_uti" => $_POST['id_uti'],
                    "nom_uti" => $_POST['nom_uti'],
                    "penom_uti" => $_POST['penom_uti'],
                    "email_uti" => $_POST['email_uti'],
                    "age_uti" => $_POST['age_uti'],
                    "genre_uti" => $_POST['genre_uti'],
                    "date" => $_POST['date']
                ];
                
                $sql = "UPDATE utilisateur
                        SET nom_uti = :nom_uti,
                            penom_uti = :penom_uti,
                            email_uti = :email_uti,
                            age_uti = :age_uti,
                            genre_uti = :genre_uti,
                            date = :date
                        WHERE id_uti = :id_uti";
                
                $statement = $connection->prepare($sql);
                $statement->execute($user);
            } catch(PDOException $error) {
                echo $sql . "<br>". $error->getMessage();
            }
        }

        if (isset($_GET['id_uti'])) {
            try {
                $connection = new PDO($dsn, $username, $password);
                $id_uti = $_GET['id_uti'];
                $sql = "SELECT * FROM utilisateur WHERE id_uti = :id_uti";
                $statement = $connection->prepare($sql);
                $statement->bindValue(':id_uti', $id_uti);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);
            } catch(PDOException $error) {
                echo $sql . "<br>". $error->getMessage();
            }
        } else {
            echo "Quelque chose a mal tourné!";
            exit;
        }
        ?>

        <?php require "templates/header.php"; ?>

        <?php if (isset($_POST['submit']) && $statement) : ?>
            <blockquote>Mise à jour avec succès.</blockquote>
        <?php endif; ?>

        <h2>Modifier un utilisateur</h2>

        <form method="post">
            <?php foreach ($user as $key => $value) : ?>
                <label for="<?php echo $key; ?>"><?php echo $key; ?></label>
                <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" 
                    value="<?php echo $value; ?>" <?php echo ($key == 'id_uti' ? 'readonly' : null); ?>>
            <?php endforeach; ?>
            <input type="submit" name="submit" value="Submit">
        </form>
    </main>
    <?php include './templates/footer.php'; ?>
</body>
</html>