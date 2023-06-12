let linkPathUrl_header = "/sampleSelling-master/util/path_config/get_relative_paths.php";
let getUrls_header = async (name) => {
  let url;
  let formData = new FormData();

  formData.append("name", name);

  await fetch(linkPathUrl_header, { method: "POST", body: formData })
    .then((res) => res.text())
    .then((text) => {
      url = text;

      console.log(url);
    });
  return url;
};



document.getElementById("cartItemsDiv").addEventListener("click", async () => {
  let url = await getUrls_header("customer_cart");
  window.location = "/sampleSelling-master/viewcart";

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
  userButton.addEventListener("click", async () => {
    window.location = "/sampleSelling-master/login";
   // window.location = await getUrls_header("sigin_signup_pages_shortend");

    //document.body.classList.toggle('stopScrolling')
  });
}
if (document.querySelector("#userButtonSignUp") != null) {
  document.querySelector("#userButtonSignUp").addEventListener("click", () => {

    document.querySelector("#userOptions").classList.toggle("d-none");
  });
}
