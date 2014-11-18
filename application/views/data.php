<?php

$j = 0;
/*muestra los registros en json*/
foreach($results as $result){

  $records[$j] = $result;


 $j++;                  
}



echo json_encode($records);
