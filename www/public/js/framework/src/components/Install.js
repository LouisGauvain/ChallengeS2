
import { render } from "../core/DomRenderer.js";
import Button from "./Button.js";

export default function Install({ step = 1 }) {
    let actStep = step;
    //installeur style temporaire
    const installerStyle = {
        backgroundColor: "grey",
        borderRadius: "5px",
        width: "100vw",
        height: "50vh"
    };

    let children

    if(step == 1){
        children = [
            Button({
            title: "-",
            style: { backgroundColor: "red" },
          })]
    }

    return {
        type: "div",
        attributes: {
            class: "Installer",
            style: { ...installerStyle }
        },
        children: [
            ...children
        ]
    }
}