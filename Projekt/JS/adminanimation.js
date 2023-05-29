const buttonPass_id = document.querySelector("#passB"),
    buttonNews_id = document.querySelector("#newsB"),
    buttonUsers_id = document.querySelector("#usersB"),
    contentPass_id = document.querySelector(".contentPass"),
    contentNews_id = document.querySelector(".contentNews"),
    contentUsers_id = document.querySelector(".contentUsers"),
    startMessage_id = document.querySelector(".startMessage");

function showPass() {
    contentPass_id.style.display = "block";
    hideNews();
    hideUsers();
    hideStart();
}

function showNews() {
    contentNews_id.style.display = "block";
    hidePass();
    hideUsers();
    hideStart();
}

function showUsers() {
    contentUsers_id.style.display = "block";
    hideNews();
    hidePass();
    hideStart();
}

// To do chowania
// zrób to klasami przyszły ja!!! ~~ nie pamiętam o co chodziło XD
hidePass = () => contentPass_id.style.display = "none";
hideNews = () => contentNews_id.style.display = "none";
hideUsers = () => contentUsers_id.style.display = "none";

hideStart = () => startMessage_id.style.display = "none";
showStart = () => startMessage_id.style.display = "flex";

function setCookie(cookie) {
    document.cookie = 'adminAction='+ cookie;
}

if (document.cookie.includes('news'))
    { showNews(); }
else if(document.cookie.includes('user'))
    { showUsers(); }
else if(document.cookie.includes('pass'))
    { showPass(); }
else
    { showStart(); setCookie(null); }

buttonPass_id.addEventListener('click', () => { showPass(); setCookie('pass') });
buttonNews_id.addEventListener('click', () => { showNews(); setCookie('news') });
buttonUsers_id.addEventListener('click', () => { showUsers(); setCookie('user') });