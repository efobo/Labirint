<?php

function print_error(string $str) {
    echo "ERROR: ", $str, "\n";
}

function incorrectInputFormatException (string $str) {
    print_error("Incorrect Input Format Exception! ", $str, "\n");
}

function fileException (string $str) {
    print_error("File Exception! ", $str, "\n");
}



?>