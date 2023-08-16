import Button from "./Button.js";
import { render } from "../core/DomRenderer.js";

export default function Compteur({ initialValue = 0 }) {
  let compteur = initialValue;

  console.log("Compteur", compteur)
  const decrement = () => {
    compteur--;
    updateCounter();
  };

  const increment = () => {
    compteur++;
    updateCounter();
  };

  const updateCounter = () => {
    const newCompteurComponent = Compteur({ initialValue: compteur });
    render(newCompteurComponent, document.getElementById("root"));
  };
  
  return {
    type: "div",
    children: [
      Button({
        title: "-",
        style: { backgroundColor: "red" },
        onClick: decrement,
      }),
      "Current compteur: " + compteur,
      Button({
        title: "+",
        style: { backgroundColor: "green" },
        onClick: increment,
      }),
    ],
  };
}
