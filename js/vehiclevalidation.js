$(document).ready(function () {

    $("#vehicleform").submit(function () {

        var vehicle_number = $("#vehicle_number").val().trim();
        var vehicle_type = $("#vehicle_type").val();
        var vehicle_capacity = $("#vehicle_capacity").val().trim();
        var vehicle_district = $("#vehicle_district").val();

        // Required Field Validation

        if (vehicle_number == "") {
            $("#msg").html("Vehicle Number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (vehicle_type == null || vehicle_type == "" || vehicle_type == "Select Vehicle Type") {
            $("#msg").html("Vehicle Type Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (vehicle_capacity == "") {
            $("#msg").html("Vehicle Capacity Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (vehicle_district == null || vehicle_district == "" || vehicle_district == "Select Branch") {
            $("#msg").html("Branch Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        // Regular Expressions

        // Accepts Sri Lankan style vehicle numbers such as:
        // ABC-1234, WP CAB-1234, NC-1234, CAA-1234
        var patVehicle = /^[A-Za-z0-9 -]{5,15}$/;

        // Numbers only (allows integers and decimals)
        var patCapacity = /^[0-9]+(\.[0-9]+)?$/;

        if (!vehicle_number.match(patVehicle)) {
            $("#msg").html("Vehicle Number is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (!vehicle_capacity.match(patCapacity)) {
            $("#msg").html("Vehicle Capacity Must Be Numeric!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (parseFloat(vehicle_capacity) <= 0) {
    $("#msg").html("Vehicle Capacity Must Be Greater Than Zero!");
    $("#msg").addClass("alert alert-danger");
    return false;
}


});

});