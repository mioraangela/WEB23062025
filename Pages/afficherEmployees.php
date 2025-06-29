<?php 
    require("../Inclus/fonctions.php");

    $nomEmployer = $_POST['nom'];
    $departName = $_POST['departments'];
    $ageMin = $_POST['ageMin'];
    $ageMax = $_POST['ageMax'];
    ini_set('display_errors', 1);
    error_reporting(E_ALL);


    // Nombre d'éléments par page
    $itemsPerPage = 20;

    // Calcul de l'offset (le nombre d'éléments à ignorer)
    $offset = ($page - 1) * $itemsPerPage;

    // Récupérer les employés de la page actuelle
    $employees = getNextEmployees($nomEmployer, $departName, $ageMin, $ageMax, $offset, $itemsPerPage);

    // Calcul du nombre total de pages
    $totalEmployees = getTotalEmployees($nomEmployer, $departName, $ageMin, $ageMax);
    $totalPages = ceil($totalEmployees / $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>Nom departement</th>
            <th>Nom Employer</th>
            <th>Age</th>
        </tr>
        <?php foreach ($employees as $employe) {?>
            <tr>
                <td><?=$employe['dept_name']?></td>
                <td><?=$employe['last_name']?> <?=$employe['first_name']?></td>
                <td><?=$employe['age']?></td>
            </tr>
        <?php } ?>
    </table>
    
    <!-- Pagination : Previous & Next -->
    <div>
        <?php if ($page > 1): ?>
            <a href="?page=<?=$page - 1?>">Previous</a>
        <?php endif; ?>

        <span>Page <?=$page?> sur <?=$totalPages?></span>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?=$page + 1?>">Next</a>
        <?php endif; ?>
    </div>

</body>
</html>
