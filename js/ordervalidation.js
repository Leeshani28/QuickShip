$(document).ready(function () {

    $("#addorder").submit(function () {

        // Sender Details
        var sname = $("#sname").val();
        var semail = $("#semail").val();
        var saddress = $("#saddress").val();
        var snic = $("#snic").val();
        var scno1 = $("#scno1").val();
        var scno2 = $("#scno2").val();

        // Receiver Details
        var rname = $("#rname").val();
        var remail = $("#remail").val();
        var raddress = $("#raddress").val();
        var rnic = $("#rnic").val();
        var rcno1 = $("#rcno1").val();
        var rcno2 = $("#rcno2").val();

        // Package Details
        var pkg_type = $("#pkg_type").val();
        var quantity = $("#quantity").val();
        var pkg_value = $("#pkg_value").val();
        var packaging_type = $("#packaging_type").val();
        var pkg_weight = $("#pkg_weight").val();
        var pkg_length = $("#pkg_length").val();
        var pkg_width = $("#pkg_width").val();
        var height = $("#height").val();

        // Delivery Details
        var premises_no = $("#premises_no").val();
        var street = $("#street").val();
        var town = $("#town").val();
        var province_id = $("#province_id").val();
        var district_id = $("#district_id").val();
        var postal_code = $("#postal_code").val();
        var return_address = $("#return_address").val();
        var delivery_type = $("#delivery_type").val();
        var preferred_del_date = $("#preferred_del_date").val();

        // Payment
        var payment_type = $("#payment_type").val();

        // Patterns
        var patNic = /^[0-9]{9}[vVxX]$/;
        var patNic2 = /^[0-9]{12}$/;
        var patMobile = /^[0-9]{10}$/;
        var patEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var patPostal = /^[0-9]{5}$/;

       
        // Sender Validation
       

        if (sname == "") {
            $("#msg").html("Sender Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (semail == "") {
            $("#msg").html("Sender Email Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (!semail.match(patEmail)) {
            $("#msg").html("Sender Email is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (saddress == "") {
            $("#msg").html("Sender Address Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (snic == "") {
            $("#msg").html("Sender NIC Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (!snic.match(patNic) && !snic.match(patNic2)) {
            $("#msg").html("Sender NIC is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (scno1 == "") {
            $("#msg").html("Sender Mobile Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (!scno1.match(patMobile)) {
            $("#msg").html("Sender Mobile Number is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (scno2 != "" && !scno2.match(patMobile)) {
            $("#msg").html("Sender Fixed Number is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

       
        // Receiver Validation
       

        if (rname == "") {
            $("#msg").html("Receiver Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (remail != ""){
            if (!remail.match(patEmail)) {
            $("#msg").html("Receiver Email is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        }


        if (raddress == "") {
            $("#msg").html("Receiver Address Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(rnic != ""){
            if (!rnic.match(patNic) && !rnic.match(patNic2)) {
            $("#msg").html("Receiver NIC is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        }

        if (rcno1 == "") {
            $("#msg").html("Receiver Mobile Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (!rcno1.match(patMobile)) {
            $("#msg").html("Receiver Mobile Number is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (rcno2 != "" && !rcno2.match(patMobile)) {
            $("#msg").html("Receiver Fixed Number is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

       
        // Package Validation
       

        if (pkg_type == null) {
            $("#msg").html("Please Select Package Type!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (quantity == "") {
            $("#msg").html("Quantity Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (pkg_value == "") {
            $("#msg").html("Declared Value Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (packaging_type == null) {
            $("#msg").html("Please Select Packaging Type!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (pkg_weight == "") {
            $("#msg").html("Package Weight Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (pkg_length == "" || pkg_width == "" || height == "") {
            $("#msg").html("Package Dimensions Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

       
        // Delivery Validation
       

        if (premises_no == "") {
            $("#msg").html("Premises Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (street == "") {
            $("#msg").html("Street Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (town == "") {
            $("#msg").html("Town/City Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        // if (province_id == "") {
        //     $("#msg").html("Please Select Province!");
        //     $("#msg").addClass("alert alert-danger");
        //     return false;
        // }

        if (district_id == null) {
            $("#msg").html("Please Select District!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (postal_code == "") {
            $("#msg").html("Postal Code Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (return_address == "") {
            $("#msg").html("Return Address Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (delivery_type == null) {
            $("#msg").html("Please Select Delivery Type!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (preferred_del_date == "") {
            $("#msg").html("Please Select Preferred Delivery Date!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }


            // small validations


        if (parseInt(quantity) <= 0) {
            $("#msg").html("Quantity must be greater than 0!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (parseFloat(pkg_value) <= 0) {
            $("#msg").html("Declared Value must be greater than 0!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }


        if (parseFloat(pkg_weight) <= 0) {
            $("#msg").html("Package Weight must be greater than 0!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }


        if (parseFloat(pkg_length) <= 0) {
            $("#msg").html("Package Length must be greater than 0!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }



        if (parseFloat(pkg_width) <= 0) {
            $("#msg").html("Package Width must be greater than 0!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }




        if (parseFloat(height) <= 0) {
            $("#msg").html("Package Height must be greater than 0!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }



        if (!postal_code.match(patPostal)) {
            $("#msg").html("Postal Code must contain exactly 5 digits!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }



       
        // Payment Validation
       

        if (payment_type == null) {
            $("#msg").html("Please Select Payment Type!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

    });

});