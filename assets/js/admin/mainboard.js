// Table
var tasktbl = "";

$(document).ready(function() {

    // Page Loader
    $(".loader-wrapper").fadeOut("slow");

    // Sidebar Toggle
    $("#sidebar-toggle-btn").on("click", function() {
        $("#sidebar-toggle-btn").toggleClass("slide-in");
        $(".sidebar").toggleClass("shrink-sidebar");
        $(".content").toggleClass("expand-content");
    });

    // Draw Table
    function draw_data() {
        if ($.fn.dataTable.isDataTable("#task-tbl") && tasktbl!="") {
            tasktbl.draw(true)
        }
        else {
            load_data()
        }
    }

    // Load Data
    function load_data () {
        tasktbl = $("#task-tbl").DataTable({
            dom: "lBf<'pt-2 mt-2't><'clearfix'ip>'",
            serverSide: true,
            ajax: {
                url: "./get_task.php",
                method: "POST"
            },
            columns: [{
                data: "Index",
                searchable: false,
                orderable: false
            },
            {
                data: "Task"
            },
            {
                data: "Description"
            },
            {
                data: "Deadline"
            },
            {
                data: null,
                orderable: false,
                className: "text-center",
                render: function (data, type, row, meta) {
                    return "<a class='edit-data' href='javascript:void(0)' data-id='" + (row.TaskID) + "'><i class='fa fa-pencil' data-toggle='tooltip' title='Edit'></i></a>"
                    + "<a class='delete-data' href='javascript:void(0)' data-id='" + (row.TaskID) + "'><i class='fa fa-trash' data-toggle='tooltip' title='Delete'></i></a>";
                }
            }],
            drawCallback: function(settings) {
                $(".edit-data").click(function() {
                    $.ajax({
                        url: "get_single.php",
                        data: { id: $(this).attr("data-id") },
                        method: "POST",
                        dataType: "json",
                        error: error => {
                            alert("An error occured: " + error.status + " " + error.statusText);
                        },
                        success: function(response) {
                            if (!!response.status) {
                                Object.keys(response.data).map(k => {
                                    if ($("#edit-modal").find("input[name='" + k + "']").length > 0)
                                        $("#edit-modal").find("input[name='" + k + "']").val(response.data[k]);
                                })
                                $("#edit-modal").modal("show")
                            } else {
                                alert("An error occured: Unable to fetch data.")
                            }
                        }
                    })
                })
                $(".delete-data").click(function() {
                    $.ajax({
                        url: "get_single.php",
                        data: { id: $(this).attr("data-id") },
                        method: "POST",
                        dataType: "json",
                        error: error => {
                            alert("An error occured: " + error.status + " " + error.statusText);
                        },
                        success: function(response) {
                            if (!!response.status) {
                                $("#delete-modal").find("input[name='TaskID']").val(response.data["TaskID"]);
                                $("#delete-modal").modal("show")
                            } else {
                                alert("An error occured: Unable to fetch data.")
                            }
                        }
                    })
                })
            },
            buttons: [
                {
                    text: "Add",
                    className: "py-1 px-2 ml-2",
                    action: function (e, dt, node, config) {
                        $("#add-modal").modal("show");
                    }
                }
            ],
            order: [
                [0, "asc"]
            ]
        })
    }

    // Load Data
    load_data();

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

    // Add Task
    $("#add-task-form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "save_data.php",
            data: $(this).serialize(),
            method: "POST",
            dataType: "json",
            error: function(xhr, text, error) {
                alert("An error occured: " + JSON.stringify(xhr));
            },
            success: function(response) {
                if (!!response.status) {
                    if (response.status == "success") {
                        var element = $("<div>")
                        element.hide()
                        element.addClass("alert alert-primary")
                        element.text("Task successfully added")

                        $("#add-task-form").get(0).reset()
                        $(".modal").modal("hide")
                        
                        $("#alert").append(element)
                        element.show("slow")
                        draw_data();
                        
                        setTimeout(() => { element.hide("slow") },2000)
                        setTimeout(() => { element.remove() },3000)
                    } else if (response.status == "success" && !!response.msg) {
                        var element = $("<div>")
                        element.hide()
                        element.addClass("alert alert-danger")
                        element.text(response.msg);
                        
                        $("#alert").append(element)
                        element.show("slow")

                        setTimeout(() => { element.hide("slow") },2000)
                        setTimeout(() => { element.remove() },3000)
                    } else {
                        alert("An error occured: Please check source code.")
                    }
                } else {
                    alert("An error occured: Please check the source code.")
                }
            }
        });
    })

    // Edit Task
    $("#edit-task-form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "update_data.php",
            data: $(this).serialize(), 
            method: "POST",
            dataType: "json",
            error: error => {
                alert("An error occured: " + error.status + " " + error.statusText);
            },
            success: function(response) {
                if (!!response.status) {
                    if (response.status == "success") {
                        var element = $("<div>")
                        element.hide()
                        element.addClass("alert alert-primary")
                        element.text("Task successfully updated")

                        $("#edit-task-form").get(0).reset()
                        $(".modal").modal("hide")
                        
                        $("#alert").append(element)
                        element.show("slow")
                        draw_data();
                        
                        setTimeout(() => { element.hide("slow") },2000)
                        setTimeout(() => { element.remove() },3000)
                    } else if (response.status == "success" && !!response.msg) {
                        var element = $("<div>")
                        element.hide()
                        element.addClass("alert alert-danger")
                        element.text(response.msg);
                        
                        $("#alert").append(element)
                        element.show("slow")

                        setTimeout(() => { element.hide("slow") },2000)
                        setTimeout(() => { element.remove() },3000)
                    } else {
                        alert("An error occured: Please check source code.")
                    }
                } else {
                    alert("An error occured: Please check the source code.")
                }
            }
        })
    })

    // Delete Task
    $("#delete-task-form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "delete_data.php",
            data: $(this).serialize(),
            method: "POST",
            dataType: "json",
            error: error => {
                alert("An error occured: " + error.status + " " + error.statusText);
            },
            success: function(response) {
                if (!!response.status) {
                    if (response.status == "success") {
                        var element = $("<div>")
                        element.hide()
                        element.addClass("alert alert-primary")
                        element.text("Task successfully deleted")

                        $("#delete-task-form").get(0).reset()
                        $(".modal").modal("hide")
                        
                        $("#alert").append(element)
                        element.show("slow")
                        draw_data();
                        
                        setTimeout(() => { element.hide("slow") },2000)
                        setTimeout(() => { element.remove() },3000)
                    } else if (response.status == "success" && !!response.msg) {
                        var element = $("<div>")
                        element.hide()
                        element.addClass("alert alert-danger")
                        element.text(response.msg);
                        
                        $("#alert").append(element)
                        element.show("slow")

                        setTimeout(() => { element.hide("slow") },2000)
                        setTimeout(() => { element.remove() },3000)
                    } else {
                        alert("An error occured: Please check source code.")
                    }
                } else {
                    alert("An error occured: Please check the source code.")
                }
            }
        })
    })

});