const obj = document.getElementById("obj");
const obs = document.getElementById("obs");
var div = document.getElementById("login-form");
var objects = document.getElementById("objects");
var display = 0;
var old_score = 0;
var highscore = 0;

var time = 0;

function hideLogin() {
  var userName = document.getElementById("userName").value;

  if (userName != "") {
    if (display == 1) {
      

      div.style.display = "block";
      objects.style.display = "none";
      display = 0;
    } else {
      div.style.display = "none";
      objects.style.display = "block";
      document.getElementById("game-info").style.display = "flex";

      document.getElementById("username").innerHTML = userName;
      display = 1;
      inter();
      test(userName);
      getHighschore(userName);
    }
  }else{
    document.getElementById("check").innerHTML = "please provide username";
  }
}
function test(usernsme) {
  let xhr = new XMLHttpRequest();

  var url = "saveUserName.php";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
    }
  };
  xhr.send(`userName=${encodeURIComponent(usernsme)}`);
}

function updatehighscore(username, hscore) {
  let xhr = new XMLHttpRequest();

  var url = "updatehighscore.php";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
    }
  };
  xhr.send(`userName=${encodeURIComponent(username)}&hiscore=${encodeURIComponent(hscore)}`);

}

function getHighschore(usernsme) {
  let xhr = new XMLHttpRequest();

  var url = "getHighScore.php";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      highscore = JSON.parse(this.responseText).highscore;
      document.getElementById("h_score").innerHTML = highscore;
    }
  };
  xhr.send(`userName=${encodeURIComponent(usernsme)}`);
}

function hideGame() {
  objects.style.display = "block";
  document.getElementById("game-over").style.display = "none";
  document.getElementById("game-info").style.display = "flex";
  getHighschore(userName);
  inter();
}

function jump() {
  if (obj.classList != "jump") {
    obj.classList.add("jump");

    setTimeout(function () {
      obj.classList.remove("jump");
    }, 500);
  }
}
function inter() {
  let isAlive = setInterval(function () {
    let objTop = parseInt(window.getComputedStyle(obj).getPropertyValue("top"));

    let obsLeft = parseInt(
      window.getComputedStyle(obs).getPropertyValue("left")
    );

    if (obsLeft < 20 && obsLeft > 0 && objTop > 240) {
      

      document.getElementById("game-over").style.display = "block";
      objects.style.display = "none";
      document.getElementById("game-info").style.display = "none";
      
      hscore();
      time = 0;
      clearInterval(isAlive);
    } else {
      time = time + 0.3;

      document.getElementById("score").innerHTML = parseInt(time);
      document.getElementById("finalscore").innerHTML = "Oh no, you lost the game! Better luck next time <br>your Final Score Is "+parseInt(time);
    }
  }, 10);
}
document.addEventListener("keydown", function (e) {
  jump();
});

function hscore() {
  var uname = document.getElementById("userName").value;
  tt = parseInt(time)

  // console.log(highscore);
  if ( tt> highscore && tt>old_score) {
    old_score=tt;
    document.getElementById("h_score").innerHTML = old_score;
    updatehighscore(uname, tt);
  }
}
