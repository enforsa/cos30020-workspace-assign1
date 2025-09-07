<?php
    require_once 'icon.php';

    enum ButtonSize: string {
        case Small = 'small';
        case Normal = 'normal';
        case Large = 'large';
    }

    enum ButtonStyle: string {
        case Filled = 'filled';
        case Shaded = 'shaded';
        case Plain = 'plain';
        case Warning = 'warning';
        case Danger = 'danger';
        case Text = 'text';
    }

    enum ButtonColor: string {
        case Grey = 'grey';
        case Red = 'red';
        case Green = 'green';
        case Amber = 'amber';
        case Blue = 'blue';
        case Purple = 'purple';
        case Pink = 'pink';
        case Teal = 'teal';
        case Brown = 'brown';
        case Orange = 'orange';
    }
    

    function createButton($size = ButtonSize::Normal, $style = ButtonStyle::Filled, $color = ButtonColor::Blue, $icon = '', $message = 'Button', $type = 'button', $href = '', $iconRight = false, $disabled = false, $iconOnly = false) {
        $sizeValue = $size->value;
        $styleValue = $style->value;
        $colourValue = $style == ButtonStyle::Plain ? 'transparent' : $color->value;
        
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
        return "<button class='button $sizeValue $colourValue $iconOnlyValue $styleValue' type='$type'><a draggable='false' href='$href'>$content</a></button>";
    }

    function getButtonIconSize($buttonSize) {
       return match($buttonSize) {
            ButtonSize::Small => IconSize::Small2,
            ButtonSize::Normal => IconSize::Small1,
            ButtonSize::Large => IconSize::Normal,
        };
    }
?>