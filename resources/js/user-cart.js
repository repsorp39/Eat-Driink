//retrieve the stand id
const standid = parseInt(window.location.pathname.split("/").at(-1));
const orderForm = document.getElementById("order-form");


//initial load
//goal is to check the number of product saved locally actually in our card
document.addEventListener("DOMContentLoaded", () => {
    let savedCart = localStorage.getItem("cart");
    savedCart = savedCart ? JSON.parse(savedCart)[standid] ?? [] : [];
    document.getElementById("card-element").innerText = savedCart.length;
    if(savedCart.length === 0) orderForm.querySelector("button").disabled = true;
});


//each time user click on add product change the value of var product id
const Btns = document.querySelectorAll(".open-modal-btn");
const quantityField = document.querySelector(".product-quantity");
const submitButton = document.getElementById("card-submit");
let productId = "";

for (const btn of Btns) {
    btn.addEventListener("click", (e) => {
        productId = e.target.dataset["id"];
    });
} 

//on form submit saved product in the local storage
submitButton.addEventListener("click", (e) => {
    let cart = localStorage.getItem("cart");
    cart = cart ? JSON.parse(cart) : {};
    let product = {
        quantite: quantityField.value,
        id: productId
    };
    let foundProductIndex = cart?.[standid]?.findIndex?.((e) => e.id == product.id);

    if(foundProductIndex !== -1 && foundProductIndex !== undefined){
        cart[standid][foundProductIndex]["quantite"] = product.quantite;
    }
    else cart[standid] = [...(cart[standid] ?? []), product];
    //update the product number in the card
    document.getElementById("card-element").innerText = cart[standid].length;
    orderForm.querySelector("button").disabled = false;
    localStorage.setItem("cart", JSON.stringify(cart));
    my_modal_3.close(); //daisy_ui built in function to close modal
});

//when user click on the cart he must see all items he store
const btnCart = document.getElementById("user-cart");

btnCart.addEventListener("click", async () => {
    let savedCart = localStorage.getItem("cart");
    savedCart = savedCart ? JSON.parse(savedCart) : {};
    //get all products ids
    let ids = (savedCart[standid] ?? []).map((item) => +item.id);
    ids = JSON.stringify(ids);
    let res = await fetch(`/product-info?ids=${ids}`);
    const productLists = await res.json();
    
    //now we have to fill the order form in case of submission
    orderForm.querySelector(".order-details").value = JSON.stringify(savedCart[standid]);
    orderForm.querySelector(".stand-id").value = standid;

    let html = "";
    productLists.forEach((product,i) => {
        html +=` 
            <li class="list-row">
                <div class="text-3xl font-thin opacity-30 tabular-nums">${String(i+1).padStart(2,"0")}</div>
                <div><img class="size-10 rounded-box" src="${product.image_url}"/></div>
                <div class="list-col-grow">
                    <div> ${
                        savedCart[standid].find((el) => el.id == product.id)["quantite"]
                    } x ${product.price}    FCFA</div>
                    <div class="text-xs uppercase font-semibold opacity-60">${product.name}</div>
                </div>
               <!-- <span class="hover:bg-red-500/20 btn btn-square btn-ghost">
                    <i class="bi bi-trash text-red-500 "></i>
                </span>-->
            </li>`;
    });    
    if(html) document.getElementById("product-list").innerHTML = html;
});

orderForm.addEventListener("submit",(e)=>{
    //when form is submitted, clean the storage
    localStorage.removeItem("cart");
})