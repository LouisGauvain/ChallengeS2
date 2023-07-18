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

