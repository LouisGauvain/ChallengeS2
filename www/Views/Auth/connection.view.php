<div class="div_input">

    <h2 class="center">Se Connecter</h2>

    <?php print_r($errors ?? null); ?>
    <?php $this->modal("form", $form); ?>

    <form class="padding-button-redirection" action="register" method="get">
        <input class="center" type="submit" value="S'inscrire">
    </form>
</div>