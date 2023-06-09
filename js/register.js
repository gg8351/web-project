let btnRegister = gid("btnReg");

function register() {
    let formData = new FormData();
    formData.append("email", getValue("email"));
    formData.append("name", getValue("name"));
    formData.append("pwd", getValue("pwd"));
    formData.append("cpwd", getValue("cpwd"));
    let errors = gid("regErrors");
    submitForm(formData, "includes/regUser.php", "./login.php", errors);

}

btnRegister.addEventListener('click', register);