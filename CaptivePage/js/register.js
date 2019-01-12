const form = document.getElementById('form-email');
      
      form.addEventListener('submit', function(e) {
        document.getElementById('status').innerHTML = "";
        document.getElementById('status').style.display = "none";
        verifyEmptyEmail();
        e.preventDefault();
      })

const verifyEmptyEmail = function() {
  const email = document.getElementById('email');
  if (email.value == ''){
    const status = document.getElementById('status');
          status.innerHTML = "Please enter your email";
          status.style.display = "table";
  }else{
    console.log(email.value);
  }
 
}