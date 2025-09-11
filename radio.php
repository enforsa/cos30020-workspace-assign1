<?php
function createRadio($id = '', $name = '', $value = '', $message = '', $checked = false)
{
    $isChecked = $checked ? 'checked' : '';
    return "<div class='radio'>
        <input id='$id' type='radio' name='$name' value='$value' $isChecked required>
        <label for='$id'>$message</label>
    </div>";
}
?>