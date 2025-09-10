<?php
require_once 'icon.php';

class BadgeSize {
    const Small = 'small';
    const Normal = 'normal';
    const Large = 'large';
}

class BadgeStyle {
    const Filled = 'filled';
    const Shaded = 'shaded';
    const Plain = 'plain';
    const Outlined = 'outlined';
    const Dashed = 'dashed';
    const Gradient = 'gradient';
}

class BadgeColor {
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

// This function creates a badge with a specified size, icon, color, and message.
function createBadge($size = BadgeSize::Normal, $style = BadgeStyle::Filled, $icon = 'path/to/icon', $color = BadgeColor::Green, $message = 'Badge message!') {
    $sizeValue = $size;
    $colourValue = $color;
    $styleValue = $style;
    
    // Check to see if icon is empty, null, or has whitespace(s), if yes then don't display icon
    $displayIcon = ($icon == null || $icon == '' || ctype_space($icon)) ? '' : createIcon($icon, getBadgeIconSize($size));
    return "<div class='badge $sizeValue $colourValue $styleValue'>$displayIcon<p>$message</p></div>";
}

function getBadgeIconSize($badgeSize) {
    // Replace match() with traditional switch (match was introduced in PHP 8.0)
    switch($badgeSize) {
        case BadgeSize::Small:
            return IconSize::Small4;
        case BadgeSize::Normal:
            return IconSize::Small3;
        case BadgeSize::Large:
            return IconSize::Small2;
        default:
            return IconSize::Small3;
    }
}
?>