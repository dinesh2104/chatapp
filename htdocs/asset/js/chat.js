const form=document.querySelector('.typing-area'),
inputField=form.querySelector('.input-field'),
sendBtn=form.querySelector('.button'),
chatbox=document.querySelector('.chat-box');

form.onsubmit=(e)=>{
    e.preventDefault();
}

sendBtn.onclick=()=>{
    let xhr=new XMLHttpRequest();
    xhr.open("POST","_insertChat.php",true);
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                inputField.value='';
                scrollToBottom();
            }
        }
    }
    let formData=new FormData(form);
    xhr.send(formData);
}
chatbox.onmouseenter=()=>{
    chatbox.classList.add('active');
}
chatbox.onmouseleave=()=>{
    chatbox.classList.remove('active');
}
setInterval(()=>{
    let xhr=new XMLHttpRequest();
    xhr.open("POST","_getChat.php",true);
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response;
                console.log(data);
                chatbox.innerHTML=data;
                if(!chatbox.classList.contains('active')){
                    scrollToBottom();
                }
            }
        }
    }
    let formData=new FormData(form);
    xhr.send(formData);
},500)

function scrollToBottom(){
    chatbox.scrollTop=chatbox.scrollHeight;
}