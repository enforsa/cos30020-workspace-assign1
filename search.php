<?php
    require_once 'icon.php';

    function createSearch($name = "q", $placeholder = 'Search') {
        return "<label class='search' for='$name'>". createIcon('./style/phosphor-icons/magnifying-glass-bold.svg', IconSize::Small2) ."<input type='search' name='$name' id='$name' placeholder='$placeholder' /></label>";
    }
?>