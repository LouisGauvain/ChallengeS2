import { render } from "../core/DomRenderer.js";
import Input from "./Input.js"
import Button from "./Button.js";

export default function Install({ step = 1, errors, verified }) {
    //installeur style temporaire
    const installerStyle = {
        backgroundColor: "grey",
        borderRadius: "5px",
        width: "100vw",
        height: "50vh"
    };

    let verifyDatabaseConnetion = (e) => {
        e.preventDefault()
        let inputs = document.querySelectorAll("form .input");

        let formData = {}
        let errors = []
        inputs.forEach(input => {
            formData[input.querySelector("input").name] = input.querySelector("input").value
            if (!input.querySelector("input").value)
                errors.push(input.querySelector("label").textContent + " ne peut pas être vide")
        });

        if (errors.length != 0)
            return render(Install({ step: 1, errors: errors }), document.getElementById("root2"))

        sessionStorage.setItem('databaseFormData', JSON.stringify(formData))

        fetch('/install/test.php', {
            method: 'post',
            body: new FormData(document.querySelector('form'))
        }).then(response => response.json())
            .then(data => {
                if (!data.success) {
                    errors.push(data.message)
                    return render(Install({ step: 1, errors: errors }), document.getElementById("root2"))
                }
                else {
                    return render(Install({ step: 1, verified: "true" }), document.getElementById("root2"))
                }
            })

    }

    let goNextStep = (e) => {
        e.preventDefault()
        return render(Install({ step: 2 }), document.getElementById("root2"))
    }

    let children = []
    if (step == 1) {
        let storedDatabaseFormData = JSON.parse(sessionStorage.getItem('databaseFormData') || '{}');

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
                        ...(storedDatabaseFormData ? { value: storedDatabaseFormData.dbHost } : {})
                    }),
                    Input({
                        label: "Database name",
                        id: "dbName",
                        name: "dbName",
                        ...(storedDatabaseFormData ? { value: storedDatabaseFormData.dbName } : {})
                    }),
                    Input({
                        label: "Database user",
                        id: "dbUser",
                        name: "dbUser",
                        ...(storedDatabaseFormData ? { value: storedDatabaseFormData.dbUser } : {})
                    }),
                    Input({
                        label: "Database password",
                        id: "dbPassword",
                        name: "dbPassword",
                        type: "password",
                        ...(storedDatabaseFormData ? { value: storedDatabaseFormData.dbPassword } : {})
                    }),
                    Button({
                        title: "Vérifier la configuration",
                        style: {
                            background: "aliceblue"
                        },
                        ...(verified ? { disabled: true } : {}),
                        onClick: verifyDatabaseConnetion
                    }),
                    Button({
                        title: "Prochaine étape",
                        style: {
                            background: "aliceblue"
                        },
                        ...(verified ? {} : { disabled: true }),
                        onClick: goNextStep
                    })
                ]
            }
        ]
    } else if (step == 2) {
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
                    { Button }
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