<?php

class Solver {

    public static $min_way_len = INF;
    public static $min_way;
    private static $maze;
    private static int $end_x;
    private static int $end_y;
    private static int $width;
    private static int $height;

    static function set_params ($maze, int $end_x, int $end_y, int $width, int $height): void {
        self::$maze = $maze;
        self::$end_x = $end_x;
        self::$end_y = $end_y;
        self::$width = $width;
        self::$height = $height;
    } 

    // в visited[][] ставить 1 там, где барьер - костыль.Так что проверка maze на 0
    // maze[y][x]
    // visited [y][x]
    // way[x][y]

    static function  find_way ($way, $visited, int $counter, int $len, int $cur_x, int $cur_y) {

        if ($cur_x == 0) {
            if ($cur_y == 0) {
                /* cur_x = 0, cur_y = 0 */
                if (self::$width > 1 && $visited[0][1] == 0) {
                    // x =1 y = 0
                    // go right
                    $way[$counter][0] = 1;
                    $way[$counter][1] = 0;
                    $len += self::$maze[0][1];
                    if (self::$end_x == 1 && self::$end_y == 0) {
                        if ($len < self::$min_way_len) {
                            $min_way_len = $len;
                            $min_way = $way;
                        }
                        return $way;
                    } else {
                        $new_visited = $visited;
                        $new_visited[0][1] = 1;
                        $way = self::find_way($way, $new_visited, ($counter+1), $len, 1, 0);
                    }
                    
                }
                if (self::$height > 1 && $visited[1][0] == 0) {
                    // x = 0 y = 1
                    // go down
                    $way[$counter][0] = 0;
                    $way[$counter][1] = 1;
                    $len += self::$maze[1][0];
                    if (self::$end_x == 0 && self::$end_y == 1) {
                        if ($len < self::$min_way_len) {
                            $min_way_len = $len;
                            $min_way = $way;
                        }
                        return $way;
                    } else {
                        $new_visited = $visited;
                        $new_visited[1][0] = 1;
                        $way = self::find_way($way, $new_visited, ($counter+1), $len, 0, 1);
                    }
                }
            }
            
            if ($cur_y != 0 && $cur_y == (self::$height - 1)) {
                 /* cur_x = 0, cur_y = height */
                 if ($visited[$cur_y - 1][0] == 0) {
                    // go up
                    $way[$counter][0] = 0;
                    $way[$counter][1] = $cur_y - 1;
                    $len += self::$maze[$cur_y - 1][0];
                    if (self::$end_x == 0 && self::$end_y == $cur_y - 1) {
                        if ($len < self::$min_way_len) {
                            $min_way_len = $len;
                            $min_way = $way;
                        }
                        return $way;
                    } else {
                        $new_visited = $visited;
                        $new_visited[$cur_y -1][0] = 1;
                        $way = self::find_way($way, $new_visited, ($counter+1), $len, 0, ($cur_y - 1));
                    }
                 }
                 if ($visited[$cur_y][1] == 0) {
                    // go right
                    $way[$counter][0] = 1;
                    $way[$counter][1] = $cur_y;
                    $len += self::$maze[$cur_y][1];
                    if (self::$end_x == 1 && self::$end_y == $cur_y) {
                        if ($len < self::$min_way_len) {
                            $min_way_len = $len;
                            $min_way = $way;
                        }
                        return $way;
                    } else {
                        $new_visited = $visited;
                        $new_visited[$cur_y][1] = 1;
                        $way = self::find_way($way, $new_visited, ($counter+1), $len, 0, ($cur_y - 1));
                    }
                 }
            }
            if ($cur_y > 0 && $cur_y < (self::$height - 1)) {
                /* cur_x = 0, cur_y = middle */
                if ($visited[$cur_y - 1][0] == 0) {
                    // go up
                }
                if ($visited[$cur_y][1] == 0) {
                    // go right
                }
                if ($visited[$cur_y + 1][0] == 0) {
                    // go down
                }

            }
            

        } else if ($cur_y == 0) {
            if ($cur_x == (self::$height -1)) {
                if ($visited[0][$cur_x - 1] == 0) {
                    // go left
                }
                if ($visited[1][$cur_x] == 0) {
                    //go down
                }
            }

            if ($cur_x < (self::$height - 1)) {
                if ($visited[0][$cur_x-1] == 0) {
                    // go left
                }
                if ($visited[0][$cur_x+1] == 0) {
                    // go right
                }
                if ($visited[1][$cur_x] == 0) {
                    // go down
                }
            }

        }
        else if ($cur_x == (self::$width - 1)) {
            if ($cur_y == (self::$height - 1)) {
                if ($visited[$cur_y][$cur_x - 1] == 0) {
                    // go left
                }
                if ($visited[$cur_y - 1][$cur_x] == 0) {
                    // go up
                }
            }
            if (($cur_y > 0) && ($cur_y < (self::$height - 1))) {
                if ($visited[$cur_y - 1][$cur_x] == 0) {
                    // go up
                }
                if ($visited[$cur_y + 1][$cur_x] == 0) {
                    // go down
                }
                if($visited[$cur_y][$cur_x - 1] == 0) {
                    // go left
                }
            }
        } else if ($cur_y == (self::$height - 1)) {
            if (($cur_x > 0) && ($cur_x < (self::$width - 1))) {
                if ($visited[$cur_y][$cur_x - 1] == 0) {
                    // go left
                }
                if ($visited[$cur_y - 1][$cur_x]) {
                    // go up
                }
                if ($visited[$cur_y][$cur_x + 1] == 0) {
                    // go right
                }
            }
        } else {
            if ($visited[$cur_y][$cur_x - 1] == 0) {
                // go left
            }
            if ($visited[$cur_y - 1][$cur_x] == 0) {
                // go up
            }
            if ($visited[$cur_y][$cur_x + 1] == 0) {
                // go right
            }
            if ($visited[$cur_y + 1][$cur_x] == 0) {
                // go down
            }
        }



        //return $way;
    }
    

    private static function go_right(){}

    private static function go_left(){}

    private static function go_up (){}

    private static function go_down () {}
}

?>