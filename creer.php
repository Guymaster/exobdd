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
                $nouvel_utilisateur = [
                    "nom_uti" => $_POST['nom_uti'],
                    "penom_uti" => $_POST['penom_uti'],
                    "email_uti" => $_POST['email_uti'],
                    "age_uti" => $_POST['age_uti'],
                    "genre_uti" => $_POST['genre_uti'],
                    "date" => $_POST['date']
                ];
                
                $sql = "INSERT INTO utilisateur (nom_uti, penom_uti, email_uti, age_uti, genre_uti, date) 
                        VALUES (:nom_uti, :penom_uti, :email_uti, :age_uti, :genre_uti, :date)";
                
                $statement = $connection->prepare($sql);
                $statement->execute($nouvel_utilisateur);
            } catch(PDOException $error) {
                echo $sql . "<br>". $error->getMessage();
            }
        }
        ?>

        <?php require "templates/header.php"; ?>

        <?php if (isset($_POST['submit']) && $statement) : ?>
            <blockquote><?php echo $_POST['nom_uti']; ?> ajouté avec succès.</blockquote>
        <?php endif; ?>

        <h2>Ajouter un utilisateur</h2>

        <form method="post">
            <label for="nom_uti">Nom</label>
            <input type="text" name="nom_uti" id="nom_uti">
            
            <label for="penom_uti">Prenoms</label>
            <input type="text" name="penom_uti" id="penom_uti">
            
            <label for="email_uti">Adresse mail</label>
            <input type="text" name="email_uti" id="email_uti">
            
            <label for="age_uti">Age</label>
            <input type="text" name="age_uti" id="age_uti">
            
            <label for="genre_uti">Genre</label>
            <input type="radio" name="genre_uti" id="genre_uti_m" value="M" checked>
            <label for="genre_uti_m">M</label>
            <input type="radio" name="genre_uti" id="genre_uti_f" value="F">
            <label for="genre_uti_f">F</label>
            
            <label for="date">Date</label>
            <input type="date" name="date" id="date">
            
            <input type="submit" name="submit" value="Submit">
        </form>
    </main>
    <?php include './templates/footer.php'; ?>
</body>
</html>