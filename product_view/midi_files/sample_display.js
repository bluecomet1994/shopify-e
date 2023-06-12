let nlinks = document.querySelectorAll(".navlinks");
let upBTN = document.getElementById("uploadbutton");
let upBTN2 = document.getElementById("uploadbutton2");
let sampleType = document.getElementById("sampleType");
let uploadFilesOnly = document.getElementById("uploadFileOnly");
let uploadAudioOnly = document.getElementById("uploadAudioOnly");
let uploadImageOnly = document.getElementById("uploadImageOnly");

const midi_display_process_url = "/sampleSelling-master/product_view/midi_files/sample_display_midies_process.php"
const common_next_function_url_template = "/sampleSelling-master/product_view/midi_files/";
const sample_search_url = "/sampleSelling-master/product_view/midi_files/sample_type_midi_search.php";
const midi_sample_div = "sample_display_midies_process";
document.getElementsByClassName('container-fluid')[0].style.display = "none";
window.addEventListener("load", async () => {
  //  let val = 0
  document.getElementById('loadingScreen').classList.toggle('d-none');
  setTimeout(async () => {
    let val = 0;
    let sampleselect = 0;
    let form = new FormData();
    form.append("sub_sample_id", sampleselect);
    form.append("current_page_number", val);

    let url = midi_display_process_url;
    fetch(url, { body: form, method: "POST" })
      .then((response) => response.text())
      .then((text) => {
        let samplebox = document.getElementById(midi_sample_div);
        samplebox.innerHTML = text;
        document.getElementById('loadingScreen').classList.toggle('d-none');
        document.getElementsByClassName('container-fluid')[0].style.display = "block";
      })
      .catch((error) => {
        console.log("Error", error);
      });

  }, 300)

});


function showsubsamples() {
  let val = 0;
  let sampleselect = document.getElementById("sub_sample_id_midies").value;

  let form = new FormData();
  form.append("sub_sample_id", sampleselect);
  form.append("current_page_number", val);
  console.log(sampleselect)
  let url = midi_display_process_url;
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {

      let samplebox = document.getElementById(midi_sample_div);
      samplebox.innerHTML = text;
    }).catch((error) => { console.error(error) });
}

let searchButton = document.getElementById("searchButton");

searchButton.addEventListener("click", () => {
  let sBox = document.getElementById("searchBox");
  let form = new FormData();
  form.append("search_text", sBox.value);
  let url = sample_search_url;
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let mainsampleBox = document.getElementById("mainsampleDiv");
      mainsampleBox.innerHTML = " ";
      mainsampleBox.classList.add("d-none");
      let samplebox = document.getElementById("sampleTypeMidiSearch");
      samplebox.innerHTML = text;
    });
});

function nextfunctionsearch(current_page_number,search_text, name) {
  let form = new FormData();
  console.log(current_page_number, search_text)
  form.append("search_text", search_text);
  
  form.append("current_page_number", current_page_number);

  let url = sample_search_url;
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let samplebox = document.getElementById("sampleTypeMidiSearch");
      samplebox.innerHTML = text;
    });
}
function commonNextFunction(current_page_number, sub_sample_id, pageName) {
  let form = new FormData();

  form.append("sub_sample_id", sub_sample_id);
  form.append("current_page_number", current_page_number);

  let url = `${common_next_function_url_template}${pageName}.php`;

  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {

      let samplebox = document.getElementById(`${pageName}`);
      samplebox.innerHTML = text;
    });
}




function viewbuy(x) {
  window.location = "/sampleSelling-master/singleview?X=" + x;
}


function upDateCartBagGui(arrayName) {
  let cartRowCount = Object.keys(arrayName).length;
  let cartBag = document.getElementById("cartItems");
  cartBag.innerHTML = cartRowCount;
}

upDateCartBagGui(getCart());
function getCart() {
  let getItemCart = globalThis.localStorage.getItem("cart");
  let check = true;
  if (getItemCart == undefined || getItemCart == null || getItemCart == "[]") {
    console.log("yo");
    console.log(getItemCart);
    globalThis.localStorage.clear();
  }
  return JSON.parse(globalThis.localStorage.getItem("cart") ?? "{}");
}
