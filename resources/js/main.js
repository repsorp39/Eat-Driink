const btnAccepts = document.querySelectorAll(".btn-accept");
const btnRejects= document.querySelectorAll(".btn-reject");
const modal = document.getElementById("modal-accept");
const form = document.querySelector("#modal-accept form");
const btnClose  = document.getElementById("btn-close");
const wrapper = document.getElementById("wrapper");


for(const btnReject of btnRejects){
   btnReject.addEventListener("click",()=>{
        modal.classList.remove("hidden");
        
        wrapper.classList.add("modal-view");
        const user_id = btnReject.dataset["id"];
        document.getElementById("user-id").value = user_id;
   })
}


btnClose.addEventListener("click",()=>{
    modal.classList.add("hidden");
    wrapper.classList.remove("modal-view");
});
