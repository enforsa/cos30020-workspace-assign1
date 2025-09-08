<?php 
    enum TextareaSize: string {
        case Small = 'small';
        case Normal = 'normal';
        case Large = 'large';
    }

    enum ResizeOptions: string {
        case Both = 'resize-both';
        case Vertical = 'resize-vertical';
        case Horizontal = 'resize-horizontal';
        case None = 'resize-none';
    }

    function createTextarea($name = '', $maxLength = 0, $size = TextareaSize::Normal, $placeholder = 'Description', $required = true, $disabled = false, $label = 'Label', $value = '', $resizeOptions = ResizeOptions::Both) {
        $sizeValue = $size->value;

        $maxLengthAttr = $maxLength == 0 ? '' : "maxlength='$maxLength'";
        $requiredAttr = $required ? 'required' : '';
        $disabledAttr = $disabled ? 'disabled' : '';
        $placeholderAttr = "placeholder='$placeholder'";
        $resizeAttr = $resizeOptions->value;

        return "<div class='textarea $sizeValue $resizeAttr'><label for='$name'>$label</label><textarea id='$name' name='$name' $maxLengthAttr $placeholderAttr $requiredAttr $disabledAttr>$value</textarea></div>";
    }
?>