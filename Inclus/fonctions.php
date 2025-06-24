<?php 
    require("connexion.php");

    function afficherLesDepartements(){
        $bdd = dbconnect();
        $sql = "SELECT * FROM departments;";
        $req = mysqli_query($bdd,$sql );
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }
    
    function getIdDepartment($nomDepartment){
        $bdd = dbconnect();
        $sql = "SELECT dept_no
            FROM departments
            WHERE dept_name ='%s';
        ";
        $sql = sprintf($sql, $nomDepartment);
        $req = mysqli_query($bdd,$sql);
        $result = mysqli_fetch_assoc($req);
        mysqli_free_result($req);
        return $result; 
    }
    
    function getEmployeesDepart(){
        $bdd = dbconnect();
        $sql = "SELECT * FROM departments
            From 
        ";
        $req = mysqli_query($bdd,$sql );
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }

    
?>