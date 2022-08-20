console.log("hello from js");
alert(1);

function change1(){
    $('h1').html('This is changed by Main.js');
}

setTimeout(()=>{
    change1()
},3000);