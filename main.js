var alertBox = document.getElementById('alert-box');


function showAlertBox(){
    if(alertBox.style.display != 'none'){
        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 5000);
    }
}
showAlertBox();


// ================== EMAIL VALIDATION ==================
function ValidateEmail(){
    var myEmail = document.getElementById('email');
    var mailformat = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
    if(myEmail.value.match(mailformat)){
        document.getElementById('msgCont').style.display = 'none';
        document.getElementById('emailMsg').innerHTML = '';
    }
    else{
        document.getElementById('msgCont').style.display = 'block';
        document.getElementById('emailMsg').innerHTML = 'Invalid email address';
    }
}