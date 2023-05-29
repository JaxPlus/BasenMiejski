const loginB_id = document.querySelector('#loginB'),
    registrationB_id = document.querySelector('#registrationB'),
    login_id = document.querySelector('#login'),
    registration_id = document.querySelector('#registration');

// Funkcje do rejestracji i logowania
function registrationF() {
    registration_id.style.visibility = 'visible';
    login_id.style.visibility = 'hidden';
    registrationB_id.classList.add('borderanimation');
    loginB_id.classList.remove('borderanimation');
}

function loginF() {
    login_id.style.visibility = 'visible';
    registration_id.style.visibility = 'hidden';
    loginB_id.classList.add('borderanimation');
    registrationB_id.classList.remove('borderanimation');
}

function setCookie(cookie) {
    cookie = cookie == 'rejestracja' ? document.cookie = 'action='+ cookie : document.cookie = 'action='+ cookie;
}

registrationF();

if (document.cookie.includes('rejestracja')) { registrationF(); } else { loginF(); }

registrationB_id.addEventListener('click', () => { registrationF(); })
loginB_id.addEventListener('click', () => { loginF(); })