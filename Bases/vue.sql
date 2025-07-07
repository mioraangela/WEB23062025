CREATE OR REPLACE VIEW v_liste_employer_depart AS
SELECT 
D.dept_no,
D.dept_name,
E.emp_no,
E.first_name,
E.last_name,
DE.from_date,
DE.to_date
FROM departments D
JOIN dept_emp DE
on D.dept_no = DE.dept_no
JOIN employees E
ON E.emp_no = DE.emp_no
WHERE DE.to_date ='9999-01-01';


CREATE OR REPLACE VIEW v_nb_employer_depart AS
SELECT E.dept_no,
Count(*) As nb_employees
FROM v_liste_employer_depart E
GROUP BY E.dept_no;

CREATE OR REPLACE VIEW v_employees AS
SELECT e.emp_no, e.birth_date,
e.last_name, e.first_name, e.gender,
e.hire_date, t.title,t.from_date,
t.to_date, s.salary
FROM employees e
JOIN titles t
on e.emp_no = t.emp_no
JOIN salaries s
on e.emp_no = s.emp_no;


CREATE OR REPLACE VIEW v_nb_employees_homme AS
SELECT Count(*) nb_employees_homme, ve.title
From v_employees ve
WHERE gender = 'M'
GROUP by ve.title;

CREATE OR REPLACE VIEW v_nb_employees_femme AS
SELECT Count(*) nb_employees_femme, ve.title
From v_employees ve
WHERE gender = 'F'
GROUP by ve.title;

CREATE OR REPLACE VIEW v_avg_salaries_par_emplois AS
SELECT ve.title, AVG(ve.salary) avg_salaries
FROM v_employees ve
GROUP by ve.title;

CREATE OR REPLACE VIEW v_liste_emplois AS
SELECT vh.title,vh.nb_employees_homme, vf.nb_employees_femme, vag.avg_salaries
FROM v_nb_employees_homme vh 
JOIN v_nb_employees_femme vf
ON vh.title = vf.title
JOIN v_avg_salaries_par_emplois vag
ON vh.title = vag.title;

CREATE OR REPLACE VIEW v_salary_history AS
SELECT salaries.emp_no, titles.title, 
salaries.salary, departments.dept_name,
salaries.from_date, salaries.to_date
FROM salaries
Join employees
on employees.emp_no = salaries.emp_no
Join titles
on employees.emp_no = titles.emp_no
Join dept_emp
on employees.emp_no = dept_emp.emp_no
Join departments
on departments.dept_no = dept_emp.dept_no;


CREATE OR REPLACE VIEW v_job_history AS
SELECT salaries.emp_no, titles.title, 
salaries.salary, departments.dept_name,
titles.from_date, titles.to_date
FROM titles
Join employees
on employees.emp_no = titles.emp_no
Join salaries
on employees.emp_no = salaries.emp_no
Join dept_emp
on employees.emp_no = dept_emp.emp_no
Join departments
on departments.dept_no = dept_emp.dept_no;

CREATE OR REPLACE VIEW v_departments_par_nom AS
SELECT *
FROM departments;

SELECT * 
From v_liste_employer_depart v 
WHERE v.emp_no ='10058';
