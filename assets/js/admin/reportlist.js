$(document).ready(function() {

    // Page Loader
    $(".loader-wrapper").fadeOut("slow");

    // Load Chart
    $.ajax({
        url: "data_chartjs.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var ReportID = [];
            var status = [];

            for (var i in data) {
                ReportID.push("Report ID " + data[i].ReportID);
                if (data[i].stat == "Symptomatic") {
                    status.push("1");
                } else {
                    status.push("0");
                }
            }

            var chartdata = {
                labels: ReportID,
                datasets: [{
                    label: 'Status',
                    backgroundColor: 'rgba(200, 200, 200, 0.75)',
                    borderColor: 'rgba(200, 200, 200, 0.75)',
                    hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    data: status
                }]
            };

            var ctx = $("#mycanvas");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

    // Sidebar Toggle
    $("#sidebar-toggle-btn").on("click", function() {
        $("#sidebar-toggle-btn").toggleClass("slide-in");
        $(".sidebar").toggleClass("shrink-sidebar");
        $(".content").toggleClass("expand-content");
    });

    // Tooltips
    $("[data-toggle='tooltip']").tooltip();

    // Modal 
    $(document.body).on("show.bs.modal", function() {
        $("#add-modal").on("shown.bs.modal", function() {
            $("body").attr("style","padding-right: 17px !important;");
            $("#logout-button").attr("style","padding-right: 27px !important;");
            $("#sidebar-toggle").attr("style","margin-left: -5px;");
        });
    });
    $(document.body).on("hide.bs.modal", function() {
        $("#add-modal").on("hidden.bs.modal", function() {
            $("body").attr("style","");
            $("#logout-button").attr("style","");
            $("#sidebar-toggle").attr("style","");
        });
    });

    // Update Button
    $('.reportInfo').click(function(){  
        var ReportID = $(this).attr("id");  
        $.ajax({  
                url:"report_update.php",  
                method:"post",  
                data:{ReportID:ReportID},
                error: function(xhr, text, error) {
                    alert(error);
                },  
                success:function(data){  
                    $('#report_detail').html(data);  
                    $('#report_update').modal("show");  
                }  
        });  
    }); 

    // Delete Button
    $('.reportDelete').click(function() {  
        var ReportID = $(this).attr("id");  
        $.ajax( {  
            url:"report_delete.php",  
            method:"post",  
            data:{ReportID:ReportID},  
            success:function(data) {  
                $('#delete_detail').html(data);  
                $('#report_delete').modal("show");  
            }  
        });  
    });  

});