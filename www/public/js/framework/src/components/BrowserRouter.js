import { generateStructure, render } from "../core/DomRenderer.js";

function BrowserRouter(routes, rootElement, pathname) {
  console.log("BrowserRouter", routes, rootElement, pathname);
  //create a div and add the browser links
  let div = {
    type: "div",
    children: [],
  }
  for (let i = 0; i < routes.length; i++) {
    const route = routes[i];
    div.children.push(BrowserLink(route.title, route.link));
  }
  return div;
}

function BrowserLink(title, link) {
  console.log("BrowserLink", title, link);
  return {
    type: "a",
    attributes: {
      href: link,
    },
    children: [title],
    events: {
      click: function (event) {
        event.preventDefault();
        history.pushState({}, undefined, link);
        window.dispatchEvent(new Event("popstate"));
        let div = {
          type: "div",
          children: [],
        }
        fetch(link, { method: "POST" }).then((response) => { return response.text() }).then((data) => { 
          const json = JSON.parse(data);
          div.children.push(json)
          render(div, document.getElementById("root"));
        });
      },
    },
  };
}

export { BrowserLink, BrowserRouter }