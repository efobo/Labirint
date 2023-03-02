<?php
//ini_set("allow_url_include", "1");
include "maze_manager.php";
include "cheker.php";
include 'exceptions.php';
include "solver.php";



echo "Hi! This program is looking for the best way out of the maze.\n";

$filename = readline("Please write the name of the file containing the maze: ");



try {
    $maze = MazeManager::getMaze($filename);
} catch (IncorrectInputFormatException | FileException $ex) {
    echo $ex->getMessage(), "\n";
}

echo "I got a maze:\n";

MazeManager::print_maze();

echo "Please write the coordinates of the starting point:\n";

$start_x = MazeManager::get_coordinate("x", MazeManager::$width);
$start_y = MazeManager::get_coordinate("y", MazeManager::$height);

echo "Please write the coordinates of the endpoint:\n";

$end_x = MazeManager::get_coordinate("x", MazeManager::$width);
$end_y = MazeManager::get_coordinate("y", MazeManager::$height);

Solver::set_params($maze, $end_x, $end_y, MazeManager::$width, MazeManager::$height);

$visited = MazeManager::make_zero_maze($start_x, $start_y);



$way = Solver::find_way(array(), $visited, 0, 0, 0, 0);

echo "Minimum path length = ", Solver::$min_way_len, "\n";

echo "Way:\n";

for ($i =0; $i < count(Solver::$min_way); $i++) {
    for ($j = 0; $j < count(Solver::$min_way[$i]); ($j+2)) {
        echo "(",Solver::$min_way[$i][$j], ", ", $Solver::$min_way[$i][$j+1], ")";
    }
    echo "\n";
}


?>