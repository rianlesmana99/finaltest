const min = document.getElementById("min-btn");
const plus = document.getElementById("plus-btn");
const qty = document.getElementById("quantity");

min.addEventListener("click", ()=> {
    if (Number(qty.value) != 0) {
        qty.value--;
    }
});

plus.addEventListener("click", ()=> {
    qty.value++;
});