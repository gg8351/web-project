let btnEmail = gid("btnEmail");
let btnPwd = gid("btnPwd");
let btnName = gid("btnName");
let btnDob = gid("btnDob");

function changeEmail() {
    let formData = new FormData();
    formData.append("email", getValue("cemail_email"));
    formData.append("pwd", getValue("cemail_pwd"));

    let errors = gid("emailErrors");
    submitForm(formData, "includes/editProfile.php", "./profile.php", errors);
}

btnEmail.addEventListener('click', changeEmail);

function changePwd() {
    let formData = new FormData();
    formData.append("pwd", getValue("cpwd_pwd"));
    formData.append("cpwd", getValue("cpwd_cpwd"));
    formData.append("oldpwd", getValue("cpwd_oldpwd"));
    
    let errors = gid("pwdErrors");
    submitForm(formData, "includes/editProfile.php", "./profile.php", errors);
}

btnPwd.addEventListener('click', changePwd);

function changeName() {
    let formData = new FormData();
    formData.append("name", getValue("cname_name"));

    let errors = gid("nameErrors");
    submitForm(formData, "includes/editProfile.php", "./profile.php", errors);
}

btnName.addEventListener('click', changeName);

function changeDob() {
    let formData = new FormData();
    formData.append("dob", getValue("cdate_dob"));

    let errors = gid("dobErrors");
    submitForm(formData, "includes/editProfile.php", "./profile.php", errors);
}