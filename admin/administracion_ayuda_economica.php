<?php 
include('../conectiondb.php');
session_start();


/* buscar solicitudes (conseguir solicitudes)
while hayan solicitudes 
    buscar estudiante
    if promedio_est >= prom_min (verificar si cumple)
        if balance_beca > 0 (intentar aprobar solicitud)
            if (balance_beca - tope_beca) > 0
                cant_aprobada = tope_beca
                balance_beca = balance_beca - tope_beca
                estatus_solicitud = 'aceptado'
            else
                cant_aprobada = balance_beca
                estatus_solicitud = 'aceptado'
                balance_beca = 0
                
        else 
            estatus_solicitud = 'denegado'
    else 
        estatus_solicitud = 'denegado' */

function otorgacion(){
    //Buscar Solicitudes
    $get_solicitud = "SELECT * FROM solicitud";

    $run_solicitud = mysqli_query($dbc, $get_solicitud);

    while($row_solicitud=mysqli_fetch_array($run_solicitud)){//controla las solicitudes (loop afuera)

        $solicitud_id = $row_solicitud['sol_id'];
        $user_id = $row_solicitud['user_id'];
        $beca_id = $row_solicitud['beca_id'];
        $fecha_solicitud = $row_solicitud['fecha_sol'];
        //$nombre_actividad = $row_solicitud['actividad'];
        $costo_actividad = $row_solicitud['costo'];
        //$fecha_actividad = $row_solicitud['fecha_actividad'];
        $status_solicitud = $row_solicitud['status'];
        $cantidad_aprobada = $row_solicitud['cantidad_aprobada'];

        //Buscar Estudiantes/Usuarios
        $get_estudiante = "SELECT * 
                        FROM estudiantes NATURAL JOIN usuarios
                        WHERE user_id = {$row_solicitud['user_id']}";//usando el user_id de solicitud

        //Buscar info becas
        $get_beca = "SELECT * 
                    FROM becas 
                    WHERE beca_id = {$row_solicitud['beca_id']}";//usando el beca_id de solicitud


        if($run_estudiante = mysqli_query($dbc, $get_estudiante) && $run_beca = mysqli_query($dbc, $get_beca))
        {
            $row_estudiante=mysqli_fetch_array($run_estudiante);
            $promedio_estudiante = $row_estudiante['promedio'];

            $row_beca=mysqli_fetch_array($run_beca);
            $tope_beca = $row_beca['tope_beca'];
            $balance_beca = $row_beca['balance_beca'];
            $promedio_min_beca = $row_beca['promedio_min'];
        }

        if($promedio_estudiante >= $promedio_min_beca)//Verificar si el estudiante cualifica por promedio
        {
            if($balance_beca > 0)//verificar si todavia hay fondos
            {
                if(($balance_beca - $tope_beca) > 0)//verificar si hay suficiente para otorgar la cantidad del tope
                {
                    $cantidad_aprobada = $tope_beca;
                    $balance_beca = $balance_beca - $tope_beca;
                    $estatus_solicitud = 'Aceptado';

                }
                else//aceptado, pero hay menos balance que el tope
                {
                    $cant_aprobada = $balance_beca;
                    $estatus_solicitud = 'Aceptado';
                    $balance_beca = 0;
                }
            }
            else//denegado pq no hay balance (se acabo el fondo de la beca)
            {
                $status_solicitud = "Denegado";
                $cantidad_aprobada = 0;
            }
        }
        else//denegado pq no cumple con el promedio
        {
            $status_solicitud = "Denegado";
            $cantidad_aprobada = 0;
        }
    }
}


?>