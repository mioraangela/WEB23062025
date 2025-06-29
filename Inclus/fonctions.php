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
        $sql = "SELECT departments.dept_no, departments.dept_name
        , employees.birth_date,employees.first_name, 
        employees.last_name, employees.gender, 
        employees.emp_no,employees.hire_date
        FROM departments
        Join dept_emp
        on departments.dept_no = dept_emp.dept_no
        Join employees
        on dept_emp.emp_no = employees.emp_no
        ";
        $req = mysqli_query($bdd,$sql );
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }

    function getEmployeesParId($idEmploye){
        $bdd = dbconnect();
        $sql = "SELECT * 
        FROM employees
        Where emp_no ='%s'
        ";
        $sql = sprintf($sql, $idEmploye);
        $req = mysqli_query($bdd,$sql );
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }

    function getEmployeesParDepartParId($idDepart){
        $bdd = dbconnect();
        $sql = "SELECT departments.dept_no, departments.dept_name
        , employees.birth_date,employees.first_name,employees.emp_no, 
        employees.last_name, employees.gender,
        employees.hire_date
        FROM departments
        Join dept_emp
        on departments.dept_no = dept_emp.dept_no
        Join employees
        on dept_emp.emp_no = employees.emp_no
        Where departments.dept_no ='%s'
        ";
        $sql = sprintf($sql, $idDepart);
        $req = mysqli_query($bdd,$sql );
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }

    function getCurrentManager(){
        $bdd = dbconnect();
        $sql = "SELECT *
            FROM employees e
            Join dept_manager dm
            on e.emp_no = dm.emp_no
            Join departments d
            on d.dept_no = dm.dept_no
            WHERE dm.to_date ='9999-01-01';
        ";
        $req = mysqli_query($bdd,$sql);
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }



    
?>