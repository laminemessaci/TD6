<?php
require_once(__DIR__ . '/config/db_connect.php');
require_once __DIR__ . '/includes/header.php';

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
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Récupérer les données des stagiaires
                $query = "SELECT id, nom, prenom FROM eleve";
                $stmt = $conn->query($query);

                while ($row = $stmt->fetch()) {
                    echo '<tr>
                      <td>' . $row['id'] . '</td>
                        <td>' . $row['nom'] . '</td>
                        <td>' . $row['prenom'] . '</td>
                        <td>
                            <a href="voir_stagiaire.php?id=' . $row['id'] . '" class="btn btn-info m-0">Voir</a>
                            <a href="supprimer_stagiaire.php?id=' . $row['id'] . '" class="btn btn-danger m-0">Supprimer</a>
                             <a href="modifier_stagiaire.php?id=' . $row['id'] . '" class="btn btn-primary m-0">Modifier</a>
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