<?php 
    include_once("../../database/pdo.php");

    if(isset($_POST["ReportID"])) {  
        $ReportID = $_POST["ReportID"];
        $sql = "SELECT *
              FROM report
              JOIN covidstatus ON (covidstatus.ReportID = report.ReportID)
              JOIN quarantinedate ON (quarantinedate.ReportID = report.ReportID)
              WHERE quarantinedate.ReportID = '".$_POST["ReportID"]."' ";
        $result = $pdo->query($sql);
        $row = $result->fetch();
        $output = '';  
        $output .= '
        <form method="post" id="delete-report">
            <input type="hidden" class="form-control" type="text" id="ReportID" value="'.$row["ReportID"].'" name="ReportID">
            <div class="form-group">
                <p>Are you sure you want to delete this record?</p>
                <p class="text-danger"><small>This action cannot be undone.</small></p>
            </div>
            <div>
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                <input type="submit" id="submit" class="btn btn-danger float-right" value="Delete">
            </div>
        </form>  
            ';   
        echo $output;  
    }  
?>

<script>
$(document).ready(function(){ 
    $('#delete-report').on("submit", function(event){  
        $.ajax({  
            url:"delete.php",  
            method:"POST",  
            data:$('#delete-report').serialize(),   
            success:function(data){  
                $('#delete-report')[0].reset();  
                $('#report_delete').modal('hide');  
                $('#report-list').html(data);  
            }  
        });  
    });   
});

</script>