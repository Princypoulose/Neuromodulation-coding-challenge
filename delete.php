<?php
   require_once "database.php";
   if(isset($_GET['id'])) {
    $pid = $_GET['id'];
    $sqlDeletePainInventory = "DELETE FROM PainInventory WHERE pid = ?";
    $stmtDeletePainInventory = sqlsrv_query($conn, $sqlDeletePainInventory, array($pid));
    if ($stmtDeletePainInventory === false) {
        die("Error deleting associated records from PainInventory table: " . print_r(sqlsrv_errors(), true));
    }
    $sqlDeletePatientTable = "DELETE FROM patient_table WHERE pid = ?";
    $stmtDeletePatientTable = sqlsrv_query($conn, $sqlDeletePatientTable, array($pid));

    if ($stmtDeletePatientTable === false) {
        die("Error deleting record from patient_table: " . print_r(sqlsrv_errors(), true));
    }
    header("Location: admin_view.php");
    exit();
} else {
    header("Location: admin_view.php");
    exit();
}
?>
