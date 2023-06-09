let btnLogin = gid("btnLogin");

function login() {
    let formData = new FormData();
    formData.append("email", getValue("email"));
    formData.append("pwd", getValue("pwd"));
    let errors = gid("loginErrors");
    submitForm(formData, "includes/loginUser.php", "./index.php", errors);
}

btnLogin.addEventListener('click', login);