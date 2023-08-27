<?php
require_once(__DIR__ . '/../../config/db_connect.php');
require_once(__DIR__ . '/../../includes/header.php');


if ($_POST) {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $nationalite = $_POST['nationalite'];
    $type_formation = $_POST['type_formation'];
    $formateur = $_POST['formateur'];
    $salle = $_POST['salle'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    $resultMessage = "";

    // Validation des champs
    if (
        strlen($nom) > 20 || strlen($prenom) > 10 || strlen($nationalite) > 20 || strlen($type_formation) > 50 ||
        strlen($formateur) > 15 || strlen($salle) > 10
    ) {

        $resultMessage = '<div id="resultMessage" class="alert alert-danger" role="alert">
                        Une erreur s\'est produite : Les champs ne doivent pas dépasser le nombre de caractères dédiés .
                      </div>';
        echo $resultMessage;
    } elseif (!filter_var($formateur, FILTER_VALIDATE_EMAIL)) {

        $resultMessage = '<div id="resultMessage" class="alert alert-danger" role="alert">
                        Une erreur s\'est produite : L\'adresse email du formateur n\'est pas valide
                      </div>';
        echo $resultMessage;
    } else {

        $query = "INSERT INTO eleve (nom, prenom, nationalite, type_formation, formateur, salle, date_debut, date_fin) 
              VALUES (:nom, :prenom, :nationalite, :type_formation, :formateur, :salle, :date_debut, :date_fin)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':nationalite', $nationalite);
        $stmt->bindParam(':type_formation', $type_formation);
        $stmt->bindParam(':formateur', $formateur);
        $stmt->bindParam(':salle', $salle);
        $stmt->bindParam(':date_debut', $date_debut);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();

        $resultMessage = '<div id="resultMessage" class="alert alert-success" role="alert">
                        Stagiaire ajouté avec succès!
                      </div>';
        echo $resultMessage;
    }


    $conn = null;
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un Stagiaire</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <script>
        // JavaScript pour masquer le message après 3 secondes
        setTimeout(function() {
            document.getElementById('resultMessage').style.display = 'none';
        }, 3000); // 3000 millisecondes (3 secondes)
    </script>
</head>

<body>

    <div class="container mt-5">
        <h2>Ajouter un Stagiaire</h2>
        <hr>
        <form action="" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nom">Nom :</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="prenom">Prénom :</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                </div>
            </div>
            <div class="form-group">
                <label for="nationalite">Nationalité :</label>
                <select class="form-control" id="nationalite" name="nationalite" required>
                    <option value="Française">Française</option>
                    <option value="Anglaise">Anglaise</option>
                    <option value="Espagnole">Espagnole</option>
                    <!-- Ajouter d'autres options de nationalités ici -->
                </select>
            </div>
            <div class="form-group">
                <label for="type_formation">Type de Formation :</label>
                <select class="form-control" id="type_formation" name="type_formation" required>
                    <option value="Développeur Web">Développeur Web</option>
                    <option value="Designer">Designer</option>
                    <option value="Développeur Full Stack">Développeur Full Stack</option>
                    <option value="Développeur Backend">Développeur Backend</option>
                    <option value="Développeur Front End">Développeur Front End</option>
                    <!-- Ajouter d'autres options de formation ici -->
                </select>
            </div>
            <div class="form-group">
                <label for="formateur">Formateur :</label>
                <input type="text" class="form-control" id="formateur" name="formateur" required>
            </div>
            <div class="form-group">
                <label for="salle">Salle :</label>
                <select class="form-control" id="salle" name="salle" required>
                    <option value="Salle A">Salle A</option>
                    <option value="Salle B">Salle B</option>
                    <option value="Salle C">Salle C</option>
                    <!-- Ajouter d'autres options de salle ici -->
                </select>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date_debut">Date de Début :</label>
                    <input type="date" class="form-control" id="date_debut" name="date_debut" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="date_fin">Date de Fin :</label>
                    <input type="date" class="form-control" id="date_fin" name="date_fin" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>