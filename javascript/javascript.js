function menuFunction(){
    x = document.getElementById("myTopnav");
    if(x.className === "topnav"){
        x.className += "responsive";
    }else{
        x.className = "topnav";
    }
}
function menuFunction(){
    x = document.getElementById("myTopnav");
    if(x.className === "topnav"){
        x.className += "responsive";
    }else{
        x.className = "topnav";
    }
}

var btn1 = document.querySelector('#btn1');
var btn2 = document.querySelector('#btn2');
var btn3 = document.querySelector('#btn3');

btn1.addEventListener('click', () => {
    document.getElementById('full').style.backgroundImage = "linear-gradient(rgba(0, 0, 0, 0.527),rgba(0, 0, 0, 0.5)) , url('bg/bg4.jpg')";
  });
  btn2.addEventListener('click', () => {
    document.getElementById('full').style.backgroundImage = "linear-gradient(rgba(0, 0, 0, 0.527),rgba(0, 0, 0, 0.5)) , url('bg/bg2.jpg')";
  });
  btn3.addEventListener('click', ()=>{
    document.getElementById('full').style.backgroundImage = "linear-gradient(rgba(0, 0, 0, 0.527),rgba(0, 0, 0, 0.5)) , url('bg/bg3.jpg')";
  });
