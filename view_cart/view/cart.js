

const checkout_page = "/sampleSelling-master/checkout/view/checkout.php";
function checkoutPageRedirect(){
         window.location = checkout_page;
}
const checkoutButton = document.getElementById("checkout-btn");
checkoutButton.addEventListener('click',()=>{
  checkoutPageRedirect();
})

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

let sendToCustomerCart = () => {
  let cartArray = JSON.stringify(getCart());

  const url = "/sampleSelling-master/view_cart/process/add_to_customer_cart.php";
  const formData = new FormData();
  formData.append("array", cartArray);
  fetch(url, { method: "POST", body: formData })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
    });
};
let sendToCustomerCartSingle = (sId, qty) => {
  let cartArray;
  cartArray = JSON.stringify([{ id: sId, qty: qty }]);

  console.log(cartArray);
  const url = "/sampleSelling-master/view_cart/process/add_to_customer_cart.php";
  const formData = new FormData();
  formData.append("array", cartArray);
  fetch(url, { method: "POST", body: formData })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
    });
};


function upDateCartBagGui(arrayName) {
  let cartBag = document.getElementById("cartItems");
  if (arrayName != null) {
    let cartRowCount = Object.keys(arrayName).length;

    cartBag.innerHTML = cartRowCount;
  } else {
    cartBag.innerHTML = "0";
  }
}


const rowHolderDiv = document.getElementById("cartRowHolder");


let showCartItems = (cart) => {
  let cartRows = cart;

  if (getCart != null && cartRows != undefined) {
    const f = new FormData();
    f.append("cartArrays", JSON.stringify(cartRows));
    let url = "/sampleSelling-master/view_cart/process/show_cart_rows.php";
    let send = fetch(url, { body: f, method: "POST" })
      .then((response) => response.text())
      .then((text) => {
        if (rowHolderDiv != null) {
          rowHolderDiv.innerHTML = text;
        }
      });
  } else {
  }
  upDateCartBagGui(getCart());
};



let newQtySelect = (id, qtynSPrice) => {
  let inputID = document.getElementById("cartQtyId" + id);
  let changingQty = inputID.value;
  console.log(changingQty);
  let url = "/sampleSelling-master/view_cart/process/add_to_cart_local_storage.php";
  let existingCart = getCart();
  let localArray = [];
  let intID;
  let intQTY;
  let form = new FormData();
  form.append("id", id);
  form.append("qty", changingQty);
  let checkID = fetch(url, {
    body: form,
    method: "POST",
  })
    .then((response) => response.json())
    .then((data) => {
      if (data["ID"] !== "Nope") {
        intQTY = parseInt(data["qty"]);
        intID = parseInt(data["id"]);

        if (existingCart.length === undefined) {
          let newArray = data;
          let objectArray = [];
          objectArray.push(newArray);
          globalThis.localStorage.setItem("cart", JSON.stringify(objectArray));
        } else {
          let arraySearch = existingCart.find((a, index) => {
            if (a.id == intID) {
              existingCart[index] = data;
            } else {
              localArray.push(existingCart[index]);
            }
            if (localArray.length === existingCart.length) {
              let newItemarray = data;
              localArray.push(newItemarray);
              globalThis.localStorage.setItem(
                "cart",
                JSON.stringify(localArray)
              );
            } else {
              globalThis.localStorage.setItem(
                "cart",
                JSON.stringify(existingCart)
              );
            }
          });
        }

        document.getElementById("qtyAndSamplePrice" + id).innerText =
          qtynSPrice * intQTY;
        upDateSubTotal();
      } else {
        inputID.value = 1;
        inputID.setAttribute("min", 1);
      }
    });
  sendToCustomerCartSingle(id, changingQty);
};

let removeFromCart = (id) => {
  let cartRows = getCart();
  const url = "/sampleSelling-master/view_cart/process/remove_from_customer_cart.php";
  const formdata = new FormData();

  formdata.append("id", id);
  formdata.append("cart", JSON.stringify(cartRows));

  fetch(url, { method: "POST", body: formdata })
    .then((res) => res.json())
    .then((text) => {
      console.log(text);
      globalThis.localStorage.setItem("cart", JSON.stringify(text));
      
      upDateCartBagGui(getCart());
      showCartItems(getCart());
      upDateSubTotal();
    });

};

let upDateSubTotal = () => {
  const subTotalSpan = document.getElementById("subTotalValue");
  let cartRows = JSON.stringify(getCart());
  console.log("cartrows is " + cartRows);
  if (cartRows != undefined) {
    let url = "/sampleSelling-master/view_cart/process/get_sub_total.php";
    const form = new FormData();
    form.append("cartRows", cartRows);
    let sendFetch = fetch(url, { body: form, method: "POST" })
      .then((response) => {
        return response.text();
      })
      .then((text) => {
        if (subTotalSpan != null) {
          subTotalSpan.innerHTML = text;
        }
      });
  } else {
  }
};


sendToCustomerCart();

upDateCartBagGui(getCart());

showCartItems(getCart());

upDateSubTotal();
