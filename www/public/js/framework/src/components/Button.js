export default function Button({ title, onClick, style, disabled }) {
  return {
    type: "button",
    attributes: {
      style: { ...style },
      ...(disabled ? { disabled } : {})
    },
    events: {
      click: onClick,
    },
    children: [title],
  };
}
