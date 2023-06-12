getCustomerCartUrl = "/sampleSelling-master/viewcart/process/getCustomerCart.php";
addtoCustomerCartUrl = "/sampleSelling-master/viewcart/process/addtoCustomerCart.php";
showCartRowsUrl = "/sampleSelling-master/viewcart/process/showCartRows.php";
addtoCartLocalStorageUrl = "/sampleSelling-master/viewcart/process/addtoCartLocalStorage.php";
removeFromCustomerCartUrl = "/sampleSelling-master/viewcart/process/removeFromCustomerCart.php";
getSubTotalUrl = "/sampleSelling-master/viewcart/process/getSubTotal.php";


let linkPathUrl_cart = "/sampleSelling-master/view_cart/util/get_relative_paths.php";
let getUrls_cart = async (name) => {
  let url;
  let formData = new FormData();

  formData.append("name", name);

  await fetch(linkPathUrl_cart, { method: "POST", body: formData })
    .then((res) => res.text())
    .then((text) => {
      url = text;

      // console.log(url);
    });
  return url;
};

let getCart = async () => {
  let getItemCart = globalThis.localStorage.getItem("cart");
  let check = true;
  let localstorageArray = globalThis.localStorage.getItem("cart");
  console.log("local storage array is " + localstorageArray);
  if (localstorageArray == null) {
    console.log("local storage array is null");
    const url = await getUrls_cart("get_customer_cart");
    console.log("url is " + url);
    fetch(url, { method: "POST" })
      .then((response) => response.json())
      .then((text) => {
        globalThis.localStorage.setItem("cart", JSON.stringify(text));
        showCartItems(
          JSON.parse(globalThis.localStorage.getItem("cart") ?? "{}")
        );
      });
  } else {
    console.log("yo yo yo");
    console.log("cart details are getting retrived by console " + globalThis.localStorage.getItem("cart") ?? "{}");
    return JSON.parse(globalThis.localStorage.getItem("cart") ?? "{}");
  }
}



(async () => {
  console.log("get cart is " + JSON.stringify(await getCart()));
})()
let sendToCustomerCart = async () => {
  let cartArray;
  cartArray = JSON.stringify(getCart());

  const url = await getUrls_cart("add_to_customer_cart");
  console.log(url)
  const formData = new FormData();
  formData.append("array", cartArray);
  fetch(url, { method: "POST", body: formData })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
    });
};
let sendToCustomerCartSingle = async (sId, qty) => {
  let cartArray;
  cartArray = JSON.stringify([{ id: sId, qty: qty }]);

  console.log(cartArray);
  const url = await getUrls_cart("add_to_customer_cart");
  const formData = new FormData();
  formData.append("array", cartArray);
  fetch(url, { method: "POST", body: formData })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
    });
};

(async () => {
  sendToCustomerCart();
})()
function upDateCartBagGui(arrayName) {
  let cartBag = document.getElementById("cartItems");
  if (arrayName != null) {
    let cartRowCount = Object.keys(arrayName).length;

    cartBag.innerHTML = cartRowCount;
  } else {
    cartBag.innerHTML = "0";
  }
}
(async () => {
  upDateCartBagGui(getCart());
})()

const rowHolderDiv = document.getElementById("cartRowHolder");



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

let showCartItems = async (cart) => {
  let cartRows = cart;

  if (getCart != null && cartRows != undefined) {
    const f = new FormData();
    f.append("cartArrays", JSON.stringify(await cartRows));
    let url = await getUrls_cart("show_cart_rows");
    let send = fetch(url, { body: f, method: "POST" })
      .then((response) => response.text())
      .then((text) => {
        console.log("cart rows are dd"+text);
        console.log(text);
        if (rowHolderDiv != null) {
          rowHolderDiv.innerHTML = text;
        }
      });
  } else {
  }
  upDateCartBagGui(getCart());
};


(async () => {
  showCartItems(getCart());
})()
let newQtySelect = async (id, qtynSPrice) => {
  let inputID = document.getElementById("cartQtyId" + id);
  let changingQty = inputID.value;
  console.log(changingQty);
  let url = await getUrls_cart("add_to_cart_local_storage");
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

let removeFromCart = async (id) => {
  let cartRows = getCart();
  let newCartRows = [];
  const url = await getUrls_cart("remove_from_customer_cart");
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

let upDateSubTotal = async () => {
  const subTotalSpan = document.getElementById("subTotalValue");
  let cartRows = JSON.stringify(await getCart());
  console.log("cartrows is " + cartRows);
  if (cartRows != undefined) {
    let url = await getUrls_cart("get_sub_total");
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

(async () => {
  upDateSubTotal();
})()