import { generateStructure } from "../core/DomRenderer.js";

/* function BrowserRouter(routes, rootElement, pathname) {
  console.log("BrowserRouter", routes, rootElement, pathname);
  rootElement.appendChild(generateStructure(routes[pathname]()));

  const oldPushState = history.pushState;
  history.pushState = function (data, unused, url) {
    oldPushState.call(history, data, unused, url);
    window.dispatchEvent(new Event("popstate"));
  };

  window.addEventListener("popstate", function () {
    const pathname = location.pathname;

    rootElement.replaceChild(
      generateStructure(routes[pathname]()),
      rootElement.childNodes[0]
    );
  });
} */

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
      },
    },
  };
}

export { BrowserLink, BrowserRouter }