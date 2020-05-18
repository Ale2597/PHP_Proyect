<?php 
include('../conectiondb.php');
session_start();


/* buscar solicitudes (conseguir solicitudes)
while hayan solicitudes 
    buscar estudiante
    if promedio_est >= prom_min (verificar si cumple)
        if balance_beca > 0 (intentar aprobar solicitud)
            if (balance_beca - tope_beca) > 0
                if(costo_actividad < tope_beca)
                    cant_aprobada = costo_actividad
                    balance_beca = balance_beca - costo_actividad
                    estatus_solicitud = 'aceptado'
                else
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

    global $dbc;

    if(!is_null($_GET['otorgar']) && $_GET['otorgar'] == 1)
    {
        //Buscar Solicitudes
        $get_solicitud = "SELECT * FROM solicitud ORDER BY fecha_sol";

        $run_solicitud = mysqli_query($dbc, $get_solicitud);

        while($row_solicitud=mysqli_fetch_array($run_solicitud))//controla las solicitudes (loop afuera)
        {
            $solicitud_id = $row_solicitud['sol_id'];
            $user_id = $row_solicitud['user_id'];
            $beca_id = $row_solicitud['beca_id'];
            $fecha_solicitud = $row_solicitud['fecha_sol'];
            $costo_actividad = $row_solicitud['costo'];
            $status_solicitud = $row_solicitud['status'];
            $cantidad_aprobada = $row_solicitud['cantidad_aprobada'];

            //Buscar promedio estudiantes e info becas
            $get_est_beca = "SELECT promedio, tope_beca, balance_beca, promedio_min
            FROM (usuarios NATURAL JOIN estudiantes) JOIN solicitud USING (user_id) JOIN becas USING (beca_id)
                            WHERE user_id = {$row_solicitud['user_id']}";//usando el user_id de solicitud


            if($run_est_beca = mysqli_query($dbc, $get_est_beca))
            {
                $row_est_beca=mysqli_fetch_array($run_est_beca);

                $promedio_estudiante = $row_est_beca['promedio'];
                $tope_beca = $row_est_beca['tope_beca'];
                $balance_beca = $row_est_beca['balance_beca'];
                $promedio_min_beca = $row_est_beca['promedio_min'];
            }

            if($promedio_estudiante >= $promedio_min_beca)//Verificar si el estudiante cualifica por promedio
            {
                if($balance_beca > 0)//verificar si todavia hay fondos
                {
                    if(($balance_beca - $tope_beca) > 0)//verificar si hay suficiente para otorgar la cantidad del tope
                    {
                        if($costo_actividad < $tope_beca)//verificar si el costo de actividad es menor que el maximo por beca
                        {
                            $cantidad_aprobada = $costo_actividad;
                            $balance_beca = $balance_beca - $costo_actividad;
                            $status_solicitud = 'Aceptado';
                        }
                        else//aceptado con el maximo por beca
                        {
                            $cantidad_aprobada = $tope_beca;
                            $balance_beca = $balance_beca - $tope_beca;
                            $status_solicitud = 'Aceptado';
                        }
                    }
                    else//aceptado, pero hay menos balance que el tope
                    {
                        $cantidad_aprobada = $balance_beca;
                        $status_solicitud = 'Aceptado';
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

            //Queries para aplicar cambios (inserts)

            //Guardar cambios de becas
            $update_beca = "UPDATE becas SET balance_beca=$balance_beca";

            $run_update_beca = mysqli_query($dbc,$update_beca);

            //Guardar cambios usuario
            $update_user = "UPDATE solicitud SET cantidad_aprobada='$cantidad_aprobada', status='$status_solicitud'";

            $run_update_user = mysqli_query($dbc,$update_user);

            // if ($run_update_beca && $run_update_user) {
            //     echo "<script>alert('Las Becas han sido otorgadas!')</script>";
            // }
            // else{
            //     echo "<script>alert('Guachet! NO CORRE!')</script>";
            // }

        }
        echo "<script>alert('Las Becas han sido otorgadas!')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    }
   
}

function reset_becas(){

    global $dbc;

    if(!is_null($_GET['otorgar']) && $_GET['otorgar'] == 0)
    {

        // Reset fondos en beca
        $reset_beca = "UPDATE becas SET balance_beca=fondo_beca";
                
        $run_reset_beca = mysqli_query($dbc,$reset_beca);

        //Reset info de otorgacion estudiante
        $reset_user = "UPDATE solicitud SET cantidad_aprobada='0', status_sol='Pendiente'";

        $run_reset_user = mysqli_query($dbc,$reset_user);

        if ($run_reset_beca && $run_reset_user) {
            echo "<script>alert('La otorgación ha sido revocada!')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
        }
        else{
            echo "<script>alert('Guachet! NO CORRE!')</script>";
        }
    }
}

?>