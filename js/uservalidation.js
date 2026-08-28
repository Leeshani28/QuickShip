$(document).ready(function () {

    var today = new Date();
    today.setFullYear(today.getFullYear() - 18);
    var maxDate = today.toISOString().split("T")[0];
    $("#dob").attr("max", maxDate);

    $("#user_role").change(function () {

        var role_id = $("#user_role").val();
        var url = "../controller/user_controller.php?status=load_functions";

        $.post(url, { role: role_id }, function (data) {
            $("#display_functions").html(data).show();
        });

    });



    $("#userform").submit(function () {

        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var email = $("#email").val();
        var dob = $("#dob").val();
        var nic = $("#nic").val();
        var cno1 = $("#cno1").val();
        var cno2 = $("#cno2").val();
        var user_role = $("#user_role").val();
        var user_location = $("#user_location").val();


        if (fname == "") {
            $("#msg").html("First Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;

        }
        if (lname == "") {
            $("#msg").html("Last Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;

        }
        if (email == "") {
            $("#msg").html("Email Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;

        }
        if (dob == "") {
            $("#msg").html("DOB Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;

        }
        if (nic == "") {
            $("#msg").html("NIC Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;

        } if (cno1 == "") {
            $("#msg").html("Contact Number 1 Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;

        }
        if (cno2 == "") {
            $("#msg").html("Contact Number 2 Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;

        }
        if (user_role == "") {
            $("#msg").html("User Role Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;

        }
        if (user_location == null || user_location == "") {
            $("#msg").html("User Location Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;

        }



        var patNic = /^[0-9]{9}[vVxX]$/;
        var patNic2 = /^[0-9]{12}$/;
        var patmobile = /^[0-9]{10}$/;

        if (!nic.match(patNic) && !nic.match(patNic2)) {
            $("#msg").html("NIC is invalid!!!");
            $("#msg").addClass("alert alert-danger");
            return false;

        }
        if (!cno1.match(patmobile)) {
            $("#msg").html("Mobile Number is invalid!!!");
            $("#msg").addClass("alert alert-danger");
            return false;

        }
        if (!cno2.match(patmobile)) {
            $("#msg").html("Fixed Number is invalid!!!");
            $("#msg").addClass("alert alert-danger");
            return false;

        }

        var today = new Date();
        var dob = new Date(dob);

        var age = today.getFullYear() - dob.getFullYear();
        var month = today.getMonth() - dob.getMonth();

        if (month < 0 || (month === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        if (age < 18) {
            $("#msg").html("User must be at least 18 years old!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }


    });

});


