<?php
include('../conectiondb.php');

// if(!$dbc = db_connect())
// {
// 	print '<p style="color: red;">'.$MYSQL_ERRNO.':'.$MYSQL_ERROR.'</p>';
//     exit();
// }        
//Old query
// $query = "SELECT solicitud.*, estudiantes.promedio AS est_promedio, becas.promedio AS beca_promedio, becas.tope_becas
// FROM solicitud, estudiantes, becas
// WHERE solicitud.num_id = estudiante.num_id AND solicitud.id_beca = beca.id
// ORDER BY fecha";

//New Query
$query = "SELECT solicitud.*, estudiantes.promedio AS est_promedio, becas.promedio_min AS beca_promedio, becas.tope_beca
FROM solicitud, usuarios, estudiantes, becas
WHERE solicitud.user_id = usuarios.user_id AND usuarios.email = estudiantes.email AND solicitud.beca_id = becas.beca_id
ORDER BY fecha_sol";

if ($result = mysqli_query($dbc,$query)){
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)){
		$ok = TRUE;
		//$razon = "";
		$status = "";
		$asignar = 0;
		$otorgar = 0;
		$disponible = 0;

        //Old query 2
        // $query = "SELECT disponible FROM beca WHERE id = {$row['id_beca']}";
        //New query 2
        $query2 = "SELECT balance_beca FROM becas WHERE beca_id = {$row['beca_id']}";
		$r = mysqli_query($dbc,$query2);
		$record = mysqli_fetch_array($r);
		$disponible = $record['balance_beca'];
		
		if ($row['est_promedio'] < $row['beca_promedio']){
			$status ="Denegado";
			//$razon = "No cumple con promedio";
			$ok = FALSE;
		}
		elseif ($record['balance_beca'] <= 0) {
				$status ="Denegado";
				//$razon = "Beca agotada";
				$ok = FALSE;
		}
		if ($ok){ 
			if ($row['costo'] > $row['tope_beca']){
				$asignar = $row['tope_beca'];
			}
			else {
				$asignar = $row['costo'];
			}
			if ($disponible >= $asignar){
				$otorgar = $asignar;
				$status = "Aceptado";
				$disponible = $disponible - $otorgar;
			}
			else {
				$otorgar = $disponible;
				$status = "Aceptado";
				$disponible = 0;
			}
		}
	    $query3="UPDATE solicitud SET cantidad_aprobada='$otorgar', status_sol='$status' WHERE sol_id={$row['sol_id']}";
		mysqli_query($dbc, $query3) or die("Bad query: $query3");
	    $query4="UPDATE becas SET balance_beca='$disponible' WHERE beca_id={$row['beca_id']}";
        mysqli_query($dbc, $query4) or die("Bad query: $query4");
    }
    echo "<script>alert('Las Becas han sido otorgadas!')</script>";
    echo "<script>window.open('./solicitantes.php','_self')</script>";
 }
 else{
	print  "<h5><p>No existen solicitudes para procesar</p></h5>";
 }
}
?>