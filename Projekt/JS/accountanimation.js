const mainAccountPageB_id = document.getElementById('mainAccountPage'),
    orderHistoryPageB_id = document.getElementById('orderHistoryPage'),
    mainAccountPage_id = document.getElementById('helloMessage'),
    orderHistoryPage_id = document.getElementById('history');

function mainAccountF() {
    mainAccountPage_id.style.display = 'block';
    orderHistoryPage_id.style.display = 'none';
}

function orderHistoryF() {
    mainAccountPage_id.style.display = 'none';
    orderHistoryPage_id.style.display = 'block';
}

mainAccountPageB_id.addEventListener("click", () => { mainAccountF(); });
orderHistoryPageB_id.addEventListener("click", () => { orderHistoryF(); });