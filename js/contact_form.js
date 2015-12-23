$(document).ready(function(){  
$("#submit").click(function(){

    var email = $("#email").val();

    $("#returnmessage").empty(); //To empty previous error/success message.
//checking for blank fields	
if(email=='')
{
    alert("Podaj swój email i spróbuj ponownie"); 
}
else{
    alert("Twój email zostal dodany do newslettera!");
// Returns successful data submission message when the entered information is stored in database.
$.post("contact_form.php",{email1: email});
}
 
});
});
