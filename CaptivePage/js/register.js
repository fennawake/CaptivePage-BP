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
    if (IsEmail){
      console.log(email.value);
    }else{
      console.log("erro");
    }
  }
  
}

function IsEmail(email){
  var exclude=/[^@-.w]|^[_@.-]|[._-]{2}|[@.]{2}|(@)[^@]*1/;
  var check=/@[w-]+./;
  var checkend=/.[a-zA-Z]{2,3}$/;
  if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){return false;}
  else {return true;}
}