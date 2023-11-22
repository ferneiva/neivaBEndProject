document.addEventListener("DOMContentLoaded", () => {
    const btnPassShow = document.querySelector(".pick");
    const passContShow=document.querySelector(".passwordContainer");
        btnPassShow.addEventListener("click", () =>{
            passContShow.classList.remove('hide');
        })

    const btnClosePass = document.querySelector('#binClose');
    
        btnClosePass.addEventListener("click", () =>{
            passContShow.classList.add("hide");
        } )


    const btnPassShow1 = document.querySelector(".pick1");
    const passContShow1=document.querySelector(".passwordContainer1");
        btnPassShow1.addEventListener("click", () =>{
            passContShow1.classList.remove('hide');
        })

    const btnClosePass1 = document.querySelector('#binClose1');
    
        btnClosePass1.addEventListener("click", () =>{
            passContShow1.classList.add("hide");
        } )

});


    
