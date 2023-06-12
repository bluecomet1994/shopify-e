const authorization_process_path = "/sampleSelling-master/user/authorization/process/";
const view_cart_process_path = "/sampleSelling-master/view_cart/process/" 
const authorization_view_path = "/sampleSelling-master/user/authorization/view/"
const home_path = "/sampleSelling-master/home/index.php"
const resources_path = "/sampleSelling-master/resources/"
function getCart2() {

  return JSON.parse(globalThis.localStorage.getItem("cart") ?? "{}");
}
function getCart() {
  let localstorageArray = globalThis.localStorage.getItem("cart");

  if (localstorageArray == null) {
    const url = "/sampleSelling-master/view_cart/process/get_customer_cart.php";
    fetch(url, { method: "POST" })
      .then((response) => response.json())
      .then((text) => {
        globalThis.localStorage.setItem("cart", JSON.stringify(text));
        showCartItems(
          JSON.parse(globalThis.localStorage.getItem("cart") ?? "{}")
        );
      });
  } else {
    return JSON.parse(globalThis.localStorage.getItem("cart") ?? "{}");
  }
}

function upDateCartBagGui(arrayName){
  let cartRowCount = Object.keys(arrayName).length;
  let cartBag = document.getElementById("cartItems");
  if(cartBag == undefined ){
    return;
  }else{
    cartBag.innerHTML = cartRowCount;
  }
 
}


(async () => {
  upDateCartBagGui(getCart());

})();
let sendToCustomerCart = () => {
  let cartArray;
  cartArray = JSON.stringify(getCart());

  const url = view_cart_process_path+"add_to_customer_cart.php";
  const formData = new FormData();
  formData.append("array", cartArray);
  fetch(url, { method: "POST", body: formData })
    .then((response) => response.text())
    .then((text) => {});
};


let forgotPassword = () => {
  let inputFieldsEmail = document.getElementById("inputFieldsEmail");

  let url = authorization_process_path+"forgot_password_process.php";
  const form = new FormData();
  form.append("I", inputFieldsEmail.value);
  fetch(url, { method: "POST", body: form })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
      if (text == "Success") {
        inputFieldsEmail.value = "";
        const errorMessageDiv = document.getElementById("errorMessage");
        errorMessageDiv.classList.remove("py-2");
        errorMessageDiv.getElementsByTagName("span")[0].innerHTML = "";
        window.location = authorization_process_path+"verify_forgot_password.php";
      } else {
        const errorMessageDiv = document.getElementById("errorMessage");
        errorMessageDiv.classList.add("py-2");
        errorMessageDiv.getElementsByTagName("span")[0].innerHTML = text;
      }
    });
};

let verifyCode = () => {
  let inputVerifyCode = document.getElementById("inputVerifyCode");

  let url = authorization_process_path+"verify_forgot_password_process.php";
  const form = new FormData();
  form.append("I", inputVerifyCode.value);
  fetch(url, { method: "POST", body: form })
    .then((response) => response.text())
    .then((text) => {
      if (text == "Success") {
        inputVerifyCode.value = "";
          
        window.location = authorization_view_path+"change_password.php";
      } else {
        const errorMessageDiv = document.getElementById("errorMessage");
        errorMessageDiv.classList.add("py-2");
        errorMessageDiv.getElementsByTagName("span")[0].innerHTML = text;
      }
    });
};

let changePassword = () => {
  let inputNewPasswordR = document.getElementById("inputNewPassword");
  
  
  let inputReEnterNewPasswordR = document.getElementById("inputReEnterNewPassword");
  console.log(inputNewPasswordR.value+" "+inputReEnterNewPasswordR.value);
  let url = authorization_process_path+"change_password_process.php";
  const form = new FormData();
  form.append("I", inputNewPasswordR.value);
  form.append("IR", inputReEnterNewPasswordR.value);
  fetch(url, { method: "POST", body: form })
    .then((response) => response.text())
    .then((text) => {
      if (text == "Success") {
        inputNewPasswordR.value = "";
        inputReEnterNewPasswordR.value = "";
        window.location = authorization_view_path+"signin_signup.php";
        //window.location =authorization_process_path+"change_password_process.php";
      } else {
        const errorMessageDiv = document.getElementById("errorMessage");
        errorMessageDiv.classList.add("py-2");
        errorMessageDiv.getElementsByTagName("span")[0].innerHTML = text;
      }
    });
};
let userSignIn =async () => {
  let pwd = document.getElementById("signpwd").value;
  let em = document.getElementById("signem").value;
  let url = authorization_process_path+"signin_process.php";
  const form = new FormData();

  form.append("PWD", pwd);
  form.append("EM", em);

  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
      if (text == "Success") {
        document.getElementById("signpwd").value = "";
        document.getElementById("signem").value = "";   
        sendToCustomerCart();
        
        window.location = home_path;   
      }
    });
};
let userSignUp = () => {
  let fn = document.getElementById("fn").value;
  let ln = document.getElementById("ln").value;
  let pwd = document.getElementById("pwd").value;
  let un = document.getElementById("un").value;
  let em = document.getElementById("em").value;
  let repwd = document.getElementById("repwd").value;
  let url = authorization_process_path+"signup_process.php";
  const form = new FormData();
  form.append("FN", fn);
  form.append("LN", ln);
  form.append("PWD", pwd);
  form.append("EM", em);
  form.append("UN", un);
  form.append("REPWD", repwd);

  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
      if (text == "Success") {
        const signInDiv = document.getElementById("signInOnly");
        const signUpDiv = document.getElementById("signUpOnly");
        signInDiv.classList.toggle("d-none");
        signUpDiv.classList.toggle("d-none");
        document.getElementById("fn").value = "";
        document.getElementById("ln").value = "";
        document.getElementById("pwd").value = "";
        document.getElementById("un").value = "";
        document.getElementById("em").value = "";
        document.getElementById("repwd").value = "";
      }
    });
};

function hideSignInDiv() {
  const signInDiv = document.getElementById("signInOnly");
  const signUpDiv = document.getElementById("signUpOnly");
  signInDiv.classList.toggle("d-none");
  signUpDiv.classList.toggle("d-none");
}
function hideSignUPDiv() {
  const signInDiv = document.getElementById("signInOnly");
  const signUpDiv = document.getElementById("signUpOnly");
  signInDiv.classList.toggle("d-none");
  signUpDiv.classList.toggle("d-none");
}
let forgotPasswordClick =()=>{
  window.location = authorization_process_path+"forgotPassword.php";
}


openCloseEyes("showPasswordIcon","signpwd");
openCloseEyes("showPasswordIconSignUp","pwd");
openCloseEyes("reshowPasswordIconSignUp","repwd");
openCloseEyes("inputNewPasswordIcon","inputNewPassword");
openCloseEyes("inputReEnterNewPasswordIcon","inputReEnterNewPassword");


function openCloseEyes(iconID,inputID){ 
    const reeyeIconSup = document.getElementById(iconID);
    const inputField= document.getElementById(inputID);
    if(inputField == undefined || reeyeIconSup == undefined){
      return;
    }else{
      reeyeIconSup.addEventListener("click",()=>{     
        const inputType = inputField.getAttribute("type")==='password'? 'text':'password';
        inputField.setAttribute('type',inputType);
        let imageName = "showPassEyeIcon";
        let srcOpen =  resources_path+"icons/showPassEyeIcon.png";
        let srcClose = resources_path+"icons/closePassEyeIcon.png";
        const imageSrc= reeyeIconSup.getAttribute("src") === srcOpen ? srcClose:srcOpen;
        reeyeIconSup.src= imageSrc;      
      })
    }
}