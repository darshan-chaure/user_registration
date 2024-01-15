function submitUser(){
	var name = $("#name").val();
	var email = $("#email").val();
	var username = $("#username").val();
	var password = $("#password").val();
	var data = $("#form1").serialize();
	data = data + "&submit=submit";
	var msg = validateSubmitUser();

	if(msg == ""){
		$.ajax({
			url: "register.php",
			method: "post",
			data: data,
			success: function(result){
				alert("User registered successfully.");
				window.location.href = "login.php";
		    },
		    error: function(result){
		    	alert("Something went wrong. Please try again later.");
		    }
		});
	}else{
		$("#err").css("color","red");
		$("#err").html(msg);
	}
}

function validateSubmitUser(){
	var name = $("#name").val();
	var email = $("#email").val();
	var username = $("#username").val();
	var password = $("#password").val();
	var msg = "";

	if(name == "" || email == "" || username == "" || password == ""){
		msg = "All fields are mandatory.";
	}else if(!validateEmail(email)){
		msg = "Invalid email.";
	}else{
		msg = "";
	}
	return msg;
}

function validateEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

$(document).ready(function() {
  $('#uploadForm').submit(function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
      type: 'POST',
      url: 'upload.php',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        response = JSON.parse(response);
        if (response.success) {
          // $('#imageContainer').html('<img src="' + response.filePath + '" alt="Uploaded Image">');
          alert("Photo uploaded successfully.");
          window.location.href = "index.php";
        } else {
          alert('Error uploading image: ' + response.error);
        }
      }
    });
  });
});
