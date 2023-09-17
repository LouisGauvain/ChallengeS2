export default function Input({ label = "", placeholder = "", name, id, type, value}) {

    console.log(value);

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
                    placeholder: placeholder,
                    name: name,
                    id: id,
                    ...(value ? {value: value} : {})
                },
            }
        ]
    }

    console.log(a)

    return a
}       