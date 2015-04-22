$(document).ready(function(){
	//function disableCreateTopic(){
	//	$('#create-topic').bind('click', function() {
     //       e.preventDefault();
     //   });
	//}
    //
	//function enableCreateTopic(){
	//	$('#create-topic').removeProp('disabled');
	//}

	$('#confirm-pass').on('input', function(){
		var password = $('#password').val();
		var confirmPass = $('#confirm-pass').val();

		if(password != confirmPass){
			wrongData('#confirm-pass');
			disableRegisterButton();
		} else {
			correctData('#confirm-pass');
			enableRegisterButton();
		}
	});

	$('#email').on('input', function(){
	var mailRegex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var email = $('#email').val();	
	var isValid = mailRegex.test(email);
	console.log(isValid);
		if(!isValid){
			wrongData('#email');
			disableRegisterButton();
		} else {
			correctData('#email');
			enableRegisterButton();
		}
	});


    function wrongData(id){
        $(id).prop('style', 'border: 2px solid red');
    }

    function correctData(id){
        $(id).prop('style', 'border: 2px solid green');
    }

    function disableRegisterButton(){
        $('#registerButton').prop('disabled', 'disabled');
    }

    function enableRegisterButton(){
        $('#registerButton').removeProp('disabled');
    }
});