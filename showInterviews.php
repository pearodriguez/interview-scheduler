<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Interviews</title>
</head>
<body>
<h2>Candidate Interviews</h2>
    <?php
    $user = "root"; 
    $password = "root";
    $host="localhost"; 

    $DBConnect = mysqli_connect($host, $user, $password); 

    if ($DBConnect === FALSE) echo "<p>Unable to connect to the company's database server.</p>" . "<p>Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>"; 
    else {
        $DBName = "companyDB";

        if (!mysqli_select_db($DBConnect, $DBName)) echo "<p>There are no interview entries.</p>";
        else {
            $TableName = "interviews"; 
            $SQLString = "SELECT * FROM $TableName"; 
            $QueryResult = mysqli_query($DBConnect, $SQLString); 

            if (mysqli_num_rows($QueryResult) == 0) echo "<p>There are no interview entries.</p>";
            else {
                echo "<p>The following interviews have taken place</p>"; 
                echo "<table width='100%' border='1'>"; 
                echo "<tr><th>First Name</th><th>Position</th><th>Date</th><th>Candidate Name</th><th>Communication Abilites</th><th>Computer Skills</th><th>Business Knowledge</th><th>Comments</th></tr>"; 
                while ($Row = mysqli_fetch_array($QueryResult)) {
                    echo "<tr><td>{$Row['interviewer_name']}</td>";
                    echo "<td>{$Row['position']}</td>";
                    echo "<td>{$Row['interview_date']}</td>"; 
                    echo "<td>{$Row['candidate_name']}</td>"; 
                    echo "<td>{$Row['communication_abilities']}</td>"; 
                    echo "<td>{$Row['computer_skills']}</td>"; 
                    echo "<td>{$Row['bussiness_skill']}</td>"; 
                    echo "<td>{$Row['comments']}</td>"; 
                }
            }
            mysqli_free_result($QueryResult); 
        }
        mysqli_close($DBConnect); 
    }
    ?>
</body>
</html>