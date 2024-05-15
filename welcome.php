<!DOCTYPE html>
<html lang="en">
    <?php
     session_start();
     ?>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeuromodulaVon Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .panel {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align:center;">Neuromodulation Form</h2>
        <form id="neuromodulaVonForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
           <div class="container">
    <form action="" method="post">
    
        <div class="form-group">
            <input type="text" class="form-control" name="firstname" placeholder="First Name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="surname" placeholder="Surname">
        </div>
        <div class="form-group">
            <input type="date" class="form-control" name="DOB" placeholder="DOB">
        </div>
        <div class="form-group">
            <input type="age" class="form-control" name="age" placeholder="age">
        </div>
        <div class="form-group">
    
    <input type="date" class="form-control" id="date_of_submission" name="date_of_submission" placeholder="Date of Submission">
</div>

                <div class="form-group">
                    <label>How much relief have pain treatments or medications provided?</label>
                    <input type="number" class="form-control pain-input" name="relief_score" min="0" max="100" required>
                </div>
                <div class="form-group">
                    <label>Please rate your pain based on the number that best describes your pain at its worst in the past week.</label>
                    <input type="number" class="form-control pain-input" name="worstpain" min="0" max="10" required>
                </div>
                <div class="form-group">
                    <label>Please rate your pain based on the number that best describes your pain at its least in the past week.</label>
                    <input type="number" class="form-control pain-input" name="leastpain" min="0" max="10" required>
                </div>
                <div class="form-group">
                    <label>Please rate your pain based on the number that best describes your pain on the average in the past week.</label>
                    <input type="number" class="form-control pain-input" name="avgpain" min="0" max="10" required>
                </div>
                <div class="form-group">
                    <label>Please rate your pain based on the number that best describes your pain right now.</label>
                    <input type="number" class="form-control pain-input" name="currentpain" min="0" max="10" required>
                </div>
                <div class="form-group">
                    <label>Based on the number that best describes how during the past week pain has interfered with your: General Activity.</label>
                    <input type="number" class="form-control pain-input" name="generalactivity" min="0" max="10" required>
                </div>
                <div class="form-group">
                    <label>Based on the number that best describes how during the past week pain has interfered with your: Mood.</label>
                    <input type="number" class="form-control pain-input" name="mood" min="0" max="10" required>
                </div>
                <div class="form-group">
                    <label>Based on the number that best describes how during the past week pain has interfered with your: Walking ability.</label>
                    <input type="number" class="form-control pain-input" name="walkingability" min="0" max="10" required>
                </div>
                <div class="form-group">
                    <label>Based on the number that best describes how during the past week pain has interfered with your: Normal work (includes work both outside the home and housework).</label>
                    <input type="number" class="form-control pain-input" name="normalwork" min="0" max="10" required>
                </div>
                <div class="form-group">
                    <label>Based on the number that best describes how during the past week pain has interfered with your: Relationships with other people.</label>
                    <input type="number" class="form-control pain-input" name="relationships" min="0" max="10" required>
                </div>
                <div class="form-group">
                    <label>Based on the number that best describes how during the past week pain has interfered with your: Sleep.</label>
                    <input type="number" class="form-control pain-input" name="sleep" min="0" max="10" required>
                </div>
                <div class="form-group">
                    <label>Based on the number that best describes how during the past week pain has interfered with your: Enjoyment of life.</label>
                    <input type="number" class="form-control pain-input" name="enjoymentoflife" min="0" max="10" required>
                </div>
                <div class="form-group">
                    <label>Total Score</label><br>
                    <input type="number" name="totalscore" id="totalScore">
                    
                </div>



      <div class="form-btn">
            <input type="submit" class="btn btn-primary" value="submit" name="submit">
            </div>
        
    </form>
</div>
<script>
    $(document).ready(function () {
        $(".pain-input").change(function () {
            var totalScore = 0;
            $(".pain-input").each(function () {
                var value = parseInt($(this).val());
                if (!isNaN(value) && value <= 10) { 
                    totalScore += value;
                }
            });
            $("#totalScore").val(totalScore); 
        });
     });

     $(document).ready(function () {
    function calculateAge(dob) {
        var currentdate = new Date();
        var birthDate = new Date(dob);
        var age = currentdate.getFullYear() - birthDate.getFullYear();
        var m = currentdate.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && currentdate.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }
    $("input[name='DOB']").on("input", function () {
        var dob = $(this).val();
        var age = calculateAge(dob);
        $("input[name='age']").val(age);
    });
});
</script>


    <?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
   require_once "database.php"; 
    
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $firstname = $_POST["firstname"];
    $surname = $_POST["surname"];
    $dob = $_POST["DOB"];
    $age = $_POST["age"];
    $date = $_POST["date_of_submission"];
    $sql = "INSERT INTO patient_table (firstname, surname, DOB, age,date_of_submission) VALUES (?, ?, ?, ?,?)";
    $params = array($firstname, $surname, $dob, $age,$date);
    $stmt = sqlsrv_query($conn, $sql, $params);
   
    $id = "SELECT pid FROM patient_table WHERE firstname = ?";
    $params = array($firstname);
    $stmt = sqlsrv_query($conn, $id, $params);
    if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
     }
   $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
   if ($row) {
    $pid = $row['pid'];
    //echo "Patient ID: " . $pid;
    } else {
    echo "No patient found with the given firstname.";
   }

   $_SESSION['id']=$pid;

    $reliefScore = $_POST["relief_score"];
    $worstPain = $_POST["worstpain"];
    $leastPain = $_POST["leastpain"];
    $averagePain = $_POST["avgpain"];
    $currentPain = $_POST["currentpain"];
    $generalActivity = $_POST["generalactivity"];
    $mood = $_POST["mood"];
    $walkingAbility = $_POST["walkingability"];
    $normalWork = $_POST["normalwork"];
    $relationships = $_POST["relationships"];
    $sleep = $_POST["sleep"];
    $enjoymentOfLife = $_POST["enjoymentoflife"];
    $totalscore=$_POST["totalscore"];

    $sql1 = "INSERT INTO PainInventory (pid, relief_score, worst_pain, least_pain, avg_pain, current_pain, general_activity, mood, walking_ability, normal_work, relationships, sleep, enjoyment_of_life,total_score) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
    $params1 = array($_SESSION['id'], $reliefScore, $worstPain, $leastPain, $averagePain, $currentPain, $generalActivity, $mood, $walkingAbility, $normalWork, $relationships, $sleep, $enjoymentOfLife,$totalscore);
    $stmt1 = sqlsrv_query($conn, $sql1, $params1);

    if ($stmt1 === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_close($conn);
}

?>

</body>
</html>
