<?php

require_once "database.php";
$sql = "SELECT * FROM patient_table INNER JOIN PainInventory ON patient_table.pid = PainInventory.pid";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 style="text-align:center">Admin View</h2><br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>Date of Submission</th>
                    <th>First Name</th>
                    <th>Surname</th>
                    <th>Age</th>
                    <th>Date of Birth</th>
                    <th>Total Score</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo isset($row['date_of_submission']) ? $row['date_of_submission']->format('Y-m-d') : ''; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['surname']; ?></td>
                        <td><?php echo $row['age']; ?></td>
                        <td><?php echo isset($row['DOB']) ? $row['DOB']->format('Y-m-d') : ''; ?></td>
                        <td><?php echo $row['total_score']; ?></td>
                        <td>
                            <a href="view.php?id=<?php echo $row['pid']; ?>" class="btn btn-info">View</a>
                            <a href="update.php?id=<?php echo $row['pid']; ?>" class="btn btn-primary">Edit</a>
                            <a href="delete.php?id=<?php echo $row['pid']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
sqlsrv_close($conn);
?>
