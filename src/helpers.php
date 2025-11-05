<?php

function get_placeholder_image_svg($width, $height, $text = 'TK Pertiwi 14') {
    return 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '"%3E%3Crect fill="%2300e676" width="' . $width . '" height="' . $height . '"/%3E%3Ctext fill="white" font-family="Arial" font-size="20" x="50%25" y="50%25" text-anchor="middle" dominant-baseline="middle"%3E' . rawurlencode($text) . '%3C/text%3E%3C/svg%3E';
}

?>