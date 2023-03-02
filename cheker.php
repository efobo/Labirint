<?php

function print_err(string $str) {
    echo "ERROR: ", $str, "\n";
}

function checkNumberFormat($char):bool {
    if (!is_numeric($char)) return true;
    $n = (int) $char;

    if ($n >= 0 && $n <= 9) return true;

    return false;
}



function incorrectInputFormat(string $err) {
    print_err("Incorrect input format! ".$err);
}



?>