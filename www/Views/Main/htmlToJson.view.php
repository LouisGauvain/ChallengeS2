<div id="root"></div>

<?php

?>
<script>
    const html = `<?= $html ?>`

    //transformer le html en vrai html
    const parser = new DOMParser()
    const htmlDocument = parser.parseFromString(html, "text/html")
    const body = htmlDocument.querySelector("body")

    const json = extractStructure(body)
    console.log(json);

    fetch("<?= $url ?>", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(json)
        })
        .then(response => response.text())
        .then(htmlResponse => {
            document.getElementById("root").innerHTML = htmlResponse;
        })
        .catch(error => {
            console.error('Une erreur s\'est produite:', error);
        });
</script>