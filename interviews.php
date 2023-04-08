<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Interview Form</title>
</head>

<body>
    <?php
    if (
        empty($_POST['interviewer_name']) || empty($_POST['position']) || empty($_POST['interview_date'])
        || empty($_POST['candidate_name']) || empty($_POST['com_abilities']) || empty($_POST['computer_skills'])
        || empty($_POST['buss_skill']) || empty($_POST['comments'])
    ) {
        echo "<p>You must input data into each field. 
            Click your browser's Back button to the Guest Book.</p>\n";
    } else {
        $user = "root";
        $password = "root";
        $host = "localhost";

        $DBConnect = mysqli_connect($host, $user, $password);
        if ($DBConnect === FALSE) {
            echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>";
        } else {
            $DBName = "companyDB";

            if (!mysqli_select_db($DBConnect, $DBName)) {
                $SQLstring = "CREATE DATABASE $DBName";
                $QueryResult = mysqli_query($DBConnect, $SQLstring);

                if ($QueryResult === FALSE) {
                    echo "<p>Unable to execute the query.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
                } else {
                    echo "<p>You are the first Interviewer!</p>";
                }
            }
            mysqli_select_db($DBConnect, $DBName);

            $TableName = "interviews";
            $SQLstring = "SHOW TABLES LIKE '$TableName'";
            $QueryResult = mysqli_query($DBConnect, $SQLstring);

            if (mysqli_num_rows($QueryResult) === 0) {
                $SQLstring = "CREATE TABLE $TableName (countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, interviewer_name VARCHAR(50), position VARCHAR(50), interview_date DATE, 
                                                        candidate_name VARCHAR(50), communication_abilities VARCHAR(100), computer_skills VARCHAR(100), bussiness_skill VARCHAR(100), 
                                                        comments VARCHAR(500))";
                $QueryResult = mysqli_query($DBConnect, $SQLstring);
                if ($QueryResult === FALSE) {
                    echo "<p>Unable to create the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
                }
            }
            $interviewName = stripslashes($_POST['interviewer_name']);
            $position = stripslashes($_POST['position']);
            $date = $_POST['interview_date'];
            $candidateName = stripslashes($_POST['candidate_name']);
            $communnicationSkills = stripslashes($_POST['com_abilities']);
            $computerSkills = stripslashes($_POST['computer_skills']);
            $bussinessSkills = stripslashes($_POST['buss_skill']);
            $comments = stripslashes($_POST['comments']);

            $SQLstring = "INSERT INTO $TableName VALUES(NULL, '$interviewName', '$position', '$date', '$candidateName', '$communnicationSkills', '$computerSkills', '$bussinessSkills', '$comments')";
            $QueryResult = mysqli_query($DBConnect, $SQLstring);

            if ($QueryResult === FALSE) {
                echo "<p>Unable to execute the query.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
            } else {
                echo "<h1>Your interview worksheet has been submitted!</h1>";
            }
            mysqli_close($DBConnect);
        }
    }
    ?>
</body>

</html>