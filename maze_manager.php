<?php
include_once 'exceptions.php';



class MazeManager {
    public static int $height = 0;
    public static int $width;
    public static $maze;

    static function getMaze(string $filename) {
        $fp = fopen($filename, 'r');

        $height = 0;
        $width = 0;
        $maze = array();
    
    
        if (!$fp) {
            fileException("Error opening the $filename file");
            
        }
        else {
            
            $check_width = 0;
            $is_first = true;
            while (($line = fgets($fp, 4096)) !== false) {
                
                $line = trim($line);
    
                $demo_maze = str_split($line);
                $demo_maze_counter = 0;
                $len = strlen($line);
                for ($i = 0; $i < $len; $i++) {
                    if ($line[$i] == " ") continue;
                    if (is_numeric($line[$i])) {
                        $demo_maze[$demo_maze_counter] = $line[$i];
                        $demo_maze_counter++;
                        $width++;
                    } else {
                        incorrectInputFormatException("A line can only contain numbers and spaces");
                        return -1;
                    }
                }
    
                
    
                if ($is_first) {
                    $check_width = $width;
                    $is_fisrt = false;
                } else {
                    if ($check_width != $width) {
                        incorrectInputFormatException("Unequal number of characters in rows.");
                        return -1;
                    }
                }
                $width = 0;
                $maze[$height] = $demo_maze;
                $height++;
    
            }
    
            
        }
    
        fclose($fp);

        self::$height = $height;
        self::$width = $check_width;
        self::$maze = $maze;
    
        return $maze;
    }


    static function get_coordinate (string $coord_name, int $limit) {
        $valid = true;

        while($valid) {
            $coord = readline("$coord_name = ");
            if (ctype_digit(strval($coord))) {
                if ($coord >= 0 && $coord < $limit) {
                    $valid = false;
                } else {
                    print_error("$coord_name must be greater than or equal to 0 and less than or equal to $limit");
                    continue;
                }
                
            } else {
                print_error("$coord_name must be an integer!");
                continue;
            }
        }
        return $coord;
    }

    static function make_zero_maze (int $cur_x, int $cur_y) {
        $zero_maze = array();

        for ($i = 0; $i < MazeManager::$height; $i++) {
            $demo_maze = array();
            for ($j = 0; $j < MazeManager::$width; $j++) {
                if ($i == $cur_y && $j == $cur_x) {
                    $demo_maze[$j] = 1;
                } else $demo_maze[$j] = 0;
            }
            $zero_maze[$i] = $demo_maze;
        }
        return $zero_maze;
    }



    static function print_maze(): void {
        echo "    ";
        for ($i = 0; $i < MazeManager::$height; $i++) {
            echo $i, " ";
        }
        echo "\n  --";
        for ($i = 0; $i < MazeManager::$height; $i++) {
            echo "--";
        }
        echo "\n";
        
        for ($i = 0; $i < MazeManager::$height; $i++) {
            echo $i, " | ";
            for ($j = 0; $j < MazeManager::$width; $j++) {
                echo self::$maze[$i][$j], " ";
            }
            echo "\n";
        }
    }

}




?>