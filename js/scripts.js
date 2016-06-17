//================================================
// Change Validity Test
//================================================

function validatePassword(){
    var pass2=document.getElementById("inputPassword").value;
    var pass1=document.getElementById("inputPasswordConfirm").value;
    
    if(pass1!=pass2)
        document.getElementById("inputPasswordConfirm").setCustomValidity("As Passwords devem ser iguais");
    else
        document.getElementById("inputPasswordConfirm").setCustomValidity('');  
}

window.onload = function () {
    document.getElementById("inputPassword").onchange = validatePassword;
    document.getElementById("inputPasswordConfirm").onchange = validatePassword;
}

//=====================================================================
// URL NERD STUFF (http://www.sitepoint.com/url-parameters-jquery/)
//=====================================================================

$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results!=null ? results[1] : '';
}

//=====================================================================
// Custom button events
//=====================================================================

$(document).ready(function() {  

	$('#loginFormError').hide();

    $('#registerFormError').hide();

    $('#loginFormButton').click(function( event ){

    	event.preventDefault();

    	//get variables
    	var passwordValue = $('#inputPassword').val();
    	var emailValue = $('#inputEmail').val();

    	$.post("scripts/loginUser.php", {email: emailValue, password: passwordValue}).done(function(data){

    		if(data === "INVALID_USER"){
    			
    			//mostrar erro
    			$('#loginFormError').show();

    			$('#inputPassword').val("");
    		}else{
    			
    			//adicionar cookie
    			$.cookie("user", emailValue, { expires: 1, path: '/' });

    			//mudar de pagina
    			window.location.replace("./home.php");

    		}
    	});
    });

    $('#guestModeButton').click(function( event ){

    	event.preventDefault();

		//adicionar cookie
		$.cookie("user", "@convidado@", { expires: 1, path: '/' });

		//mudar de pagina
		window.location.replace("./home.php");

    });

    $('#registerFormSubmitButton').click(function( event ){

        //get variables
        var inputFirstNameValue = $('#inputFirstName').val(); 
        var inputLastNameValue = $('#inputLastName').val(); 
        var inputTelValue = $('#inputTel').val();
        var inputEmailValue = $('#inputEmail').val();
        var inputPasswordValue = $('#inputPassword').val();
        var inputPasswordConfirmValue = $('#inputPasswordConfirm').val();

        if(inputFirstNameValue != "" && inputLastName != "" && inputEmailValue != "" && inputPasswordValue != "" &&
         inputPasswordValue == inputPasswordConfirmValue){

            $.post("scripts/createUser.php", {inputFirstName: inputFirstNameValue, 
                inputLastName: inputLastNameValue, 
                inputTel: inputTelValue, 
                inputEmail: inputEmailValue,
                inputPassword: inputPasswordValue }).done(function(data){

                if(data == "EMAIL_ALREADY_REGISTERED"){
                    
                    //mostrar erro
                    $('#registerFormError').show();

                }else if(data == "VALID_INSERTION"){

                    //adicionar cookie
                    $.cookie("user", inputEmailValue, { expires: 1, path: '/' });

                    //mudar de pagina
                    window.location.replace("./home.php");

                }else if(data == "INVALID_INSERTION"){

                    $('#registerFormError').show();

                    $('#registerFormError').text("Algo correu mal! Tente novamente mais tarde");
                }
            });
        }  

    });
    
    $('#logoutButton').click(function( event ){

        event.preventDefault();

        //adicionar cookie
        console.log($.removeCookie("user", { expires: 1, path: '/' }));

        //mudar de pagina
        window.location.replace("./index.php");

    });

    $('#searchButton').click(function( event ){

        event.preventDefault();

        var category = $.urlParam('category');

        var searchQuery = $('#searchInput').val();

        if(searchQuery != ''){
            if(category != '')
                window.location.replace("./home.php?category=" + category + "&searchQuery=" + encodeURIComponent(searchQuery) + "");
            else
                window.location.replace("./home.php?searchQuery=" + encodeURIComponent(searchQuery) + "");
        }

    });

    $('#enrollCourseButton').click(function( event ){

        event.preventDefault();

        //Enroll user in courses
        $.post("scripts/enrollCourse.php", {courseId: $.urlParam('id')}).done(function(data){

            console.log(data);
            
            window.location.reload();
        
        });

    });


    //Question Scritps

    //Hide button
    $('#fwd').hide();

    //Script for each Submit
    $("#submitQuestion").click(function(event){

        event.preventDefault();

        //Get Values
        var questionIdValue = $('#questionId').val();

        var lessonIdValue = $('#lessonId').val();

        var answerValue = $('.selectedAnswer').text();

        //Test If Answer Is Correct
        $.post("scripts/submitQuestion.php", {questionId: questionIdValue, answer: answerValue, userEmail: $.cookie('user') , lessonId: lessonIdValue }).done(function(data){

            if(data=="CORRECT_ANSWER"){

                $('#fwd').show();

                $(".selectedAnswer").css("background", "#27ae60");


            }else{

                $(".selectedAnswer").css("background" ,"#c0392b");
            }
        
        });        

    });

    //Script for each Answer
    $(".questionAnwser").click(function(event){

        event.preventDefault();
        
        //Clean other Answer
        $(".questionAnwser").removeClass("selectedAnswer");

        //Mark Answer as right
        $(this).addClass("selectedAnswer");

    });
    
});