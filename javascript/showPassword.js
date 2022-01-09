const passField=document.querySelector('.form input[type="password"]');
const togglebtn=document.querySelector('.form .field i');

togglebtn.onclick=function(){
    if(passField.type=='password'){
        passField.type='text';
        togglebtn.classList.add('active');
    }
    else{
        passField.type='password';
        togglebtn.classList.remove('active');
    }
}
