<div class="div_input">
    <h2>S'inscrire</h2>

    <?php print_r($errors ?? null); ?>
    <?php $this->modal("form", $form); ?>

    <form class="padding-button-redirection" action="login" method="get">
        <input type="submit" value="Se connecter">
    </form>
</div>