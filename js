
  var err=document.getElementById("error");

function validateForm() {
  var fName = document.forms["signupform"]["fName"].value;
  var mName = document.forms["signupform"]["mName"].value;
  var lName = document.forms["signupform"]["lName"].value;
  var password = document.forms["signupform"]["password"].value;
  var cpass = document.forms["signupform"]["confirm"].value;
  var mobile = document.forms["signupform"]["mobile"].value;
  var err=document.getElementById("error");


   if (cpass.length<=5) {
    err.innerHTML="Password Is Too Weak";
    return false;
  }else if(cpass!=password)
  {
    err.innerHTML="Passwords not Matching";
    return false;
  }else if(mobile.length!=10)
  {
    err.innerHTML="Mobile Number is Invalid";
    return false;
  }
}

function validateLogin() {

  var password = document.forms["signupform"]["password"].value;
  var err=document.getElementById("error");


   if (password.length<=5) {
    err.innerHTML="Invalid Password/Email";
    return false;
  }
}

function SearchProducts()
{
  var fName = document.forms["searchForm"]["fName"].value;
  var keyword=document.getElementById['search'].value;


  console.log(keyword);
}
