function generateStructure(structure) {
  const element = document.createElement(structure.type);
  if (structure.attributes) {
    for (let attrName in structure.attributes) {
      if (attrName.startsWith("data-")) {
        element.dataset[attrName.replace("data-", "")] =
          structure.attributes[attrName];
      } else if (attrName === "style") {
        Object.assign(element.style, structure.attributes[attrName]);
      } else element.setAttribute(attrName, structure.attributes[attrName]);
    }
  }
  if (structure.events) {
    for (let eventName in structure.events) {
      element.addEventListener(eventName, structure.events[eventName]);
    }
  }

  if (structure.children) {
    for (let child of structure.children) {
      let subChild;
      if (typeof child === "string") {
        subChild = document.createTextNode(child);
      } else {
        subChild = generateStructure(child);
      }
      element.appendChild(subChild);
    }
  }

  return element;
}

function render(structure, root) {
  const oldElement = root
  const newElement = generateStructure(structure);

  //wait for everything to be rendered
  addEventListener("load", () => {
    if(oldElement.firstChild === null) {
      root.appendChild(newElement);
      return;
    }
    if (oldElement.isEqualNode(newElement)) {
      return;
    }
    root.replaceChild(newElement, oldElement);
    
  });

}

export { generateStructure, render };