<?php
// Ruta al archivo CSV
$csvFile = 'F-CMP-01_Solicitud_de_mercancía2024-08-12_14_35_40.csv';

// Abrir el archivo CSV
if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    // Leer encabezados
    $headers = fgetcsv($handle, 1000, ',');

    // Conexión a la base de datos
    $pdo = new PDO('mysql:host=localhost;dbname=base4', 'root', '');
    
    try {
        $pdo->beginTransaction();

        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // Mapear los datos CSV a las variables correspondientes
            list(
                $noEmpleado, $idDepartamento, $nombreEmpleado, $apellidoPaterno,
                $apellidoMaterno, $emailEmpleado, $folio, $Prioridad,
                $gestiona, $solicitando, $fecha_pedido, $fecha_entrega,
                $fines_utilizacion, $nombre_solicitud, $nombre_jefe,
                $correo_jefe, $nombre_recibe,
                $partida, $cantidad, $unidad, $descripcion
            ) = $data;

            // Convertir las fechas al formato Y-m-d H:i:s
            $fechaPedidoObj = DateTime::createFromFormat('d/m/Y H:i', $fecha_pedido);
            $fechaEntregaObj = !empty($fecha_entrega) ? DateTime::createFromFormat('d-M-y', strftime('%d-%b-%y', strtotime($fecha_entrega))) : null;

            if (!$fechaPedidoObj) {
                echo "Formato de fecha incorrecto en el archivo CSV para la fecha de pedido: $fecha_pedido\n";
                continue; // Saltar a la siguiente fila en caso de error
            }

            $fecha_pedido = $fechaPedidoObj->format('Y-m-d H:i:s');
            $fecha_entrega = $fechaEntregaObj ? $fechaEntregaObj->format('Y-m-d') : null;

            // Inserción en la tabla soliMercaServi
            $sql1 = "INSERT INTO soliMercaServi (
                        noEmpleado, idDepartamento, nombreEmpleado, apellidoPaterno, 
                        apellidoMaterno, emailEmpleado, folio, Prioridad, 
                        gestiona, solicitando, fecha_pedido, fecha_entrega, 
                        fines_utilizacion, nombre_solicitud, nombre_jefe, 
                        correo_jefe, nombre_recibe
                    ) VALUES (
                        :noEmpleado, :idDepartamento, :nombreEmpleado, :apellidoPaterno, 
                        :apellidoMaterno, :emailEmpleado, :folio, :Prioridad, 
                        :gestiona, :solicitando, :fecha_pedido, :fecha_entrega, 
                        :fines_utilizacion, :nombre_solicitud, :nombre_jefe, 
                        :correo_jefe, :nombre_recibe
                    )";
            
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->execute([
                ':noEmpleado' => $noEmpleado,
                ':idDepartamento' => $idDepartamento,
                ':nombreEmpleado' => $nombreEmpleado,
                ':apellidoPaterno' => $apellidoPaterno,
                ':apellidoMaterno' => $apellidoMaterno,
                ':emailEmpleado' => $emailEmpleado,
                ':folio' => $folio,
                ':Prioridad' => $Prioridad,
                ':gestiona' => $gestiona,
                ':solicitando' => $solicitando,
                ':fecha_pedido' => $fecha_pedido,
                ':fecha_entrega' => $fecha_entrega,
                ':fines_utilizacion' => $fines_utilizacion,
                ':nombre_solicitud' => $nombre_solicitud,
                ':nombre_jefe' => $nombre_jefe,
                ':correo_jefe' => $correo_jefe,
                ':nombre_recibe' => $nombre_recibe
            ]);

            // Obtener el ID generado para usarlo en la segunda tabla
            $soliMercaServi_id = $pdo->lastInsertId();

            // Inserción en la tabla mercancias_servicios
            $sql2 = "INSERT INTO mercancias_servicios (
                        soliMercaServi_id, partida, 
                        cantidad, unidad, descripcion
                    ) VALUES (
                        :soliMercaServi_id, :partida, 
                        :cantidad, :unidad, :descripcion
                    )";

            $stmt2 = $pdo->prepare($sql2);
            $stmt2->execute([
                ':soliMercaServi_id' => $soliMercaServi_id,
                ':partida' => $partida,
                ':cantidad' => $cantidad,
                ':unidad' => $unidad,
                ':descripcion' => $descripcion
            ]);
        }

        $pdo->commit();

        echo "Datos insertados correctamente desde el CSV.";
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Error al insertar datos desde el CSV: " . $e->getMessage();
    }

    fclose($handle);
} else {
    echo "No se pudo abrir el archivo CSV.";
}
?>
