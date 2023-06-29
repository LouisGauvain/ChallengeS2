const previewContainer = document.getElementById("preview-container");
const codeEditor = document.getElementsByClassName("code-editor")[0];
console.log(codeEditor);
console.log(previewContainer);

codeEditor.addEventListener("keyup", function () {
    console.log("change");
    var htmlCode = codeEditor.value;
    console.log(htmlCode);

    // Met à jour le contenu de l'aperçu avec le code HTML
    previewContainer.innerHTML = htmlCode;
});