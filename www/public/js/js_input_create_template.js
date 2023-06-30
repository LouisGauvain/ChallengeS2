// code pour voir en temps réel le code html dans la page de création de template
const pageURL = window.location.href;
const path = pageURL.substring(pageURL.lastIndexOf("/") + 1);

if (path === "add_Template_Page") {
    const previewContainer = document.getElementById("preview-container");
    const codeEditor = document.getElementsByClassName("code-editor")[0];

    codeEditor.addEventListener("keyup", function () {
        var htmlCode = codeEditor.value;
        previewContainer.innerHTML = htmlCode;
    });
}

