$(document).ready(function () {

    var today = new Date();
    today.setFullYear(today.getFullYear() - 18);
    var maxDate = today.toISOString().split("T")[0];
    $("#driver_date_of_birth").attr("max", maxDate);

    $("form").submit(function () {

        var driver_categary = $("#driver_categary").val();
        var driver_name = $("#driver_name").val().trim();
        var driver_nic = $("#driver_nic").val().trim();
        var driver_date_of_birth = $("#driver_date_of_birth").val();
        var driver_phone_number = $("#driver_phone_number").val().trim();
        var license_number = $("#license_number").val().trim();
        var license_expiry_date = $("#license_expiry_date").val();
        var driver_address = $("#driver_address").val().trim();
        var driver_district = $("#driver_district").val();
        // var driver_profile_picture = $("#driver_profile_picture").val();

        // Required field validation

        if (driver_categary == null || driver_categary == "") {
            $("#msg").html("Driver Category Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (driver_name == "") {
            $("#msg").html("Driver Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (driver_nic == "") {
            $("#msg").html("NIC Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (driver_date_of_birth == "") {
            $("#msg").html("Date of Birth Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (driver_phone_number == "") {
            $("#msg").html("Mobile Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (license_number == "") {
            $("#msg").html("License Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (license_expiry_date == "") {
            $("#msg").html("License Expiry Date Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (driver_address == "") {
            $("#msg").html("Address Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (driver_district == null || driver_district == "" || driver_district == "Select District") {
            $("#msg").html("District Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        // if (driver_profile_picture == "") {
        //     $("#msg").html("Profile Picture Cannot Be Empty!");
        //     $("#msg").addClass("alert alert-danger");
        //     return false;
        // }

        // Regular Expressions

        var patNic = /^[0-9]{9}[vVxX]$/;
        var patNic2 = /^[0-9]{12}$/;
        var patMobile = /^[0-9]{10}$/;
        var patLicense = /^[A-Za-z]{0,2}[0-9]{5,8}$/;

        if (!driver_nic.match(patNic) && !driver_nic.match(patNic2)) {
            $("#msg").html("NIC is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (!driver_phone_number.match(patMobile)) {
            $("#msg").html("Mobile Number is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (!license_number.match(patLicense)) {
            $("#msg").html("License Number is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        // Driver should be at least 18 years old

        var today = new Date();
        var dob = new Date(driver_date_of_birth);

        var age = today.getFullYear() - dob.getFullYear();
        var month = today.getMonth() - dob.getMonth();

        if (month < 0 || (month === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        if (age < 18) {
            $("#msg").html("Driver must be at least 18 years old!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        // License expiry date must be today or future

        var expiry = new Date(license_expiry_date);
        today.setHours(0, 0, 0, 0);

        if (expiry < today) {
            $("#msg").html("License has already expired!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

    });

});