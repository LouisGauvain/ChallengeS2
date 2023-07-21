<div class="div_input">
    <h2>Modifier user: <?php echo $fullname ?></h2>

    <?php print_r($errors ?? null); ?>

    <?php $this->modal("form", $form); ?>
</div>