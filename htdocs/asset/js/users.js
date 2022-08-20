const searchBar = document.querySelector(".users .search input"),
searchbtn = document.querySelector('.users .search button'),
userList=document.querySelector(".users .users-list");

searchbtn.onclick = function(){
    searchbtn.classList.toggle('active');
}


searchBar.onkeyup=()=>{
    let searchTerm=searchBar.value;
    console.log("hello");
    let xhr=new XMLHttpRequest();
    xhr.open("POST",'php/search.php');
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response;
            }
        }
    }
    xhr.setRequestHeader('Content-type',"application/x-www-form-urlencoded");
    xhr.send("searchTerm="+searchTerm);
}

setInterval(()=>{
    let xhr=new XMLHttpRequest();
    xhr.open("GET","php/users.php",true);
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response;
                userList.innerHTML=data;
            }
        }
    }
    xhr.send();
},500)