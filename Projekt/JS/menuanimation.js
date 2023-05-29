const navigation_id = document;

// Funkcje do menu
function menu() {
    document.getElementById('navigation').style.visibility = 'visible';
    document.getElementById('menu').style.visibility = 'hidden';
    document.getElementById('navigation').classList.add('menuanimation');
    // document.querySelector('body').style.overflowY = 'hidden';
    document.querySelectorAll('.blur').forEach(Element => {
        Element.style.filter = 'blur(5px)';});
}

function exit() {
    document.getElementById('navigation').style.visibility = 'hidden';
    document.getElementById('menu').style.visibility = 'visible';
    document.getElementById('navigation').classList.remove('menuanimation');
    // document.querySelector('body').style.overflowY = 'visible';
    document.querySelectorAll('.blur').forEach(Element => {
        Element.style.filter = '';});

}

document.querySelector("#menu").addEventListener('click', () => { menu(); })
document.querySelector("#exit").addEventListener('click', () => { exit(); })