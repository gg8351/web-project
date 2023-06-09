let btnComment = gid("btn_comment");

function addComment() {
    let formData = new FormData();
    formData.append("content", getValue("txa_comment"));
    formData.append("prid", getValue("giftPrid"));
    console.log(formData);
    submitForm(formData, "./includes/addComment.php", "", gid("commentErrors"));
}

btnComment.addEventListener('click', addComment);