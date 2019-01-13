
// event submit
const form = document.getElementById('form-email');

form.addEventListener('submit', function(e) {
  hideSpans();
  validate();
  e.preventDefault();
})

// function to validate fields and redirect to next step
const validate = function() {
  const name = document.getElementById('name');
  const email = document.getElementById('email');

  if (name.value == ""){
    const statusName = document.getElementById('statusName');
          statusName.innerHTML = "Please enter your name";
          statusName.style.display = "table";
  }else if (email.value == ""){
    const statusEmail = document.getElementById('statusEmail');
          statusEmail.innerHTML = "Please enter your email";
          statusEmail.style.display = "table";
  }else{
    window.location.href = "#";
  }
 
}

// hide fields spans
const hideSpans = function(){
  document.getElementById('statusName').innerHTML = "";
  document.getElementById('statusName').style.display = "none";
  document.getElementById('statusEmail').innerHTML = "";
  document.getElementById('statusEmail').style.display = "none";
}