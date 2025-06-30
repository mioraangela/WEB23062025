<?php 
    require("../Inclus/fonctions.php");
    session_start();
    $numbers = getMinEtMaxAge();
    if($_SERVER['REQUEST_METHOD'] ==='GET'){
        if(isset($_GET['page'])){
            $page =$_GET['page'];
            $nomEmployer = $_GET['nom'];
            $departName = $_GET['departments'];
            $ageMin = $_GET['ageMin'];
            if($_GET['ageMax'] ==""){
                foreach($numbers as $number){
                    $max = $number['age_max'];
                    $ageMax = $max;
                }
            }
            else{
                $ageMax = $_GET['ageMax'];
            }
        }
    }
    else{
        $nomEmployer = $_POST['nom'];
        $departName = $_POST['departments'];
        $ageMin = $_POST['ageMin'];
        $ageMax = $_POST['ageMax'];
        if($_POST['ageMax'] == ""){
            foreach($numbers as $number){
                $max = $number['age_max'];
                $ageMax = $max;
            }
        }
        else{
            $ageMax = $_POST['ageMax'];
        }
        
        if($nomEmployer==""|| $departName == ""){
            header("location: index.php?error=1");
        }
        $page = 1;
    }

    // Nombre d'éléments par page
    $itemsPerPage = 20;

    // Calcul de l'offset (le nombre d'éléments à ignorer)
    $offset = ($page - 1) * $itemsPerPage;

    // Récupérer les employés de la page actuelle
    $employees = getNextEmployees($nomEmployer, $departName, $ageMin, $ageMax, $offset, $itemsPerPage);

    // Calcul du nombre total de pages
    $totalEmployees = getTotalEmployees($nomEmployer, $departName, $ageMin, $ageMax);
    $totalEmployees;
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
        <?php if ($page > 1){?>
            <a href="?page=<?=$page - 1?>&&nom=<?= $nomEmployer?>&&departments=<?= $departName ?>&&ageMin=<?= $ageMin ?>&&ageMax=<?= $ageMax?>">Previous</a>
        <?php } ?>
            <span> Page <?=$page?> sur <?=$totalPages?></span>
        <?php if ($page < $totalPages){?>
            <a href="?page=<?=$page + 1?>&&nom=<?= $nomEmployer?>&&departments=<?= $departName ?>&&ageMin=<?= $ageMin ?>&&ageMax=<?= $ageMax?>">Next</a>
        <?php }?>
    </div>
    <div>
        <a href="index.php">home</a>
    </div>

</body>
</html>
