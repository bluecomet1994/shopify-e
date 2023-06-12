let nlinks = document.querySelectorAll('.navlinks');
let upBTN = document.getElementById('uploadbutton');
let upBTN2 = document.getElementById('uploadbutton2')
let sampleType = document.getElementById('sampleType');
let uploadFilesOnly = document.getElementById('uploadFileOnly');
let uploadAudioOnly = document.getElementById('uploadAudioOnly');
let uploadImageOnly = document.getElementById('uploadImageOnly');
let sampletypeselect = document.getElementById('sampleType');

const upload_audio_process_url = "../process/store_audio_samples.php";
const upload_midi_process_url = "../process/store_midi_samples.php";
const load_sub_midi_url = "../process/sub_midies.php";
sampletypeselect.addEventListener('change', () => {
    let subsample = document.getElementById('mtDIV');
    subsample.className = "rag";



    fetch(load_sub_midi_url, { method: "GET" })
        .then(response => response.text())
        .then(text => {
            console.log(text)
            subsample.innerHTML = text;
        })

})





upBTN.addEventListener('click', function () {
    let samplePrice = document.getElementById('samplePrice');
    let sampleName = document.getElementById('sampleName');
    let sampleType = document.getElementById('sampleType');
    let sampleFile = document.getElementById('sampleFile');
    let sampleImage = document.getElementById('sampleImage');
    let submelodytype = document.getElementById('subMidiType');
    let sampledescription = document.getElementById('sampleDescription');


    let form_1 = new FormData();
    let form_2 = new FormData();
    form_2.append('SamplePrice', samplePrice.value);
    form_2.append('SampleName', sampleName.value);
    form_2.append('SampleType', sampleType.value);
    form_2.append('SampleFile', sampleFile.files[0]);

    form_2.append('SampleImage', sampleImage.files[0]);
    form_2.append('SampleSubMelody', submelodytype.value);
    form_2.append('SampleDescription', sampledescription.value);


    fetch(upload_midi_process_url, { body: form_2, method: "POST" })
        .then(response => response.text())
        .then((text) => { 
            if (text === "Success") {
                samplePrice.value = "";
                sampleName.value = "";
                sampledescription.value = "";
                sampleType.value = "Select Midi Type";
                document.getElementById("mtDIV").innerHTML = "";
                sampleFile.value = "";
                sampleImage.value = "";
             
                window.location.reload();

            } else {

                document.getElementById("showmessage").innerHTML = text;
            }
        
        
        })



})