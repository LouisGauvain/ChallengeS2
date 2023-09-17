
import { render } from "../core/DomRenderer.js";
import Input from "./Input.js"
import Button from "./Button.js";

export default function Install({ step = 1, errors }) {
    //installeur style temporaire
    const installerStyle = {
        backgroundColor: "grey",
        borderRadius: "5px",
        width: "100vw",
        height: "50vh"
    };

    let verifyDatabaseConnetion = (e) => {
        e.preventDefault()
        let inputs = document.querySelectorAll("form .input input")

        let errors = []
        inputs.forEach(input => {
            if (!input.id || !input.value)
                errors.push("Id ou value vide")
        });

        render(Install({step: 1, errors: errors}), document.getElementById("root2"))
    }

    let updateInstaller = () => {
        render(Install({ step: 2 }), document.getElementById("root2"))
    }

    let children = []
    if (step == 1) {
        children = [
            ...(errors ? [{
                type: "div",
                attributes: {
                    class: "errors"
                },
                children: [
                    ...errors
                ]
            }] : []),
            {
                type: "form",
                children: [
                    Input({
                        name: "Database host",
                        id: "dbHost",
                        label: "dbHost",
                    }),
                    Input({
                        name: "Database name",
                        id: "dbName",
                        label: "dbName",
                    }),
                    Input({
                        name: "Database user",
                        id: "dbUser",
                        label: "dbUser",
                    }),
                    Input({
                        name: "Database password",
                        id: "dbPassword",
                        label: "dbPassword",
                    }),
                    Button({
                        title: "Prochaine étape",
                        style: {
                            background: "aliceblue"
                        },
                        onClick: verifyDatabaseConnetion
                    })
                ]
            }
        ]
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