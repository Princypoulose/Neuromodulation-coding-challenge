<?php
require_once "database.php";

if(isset($_GET['id'])) {
    $submission_id = $_GET['id'];
    $sql = "SELECT * FROM patient_table INNER JOIN PainInventory ON patient_table.pid = PainInventory.pid WHERE patient_table.pid = ?";
    $params = array($submission_id);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detailed View</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container mt-5">
        <h2 style="text-align:center">Detailed View</h2><br>
        <form action="view.php" method="post">
            <input type="hidden" name="submission_id" value="<?php echo $submission_id; ?>">
            
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>">
            </div>
            <div class="form-group">
                <label for="surname">Surname:</label>
                <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $row['surname']; ?>">
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" class="form-control" id="age" name="age" value="<?php echo $row['age']; ?>">
            </div>
            <div class="form-group">
                <label for="DOB">Date of Birth:</label>
                <input type="date" class="form-control" id="DOB" name="DOB" value="<?php echo $row['DOB']->format('Y-m-d'); ?>">
            </div>
            <div class="form-group">
                <label for="date_of_submission">Date of Submission:</label>
                <input type="date" class="form-control" id="date_of_submission" name="date_of_submission" value="<?php echo $row['date_of_submission']->format('Y-m-d'); ?>">
            </div>
            <div class="form-group">
                <label for="total_score">Total Score:</label>
                <input type="text" class="form-control" id="total_score" name="total_score" value="<?php echo $row['total_score']; ?>">
            </div>
           
        </form>
        <div>
            <a href="admin_view.php">Back </a>
        </div>
    </div>
           <?php
             $_session['score']= $row['total_score'];
                //echo $_session['score'] ;
                ?>
         
</body>
</html>

<?php
sqlsrv_close($conn);
?>
