const download_btn = document.getElementById("download-btn");
const accept_btn = document.getElementById("accept-btn");
const warning_div = document.getElementById("warning_div");
const download_form_url = "download_form.php";
const download_form_container = document.getElementById("download-form");
function keyFrameStyling(className,frompostion, toposition) {
    return (
        `  
         .${className}{
            -webkit-animation: 'smoothappear';
            -webkit-animation-duration: 2s; 
             position: absolute;
             animation-fill-mode: forwards;
        }
        
        @keyframes smoothappear{
          from{
          top: ${frompostion};
          }
          to{
          top :${toposition};
          }
        }
        `

    )
}


window.addEventListener('load', () => {
    accept_btn.classList.add("invisible")
    let to = (warning_div.getBoundingClientRect().top) + "px";
    let from = "-200px"
    const className = "myAnimation";

    const styleTag = document.createElement("style");

    animation_class = keyFrameStyling(className,from, to);
    // animation_class = textBold();
    const style = document.createElement('style');
    const headerTag = document.getElementsByTagName('head')[0];

    headerTag.appendChild(style);

    style.innerHTML = animation_class;

    warning_div.classList.add(className)
    console.log(warning_div.getBoundingClientRect().top)
    setTimeout(()=>{
      accept_btn.classList.remove("invisible")
    },5000)
})

acceptBtnProcess =async (unique_id,dnt)=>{
    console.log(unique_id,dnt)
    warning_div.remove();
    
    const form = new FormData();
    form.append("unique_id",unique_id)
    form.append("dnt",dnt)

    await fetch(download_form_url,{body:form,method:"POST"})
    .then((res)=>res.text())
    .then((text)=>{
        console.log(text);
        console.log(download_form_container)
        download_form_container.classList.remove("d-none");
        download_form_container.innerHTML = text;
    })

    
}

