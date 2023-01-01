<?php  
 include_once("../../database/pdo.php"); 
 if(!empty($_POST))  
 {   
 
      $ReportID = $_POST['ReportID'];

      $sql = "DELETE FROM covidstatus WHERE ReportID='{$ReportID}';
              DELETE FROM quarantinedate WHERE ReportID='{$ReportID}';
              DELETE FROM report WHERE ReportID='{$ReportID}'; 
              COMMIT; ";
      
      $result = $pdo->query($sql);

 }  
 ?>