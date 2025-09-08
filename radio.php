<?php
    function createRadio($label = "", $name = "", $value = "", $isRequired = true) {
        $required = $isRequired == true ? 'required' : '';
        return "<div class='radio'><input type='radio' name='$name' id='$value' $required><label for='$value'>$label</label></div>";
    }
?>