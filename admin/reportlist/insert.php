<?php  
 include_once("../../database/pdo.php"); 
 if(!empty($_POST))  
 {   
 
      $ReportID = $_POST['ReportID'];
      $status = $_POST['status'];
      $StartDay = $_POST['StartDay'];
      $EndDay = $_POST['EndDay'];

      $sql = "UPDATE covidstatus 
      SET covidstatus.stat= '{$status}' 
      WHERE covidstatus.ReportID = '{$ReportID}'; 
      UPDATE quarantinedate 
      SET quarantinedate.StartDate = '{$StartDay}', quarantinedate.EndDate = '{$EndDay}' 
      WHERE quarantinedate.ReportID = '{$ReportID}'; 
      COMMIT; ";
      
      $result = $pdo->query($sql);

 }  
?>