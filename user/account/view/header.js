document.getElementById("cartItemsDiv").addEventListener("click", () => {
  window.location = "../viewcart/viewcart.php";
});
const burgerMenu = document.getElementById("burgerMenu");

const userButton = document.getElementById("userButton");
const createAccount = document.getElementById("createAccount");
const signInDiv = document.getElementById("signInOnly");
const signUpDiv = document.getElementById("signUpOnly");
burgerMenu.addEventListener("click", () => {
  navBarVertical = document.getElementById("navBarVertical");
  navBarVertical.classList.toggle("d-none");
  // document.body.classList.toggle('stopScrolling')
});
if (userButton != null) {
  userButton.addEventListener("click", () => {
    window.location = "../userProcess/signInsignUpPages.php";

    //document.body.classList.toggle('stopScrolling')
  });
}
if (document.querySelector("#userButtonSignUp") != null) {
  document.querySelector("#userButtonSignUp").addEventListener("click", () => {
    document.querySelector("#userOptions").classList.toggle("d-none");
  });
}
