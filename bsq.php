<?php
ini_set("memory_limit", "1024M");
function bsq($filePath){
    $file = file($filePath);
    $number = $file[0];
    $array = [];
    $other = [];

    for($i=0; $i < $number; $i++){
        $array[$i] = [];
        $other[$i] = [];
    }

    
    unset($file[0]);

    foreach ($file as $line_num => $line) {
        $eltrim = trim($line);
        $elcol = strlen($eltrim);
        $chars = str_split($eltrim);
        foreach($chars as $key => $string){
            $array[$line_num-1][$key] = $string;
        }
    }

    function square($map, $row, $col){

        for ($i=0; $i < $row; $i++) { 
            if($map[$i][0]== "."){
                $other[$i][0]= 1;
            }else{
                $other[$i][0]= 0;
            }
        }
        for ($i=0; $i < $col; $i++) { 
            if($map[0][$i]== "."){
                $other[0][$i]= 1;
            }else{
                $other[0][$i]= 0;
            }
        }

        for($i=1; $i < $row; $i++){
            for ($j=1; $j < $col; $j++) { 
                if($map[$i][$j]== "."){
                    $min = min($other[$i-1][$j],$other[$i][$j-1],$other[$i-1][$j-1]);
                    $other[$i][$j]= $min+1;
                }else{
                    $other[$i][$j]= 0;
                }
            }
        }       
        
        $e=0;
        $keyRow;
        $keyCol;
    for ($i=0; $i < $row; $i++) { 
        for ($j=0; $j < $col; $j++) {  
            if($other[$i][$j] > $e){
                $e = $other[$i][$j];
                $keyRow=$i;
                $keyCol=$j;
            }
        }
    }

    for ($i=0; $i < $e; $i++) { 
       for ($j=0; $j < $e; $j++) { 
            $map[$keyRow-$i][$keyCol-$j] = "x";
       }
    }

    foreach ($map as $key => $value) {
        $tre="";
        foreach ($value as $keys => $values) {
            $tre = $tre."".$values;
        }
        echo $tre."\n";
    }
};
    square($array, $number, $elcol);

};

bsq($argv[1]);
