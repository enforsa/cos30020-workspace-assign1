<?php
// A class that defines the possible sizes of an icon (compatible with older PHP versions)
class IconSize {
    const Small4 = 'small-4';
    const Small3 = 'small-3';
    const Small2 = 'small-2';
    const Small1 = 'small-1';
    const Normal = 'normal';
    const Large = 'large';
    const ExtraLarge = 'extra-large';
}

// Creates the icon
function createIcon($path = '', $size = IconSize::Normal) {
    return parseSVGContents($path, $size);
}

// Reads in and replaces the current fill with currentColor
function parseSVGContents($path, $sizeValue) {
    $contents = file_get_contents($path);
    
    // Add class to the svg.
    $contents = str_replace("<svg", "<svg class='icon $sizeValue'", $contents);
    $pattern = '/fill=[\'"]#([0-9a-fA-F]{3,6})[\'"]/';
    $replacement = 'fill="currentColor"';
    return preg_replace($pattern, $replacement, $contents);
}
?>