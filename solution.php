<?php
	//error_reporting(E_ALL);
	ini_set('display_errors', 'Off');
	ini_set('html_errors', 'Off');
	// 1st section
        $a = fopen('awards.csv', 'r');
        $c = fopen('contracts.csv', 'r');
         while (($data = fgetcsv($a, 0, ",")) !== FALSE) {
            $awards[]=$data;
        }
        while (($data = fgetcsv($c, 0, ",")) !== FALSE) {
                $contracts[]=$data;
        }
 		// 2nd section   
        for($x=0;$x< count($contracts);$x++)
        {
            if($x==0){
                unset($awards[0][0]);
                $line[$x]=array_merge($contracts[0],$awards[0]); //header
            }
            else{
                $deadlook=0;
                for($y=0;$y <= count($awards);$y++)
                {
                    if($awards[$y][0] == $contracts[$x][0]){
                        unset($awards[$y][0]);
                        $line[$x]=array_merge($contracts[$x],$awards[$y]);
                        $deadlook=1;
                    }           
                }
                if($deadlook==0)
                    $line[$x]=$contracts[$x];
            }
        }
  	// 3rd section     
        $final = fopen('final.csv', 'w');
        
        foreach ($line as $fields) {
            fputcsv($final, $fields);
        }

        function csv($filename){
        	$rows = array();
        	foreach(file($filename)as $line){
 		$rows[] = str_getcsv($line);
        	}
        	
	$i=0;
        	while($i<count($rows)){
        		if($rows[$i][1]=="current"){

        			$amount[] = $rows[$i][12];
        			while($j<count($amount)){
        			if($amount[$j]!=0){
        				$sum = array_sum($amount);
        				echo "Total Amount of current contracts: " . $sum;
			}
        			$j++;
        		}        		     			        		
             	}
             	$i++;
        	}
    	
        }	
        echo csv('final.csv');
	fclose($final);
?>
