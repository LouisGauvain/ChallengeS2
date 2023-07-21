function extractStructure(element) {
    const structure = {
        type: element.tagName.toLowerCase(),
    };
  
    // Extract attributes
    if (element.attributes.length > 0) {
        structure.attributes = {};
        for (let i = 0; i < element.attributes.length; i++) {
            const attr = element.attributes[i];
            const attrName = attr.name.toLowerCase();
  
            if (attrName.startsWith("data-")) {
                if (!structure.attributes.data) {
                    structure.attributes.data = {};
                }
                const dataAttrName = attrName.replace("data-", "");
                structure.attributes.data[dataAttrName] = attr.value;
            } else if (attrName === "style") {
                structure.attributes.style = Object.assign({}, element.style);
            } else {
                structure.attributes[attrName] = attr.value;
            }
        }
    }
  
    // Extract events
    const eventNames = Object.keys(element).filter((key) => key.startsWith("on"));
    if (eventNames.length > 0) {
        structure.events = {};
        for (const eventName of eventNames) {
            structure.events[eventName] = element[eventName].toString();
        }
    }
  
    // Extract children
    if (element.childNodes.length > 0) {
        structure.children = [];
        for (let i = 0; i < element.childNodes.length; i++) {
            const child = element.childNodes[i];
            if (child.nodeType === Node.TEXT_NODE) {
                structure.children.push(child.nodeValue);
            } else if (child.nodeType === Node.ELEMENT_NODE) {
                structure.children.push(extractStructure(child));
            }
        }
    }
  
    return structure;
  }