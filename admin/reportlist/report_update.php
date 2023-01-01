<?php 
include_once("../../database/pdo.php");
if(isset($_POST["ReportID"]))  
{  
    $output = '';  
    $sql = "SELECT *
            FROM report
            JOIN covidstatus ON (covidstatus.ReportID = report.ReportID)
            JOIN quarantinedate ON (quarantinedate.ReportID = report.ReportID)
            WHERE quarantinedate.ReportID = ".$_POST["ReportID"]." ";

    $result = $pdo->query($sql);

    while($row = $result->fetch())  
    {  
        $output .= '   
            <form method="post" id="update-report">
                <input type="hidden" class="form-control" type="text" id="ReportID" value="'.$row["ReportID"].'" name="ReportID">
                <div class="form-group">
                    <label for="status">Status</label>
                    <input class="form-control" type="text" id="status" value="'.$row["stat"].'" name="status">
                </div>
                <div class="form-group">
                    <label for="StartDay">Quarantine Start Date</label>
                    <input class="form-control" type="date" id="StartDay" value="'.$row["StartDate"].'" name="StartDay">
                </div>
                <div class="form-group">
                    <label for="EndDay">Quarantine End Date</label>
                    <input class="form-control" type="date" id="EndDay" value="'.$row["EndDate"].'" name="EndDay">
                </div>
                <button class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="submit" class="btn btn-warning float-right">Update</button>
            </form>
        ';  
    }  
    echo $output;  
}  


 ?>

<script>
$(document).ready(function(){ 
    $('#update-report').on("submit", function(event){  
        $.ajax({  
            url:"insert.php",  
            method:"POST",  
            data:$('#update-report').serialize(),   
            success:function(data){  
                $('#update-report')[0].reset();  
                $('#report_update').modal('hide');  
                $('#report-list').html(data);  
            }  
        });  
    });   
});

</script>
