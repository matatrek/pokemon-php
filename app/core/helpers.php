<?php 

function dd($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    exit;
}

function printer($data) {
    echo $data;
}

function background($hex, $alpha = 0.2) {
    $hex = str_replace('#', '', $hex);
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    return "rgba($r, $g, $b, $alpha)";
}

function colors() {
    return [
        "Normal"   => "#A8A77A",
        "Fire"     => "#EE8130",
        "Water"    => "#6390F0",
        "Electric" => "#F7D02C",
        "Grass"    => "#7AC74C",
        "Ice"      => "#96D9D6",
        "Fighting" => "#C22E28",
        "Poison"   => "#A33EA1",
        "Ground"   => "#E2BF65",
        "Flying"   => "#A98FF3",
        "Psychic"  => "#F95587",
        "Bug"      => "#A6B91A",
        "Rock"     => "#B6A136",
        "Ghost"    => "#735797",
        "Dragon"   => "#6F35FC",
        "Dark"     => "#705746",
        "Steel"    => "#B7B7CE",
        "Fairy"    => "#D685AD"
    ];
}