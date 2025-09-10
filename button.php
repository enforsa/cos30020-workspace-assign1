<?php
require_once 'icon.php';

class ButtonSize {
    const Small = 'small';
    const Normal = 'normal';
    const Large = 'large';
}

class ButtonStyle {
    const Filled = 'filled';
    const Shaded = 'shaded';
    const Plain = 'plain';
    const Warning = 'warning';
    const Danger = 'danger';
    const Text = 'text';
}

class ButtonColor {
    const Grey = 'grey';
    const Red = 'red';
    const Green = 'green';
    const Amber = 'amber';
    const Blue = 'blue';
    const Purple = 'purple';
    const Pink = 'pink';
    const Teal = 'teal';
    const Brown = 'brown';
    const Orange = 'orange';
}

function createButton($size = ButtonSize::Normal, $style = ButtonStyle::Filled, $color = ButtonColor::Blue, $icon = '', $message = 'Button', $type = 'button', $href = '', $iconRight = false, $disabled = false, $iconOnly = false) {
    $sizeValue = $size;
    $styleValue = $style;
    $colourValue = $style == ButtonStyle::Plain ? 'transparent' : $color;
    $displayIcon = ($icon != null && $icon != '' && !ctype_space($icon)) ? createIcon($icon, getButtonIconSize($size)) : '';
    
    if ($iconOnly) {
        $content = $displayIcon;
    } else {
        $content = $iconRight ? "<span>$message</span>" . $displayIcon : $displayIcon . "<span>$message</span>";
    }
    
    $iconOnlyValue = $iconOnly ? 'icon-only' : '';
    
    if($disabled) {
        return "<button class='button $sizeValue $colourValue $iconOnlyValue $styleValue' type='$type' disabled><a draggable='false'>$content</a></button>";
    }
    
    $displayInner = $type == 'button' ? "<a draggable='false' href='$href'>$content</a>" : $content;
    return "<button class='button $sizeValue $colourValue $iconOnlyValue $styleValue' type='$type'>$displayInner</button>";
}

function getButtonIconSize($buttonSize) {
    switch($buttonSize) {
        case ButtonSize::Small:
            return IconSize::Small2;
        case ButtonSize::Normal:
            return IconSize::Small1;
        case ButtonSize::Large:
            return IconSize::Normal;
        default:
            return IconSize::Small1;
    }
}
?>