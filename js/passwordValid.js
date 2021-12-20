function ValidatePassword(){
    let myPass = document.getElementById('password');
    let passCont = document.getElementById('pwdCont');
    

    let pwdLen = document.getElementById('pwdLen');
    let pwdAlpha = document.getElementById('pwdAlpha');
    let pwdNum = document.getElementById('pwdNum');
    let pwdUpp = document.getElementById('pwdUpp');

    let flag1 = false;
    let flag2 = false;
    let flag3 = false;
    let flag4 = false;

    const alphaFormat = /[a-z]/g;
    const numFormat = /[0-9]/g;
    const uppFormat = /[A-Z]/g;

    if(myPass.value.length >=8 && myPass.value.length<=20){
        pwdLen.style.display = 'none';
        flag1 = true;
    }
    else{
        pwdLen.style.display = 'block';
        pwdLen.style.color = '#a70040';
        flag1 = false;
    }

    if(myPass.value.match(alphaFormat)){
        pwdAlpha.style.display = 'none';
        flag2 = true;
    }
    else{
        pwdAlpha.style.display = 'block';
        pwdAlpha.style.color = '#a70040';
        flag2 = false;
    }

    if(myPass.value.match(numFormat)){
        pwdNum.style.display = 'none';
        flag3 = true;
    }
    else{
        pwdNum.style.display = 'block';
        pwdNum.style.color = '#a70040';
        flag3 = false;
    }

    if(myPass.value.match(uppFormat)){
        pwdUpp.style.display = 'none';
        flag4 = true;
    }
    else{
        pwdUpp.style.display = 'block';
        pwdUpp.style.color = '#a70040';
        flag4 = false;
    }

    if(flag1 && flag2 && flag3 && flag4){
        passCont.style.display = 'none';
    }
    else{
        passCont.style.display = 'block';
    }

}

function MatchPasswords(){
    let myPass = document.getElementById('password');
    let cMyPass = document.getElementById('cpassword');

    if(cMyPass.value == myPass.value){
        document.getElementById('conPwdCont').style.display = 'none';
    }
    else{
        document.getElementById('conPwdCont').style.display = 'block';
    }
}