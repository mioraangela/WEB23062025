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

   

    // Calcul du nombre total de pages
    $totalEmployees = getTotalEmployees($nomEmployer, $departName, $ageMin, $ageMax);
    $totalEmployees;
    $totalPages = ceil($totalEmployees / $itemsPerPage);
    if($page <= 0){
        $page = 1;
        header("location: ?page=$page&&nom=$nomEmployer&&departments=$departName&&ageMin=$ageMin&&ageMax=$ageMax");
        exit();
    }
    if($page > $totalPages){
        $page = $totalPages;
        header("location: ?page=$page&&nom=$nomEmployer&&departments=$departName&&ageMin=$ageMin&&ageMax=$ageMax");
        exit();
    }

     // Calcul de l'offset (le nombre d'éléments à ignorer)
    $offset = ($page - 1) * $itemsPerPage;

    // Récupérer les employés de la page actuelle
    $employees = getNextEmployees($nomEmployer, $departName, $ageMin, $ageMax, $offset, $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <a href="index.php">home</a>
    </div>
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
        <form action="" method="get">
            <p>Naviguer vers la page 
                <input type="number" name="page" id="page" required>
            </p>
            <input type="hidden" name="nom" value="<?= $nomEmployer?>">
            <input type="hidden" name="departments" value="<?= $departName ?>">
            <input type="hidden" name="ageMin" value="<?= $ageMin ?>">
            <input type="hidden" name="ageMax" value="<?= $ageMax ?>">
            <input type="submit" value="Valider">
        </form>
    </div>

</body>
</html>
