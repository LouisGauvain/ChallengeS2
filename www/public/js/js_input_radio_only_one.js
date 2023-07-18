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