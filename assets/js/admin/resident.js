// Table
var residentlist = "";

$(document).ready(function() { // Codes run safely after the whole page is ready

    // Page Loader
    $(".loader-wrapper").fadeOut("slow");

    // Sidebar Toggle
    $("#sidebar-toggle-btn").on("click", function() {
        $("#sidebar-toggle-btn").toggleClass("slide-in");
        $(".sidebar").toggleClass("shrink-sidebar");
        $(".content").toggleClass("expand-content");
    });

    // Draw Table
    function draw_data() { // Called if database is updated
        if ($.fn.dataTable.isDataTable("#resident-list") && residentlist!="") {
            residentlist.draw(true)
        }
        else {
            load_data()
        }
    }

    // Load Data
    function load_data () {
        residentlist = $("#resident-list").DataTable({
            dom: "fl<t><'clearfix'ip>", // Determine the order of table elements
            serverSide: true, // Let server do data processing instead of client
            ajax: {
                url: "./get_all.php",
                method: "POST"
            },
            columns: [{ // Configure column properties such as adding some class
                    data: "Name",
                },
                {
                    data: "PhoneNumber",
                    className: "phone-info"
                },
                {
                    data: "Block",
                    className: "block-info"
                },
                {
                    data: "Unit",
                    className: "unit-info",
                    orderable: false
                },
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return "<a class='edit-data' href='javascript:void(0)' data-id='" + (row.ResidentID) + "'><i class='fa fa-pencil' data-toggle='tooltip' title='Edit'></i></a>"
                        + "<a class='delete-data' href='javascript:void(0)' data-id='" + (row.ResidentID) + "'><i class='fa fa-trash' data-toggle='tooltip' title='Delete'></i></a>";
                    }
                }
            ],
            drawCallback: function(settings) { // Assign event to row elements
                $(".edit-data").click(function() {
                    $.ajax({
                        url: "get_one.php",
                        data: { id: $(this).attr("data-id") },
                        method: "POST",
                        dataType: "json",
                        error: error => { // Fired when the request could not be fulfilled
                            alert("An error occured: " + error.status + " " + error.statusText);
                        },
                        success: function(response) {
                            if (!!response.status) { // Data successfully read
                                Object.keys(response.data).map(k => { // Assign the current value of each field
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
                        url: "get_one.php",
                        data: { id: $(this).attr("data-id") },
                        method: "POST",
                        dataType: "json",
                        error: error => {
                            alert("An error occured: " + error.status + " " + error.statusText);
                        },
                        success: function(response) {
                            if (!!response.status) { // Data successfully read
                                $("#delete-modal").find("input[name='ResidentID']").val(response.data["ResidentID"]);
                                $("#delete-modal").modal("show")
                            } else {
                                alert("An error occured: Unable to fetch data.")
                            }
                        }
                    })
                })
            },
            order: [ // Default ordering to 1st column
                [0, "asc"]
            ]
        })
    }

    load_data() // Load data when page is first opened

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
    $(document.body).on("show.bs.modal", function() {
        $("#edit-modal").on("shown.bs.modal", function() {
            $("body").attr("style","padding-right: 17px !important;");
            $("#logout-button").attr("style","padding-right: 27px !important;");
            $("#sidebar-toggle").attr("style","margin-left: -5px;");
        });
    });
    $(document.body).on("hide.bs.modal", function() {
        $("#edit-modal").on("hidden.bs.modal", function() {
            $("body").attr("style","");
            $("#logout-button").attr("style","");
            $("#sidebar-toggle").attr("style","");
        });
    });

    // Add Resident
    $("#add-modal").submit(function(e) {
        e.preventDefault(); // Prevent form submission and page refresh
        $.ajax({
            url: "add_data.php",
            data: $("#add-resident").serialize(), // Makes standard URL-encoded text
            method: "POST",
            dataType: "json",
            error: error => {
                alert("An error occured: " + error.status + " " + error.statusText);
            },
            success: function(response) {
                if (!!response.status) { // Back-end script is successfully executed
                    if (response.status == "success") {
                        // Build success message
                        var element = $("<div>")
                        element.hide()
                        element.addClass("alert alert-primary")
                        element.text("Resident successfully added")

                        // Reset the form
                        $("#add-resident").get(0).reset()
                        $(".modal").modal("hide")
                        
                        // Show the success message
                        $("#alert").append(element)
                        element.show("slow")
                        draw_data();
                        
                        // Hide the message
                        setTimeout(() => { element.hide("slow") },2000)
                        setTimeout(() => { element.remove() },3000)
                    } else if (response.status == "success" && !!response.msg) {
                        // Build failure message
                        var element = $("<div>")
                        element.hide()
                        element.addClass("alert alert-danger")
                        element.text(response.msg);
                        
                        // Show failure message
                        $("#alert").append(element)
                        element.show("slow")

                        // Hide the message
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

    // Edit Resident
    $("#edit-modal").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "edit_data.php",
            data: $("#edit-resident").serialize(), 
            method: "POST",
            dataType: "json",
            error: error => {
                alert("An error occured: " + error.status + " " + error.statusText);
            },
            success: function(response) {
                if (!!response.status) { // Back-end script is successfully executed
                    if (response.status == "success") {
                        // Build success message
                        var element = $("<div>")
                        element.hide()
                        element.addClass("alert alert-primary")
                        element.text("Resident successfully updated")

                        // Reset the form
                        $("#edit-resident").get(0).reset()
                        $(".modal").modal("hide")
                        
                        // Show the success message
                        $("#alert").append(element)
                        element.show("slow")
                        draw_data();
                        
                        // Hide the message
                        setTimeout(() => { element.hide("slow") },2000)
                        setTimeout(() => { element.remove() },3000)
                    } else if (response.status == "success" && !!response.msg) {
                        // Build failure message
                        var element = $("<div>")
                        element.hide()
                        element.addClass("alert alert-danger")
                        element.text(response.msg);
                        
                        // Show failure message
                        $("#alert").append(element)
                        element.show("slow")

                        // Hide the message
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

    // Delete Resident
    $("#delete-modal").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "delete_data.php",
            data: $("#delete-resident").serialize(),
            method: "POST",
            dataType: "json",
            error: error => {
                alert("An error occured: " + error.status + " " + error.statusText);
            },
            success: function(response) {
                if (!!response.status) { // Back-end script is successfully executed
                    if (response.status == "success") {
                        // Build success message
                        var element = $("<div>")
                        element.hide()
                        element.addClass("alert alert-primary")
                        element.text("Resident successfully deleted")

                        // Reset the form
                        $("#delete-resident").get(0).reset()
                        $(".modal").modal("hide")
                        
                        // Show the success message
                        $("#alert").append(element)
                        element.show("slow")
                        draw_data();
                        
                        // Hide the message
                        setTimeout(() => { element.hide("slow") },2000)
                        setTimeout(() => { element.remove() },3000)
                    } else if (response.status == "success" && !!response.msg) {
                        // Build failure message
                        var element = $("<div>")
                        element.hide()
                        element.addClass("alert alert-danger")
                        element.text(response.msg);
                        
                        // Show failure message
                        $("#alert").append(element)
                        element.show("slow")

                        // Hide the message
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