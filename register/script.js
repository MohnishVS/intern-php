var check = function () {
    if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'Password matching';
    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Password not matching';
    }
};

var usercheck = function () {
    var username = $('#username').val();
    if (username == '') {
        username_state = false;
        return;
    }
    $.ajax({
        url: 'process.php',
        type: 'post',
        data: {
            'username_check': 1,
            'username': username,
        },
        success: function (response) {
            if (response == 'taken') {
                username_state = false;
                document.getElementById('message1').style.color = 'red';
                document.getElementById('message1').innerHTML = 'Username already exists';
                document.getElementById('user').value = username;
            } else if (response == 'not_taken') {
                username_state = true;
                document.getElementById('message1').style.color = 'green';
                document.getElementById('message1').innerHTML = 'Username available';
                document.getElementById('user').value = username;
            }
        }
    });
};

var emailcheck = function () {
    var email = $('#email').val();
    if (email == '') {
        email_state = false;
        return;
    }
    $.ajax({
        url: 'process.php',
        type: 'post',
        data: {
            'email_check': 1,
            'email': email,
        },
        success: function (response) {
            if (response == 'taken') {
                email_state = false;
                document.getElementById('message2').style.color = 'red';
                document.getElementById('message2').innerHTML = 'Email already exists';
            } else if (response == 'not_taken') {
                email_state = true;
                document.getElementById('message2').style.color = 'green';
                document.getElementById('message2').innerHTML = 'Welcome new user';
            }
        }
    });
};


var save = function () {
    var username = $('#username').val();
    var email = $('#email').val();
    var password = $('#password').val();
    if (username_state == false || email_state == false) {
        $('#error_msg').text('Fix the errors in the form first');
    } else {
        $.ajax({
            url: 'process.php',
            type: 'POST',
            data: {
                'save': 1,
                'email': email,
                'username': username,
                'password': password,
            },
            success: function (response) {
                if(response == 'success'){
                    document.getElementById('messageuser').innerHTML="User Registered";
                    document.getElementById('user').innerHTML = username;
                }
                else{
                    document.getElementById('messageuser').innerHTML="Registration Failed";
                }
               
            }
        });
    }
};



var resup = function () {
    var jform = new FormData();
    jform.append('user',$('#user').val());
    jform.append('file',$('#file').get(0).files[0]); // Here's the important bit

    $.ajax({
        url: 'process.php',
        type: 'POST',
        data: jform,
        dataType: 'text',
        mimeType: 'multipart/form-data', // this too
        contentType: false,
        cache: false,
        processData: false,
        success: function(data){
            if(data == "Uploaded"){
                document.getElementById('messageres').innerHTML="Upload Success";
            }
            else{
                document.getElementById('messageres').innerHTML=data;
            }
        },
        error: function(jqXHR,status,error){
            // Hopefully we should never reach here
            console.log(jqXHR);
            console.log(status);
            console.log(error);
        }
    });
};
