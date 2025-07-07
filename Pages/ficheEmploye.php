<?php 
    require("../Inclus/fonctions.php");
    if(isset($_GET['idChange'])){
         $idEmployer=$_GET['idChange'];
    }
    else{
        $idEmployer=$_GET['id'];
    }
    if(isset($_GET['departments'])&& isset($_GET['date'])){
        $nomDepartment = $_GET['departments'];
        $idDepart = getIdDepartment($nomDepartment);
        $fromDate = $_GET['date'];
        changerDepartEmployer($idDepart,$fromDate,$idEmployer);
    }
    $departments = afficherLesDepartements();
    $employer = getEmployeesParId($idEmployer);
    $salaires = getSalaryHistoryParId($idEmployer);
    $longTimeEmploi = getLongTimeEmploi($idEmployer);
    $count = count($longTimeEmploi);
    $updates = getUpdateEmployer($idEmployer);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Fiche Employer</h1>
    <div>
        <a href="index.php">home</a>
    </div>
    <a href="?changerDepart=1&&idChange=<?= $idEmployer?>">
        <button>Changer de departement</button>
    </a>
    <?php foreach($employer as $info){ ?>
        <p>Nom: <?= $info['last_name']?></p>
        <p>Prenom: <?=$info['first_name']?></p>
        <p>Numero id: <?=$info['emp_no']?></p>
        <p>Date de naissance: <?=$info['birth_date']?></p>
        <p>Sexe: <?=$info['gender']?></p>
        <p>Date de recrutement: <?=$info['hire_date']?></p>
        
        <p>Nom de departement Occuper : <?= $updates[0]['dept_name']?> / Date Debut: <?= $updates[0]['from_date']?></p>
        <?php if($count == 0){?>
            <p> Pas de long duree de travail, employer en cours</p>
        <?php } else{ ?>
            <p>emploi le plus long: <?= $longTimeEmploi[0]['title']?> vers la date <?= $longTimeEmploi[0]['from_date']?> a <?= $longTimeEmploi[0]['to_date']?></p>
        <?php } ?>
    <?php } ?>
        <p> Emploi occuper: <?= $salaires[0]['title']?></p>
    <br>
    <?php if(isset($_GET['changerDepart'])){ ?>
        <form action="">
            <select name="departments" id="departments">
                <option value="">Choisisser le departement</option>
                <?php foreach ($departments as $department) { 
                    if($department['dept_name']== $updates[0]['dept_name']){ 
                        continue?>
                    <?php } else { ?>
                    <option value="<?= $department['dept_name']?>"><?=$department['dept_name']?></option>
                <?php } }?>
            </select>
            <p>Date Debut <input type="date" name="date" id="date"></p>
            <input type="hidden" name="id" value="<?= $idEmployer?>">
            <input type="submit" value="valider">
        </form>
    <?php }?>
    <br>
    <table border ='1' style="border-collapse: collapse">
        <tr>
            <th>Emploi occuper</th>
            <th>Salaire</th>
            <th>Date debut</th>
            <th>Date fin</th>
        </tr>
        <?php foreach($salaires as $salaire){?>
            <tr>
                <td><?= $salaire['title']?></td>
                <td><?= $salaire['salary']?></td>
                <td><?= $salaire['from_date']?></td>
                <td><?= $salaire['to_date']?></td>
            </tr>
        <?php } ?>
    </table>
    
</body>
</html>