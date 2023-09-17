export default function Input({ label = "", placeholder = "", name, id }) {

    return {
        type: "div",
        attributes: {
            class: "input"
        },
        children: [
            {
                type: "label",
                children: [label],
                attributes:{
                    for: id
                }
            },
            {
                type: "input",
                attributes: {
                    placeholder: placeholder,
                    name: name,
                    id: id
                }
            }   
        ]
    }
}   