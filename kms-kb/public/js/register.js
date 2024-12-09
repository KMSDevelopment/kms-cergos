function register() {
	document.querySelector("#login").style.left = "-500px";
	document.querySelector("#register").style.left = "0px";
	document.querySelector("#btn").style.left = "110px";
	document.querySelector("#log").style.color = "rgb(234, 234, 235)";
	document.querySelector("#reg").style.color = "#252525";
	document.querySelector("#after").style.left = "0";
	document.querySelector("#after").style.top = "0";
}
function login() {
	document.querySelector("#login").style.left = "0px";
	document.querySelector("#register").style.left = "500px";
	document.querySelector("#btn").style.left = "0px";
	document.querySelector("#log").style.color = "rgb(234, 234, 235)";
	document.querySelector("#reg").style.color = "#252525";
	document.querySelector("#after").style.left = "50%";
	document.querySelector("#after").style.top = "0";
}

