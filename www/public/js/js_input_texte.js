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
    }, 100);
});