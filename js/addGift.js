let btnGift = gid("addGift");

function addGift() {
    let formData = new FormData();
    formData.append("name", getValue("giftName"));
    formData.append("url", getValue("giftUrl"));
    formData.append("prid", getValue("giftPrid"));
    let errors = gid("giftErrors");
    
    submitForm(formData, "./includes/regGift.php", "", errors);
}

btnGift.addEventListener('click', addGift);

function voteForGift(prid, giftId) {
    let formData = new FormData();
    formData.append("prid", prid);
    formData.append("giftId", giftId);
    
    let errors = gid("giftErrors");
    submitForm(formData, "./includes/regVote.php", "", errors);
}

function removeVoteForGift(prid, giftId) {
    let formData = new FormData();
    formData.append("prid", prid);
    formData.append("giftId", giftId);
    
    let errors = gid("giftErrors");
    submitForm(formData, "./includes/regRemoveVote.php", "", errors);
}