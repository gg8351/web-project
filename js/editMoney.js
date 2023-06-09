let btnIban = gid("btn_iban");
let btnPrice = gid("btn_newprice");
let btnFunds = gid("btn_addfunds");
let fundErrors = gid("fundErrors");

function changeIban() {
    let formData = new FormData();
    formData.append("prid", getValue("giftPrid"));
    formData.append("iban", getValue("if_iban"));

    submitForm(formData, "./includes/updateFunds.php", "", fundErrors);
}

btnIban.addEventListener('click', changeIban);

function setPrice() {
    let formData = new FormData();
    formData.append("prid", getValue("giftPrid"));
    formData.append("price", getValue("if_newprice"));
    submitForm(formData, "./includes/updateFunds.php", "", fundErrors);
    
}

btnPrice.addEventListener('click', setPrice);

function addFunds() {
    let formData = new FormData();
    formData.append("prid", getValue("giftPrid"));
    formData.append("funds", getValue("if_addfunds"));
    submitForm(formData, "./includes/updateFunds.php", "", fundErrors);

}

btnFunds.addEventListener('click', addFunds);