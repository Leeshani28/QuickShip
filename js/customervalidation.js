$(document).ready(function () {

    $("form").submit(function () {

        var name = $("#name").val().trim();
        var name = $("#Customer_category").val().trim();
        var address = $("#address").val().trim();
        var email = $("#email").val().trim();
        var nic = $("#nic").val().trim();
        var cno1 = $("#cno1").val().trim();
        var cno2 = $("#cno2").val().trim();

        
        // Required Field Validation
        

        if (name == "") {
            $("#msg").html("Customer Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (Customer_category == null || Customer_category == "") {
            $("#msg").html("customer Category Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (address == "") {
            $("#msg").html("Address Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (email == "") {
            $("#msg").html("Email Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (nic == "") {
            $("#msg").html("NIC Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (cno1 == "") {
            $("#msg").html("Mobile Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        
        // Regular Expressions
        

        var patName = /^[A-Za-z ]+$/;
        var patEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var patNicOld = /^[0-9]{9}[vVxX]$/;
        var patNicNew = /^[0-9]{12}$/;
        var patMobile = /^[0-9]{10}$/;
        var patFixed = /^[0-9]{10}$/;

        if (!name.match(patName)) {
            $("#msg").html("Customer Name is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (!email.match(patEmail)) {
            $("#msg").html("Email Address is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (!nic.match(patNicOld) && !nic.match(patNicNew)) {
            $("#msg").html("NIC is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (!cno1.match(patMobile)) {
            $("#msg").html("Mobile Number is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        // Fixed number is optional
        if (cno2 != "" && !cno2.match(patFixed)) {
            $("#msg").html("Fixed Number is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

    });

});