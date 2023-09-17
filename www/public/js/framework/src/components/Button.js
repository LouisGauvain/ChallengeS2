export default function Button({ title, onClick, style, disabled }) {
  const baseStyle = {
    backgroundColor: "grey",
    borderRadius: "5px",
  };
  return {
    type: "button",
    attributes: {
      style: { ...baseStyle, ...style },
      ...(disabled ? {disabled} : {})
    },
    events: {
      click: onClick,
    },
    children: [title],
  };
}
