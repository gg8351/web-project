var gid = document.getElementById.bind(document);

function getValue(id) {
   let el = gid(id);
   if (el === null)
      return "";
   return el.value.trim();
}

function submitForm(formData, target, redirect, errorsDiv) {
   errorsDiv.innerHTML = "";
   fetch(target, {
      method: "POST",
      body: formData
   })
   .then((response => response.json()))
   .then((data) => {
      if(data.success == true) {
            window.location = redirect;
      } else {
         data.errors.forEach(el => {
            errorsDiv.innerHTML += `<p>${el}</p>`;
         });
      }
   });
}