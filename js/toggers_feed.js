const createPost = document.querySelector(".create-post");
const createPostWrapper = document.querySelector("#create-post-wrapper");
const cancelPost = document.querySelector(".cancel");
/* document.querySelector("body > main > div.content-container > button").addEventListener("click", () => {
    console.log("tis")
    createPostWrapper.classList.toggle("active");
}) */
cancelPost.addEventListener("click", () => {
    createPostWrapper.classList.remove("active");
})
createPost.addEventListener("click", () => {
    console.log("tis")
    createPostWrapper.classList.toggle("active");
})

/* const imgInput = document.querySelector(".img-input");
const imgShowInput = document.querySelector(".img-show-input");
imgInput.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
        imgShowInput.src = URL.createObjectURL(file)
    }
}
 */
var loadFile = function (event) {
    var output = document.querySelector(".img-show-input");
    output.src = URL.createObjectURL(event.target.files[0]);
    output.classList.add("contain")
    output.onload = function () {
        URL.revokeObjectURL(output.src) // free memory
    }
};