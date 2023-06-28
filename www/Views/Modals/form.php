<?php

use App\Core\Utils;

?>
<form
        method="<?= $config["config"]["method"]??"GET" ?>"
        action="<?= $config["config"]["action"] ?>">

    <?php foreach ($config["inputs"] as $name=>$input):?>

        <?php if($input["type"] == "select"):?>
            <select name="<?= $name;?>">
                <?php foreach ($input["options"] as $option):?>
                    <option><?= $option;?></option>
                <?php endforeach;?>
            </select>
        <?php elseif($input["type"] == "checkbox"):?>
            <input
                    name="<?= $name;?>"
                    type="<?= $input["type"]?>"
                    <?php if(isset($input["checked"]) && $input["checked"] == true):?>
                        checked
                    <?php endif;?>
            >
            <label for="<?= $name;?>"><?= $input["label"];?></label>
        <?php else : ?>
            <input
                    name="<?= $name;?>"
                    type="<?= $input["type"]?>"
                    placeholder=" <?= $input["placeholder"]?>"
                    value="<?= $input["value"]??"";?>"
                    
            >
        <?php endif;?>

    <?php endforeach; ?>


    <input type="submit" name="submit" value="<?= $config["config"]["submit"] ?>">
    <input type="reset" value="<?= $config["config"]["cancel"] ?>">
</form>