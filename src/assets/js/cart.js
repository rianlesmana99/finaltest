const btn = document.getElementById("btn-menu");
const closeBtn = document.getElementById("close-btn");
const navside = document.getElementById("navside");

btn.addEventListener("click", ()=> navside.style = "left: 0;");
closeBtn.addEventListener("click", ()=> navside.style = "left: -100vw;");