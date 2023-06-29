import DomRenderer from "../core/DomRenderer.js";

export default function BrowserRouter(routes, rootElement, pathname) {
  rootElement.appendChild(DomRenderer(routes[pathname]()));

  /*const oldPushState = history.pushState;
  history.pushState = function (data, unused, url) {
    oldPushState.call(history, data, unused, url);
    window.dispatchEvent(new Event("popstate"));
  };

  window.addEventListener("popstate", function () {
    const pathname = location.pathname;

    rootElement.replaceChild(
      DomRenderer(routes[pathname]()),  
      rootElement.childNodes[0]
    );
  });*/
}


export function BrowserLink(title, link) {
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
