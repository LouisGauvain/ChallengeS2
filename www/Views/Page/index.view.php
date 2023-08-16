<div id="header"></div>
<div id="root"></div>

<script type="module">
    import { generateStructure, render } from "/public/js/framework/src/index.js"
    import Compteur from "/public/js/framework/src/components/Compteur.js"
    import { BrowserLink, BrowserRouter } from "/public/js/framework/src/components/BrowserRouter.js"

    //render(<?= $page["content"] ?>, document.getElementById("root"));
    /*render(
        BrowserLink("Home", "/")
    , document.getElementById("header"));*/
    render(BrowserRouter
        ([
            {title: "Home", link: "/"},
            {title: "About", link: "/about"},
            {title: "Contact", link: "/contact"},
        ],
        document.getElementById("header")),
        document.getElementById("header")
    )
    
    render(Compteur({count: 0}), document.getElementById("root"));
</script>