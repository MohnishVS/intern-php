var check = function() {
    if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'Password matching';
    } 
    else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Password not matching';
    }
};

$('document').ready(function(){
    var username_state = false;
    var email_state = false;
    
    $('#username').on('blur', function(){
     var username = $('#username').val();
     if (username == '') {
         username_state = false;
         return;
     }
     $.ajax({
       url: 'process.php',
       type: 'post',
       data: {
           'username_check' : 1,
           'username' : username,
       },
       success: function(response){
         if (response == 'taken' ) {
             username_state = false;
             document.getElementById('message').style.color = 'red';
             document.getElementById('message1').innerHTML = 'username already exists';;
         }
         else if (response == 'not_taken') {
             username_state = true;
             document.getElementById('message').style.color = 'green';
             document.getElementById('message1').innerHTML = 'username available';
         }
       }
     });
    });

    $('#email').on('blur', function(){
        var email = $('#email').val();
        if (email == '') {
            email_state = false;
            return;
        }
        $.ajax({
         url: 'process.php',
         type: 'post',
         data: {
             'email_check' : 1,
             'email' : email,
         },
         success: function(response){
             if (response == 'taken' ) {
             email_state = false;
             document.getElementById('message').style.color = 'red';
             document.getElementById('message2').innerHTML = 'email already exists';
             }
             else if (response == 'not_taken') {
               email_state = true;
               document.getElementById('message').style.color = 'green';
               document.getElementById('message2').innerHTML = 'welcome new user';
             }
         }
        });
    });

    $('#reg_btn').on('click', function(){
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        if (username_state == false || email_state == false) {
         $('#error_msg').text('Fix the errors in the form first');
       }
       else{
         $.ajax({
             url: 'process.php',
             type: 'post',
             data: {
                 'save' : 1,
                 'email' : email,
                 'username' : username,
                 'password' : password,
             },
             success: function(response){
                 alert('user saved'); 
             },
             error: function(response){
                 alert('error occured');

             }
         });
        }
    });
   });
