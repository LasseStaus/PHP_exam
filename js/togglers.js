const userOptionsToggler = document.querySelector(".chev-down");
const userOptions = document.querySelector(".user-options-container");
const closeOptions = document.querySelector("i.close");


closeOptions.addEventListener("click", () => {

    userOptionsToggler.classList.remove("active");
    userOptions.classList.remove("active");
})



userOptionsToggler.addEventListener("click", () => {

    userOptionsToggler.classList.toggle("active");
    userOptions.classList.toggle("active");

});


