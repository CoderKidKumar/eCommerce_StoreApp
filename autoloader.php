<?php
spl_autoload_register(function($class){
    /*lastdirectories = get the file that called auto loader, 
    subtract the directory from it to find how "deep" the file is*/
    $lastdirectories = substr(getcwd(),strlen(__DIR__));

//echo "CWD = ".getcwd()."<br>";
//echo "DIR = ".__DIR__."<br>";
//echo "lastDIR = ".$lastdirectories."<br>";


    //use that information to count slashes for folder depth
    $numOfLastDirectories = substr_count($lastdirectories, "/");

//echo "# of different DIR = ".$numOfLastDirectories."<br>";
    //list of classes we might need
    $classes = ["data"];

    //look inside each class list above for the proper class
    foreach($classes as $c){
        $currentDir = $c;
        //echo "Looking in DIR :".$c."<br>";
        for ($n = 0; $n < $numOfLastDirectories; $n++){
            //add ../ for each depth on the return path
            $currentDir = "../".$currentDir;
        }
        //add the file name to the end of the return path
        $classFile = $currentDir . "/". $class .".php";

        //echo "Going into ===> ".$classFile."<br>";
        //makes sure that the return path is readable
        if(is_readable($classFile)){
            if (require $c . "/" . $class. ".php"){
                //echo "Readable".$classFile."<br>";
            break;
            }
        }
        else{
            echo "Not Readable".$classFile."<br>";
        }
    }
});
?>
