const editImage = document.querySelector(".edit-image");
const editImageContainer = document.querySelector(".edit-image-container");
const closeEdit = document.querySelector("i.close.edit");
editImage.addEventListener("click", () => {
    editImage.classList.toggle("active");
    editImageContainer.classList.toggle("active");
})

closeEdit.addEventListener("click", () => {
    editImage.classList.remove("active");
    editImageContainer.classList.remove("active");

})