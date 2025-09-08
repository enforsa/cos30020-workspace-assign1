<?php
    function createCheckbox($label = "", $name = "", $value = "") {
        return "<div class='checkbox'><input type='checkbox' name='$name' id='$value'><label for='$value'>$label</label></div>";
    }
?>