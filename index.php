<?php 
    include('helpers/extractHour.php');
    include('config/db.php');
    $fp = fopen('./reporte.csv', 'r');
    $datos = array();
    while ($data = fgetcsv ($fp, 1000, ";")) {
        $num = count ($data);
        $explode = explode(',', $data[0]);
        $explode[2] = substr($explode[2], 0, -5). 'm';
        $fechaHora = explode(' ', $explode[2]);
        $explode[2]=$fechaHora;
        $explode[2][0] = strtotime(str_replace('/', '-', $fechaHora[0]));
        $explode[2][1] = date("H:i:s" , strtotime($explode[2][1].' '.$explode[2][2]));
        array_push($datos, $explode);
    }
    $val = entryExit($datos);
    if ($val) {
        $db = New DB();
        $conect=$db->connection('asistencia');
        for ($i=0; $i < count($val); $i++) { 
                $sql = 'INSERT INTO `asistencia`(`fecha`, `cedula`, `nombre`, `hora_entrada`, `hora_salida`) VALUES (?, ?, ?, ?, ?)';
                $stmt = $conect->prepare($sql); 
                $stmt->bind_param("sisss", $val[$i]['fecha'], $val[$i]['cedula'], $val[$i]['nombre'], $val[$i]['hora_entrada'], $val[$i]['hora_salida']);
                $stmt->execute(); 
                
            }
            
       
    }
    
?>