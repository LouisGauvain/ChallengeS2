const pageURL = window.location.href;
const path = pageURL.substring(pageURL.lastIndexOf("/") + 1);

// code pour voir en temps réel le code html dans la page de création de template
if (path === "add_template_page") {
    const previewContainer = document.getElementById("preview-container");
    console.log(previewContainer);
    const codeEditor = document.getElementsByClassName("code-editor")[0];

    codeEditor.addEventListener("keyup", function () {
        let htmlCode = codeEditor.value;
        previewContainer.innerHTML = htmlCode;
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

if (path === "create_page") {
    // Transforme les input de type file en input caché et ajoute un label avec une image

    // récupère tous les input de type file
    const fileInputs = document.querySelectorAll('input[type="file"]');
    // récupère le formulaire
    const form = document.querySelector('form');

    // recupère l'input de type reset
    const reset = document.querySelector('input[type="reset"]');

    fileInputs.forEach((input) => {
        input.style.display = 'none';
        const id = input.getAttribute('id');
        // créer un id aléatoire si l'input n'en a pas
        if (id === null) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let length = 10;
            let randomText = '';
            for (var i = 0; i < length; i++) {
                let randomIndex = Math.floor(Math.random() * characters.length);
                randomText += characters.charAt(randomIndex);
            }
            // ajoute l'id aléatoire à l'input
            input.setAttribute('id', randomText);
        }
        // créer un label avec l'id de l'input
        const label = document.createElement('label');
        label.setAttribute('for', input.id);
        // ajoute le label avant l'input avec une image par défaut
        form.insertBefore(label, input);
        const image = document.createElement('img');
        image.src = "public/image/image_en_attente.svg";
        image.width = 100;
        label.appendChild(image);
        // change l'image du label par l'image de l'input
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
        }, 1000);
    });
}