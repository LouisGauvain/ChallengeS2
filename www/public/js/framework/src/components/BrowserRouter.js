import { generateStructure, render } from "../core/DomRenderer.js";
import Comments from "./Comments.js";

function BrowserRouter(routes, rootElement, pathname) {
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
  return {
    type: "a",
    attributes: {
      href: link,
    },
    children: [title],
    events: {
      click: function (event) {
        if ((new URL(event.currentTarget.href)).pathname === "/")
          return;
        event.preventDefault();
        history.pushState({}, undefined, link);
        window.dispatchEvent(new Event("popstate"));
        let div = {
          type: "div",
          children: [],
        }
        let div2 = {
          type: "div",
          children: [],
        }
        fetch(link, { method: "POST" }).then((response) => { return response.text() }).then((data) => {
          const json = JSON.parse(data);
          console.log("data", json)

          div.children.push(JSON.parse(json.content))
          render(div, document.getElementById("root"));

          if (json.comments.length > 0) {
            div2.children.push(json.comments)
            render(Comments(div2), document.getElementById("comment"));
          }
          else {
            render({ type: "div", children: [] }, document.getElementById("comment"));
          }
        });
      },
    },
  };
}

export { BrowserLink, BrowserRouter }