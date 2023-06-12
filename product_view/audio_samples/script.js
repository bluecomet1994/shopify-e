// import { ServerSide } from "/sampleSelling-master/util/server_side.js";

let nlinks = document.querySelectorAll(".navlinks");
let upBTN = document.getElementById("uploadbutton");
let upBTN2 = document.getElementById("uploadbutton2");
let sampleType = document.getElementById("sampleType");
let uploadFilesOnly = document.getElementById("uploadFileOnly");
let uploadAudioOnly = document.getElementById("uploadAudioOnly");
let uploadImageOnly = document.getElementById("uploadImageOnly");

const sample_display_drums_process_url = "/sampleSelling-master/product_view/audio_samples/sample_display_drums_process.php";
const sample_display_melodies_process_url = "/sampleSelling-master/product_view/audio_samples/sample_display_melodies_process.php";
const sample_search_url = "/sampleSelling-master/product_view/audio_samples/bySearch.php";
const common_next_function_url_template = "/sampleSelling-master/product_view/audio_samples/";
const drum_sample_div = "sample_display_drums_process";
const melody_sample_div = "sample_display_melodies_process";


document.getElementsByClassName('container-fluid')[0].style.display = "none";
window.addEventListener("load", async () => {

  let samplebox1 = document.getElementById(melody_sample_div);
  let samplebox2 = document.getElementById(drum_sample_div);


  document.getElementById('loadingScreen').classList.toggle('d-none');
  let form = new FormData();

  setTimeout(async () => {
    let url = sample_display_melodies_process_url;
    let abc = await fetch(url, { body: form, method: "POST" })
      .then((response) => response.text())
      .then((text) => {


        samplebox1.innerHTML = text;
      }).catch((error) => console.error(error));

    let url2 = sample_display_drums_process_url;
    let def = await fetch(url2, { body: form, method: "POST" })
      .then((response) => response.text())
      .then((text) => {

        samplebox2.innerHTML = text;
        document.getElementById('loadingScreen').classList.toggle('d-none');
        document.getElementsByClassName('container-fluid')[0].style.display = "block";
      }).catch((error) => console.error(error));

  }, 500)

});

function show_sub_melody_samples() {

  let val = 0;
  let sub_sample_id = document.getElementById("sub_sample_melody_id").value;

  let form = new FormData();
  if (sub_sample_id !== "ALL") {
    form.append("sub_sample_id", sub_sample_id);
  }

  form.append("current_page_number", val);

  let url = sample_display_melodies_process_url;

  let server_side = new ServerSide();
  server_side.method = "POST";
  server_side.form = form;
  server_side.url = url;
  server_side.container = document.getElementById(melody_sample_div)
  function doThis(){
    server_side.container.innerHTML = server_side.text;
  } 
  server_side.sendPostRequest(doThis);  

}

function show_sub_drum_samples() {
  let val = 0;
  let sub_sample_id = document.getElementById("sub_sample_drum_id").value;

  let form = new FormData();
  if (sub_sample_id !== "ALL") {
    form.append("sub_sample_id", sub_sample_id);
  }

  form.append("current_page_number", val);
  let url = sample_display_drums_process_url;
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let samplebox = document.getElementById(drum_sample_div);
      samplebox.innerHTML = text;
    });
}
let searchButton = document.getElementById("searchButton");
searchButton.addEventListener("click", () => {
  let sBox = document.getElementById("searchBox");
  let form = new FormData();
  form.append("search_text", sBox.value);
  let url = sample_search_url;
  console.log(url);
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let mainsampleBox = document.getElementById("mainsampleDiv");
      mainsampleBox.innerHTML = " ";
      mainsampleBox.classList.add("d-none");
      let samplebox = document.getElementById("bySearch");
      samplebox.innerHTML = text;
    }).catch((error) => console.error(error));
});

function nextfunctionsearch(current_page_number, search_text, name) {
  let form = new FormData();

  if (search_text !== null) {
    form.append("search_text", search_text);
  }

  form.append("current_page_number", current_page_number);

  let url = sample_search_url;
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let samplebox = document.getElementById("bySearch");
      samplebox.innerHTML = text;
    });
}
function commonNextFunction(current_page_number, sub_sample_id, pageName) {
  console.log("page number is " + current_page_number, " sub_sample_type_number is " + sub_sample_id, " page name is " + pageName)

  let form = new FormData();

  form.append("sub_sample_id", sub_sample_id);
  form.append("current_page_number", current_page_number);
  console.log(form)
  let url = `${common_next_function_url_template}${pageName}.php`;
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {

      let samplebox = document.getElementById(`${pageName}`);
      samplebox.innerHTML = text;
    });
}

function playmusic(x) {
  let playmusicicon = document.getElementById("playmusic" + x);
  let pausemusicicon = document.getElementById("pausemusic" + x);
  const album = document.getElementById("beatPackDiv" + x);
  album.style.transform = "scale(1.05)";
  let playAlbumClassDiv = document.querySelectorAll(".audiopreviewImage");

  playAlbumClassDiv.forEach((el) => {
    if (el.id === "audio" + x) {
      console.log(x);
      document.getElementById(el.id).play();
    } else {
      document.getElementById(el.id).pause();
      let otherID = parseInt(el.id.split("audio")[1]);
      console.log(otherID);
      document.getElementById("playmusic" + otherID).classList.remove("d-none");
      document.getElementById("pausemusic" + otherID).classList.add("d-none");
      const album = document.getElementById("beatPackDiv" + otherID);

      album.style.transform = "scale(1.00)";
      album.style.transform = "scale(1.00)";

      album.style.backgroundColor = "rgb(0, 0, 0)";
      album.style.transition =
        "background-color 0.7s ease-in-out,transform 0.5s ease-in-out";
    }
  });

  album.style.backgroundColor = "rgb(30, 26, 26)";
  album.style.transition =
    "background-color 0.5s ease-in-out,transform 0.5s ease-in-out";
  let music = document.getElementById("audio" + x);
  pausemusicicon.classList.toggle("d-none");
  playmusicicon.classList.toggle("d-none");
  music.play();
}

function pausemusic(x) {
  let playmusicicon = document.getElementById("playmusic" + x);
  let pausemusicicon = document.getElementById("pausemusic" + x);
  const album = document.getElementById("beatPackDiv" + x);

  album.style.transform = "scale(1.00)";

  album.style.backgroundColor = "rgb(0, 0, 0)";
  album.style.transition =
    "background-color 0.7s ease-in-out,transform 0.5s ease-in-out";

  let music = document.getElementById("audio" + x);
  pausemusicicon.classList.toggle("d-none");
  playmusicicon.classList.toggle("d-none");
  music.pause();
}
function audioEnded(audio){
  
  let audio_id = audio.split("audio")[1];
  pausemusic(audio_id);
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
