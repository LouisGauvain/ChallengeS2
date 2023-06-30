const previewContainer = document.getElementById("preview-container");
const codeEditor = document.getElementsByClassName("code-editor")[0];

codeEditor.addEventListener("keyup", function () {
    var htmlCode = codeEditor.value;
    previewContainer.innerHTML = htmlCode;
});