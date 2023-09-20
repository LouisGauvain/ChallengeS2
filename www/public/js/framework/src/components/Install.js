import { render } from "../core/DomRenderer.js";
import Input from "./Input.js"
import Button from "./Button.js";

export default function Install({ step = 1, errors, verified, install, force }) {
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
            return render(Install({ step: 1, errors: errors }), document.getElementById("root"))

        sessionStorage.setItem('databaseFormData', JSON.stringify(formData))

        fetch('/install/test.php', {
            method: 'post',
            body: new FormData(document.querySelector('form'))
        }).then(response => response.json())
            .then(data => {
                if (!data.success) {
                    errors.push(data.message)
                    return render(Install({ step: 1, errors: errors }), document.getElementById("root"))
                }
                else {
                    return render(Install({ step: 1, verified: "true" }), document.getElementById("root"))
                }
            })

    }

    let goNextStep = (e) => {
        e.preventDefault()
        return render(Install({ step: 2 }), document.getElementById("root"))
    }

    let setupSite = (e) => {
        e.preventDefault()
        let inputs = document.querySelectorAll("form .input");

        let formData = {}
        let errors = []
        
        var data = new FormData(document.querySelector('form'));
        for (const entry of data) {
            formData[entry[0]] = entry[1]
            if (!entry[1])
                errors.push(entry[0] + " ne peut pas être vide")
        }

        if (errors.length != 0)
            return render(Install({ step: 2, errors: errors }), document.getElementById("root"))

        const prefix = inputs[1].querySelector("input").value
        if (prefix.length <= 2 || prefix.length > 10 || prefix[prefix.length - 1] !== "_")
            errors.push("Le prefix doit faire entre 3 et 10 caracteres et doit se finir par un \"_\"")

        const email = inputs[2].querySelector("input").value
        const regexMail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!regexMail.test(email))
            errors.push("Le mail renseigné ne respecte pas le format")

        const password = inputs[3].querySelector("input").value
        const passwordVerif = inputs[4].querySelector("input").value
        const regexPasssword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;

        if (password !== passwordVerif)
            errors.push("Les mots de passe ne corresponde pas")
        if (!regexPasssword.test(password))
            errors.push("Le mot de passe doit contenir, au moins une minuscule, au moins une majuscule, aumoins, un chiffre, au moins un caractere spécial, et faire au moins 8 caracteres")

        //selectionner les input avec le name installType
        const installType = document.querySelectorAll("input[name=installType]")
        //verifier si un des input est checked
        let checked = false
        installType.forEach(input => {
            if (input.checked)
                checked = true
        })
        if (!checked)
            errors.push("Vous devez selectionner un type d'installation")

        if (errors.length != 0)
            return render(Install({ step: 2, errors: errors }), document.getElementById("root"))

        sessionStorage.setItem('storedSetupFormData', JSON.stringify(formData))

        let databaseFormData = JSON.parse(sessionStorage.getItem('databaseFormData') || '{}');
        formData = { ...formData, ...databaseFormData }

        let formDataObj = new FormData(document.querySelector('form'))
        for (let key in formData) {
            formDataObj.append(key, formData[key])
        }

        fetch('/install/setup.php', {
            method: 'post',
            body: formDataObj
        }).then(response => response.json())
            .then(data => {
                console.log(data)
                if (!data.success) {
                    errors.push(data.message)
                    return render(Install({ step: 2, force: true, errors: errors }), document.getElementById("root"))
                }
                else {
                    return render(Install({ step: 3 }), document.getElementById("root"))
                }
            })
    }

    let forceSetupSite = (e) => {
        e.preventDefault()

        let formDataObj = new FormData(document.querySelector('form'))
        let formData = JSON.parse(sessionStorage.getItem('storedSetupFormData') || '{}');
        formData = { ...formData, ...JSON.parse(sessionStorage.getItem('databaseFormData') || '{}') }
        for (let key in formData) {
            formDataObj.append(key, formData[key])
        }
        formDataObj.append("force", "true")

        fetch('/install/setup.php', {
            method: 'post',
            body: formDataObj
        }).then(response => response.json())
            .then(data => {
                if (!data.success) {
                    errors.push(data.message)
                    return render(Install({ step: 2, force: true, errors: errors }), document.getElementById("root"))
                }
                else {
                    return render(Install({ step: 3 }), document.getElementById("root"))
                }
            }
            )

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
        let storedSetupFormData = JSON.parse(sessionStorage.getItem('storedSetupFormData') || '{}');

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
                        label: "Nom du site",
                        id: "siteName",
                        name: "siteName",
                        ...(storedSetupFormData ? { value: storedSetupFormData.siteName } : {}),
                        ...(install ? { disabled: true } : {})
                    }), Input({
                        label: "Prefix des tables",
                        id: "tablePrefix",
                        name: "tablePrefix",
                        ...(storedSetupFormData ? { value: storedSetupFormData.tablePrefix } : {}),
                        ...(install ? { disabled: true } : {})
                    }), Input({
                        label: "Email de l'Admin",
                        id: "adminEmail",
                        name: "adminEmail",
                        type: "email",
                        ...(storedSetupFormData ? { value: storedSetupFormData.adminEmail } : {}),
                        ...(install ? { disabled: true } : {})
                    }), Input({
                        label: "Mot de passz de l'Admin",
                        id: "adminPassword",
                        name: "adminPassword",
                        type: "password",
                        ...(storedSetupFormData ? { value: storedSetupFormData.adminPassword } : {}),
                        ...(install ? { disabled: true } : {})
                    }), Input({
                        label: "Remettre mot de passe",
                        id: "adminPasswordVerif",
                        name: "adminPasswordVerif",
                        type: "password",
                        ...(storedSetupFormData ? { value: storedSetupFormData.adminPasswordVerif } : {}),
                        ...(install ? { disabled: true } : {})
                    }),
                    {
                        type: "div",
                        children: [
                            Input({
                                label: "En local",
                                id: "local",
                                name: "installType",
                                type: "radio",
                                value: "local",
                                checked: "true",
                                ...(install ? { disabled: true } : {})
                            }), Input({
                                label: "Sur un serveur",
                                id: "server",
                                name: "installType",
                                type: "radio",
                                value: "server",
                                ...(install ? { disabled: true } : {})
                            }),
                        ]
                    },
                    ...(install ? [{
                        type: "p",
                        children: "Site en cours d'installation, veuillez ne pas quittez la page"
                    }] : [Button({
                        title: "Setup le site",
                        style: {
                            background: "lightblue"
                        },
                        ...(verified ? { disabled: true } : {}),
                        onClick: setupSite
                    })]),
                    ...(force ? [Button({
                        title: "Forcer l'installation",
                        style: {
                            background: "lightblue"
                        },
                        onClick: forceSetupSite
                    })] : [])
                ]
            }
        ]
    }
    else if (step == 3) {
        children = [
            {
                type: "p",
                children: "Site installé avec succès"
            }
        ]
    }

    return {
        type: "div",
        attributes: {
            class: "Installer",
        },
        children: [
            ...children
        ]
    }
}