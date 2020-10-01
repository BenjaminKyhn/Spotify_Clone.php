$(document).ready(function(){
    $("#hideLogin").click(function(){
        $("#loginForm").hide();
        $("#registerForm").show();
    });
});

$(document).ready(function(){
    $("#hideRegister").click(function(){
        $("#registerForm").hide();
        $("#loginForm").show();
    });
});