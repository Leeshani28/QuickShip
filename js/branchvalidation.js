$(document).ready(function () {

    $("form").submit(function () {

        $("#msg").removeClass("alert alert-danger alert-success").html("");

        var branch_name = $("#branch_name").val().trim();
        var branch_district = $("#branch_district").val();
        var branch_address = $("#branch_address").val().trim();
        var contact_no = $("#contact_no").val().trim();
        var email = $("#email").val().trim();
        

        
        // Empty Validations
        

        if (branch_name == "") {
            $("#msg").html("Branch Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (branch_district == null || branch_district == "") {
            $("#msg").html("Please Select a District!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (branch_address == "") {
            $("#msg").html("Address Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (contact_no == "") {
            $("#msg").html("Contact Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (email == "") {
            $("#msg").html("Email Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        

        
        // Pattern Validations
        

        var patMobile = /^[0-9]{10}$/;

        var patEmail = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;

        if (!contact_no.match(patMobile)) {
            $("#msg").html("Contact Number is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (!email.match(patEmail)) {
            $("#msg").html("Email Address is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        
        // Branch Name Validation
        

        if (branch_name.length < 3) {
            $("#msg").html("Branch Name Must Contain At Least 3 Characters!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        return true;

    });

});