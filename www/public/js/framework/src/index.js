/*import BrowserRouter from "./components/BrowserRouter.js";
import routes from "./routes.js";

const root = document.getElementById("root");
BrowserRouter(routes, root);
*/
import {generateStructure, render} from "./core/DomRenderer.js";
console.log( render);

export {generateStructure, render};