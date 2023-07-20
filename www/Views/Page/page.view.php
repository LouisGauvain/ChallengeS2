<?php print_r($errors ?? null); ?>

<script>
    fetch("<?= $url ?>", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(<?= $page['content'] ?>)
        })
        .then(response => response.text())
        .then(htmlResponse => {
            document.getElementById("root").innerHTML = htmlResponse;
        })
        .catch(error => {
            console.error('Une erreur s\'est produite:', error);
        });
</script>