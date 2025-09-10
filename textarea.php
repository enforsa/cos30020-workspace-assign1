<?php 
    class TextareaSize {
        const Small = 'small';
        const Normal = 'normal';
        const Large = 'large';
    }

    class ResizeOptions {
        const Both = 'resize-both';
        const Vertical = 'resize-vertical';
        const Horizontal = 'resize-horizontal';
        const None = 'resize-none';
    }

    function createTextarea($name = '', $maxLength = 0, $size = TextareaSize::Normal, $placeholder = 'Description', $required = true, $disabled = false, $label = 'Label', $value = '', $resizeOptions = ResizeOptions::Both) {
        $sizeValue = $size;

        $maxLengthAttr = $maxLength == 0 ? '' : "maxlength='$maxLength'";
        $requiredAttr = $required ? 'required' : '';
        $disabledAttr = $disabled ? 'disabled' : '';
        $placeholderAttr = "placeholder='$placeholder'";
        $resizeAttr = $resizeOptions;

        return "<div class='textarea $sizeValue $resizeAttr'><label for='$name'>$label</label><textarea id='$name' name='$name' $maxLengthAttr $placeholderAttr $requiredAttr $disabledAttr>$value</textarea></div>";
    }
?>