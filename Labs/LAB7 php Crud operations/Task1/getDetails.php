<?php 
include "19bce7002_connect.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
            rel="stylesheet"
        />
        <style>
            h1 {
                color: rgb(0, 0, 0);
            }
            span {
                color: red;
            }
            .con {
                background-color: rgb(197, 217, 235);
                color: black;
                padding: 0 10px;
                border-radius: 20px;
            }
            .in {
                padding: 6px 10px;
                margin: 4px 0;
                box-sizing: border-box;
                border-radius: 5px;
            }
            button {
                background-color: hsl(165, 83%, 38%); /* Green */
                border: none;
                color: white;
                padding: 10px 20px;
                border-radius: 10px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
            }
        </style>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Employee Details Display</title>
    </head>
    <body align="center"  style="
            padding: 0 30%;
            font-family: 'Montserrat', sans-serif;
            background-color: hsl(192, 28%, 82%);
        ">
    <div>
       <center>
       <h1 align="center"><u> Employee Details </u></h1>
    <form action="getDetails.php" method="POST">
        <table border="0" cellpadding="10" cellspacing="5">
            <tr align="left">
                <th>Enter Table Name<span> *</span></th>
                <th>
                    <input name="tablename" id="tablename" type="text" required autocomplete="off"/>
                </th>
                <th>
                <button name="btn" type="submit" id="btn" class="btn3">Get Details</button>
                </th>
            </tr>
        </table>
    </form>
</div>
  </body>

<?php
if(isset($_POST['btn'])) {

$tablename = $_POST['tablename']; // My table name is employee_modified_task1

$Query1b = "UPDATE $tablename SET designation = 'Professor', salary = salary + 20000 WHERE $tablename.`designation` = 'Associate Professor' AND abs(year(current_date)-year(doj)) > 5";
mysqli_query($link, $Query1b);

$Query1a = "UPDATE $tablename SET designation = 'Associate Professor', salary = salary + 50000 WHERE $tablename.`designation` = 'Assistant Professor' AND abs(year(current_date)-year(doj)) > 5";
mysqli_query($link, $Query1a);


$sql = "SELECT empno, empname, dob, doj, designation, department, abs(year(current_date)-year(doj)) as experience, salary FROM employee";
$connvar=mysqli_query($link, $sql);
$count=mysqli_num_rows($connvar);

$sql2 = "SELECT empno, empname, dob, doj, designation, department, abs(year(current_date)-year(doj)) as experience, salary FROM $tablename";
$connvar2=mysqli_query($link, $sql2);
$count2=mysqli_num_rows($connvar2);

    ?>
    <html>
	<body>
    <br>
    <h2 align="center">Actual Employee Table</h2>
    <br>
        <table border="1" align="center" cellpadding="10" cellspacing="0">
        <thead>
        <tr>
        <td>Employee Number</td>
        <td>Employee Name </td>
        <td>DOB </td>
        <td>DOJ </td>
        <td>Current Designation </td>
        <td>Department </td>
        <td>Experience </td>
        <td>Salary</td>
        </tr>
        </thead>
        <tbody>
        <?php
        while($row=mysqli_fetch_array($connvar)):
        ?>
        <tr>
        	<td><?php echo $row['empno']; ?></td>
            <td><?php echo $row['empname']; ?></td>
            <td><?php echo $row['dob']; ?></td>
            <td><?php echo $row['doj']; ?></td>
            <td><?php echo $row['designation']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td><?php echo $row['experience']; ?></td>
            <td><?php echo $row['salary']; ?></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
        </table>
    <br>
    <h2 align="center">Employee Table after Norms</h2>
    <br>
        <table border="1" align="center" cellpadding="10" cellspacing="0">
        <thead>
        <tr>
        <td>Employee Number</td>
        <td>Employee Name </td>
        <td>Updated Designation </td>
        <td>Experience </td>
        <td>Salary Change </td>
        </tr>
        </thead>
        <tbody>
        <?php
        while($row=mysqli_fetch_array($connvar2)):
        ?>
        <tr>
        	<td><?php echo $row['empno']; ?></td>
            <td><?php echo $row['empname']; ?></td>
            <td><?php echo $row['designation']; ?></td>
            <td><?php echo $row['experience']; ?></td>
            <td><?php echo $row['salary']; ?></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
        </table>
	</body>
</html>
    <?php
}
?>