const form=document.querySelector('.signup form'),
btn=form.querySelector('.button input'),
errorText=form.querySelector(".error-text");

form.onsubmit=(e)=>{
    e.preventDefault();
}

btn.onclick=()=>{
    console.log("clicked");
    let xhr=new XMLHttpRequest();
    xhr.open("POST","_signup.php",true);
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response;
                if(data=='success'){
                    location.href="users.php";
                }else{
                    errorText.textContent=data;
                    errorText.style.display='block';
                }
            }
        }
    }
    let formData=new FormData(form);
    xhr.send(formData);
}