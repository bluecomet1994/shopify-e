const purchasedHistoryProcessUrl ="/sampleSelling-master/user/account/process/purchased_history.php" ;
const userAccountUpdateUrl = "/sampleSelling-master/user/account/process/user_account_update.php";
const userAccountUpdateFormurl = "/sampleSelling-master/user/account/process/user_account_update_form.php";
const userInfoDivUrl = "/sampleSelling-master/user/account/util/user_info_div.php";


const updateModeButton = document.querySelector("#updateModeButton");
const updateButton = document.querySelector("#updateButton");
const userInfobuttonDiv = document.querySelector("#userInfobuttonDiv");
const userInfoDiv = document.querySelector("#userInfoDiv");
let divElements;

updateModeButton.addEventListener("click", () => {
  divElements = userInfoDiv.innerHTML;
  userInfoDiv.innerHTML = "";

  fetch(userAccountUpdateFormurl, { method: "POST" })
    .then((res) => res.text())
    .then((text) => {
      userInfoDiv.innerHTML = text;
    });

  fetch(userInfoDivUrl, { method: "POST" })
    .then((res) => {
      let a = res.text();
      console.log(a);
      if (res.status == 200) {
        return a;
      }
    })
    .then((text) => {
      userInfobuttonDiv.innerHTML = text;
    });
});

console.log(document.querySelector("#updateButton"));
if (document.querySelector("#updateButton") !== null) {
  updateButton.addEventListener("click", () => {
    userInfobuttonDiv.innerHTML = "";
    userInfobuttonDiv.append(updateModeButton);
    
    userInfoDiv.innerHTML = divElements;
  });
}
function updateuser() {
  userInfobuttonDiv.innerHTML = "";
  userInfobuttonDiv.append(updateModeButton);

  let uname = document.getElementById("username");
  console.log(uname.value);
  let ufname = document.querySelector("#userfirstname");
  let ulname = document.querySelector("#userlastname");
  const form = new FormData();
  form.append("un", uname.value);
  form.append("ufn", ufname.value);
  form.append("uln", ulname.value);
  const url = userAccountUpdateUrl;
  fetch(url, { method: "POST", body: form })
    .then((res) => res.text())
    .then((text) => {
      console.log(text);
      if (text === "Success") {
        location.reload();
      } else {
        userInfoDiv.innerHTML = divElements;
      }
    });
}

function getCart() {
  return JSON.parse(globalThis.localStorage.getItem("cart") ?? "{}");
}

function upDateCartBagGui(arrayName) {
  let cartRowCount = Object.keys(arrayName).length;
  let cartBag = document.getElementById("cartItems");
  if (cartBag == undefined) {
    return;
  } else {
    cartBag.innerHTML = cartRowCount;
  }
}


upDateCartBagGui(getCart());

let loadPurchaseHistory = () => {
  const show = document.querySelector("#purchaseHistoryDiv");
  const url = purchasedHistoryProcessUrl;
  fetch(url, { method: "POST" })
      .then((res) => res.text())
      .then((text) => {
          show.innerHTML = text;

      })
}
loadPurchaseHistory();

let navigation = (value) => {
  const show = document.querySelector("#purchaseHistoryDiv");
  const url = purchasedHistoryProcessUrl;
  const form = new FormData();
  form.append("navivalue",value)
  fetch(url, { method: "POST",body:form })
      .then((res) => res.text())
      .then((text) => {
          show.innerHTML = text;

      })
}
////////
