<?php
ini_set("allow_url_include", "1");
include "maze_manager.php";
include_once "cheker.php";
include "solver.php";
include_once 'C:\Games\Labirint\exceptions.php';



echo "Hi! This program is looking for the best way out of the maze.\n";

//$filename = readline("Please write the name of the file containing the maze: ");
$filename = "file.txt";


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



?>