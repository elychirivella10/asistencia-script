<?php 

     function entryExit($array){
        $ar= array();
        $temporal = ['posicion' => 0];
        for ($i=0; $i < count($array) ; $i++) { 
            $entrada = null;
            if ($i==0 || $array[$i][2][0] > $array[$i-1][2][0] || $array[$i][2][0] < $array[$i-1][2][0]) {
                if ($temporal['posicion'] && $temporal['posicion'] == 1) {
                    array_push($ar,$temporal);
                    
                    $temporal = ['cedula'=> intval($array[$i][0]), 'nombre' => $array[$i][1], 'fecha' => date('Y-m-d',$array[$i][2][0]), 'hora_entrada' => $array[$i][2][1], 'hora_salida' => '00:00:00', 'posicion' => 1 ];
                }else {
                    $temporal = ['cedula'=> intval($array[$i][0]), 'nombre' => $array[$i][1], 'fecha' => date('Y-m-d',$array[$i][2][0]), 'hora_entrada' => $array[$i][2][1], 'hora_salida' => '00:00:00', 'posicion' => 1 ];
                    
                }
            }
            else if ($i == count($array)-1 || $array[$i][2][0] > $array[$i+1][2][0] || $array[$i][2][0] < $array[$i+1][2][0] ) {
                $temporal['hora_salida'] =$array[$i][2][1];
                array_push($ar,$temporal );
                $temporal['posicion']=  0;
            }
            
        }
        return $ar;
    }
    

?>