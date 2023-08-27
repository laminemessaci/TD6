<?php
require_once(__DIR__ . '/../../config/db_connect.php');
require_once(__DIR__ . '/../../includes/header.php');

?>



<!DOCTYPE html>
<html>

<head>
    <title>Modifier un Stagiaire</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2>Modifier un Stagiaire</h2>
        <hr>
        <?php



        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $formateur = $_POST['formateur'];
                $salle = $_POST['salle'];
                $type_formation = $_POST['type_formation'];

                $query = "UPDATE eleve SET nom = :nom, prenom = :prenom, formateur = :formateur, salle = :salle, type_formation = :type_formation WHERE id = :id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':formateur', $formateur);
                $stmt->bindParam(':salle', $salle);
                $stmt->bindParam(':type_formation', $type_formation);
                $stmt->execute();

                echo '<div class="alert alert-success">Stagiaire modifié avec succès!</div>';
            }


            $query = "SELECT * FROM eleve WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stagiaire = $stmt->fetch(PDO::FETCH_ASSOC);

            // Affichage du formulaire de modification avec les données actuelles
            echo '<form action="" method="post">
                    <input type="hidden" name="id" value="' . $id . '">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="' . $stagiaire['nom'] . '">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="' . $stagiaire['prenom'] . '">
                    </div>
                    <div class="form-group">
                        <label for="formateur">Formateur</label>
                        <input type="text" class="form-control" id="formateur" name="formateur" value="' . $stagiaire['formateur'] . '">
                    </div>
                    <div class="form-group">
                        <label for="salle">Salle</label>
                        <input type="text" class="form-control" id="salle" name="salle" value="' . $stagiaire['salle'] . '">
                    </div>
                    <div class="form-group">
                        <label for="type_formation">Type de Formation</label>
                        <input type="text" class="form-control" id="type_formation" name="type_formation" value="' . $stagiaire['type_formation'] . '">
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>';


            $conn = null;
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>