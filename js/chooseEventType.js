let usrChoice = gid("userChoice");
let privEventForm = gid("privateEvent");
let pubEventForm = gid("publicEvent");

function showPrivEventForm() {
    privEventForm.style.display = "none";
    pubEventForm.style.display = "none";
}

function changeFormVisibility() {
    let value = usrChoice.value;
    privEventForm.style.display = value === "personal" ? "block" : "none";
    pubEventForm.style.display = value === "public" ? "block" : "none";
}

showPrivEventForm();

usrChoice.addEventListener('change', changeFormVisibility);