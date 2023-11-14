document.addEventListener("DOMContentLoaded", () => {
                
    const removeButtons = document.querySelectorAll('button[name="deleteReview"]');

    
    
    for(let button of removeButtons) {
        
        button.addEventListener("click", () => {
            // console.log(button.dataset.review_id);
            
            const liRemove = button.parentNode.parentNode;
            
            fetch("/requests/", {
                method: "POST",
                headers: {
                    "Content-Type":"application/x-www-form-urlencoded" // para evitar o encode em json na var Post e fazer parse 
                },
                body: "request=deleteReview&review_id=" + liRemove.dataset.review_id
            })
            .then(response => response.json())
            .then(result => {
                
                if(result.message && result.message === "OK") {
                    liRemove.remove();
                }
            });
        });
    }
    
    
    
});