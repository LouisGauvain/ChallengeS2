const pageURL = window.location.href;
const path = pageURL.substring(pageURL.lastIndexOf("/") + 1);
const fileInputs = document.querySelectorAll('input[type="file"]');
const reset = document.querySelector('input[type="reset"]');

// code pour voir en temps réel le code html dans la page de création de template
if (path === "add_template_page") {
    const previewContainer = document.getElementById("preview-container");
    const codeEditor = document.getElementsByClassName("code-editor")[0];

    codeEditor.addEventListener("keyup", function () {
        let htmlCode = codeEditor.value;
        previewContainer.innerHTML = htmlCode;
    });

    fileInputs.forEach((input) => {
        const image = document.querySelectorAll("img")[0];
        input.addEventListener('change', (e) => {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    image.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
        // change l'image du label par l'image de l'input
        reset.addEventListener('click', (e) => {
            image.src = "public/image/image_en_attente.svg";
        });
    });
}

if (path === "choice_template_page") {
    // code pour qu'un seul input radio soit sélectionné à la fois
    const radioButtons = document.querySelectorAll('input[type="radio"]');
    for (let i = 0; i < radioButtons.length; i++) {
        radioButtons[i].addEventListener("click", function () {
            for (let j = 0; j < radioButtons.length; j++) {
                if (radioButtons[j] != this) {
                    radioButtons[j].checked = false;
                }
            }
        });
    }
}

// Utilisez la méthode URL pour créer un objet URL à partir de la chaîne fullURL.
const urlObject = new URL(pageURL);

// Récupérez le chemin (path) à partir de l'objet URL.
const uri = urlObject.pathname;

if (uri === "/create_page") {
    const fileTextes = document.querySelectorAll('input[type="text"]');
    fileTextes.forEach((texte) => {
        let id = texte.getAttribute('id');
        if (id === null) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let length = 10;
            let randomText = '';
            for (var i = 0; i < length; i++) {
                let randomIndex = Math.floor(Math.random() * characters.length);
                randomText += characters.charAt(randomIndex);
            }
            // ajoute l'id aléatoire à l'input
            texte.setAttribute('id', randomText);
        }
        const idFinal = '#' + texte.id;
        setTimeout(() => {
            tinymce.init({
                selector: idFinal,
            });
        }, 2000);
    });
}

if (uri === "/create_page") {
    // Transforme les input de type file en input caché et ajoute un label avec une image
    let i = 0;
    fileInputs.forEach((input) => {
        const image = document.querySelectorAll("img")[i];
        i++
        input.addEventListener('change', (e) => {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    image.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
        // change l'image du label par l'image de l'input
        reset.addEventListener('click', (e) => {
            image.src = "public/image/image_en_attente.svg";
        });
    });
}