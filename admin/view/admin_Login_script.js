const loginbtn = document.querySelector("#loginbtn");
const email = document.querySelector("#email");
const password = document.querySelector('#password')

const sample_search_url = "/sampleSelling-master/admin/process/authenticate.php";



const sendFunction = async () => {
    const form = new FormData();
    form.append("email", email.value)
    form.append("password", password.value)

   await fetch(sample_search_url, { method: "POST", body: form })
        .then((res) => res.text())
        .then((text) => {
            console.log(text)
            if(text==="Verification is sent"){
                location.reload();
            }
        })
}
loginbtn.addEventListener('click',async ()=>{
 await sendFunction()
})