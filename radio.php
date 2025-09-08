<?php
    function createRadio($label = "", $name = "", $value = "") {
        return "<div class='radio'><input type='radio' name='$name' id='$value'><label for='$value'>$label</label></div>";
    }
?>