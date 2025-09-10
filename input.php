<?php 
    // This enum defines the sizes of inputs that can be created.
    class InputSize {
        const Small = 'small';
        const Normal = 'normal';
        const Large = 'large';
    }

    function createInput($type = 'text', $name = '', $maxLength = 0, $size = InputSize::Normal, $placeholder = 'Description', $pattern = '', $required = true, $disabled = false, $label = 'Label', $hasHelper = false, $helperText = "Helper") {
        $sizeVaue = $size;
        
        $maxLength = $maxLength == 0 ? '' : "maxlength=$maxLength";
        $required = $required == true ? 'required' : '';
        $disabled = $disabled == true ? 'disabled' : '';
        $attributes = "type='$type' name='$name' $maxLength placeholder='$placeholder' pattern='$pattern' $required $disabled";
        
        return "<div class='input $sizeVaue'>" . createLabel($label, $name) . "<input $attributes></input></div>";
    }
?>