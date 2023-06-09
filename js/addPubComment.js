let btnComment = gid("btn_comment");

function addComment() {
    let formData = new FormData();
    formData.append("content", getValue("txa_comment"));
    formData.append("puid", getValue("puid"));
    console.log(formData);
    submitForm(formData, "./includes/addPubComment.php", "", gid("commentErrors"));
}

btnComment.addEventListener('click', addComment);