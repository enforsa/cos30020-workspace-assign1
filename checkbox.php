<?php
function createCheckbox($id = '', $name = '', $value = '', $message = '')
{
    return "<div class='checkbox'>
        <input id='$id' name='$name' type='checkbox' value='$value'>
        <label for='$id'>$message</label>
    </div>";
}
?>
