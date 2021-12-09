var alertBox = document.getElementById('alert-box');


function showAlertBox(){
    if(alertBox.style.display != 'none'){
        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 5000);
    }
}
showAlertBox();