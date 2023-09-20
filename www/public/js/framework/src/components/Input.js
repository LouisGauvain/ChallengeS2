export default function Input({ label = "", placeholder = "", name, id, type, value, disabled, checked }) {

    let a = {
        type: "div",
        attributes: {
            class: "input"
        },
        children: [
            {
                type: "label",
                children: [label],
                attributes: {
                    for: id
                }
            },
            {
                type: "input",
                attributes: {
                    type: type,
                    ...(placeholder ? { placeholder: placeholder } : {}),   
                    name: name,
                    id: id,
                    ...(checked ? { checked: true } : {}),
                    ...(value ? { value: value } : {}),
                    ...(disabled ? { disabled: disabled } : {}),
                },
            }
        ]
    }

    return a
}       