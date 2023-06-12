const verify_btn = document.querySelector("#verify-btn");
const verify_code = document.querySelector("#verify-code");

const url = "/sampleSelling-master/admin/process/verify_code.php";



const sendFunction = async () => {
    const form = new FormData();
    form.append("verify_code", verify_code.value)

   await fetch(url, { method: "POST", body: form })
        .then((res) => res.text())
        .then((text) => {
            console.log(text)
            if(text==="Verification success"){
                location.reload();
            }
        })
}
verify_btn.addEventListener('click',async ()=>{
 await sendFunction()
})