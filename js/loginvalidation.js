$(document).ready(function(){

    $("form").submit(function(){
        var username = $("#loginusername").val();
        var password = $("#loginpassword").val();

        if(username==""){
            $("#msg").addClass("alert alert-danger");
            $("#msg").html("<b>User Name Cannot Be Empty!!!</b>");
            return false;
        }
        else if(password==""){
            $("#msg").addClass("alert alert-danger");
            $("#msg").html("<b>Password Cannot Be Empty!!!</b>");
            return false;
        }
    });


});