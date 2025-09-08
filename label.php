<?php

    function createLabel($text = 'Label', $for = "", $required = false) {
        return "
            <label class='label' for='$for'>
                $text
            </label>
        ";
    }
?>