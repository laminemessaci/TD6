<?php
require_once(__DIR__ . '/config/db_connect.php');
require_once __DIR__ . '/includes/header.php';

$resultMessage = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $query = "DELETE FROM eleve WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $resultMessage = '<div id="resultMessage" class="alert alert-success" role="alert">
                        Stagiaire supprimé avec succès!
                      </div>';


    // Redirection vers la page de liste des stagiaires par exemple
    header("Location: index.php");


    $conn = null;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Liste des Stagiaires</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<body>

    <div class="container mt-5">
        <h2>Liste des Stagiaires</h2>
        <hr>

        <? $resultMessage ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Formation</th>
                    <th>Salle</th>
                    <th>Formateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Récupérer les données des stagiaires
                $query = "SELECT id, nom, prenom, type_formation,formateur, salle FROM eleve";
                $stmt = $conn->query($query);

                while ($row = $stmt->fetch()) {
                    echo '<tr>
                      <td>' . $row['id'] . '</td>
                        <td>' . $row['nom'] . '</td>
                        <td>' . $row['prenom'] . '</td>
                        <td>' . $row['type_formation'] . '</td>
                        <td>' . $row['salle'] . '</td>
                        <td>' . $row['formateur'] . '</td>
                        <td>
                         
                            <a href="?id=' . $row['id'] . '" class="btn btn-danger m-0" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce stagiaire ?\')">Supprimer</a>
                             <a href="src/stagiaire/modifier_stagiaire.php?id=' . $row['id'] . '" class="btn btn-primary m-0">Modifier</a>
                        </td>
                    </tr>';
                }




                $conn = null;
                ?>
            </tbody>

        </table>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>