<?php
//ini_set("allow_url_include", "1");
include_once "maze_manager.php";
include_once 'exceptions.php';
include_once "solver.php";



echo "Hi! This program is looking for the best way out of the maze.\n";

$filename = readline("Please write the name of the file containing the maze: ");




$maze = MazeManager::getMaze($filename);
if ($maze != -1) {
    echo "I got a maze:\n";

    MazeManager::print_maze();

    echo "Please write the coordinates of the starting point:\n";

    $valid = true;
    while ($valid) {
        $start_x = MazeManager::get_coordinate("x", MazeManager::$width);
        $start_y = MazeManager::get_coordinate("y", MazeManager::$height);
        if ($maze[$start_y][$start_x] == 0) {
            print_error("There is a barrier in the maze!");
        } else $valid = false;
    }

    

    echo "Please write the coordinates of the endpoint:\n";

    $valid = true;

    while ($valid) {
        $end_x = MazeManager::get_coordinate("x", MazeManager::$width);
        $end_y = MazeManager::get_coordinate("y", MazeManager::$height);
        if ($maze[$end_y][$end_x] == 0) {
            print_error("There is a barrier in the maze!");
        } else $valid = false;
    }
    

    Solver::set_params($maze, $end_x, $end_y, MazeManager::$width, MazeManager::$height);

    $visited = MazeManager::make_zero_maze($start_x, $start_y);

 

    $way = Solver::find_way(array(), $visited, 0, 0, 0, 0);

    if (Solver::$min_way != -1) {
        echo "Minimum path length = ", Solver::$min_way_len, "\n";

        echo "Way:\n";

        Solver::print_way(Solver::$min_way);
    } else {
        print_error("Couldn't find the way in the maze");
    }

    


}



?>