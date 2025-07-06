<?php 
    require("../Inclus/fonctions.php");
    if(isset($_GET['idDepart'])){
        $idDepart = $_GET['idDepart'];
    }
    else{
        $idDepart = $_GET['id'];
    }
    
    $totalTab= getTotalEmployeesParDepartParId($idDepart);
    $totalEmployees = $totalTab['count'];
    $itemPerPage = 20;
    
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }

    if(isset($_GET['totalPage'])){
        $totalPages = $_GET['totalPage'];
    }
    else{
        $totalPages = ceil($totalEmployees/$itemPerPage);
    }
    if($page <= 0){
        $page = 1;
        header("location: ?page=$page&&totalPage=$totalPages&&idDepart=$idDepart");
    }
    if($page > $totalPages){
        $page = $totalPages;
        header("location: ?page=$page&&totalPage=$totalPages&&idDepart=$idDepart");
    }
    $offset = ($page - 1)*$itemPerPage;
    $employees = getEmployeesParDepartParId($idDepart,$offset);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <h1>Liste des Employees par departements</h1>
        <div>
            <a href="index.php">home</a>
        </div>
        <table border ='1' style="border-collapse: collapse">
            <tr>
                <th> Numero de departements </th>
                <th> Nom de departements</th>
                <th> Date de naissance</th>
                <th> Nom des employes</th>
                <th> Sexe</th>
                <th> Date de recrutement</th>
            </tr>
            <?php foreach($employees as $employe){
                $idEmploye = $employe['emp_no']; 
            ?>
                <a href="ficheEmploye.php?id=<?= $idEmploye?>">
                    <tr onclick="window.location='ficheEmploye.php?id=<?= $idEmploye?>';"
                        style="cursor:pointer;"
                    >
                        <td><?=$employe['dept_no']?></td>
                        <td><?=$employe['dept_name']?></td>
                        <td><?=$employe['birth_date']?></td>
                        <td><?=$employe['last_name']?> <?=$employe['first_name']?></td>
                        <td><?=$employe['gender']?></td>
                        <td><?=$employe['hire_date']?></td>
                    </tr>
                </a>

            <?php } ?>
        </table>
        <div>
            
            <?php if($page == $totalPages){?>
                <span>
                    <a href="?page=<?=$page - 4?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"><< </a>
                    <a href="?page=<?=$page?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"> <?=$page?></a>
                </span>

            <?php } else if($page == $totalPages - 4){ ?>
                <a href="?page=<?=$page - 1?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"><<</a>
                <span>
                    <?php for($i = 0; $i < 3;$i++){?>
                        <a href="?page=<?= $page + $i + 1?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"><?= $page + $i + 1?></a>
                    <?php }?>
                </span>
                <span>. . . . .</span>
                <a href="?page=<?=$totalPages?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"><?=$totalPages?></a>
            
            <?php } else if($page > $totalPages - 4 && $page < $totalPages){ ?>
                <a href="?page=<?=$page - 1?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"><<</a>
                <?php if($page == $totalPages - 3) { ?>
                    <?php for($i = 0; $i < 2;$i++){?>
                        <span>
                            <a href="?page=<?= $page + $i + 1?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"><?= $page + $i + 1?></a>
                        </span>
                    <?php } ?>
                <?php } else if($page == $totalPages -2){?>
                    <span>
                        <a href="?page=<?= $page + 1?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"><?= $page + 1?></a>
                    </span>
                <?php } ?>
                
                <span>. . . . .</span>
                <a href="?page=<?=$totalPages?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"><?=$totalPages?></a>
                <a href="?page=<?=$page + 1?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"> >></a>  
                
            <?php } else if($page == 1) { ?>
                <span>
                    <?php for($i = 0; $i < 3;$i++){?>
                        <a href="?page=<?= $page + $i + 1?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"><?= $page + $i + 1?></a>
                    <?php }?>
                </span>
                <span>. . . . .</span>
                <a href="?page=<?=$totalPages?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"><?=$totalPages?></a>
                <a href="?page=<?=$page + 1?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"> >></a>   

            <?php } else { ?>
                <a href="?page=<?=$page - 1?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"><<</a>
                <span>
                    <?php for($i = 0; $i < 3;$i++){?>
                        <a href="?page=<?= $page + $i + 1?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"><?= $page + $i + 1?></a>
                    <?php }?>
                </span>
                <span>. . . . .</span>
                <a href="?page=<?=$totalPages?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"><?=$totalPages?></a>
                <a href="?page=<?=$page + 1?>&&totalPage=<?=$totalPages?>&&idDepart=<?=$idDepart?>"> >></a>
            <?php } ?>
        </div>
        <div>
            <form action="" method="get">
                <p>Naviguer vers la page 
                    <input type="number" name="page" id="page" required>
                </p>
                <input type="hidden" name="totalPage" value="<?= $totalPages ?>">
                <input type="hidden" name="idDepart" value="<?= $idDepart ?>">
                <input type="submit" value="Valider">
            </form>
        </div>

    </main>
</body>
</html>