/*
let prsName = getValue("prsName");
let prsDeadline = getValue("prsDeadline");
let prsDate = getValue("prsDate");
let prsRecName = getValue("prsRecName");
let prsRecEmail = getValue("prsRecEmail");
let prsIban = getValue("prsIban");
let prsDesc = getValue("prsDesc");
*/

let btnPrsSubmit = gid("prsSubmit");
let btnPubSubmit = gid("pubSubmit");

function submitPrs() {
    console.log("hi");
    let formData = new FormData();
    formData.append("name", getValue("prsName"));
    formData.append("date", getValue("prsDate"));
    formData.append("deadline", getValue("prsDeadline"));
    formData.append("recName", getValue("prsRecName"));
    formData.append("recEmail", getValue("prsRecEmail"));
    formData.append("iban", getValue("prsIban"));
    formData.append("desc", getValue("prsDesc"));
    let errors = gid("prsErrorsDiv");

    submitForm(formData, "./includes/regPrsEvent.php", "./events.php", errors);
}

btnPrsSubmit.addEventListener('click', submitPrs);

function submitPub() {
    let formData = new FormData();
    formData.append("name", getValue("pubName"));
    formData.append("date", getValue("pubDate"));
    formData.append("hour", getValue("pubHour"));
    formData.append("place", getValue("pubPlace"));
    formData.append("desc", getValue("pubDesc"));
    formData.append("external", getValue("pubExternal"));
    let errors = gid("pubErrorsDiv");
    submitForm(formData, "./includes/regPubEvent.php", "./events.php", errors);
}

btnPubSubmit.addEventListener('click', submitPub);