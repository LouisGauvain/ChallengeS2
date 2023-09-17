
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

    var feur
    let verifyDatabaseConnetion = (e) => {
        e.preventDefault()
        let inputs = document.querySelectorAll("form .input");

        let errors = []
        inputs.forEach(input => {
            if (!input.querySelector("input").value)
                errors.push(input.querySelector("label").textContent + " ne peut pas être vide")
        });

        if (errors = ![])
            return render(Install({ step: 1, errors: errors }), document.getElementById("root2"))

        

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
                    ...errors.map(error => {
                        return {
                            type: "p", children: [
                                error
                            ]
                        };
                    })
                ]
            }] : []),
            {
                type: "form",
                children: [
                    Input({
                        label: "Database host",
                        id: "dbHost",
                        name: "dbHost",
                    }),
                    Input({
                        label: "Database name",
                        id: "dbName",
                        name: "dbName",
                    }),
                    Input({
                        label: "Database user",
                        id: "dbUser",
                        name: "dbUser",
                    }),
                    Input({
                        label: "Database password",
                        id: "dbPassword",
                        name: "dbPassword",
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