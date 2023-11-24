function showTag(){
    console.log("entrei na f exibir");
    
    let seeTag = document.querySelector(".hide-list");
    seeTag.classList.toggle("show-list");
};
let seeTag = document.querySelector("#pick");
seeTag.addEventListener("click", showTag);

                 
// transform above function as universal
//with variables on showTag(btnClass, hideClassTag,showClassTag). Added to to-do list