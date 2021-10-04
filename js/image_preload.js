var loadFile = function (event) {
    var output = document.querySelector(".img-show-input");
    output.src = URL.createObjectURL(event.target.files[0]);
    output.classList.add("contain")
    output.onload = function () {
        URL.revokeObjectURL(output.src) // free memory
    }
};