const add_to_cart_local_storage_url = "/sampleSelling-master/checkout/process/add_to_cart_local_storage.php"
const add_to_customer_cart_url = "/sampleSelling-master/checkout/process/add_to_customer_cart.php"
const get_customer_cart_url = "/sampleSelling-master/checkout/process/get_customer_cart.php";
const get_sub_total_url = "/sampleSelling-master/checkout/process/get_sub_total.php"
const remove_from_customer_cart_url = "/sampleSelling-master/checkout/process/remove_from_customer_cart.php"
const show_cart_rows_url = "/sampleSelling-master/checkout/process/show_cart_rows.php";
const validate_products_url = "/sampleSelling-master/checkout/process/validate_products.php";



function getCart() {

  let getItemCart = globalThis.localStorage.getItem("cart");
  let check = true;
  let localstorageArray = globalThis.localStorage.getItem("cart");

  if (localstorageArray == null) {
    const url = get_customer_cart_url;
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
  let cartArray;
  cartArray = JSON.stringify(getCart());

  const url = add_to_customer_cart_url;
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
  const url = add_to_customer_cart_url;
  const formData = new FormData();
  formData.append("array", cartArray);
  fetch(url, { method: "POST", body: formData })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
    });
};
sendToCustomerCart();

function upDateCartBagGui(arrayName) {
  let cartBag = document.getElementById("cartItems");
  if (arrayName != null) {
    let cartRowCount = Object.keys(arrayName).length;

    cartBag.innerHTML = cartRowCount;
  } else {
    cartBag.innerHTML = "0";
  }
}

upDateCartBagGui(getCart());
const rowHolderDiv = document.getElementById("cartRowHolder");

function loadCart() {
  let cartRows = getCart();
  let outArray = [];
  let myid = 111;

  if (cartRows.length == undefined) {
    let myArray = { id: myid, qty: 33 };
    let secondMyArray = { id: 555, qty: 33 };
    let thirdMyArray = { id: 1000, qty: 1000 };
    let ab = [];
    ab.push(myArray);
    ab.push(secondMyArray);
    ab.push(thirdMyArray);
    globalThis.localStorage.setItem("cart", JSON.stringify(ab));
  } else {
    let mA = cartRows.find((a, i) => {
      if (a.id === myid) {
        cartRows[i] = { id: myid, qty: 25 };
      } else {
        outArray.push(cartRows[i]);
      }

      if (outArray.length === cartRows.length) {
        let newIDQ = { id: myid, qty: 2000 };
        outArray.push(newIDQ);
        globalThis.localStorage.setItem("cart", JSON.stringify(outArray));
      } else {
        globalThis.localStorage.setItem("cart", JSON.stringify(cartRows));
      }
    });
  }
}

let newAddtoCart = (id, qty) => {
  let existingCart = getCart();
  let localArray = [];
  const cartRowCount = Object.keys(existingCart).length;

  if (existingCart.length === undefined) {
    let newArray = { id: id, qty: qty };
    let objectArray = [];
    objectArray.push(newArray);
    globalThis.localStorage.setItem("cart", JSON.stringify(objectArray));
  } else {
    let searchArray = existingCart.find((a, index) => {
      if (a.id == id) {
        existingCart[index] = { id: id, qty: qty };
      } else {
        localArray.push(existingCart[index]);
      }
      if (localArray.length === existingCart.length) {
        let newItemarray = { id: id, qty: qty };
        localArray.push(newItemarray);
        globalThis.localStorage.setItem("cart", JSON.stringify(localArray));
      } else {
        globalThis.localStorage.setItem("cart", JSON.stringify(existingCart));
      }
    });
  }
};

let showCartItems = async(cart) => {
  let cartRows = cart;

  if (getCart != null && cartRows != undefined) {
    const form = new FormData();
    form.append("cartArrays", JSON.stringify(cartRows));
    let url = show_cart_rows_url;
    let send = fetch(url, { body: form, method: "POST" })
      .then((response) => response.text())
      .then((text) => {
        if (rowHolderDiv != null) {
          rowHolderDiv.innerHTML = text;
          document.getElementById("checkout-btn-click").click();
        }
      });
  } else {
  }
  upDateCartBagGui(getCart());
};
window.addEventListener('load', async () => {
  showCartItems(getCart());
})

let newQtySelect = (id, qtynSPrice) => {
  let inputID = document.getElementById("cartQtyId" + id);
  let changingQty = inputID.value;
  console.log(changingQty);
  let url = add_to_cart_local_storage_url;
  let existingCart = getCart();
  let localArray = [];
  let intID;
  let intQTY;
  let f = new FormData();
  f.append("id", id);
  f.append("qty", changingQty);
  let checkID = fetch(url, {
    body: f,
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
  let newCartRows = [];
  const url = remove_from_customer_cart_url;
  const formdata = new FormData();

  formdata.append("id", id);
  formdata.append("cart", JSON.stringify(cartRows));

  fetch(url, { method: "POST", body: formdata })
    .then((res) => res.json())
    .then((text) => {
      console.log(text);
      globalThis.localStorage.setItem("cart", JSON.stringify(text));
      upDateSubTotal();
      upDateCartBagGui(getCart());
      showCartItems(getCart());
    });

};

let upDateSubTotal = () => {
  const subTotalSpan = document.getElementById("subTotalValue");
  let cartRows = JSON.stringify(getCart());
  console.log("cartrows is " + cartRows);
  if (cartRows != undefined) {
    let url = get_sub_total_url;
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
upDateSubTotal();
// const checkoutBtn = document.querySelector("#checkout-and-portal-button");
// checkoutBtn.addEventListener('click',async () => {
//   let cart = getCart();
//   const form = new FormData();
//   form.append("cart",JSON.stringify(cart));
//   const url = "../payment-testing/create-checkout-session.php";
//   console.log(cart);
//   fetch(url,{body:form,method:"POST"})
//   .then((res)=>res.text())
//   .then((text)=>{
//     console.log((text));
//   })
// })