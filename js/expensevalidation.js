$(document).ready(function () {

    $("form").submit(function () {

        var expense_category = $("#expense_category").val();
        var expense_amount = $("#expense_amount").val().trim();
        var expense_date = $("#expense_date").val();
        var expense_description = $("#expense_description").val().trim();

        // Clear previous message
        $("#msg").removeClass("alert alert-danger").html("");

        
        // Required Field Validation
        

        if (expense_category == null ||
            expense_category == "" ||
            expense_category == "Select Category") {

            $("#msg").html("Expense Category Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (expense_amount == "") {

            $("#msg").html("Expense Amount Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (expense_date == "") {

            $("#msg").html("Expense Date Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (expense_description == "") {

            $("#msg").html("Description Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        
        // Regular Expressions
        

        var patAmount = /^\d+(\.\d{1,2})?$/;

        if (!expense_amount.match(patAmount)) {

            $("#msg").html("Expense Amount is Invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        
        // Business Validations
        

        if (parseFloat(expense_amount) <= 0) {

            $("#msg").html("Expense Amount must be greater than 0!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        var today = new Date().toISOString().split("T")[0];
            $("#expense_date").attr("min", today);

            if (expense_date < today) {
                $("#msg").html("Expense Date cannot be a past date!");
                $("#msg").addClass("alert alert-danger");
                return false;
        }

        if (expense_description.length < 5) {

            $("#msg").html("Description must contain at least 5 characters!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

    });

});