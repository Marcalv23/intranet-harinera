<?php
require_once '../../../../Models/Connection.php';

// Obtener el nombre de la tabla desde la solicitud GET
$type = isset($_GET['type']) ? $_GET['type'] : '';

if (!empty($type)) {
    $pdo = Connection::connectionBD();

    try {
        $query = '';
        switch ($type) {
            case 'solimercaservi':
                $query = "
                    SELECT s.id AS 'ID', s.noEmpleado AS 'Número de Empleado', s.idDepartamento AS 'ID Departamento', 
                           s.nombreEmpleado AS 'Nombre del Empleado', s.apellidoPaterno AS 'Apellido Paterno', 
                           s.apellidoMaterno AS 'Apellido Materno', s.emailEmpleado AS 'Correo Electrónico', 
                           s.telefono AS 'Teléfono', s.folio AS 'Folio', s.Prioridad AS 'Prioridad', 
                           s.gestiona AS 'Gestiona', s.fecha_pedido AS 'Fecha de Pedido', s.fecha_entrega AS 'Fecha de Entrega', 
                           s.fines_utilizacion AS 'Fines de Utilización', s.nombre_solicitud AS 'Nombre de Solicitud', 
                           s.firma_solicitud AS 'Firma de Solicitud', s.nombre_jefe AS 'Nombre del Jefe', 
                           s.correo_jefe AS 'Correo del Jefe', s.nombre_recibe AS 'Nombre del Recibidor', 
                           s.firma_recibe AS 'Firma del Recibidor', s.firma_jefe_recibe AS 'Firma del Jefe que Recibe', 
                           s.solicitando AS 'Solicitando', sm.partida AS 'Partida', sm.cantidad AS 'Cantidad', 
                           sm.unidad AS 'Unidad', sm.descripcion AS 'Descripción'
                    FROM solimercaservi s
                    LEFT JOIN mercancias_servicios sm ON s.id = sm.soliMercaServi_id
                ";
                break;

            case 'escolaboradores':
                $query = "
                    SELECT e.id AS 'ID', e.noEmpleado AS 'Número de Empleado', d.nombre AS 'Departamento', 
                           e.nombreEmpleado AS 'Nombre del Empleado', e.apellidoPaterno AS 'Apellido Paterno', 
                           e.apellidoMaterno AS 'Apellido Materno', e.emailEmpleado AS 'Correo Electrónico', 
                           e.telefono AS 'Teléfono', e.folio AS 'Folio', e.fecha_solicitud AS 'Fecha de Solicitud', 
                           e.propietario_equipo AS 'Propietario del Equipo', e.entrada_salida AS 'Entrada/Salida', 
                           e.fecha_devolucion AS 'Fecha de Devolución', e.motivo AS 'Motivo', e.evidencia AS 'Evidencia', 
                           e.nombre_colaborador AS 'Nombre del Colaborador', e.firma_responsable AS 'Firma del Responsable', 
                           e.aceptacion_responsabilidad AS 'Aceptación de Responsabilidad', e.nombre_autorizador AS 'Nombre del Autorizador', 
                           e.correo_autorizador AS 'Correo del Autorizador', e.firma_autorizador AS 'Firma del Autorizador', 
                           sm.tipo_equipo AS 'Tipo de Equipo', sm.marca AS 'Marca', sm.modelo AS 'Modelo', 
                           sm.numero_serie AS 'Número de Serie'
                    FROM escolaboradores e
                    LEFT JOIN departamento d ON e.idDepartamento = d.idDepto
                    LEFT JOIN caracteristicasescolaboradores sm ON e.id = sm.ESColaboradores_id 
                ";
                break;

                case 'reinci':
                    $query = "
                                SELECT 
                                    r.id AS 'ID', 
                                    r.noEmpleado AS 'Número de Empleado', 
                                    d.nombre AS 'Departamento', 
                                    r.nombreEmpleado AS 'Nombre del Empleado',
                                    r.apellidoPaterno AS 'Apellido Paterno',
                                    r.apellidoMaterno AS 'Apellido Materno',
                                    r.emailEmpleado AS 'Correo Electrónico',
                                    r.telefono AS 'Teléfono',
                                    r.folio AS 'Folio',
                                    r.fecha_reporte AS 'Fecha del Reporte', 
                                    r.tipo_inc AS 'Tipo de Incidente', 
                                    r.dep_rep AS 'Departamento que Reporta', 
                                    r.descrip_inc AS 'Descripción del Incidente', 
                                    r.evidencia AS 'Evidencia', 
                                    r.fecha_atencion AS 'Fecha de Atención', 
                                    r.firma_de_conformidad AS 'Firma de Conformidad'
                                FROM 
                                    reinci r
                                LEFT JOIN 
                                    departamento d ON r.idDepartamento = d.idDepto
                            ";
                    break;

            case 'esvisitantes':
                $query = "
                    SELECT 
                        e.id AS 'ID', 
                        e.fechaSolicitud AS 'Fecha de Solicitud', 
                        e.nombreEmpresa AS 'Nombre de la Empresa', 
                        e.nombreVisitante AS 'Nombre del Visitante', 
                        e.correo AS 'Correo Electrónico', 
                        e.telefono AS 'Teléfono', 
                        e.folio AS 'Folio', 
                        e.prioridad AS 'Prioridad', 
                        e.entradaOsalida AS 'Entrada o Salida', 
                        e.fechaDevolucion AS 'Fecha de Devolución', 
                        e.finesUtilizacion AS 'Fines de Utilización', 
                        e.nombreResponsable AS 'Nombre del Responsable', 
                        e.firmaDeresponsable AS 'Firma del Responsable', 
                        e.aceptacionResponsabilidad AS 'Aceptación de Responsabilidad', 
                        e.nombreAUTho AS 'Nombre del Autorizador', 
                        e.correoAUTho AS 'Correo del Autorizador', 
                        e.firmaAUTho AS 'Firma del Autorizador', 
                        e.evidencia AS 'Evidencia',
                        c.id AS 'ID Característica', 
                        c.tipoEquipo AS 'Tipo de Equipo', 
                        c.marca AS 'Marca', 
                        c.modelo AS 'Modelo', 
                        c.numeroSerie AS 'Número de Serie', 
                        c.perteneceHO AS 'Pertenece a HO'
                    FROM 
                        esvisitantes e
                    LEFT JOIN 
                        esvisitantescaracteristicas c 
                    ON 
                        e.id = c.ESVisitantes_id
                ";
                break;

            // Aquí parece que el caso 'postulaciones' es igual a 'reinci'. Si es el caso, puedes modificarlo si es diferente o eliminar el duplicado
            case 'postulaciones':
                $query = "
                    SELECT 
                        id AS 'ID',
                        cv_documento AS 'CV',
                        constancia_documento AS 'Constancia',
                        nss_documento AS 'NSS',
                        curp_documento AS 'CURP',
                        puesto_postula AS 'Puesto',
                        nombre AS 'Nombre',
                        apellido AS 'Apellido',
                        edad AS 'Edad',
                        sexo AS 'Sexo',
                        correo AS 'Correo Electrónico',
                        telefono AS 'Teléfono',
                        direccion AS 'Dirección',
                        colonia AS 'Colonia',
                        ciudad AS 'Ciudad',
                        estado AS 'Estado',
                        codigo_postal AS 'Código Postal',
                        institucion_academica AS 'Institución Académica',
                        grado_estudio AS 'Grado de Estudio',
                        nombre_carrera AS 'Nombre de la Carrera',
                        experiencia_laboral AS 'Experiencia Laboral',
                        exp_soli AS 'Experiencia Solicitada',
                        tipo_licencia AS 'Tipo de Licencia',
                        pariente AS '¿Tiene Pariente?',
                        nombre_pariente AS 'Nombre del Pariente',
                        documentacion AS 'Documentación',
                        fecha_registro AS 'Fecha de Registro'
                    FROM 
                        postulaciones
                ";
                break;

            // Agregar más casos según sea necesario...

            default:
                echo json_encode(['success' => false, 'error' => 'Tipo de datos no válido']);
                exit;
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($data) {
            // Establecer el juego de caracteres a UTF-8 para manejar caracteres especiales
            header('Content-Type: text/csv; charset=UTF-8');
            header('Content-Disposition: attachment;filename="documento.csv"');
            header('Cache-Control: max-age=0');

            // Crear un archivo CSV en memoria
            $csvOutput = fopen('php://output', 'w');

            // Agregar BOM para que Excel reconozca correctamente UTF-8
            fputs($csvOutput, "\xEF\xBB\xBF");

            // Obtener encabezados de columna y escribir en el archivo CSV
            $headers = array_keys($data[0]);
            fputcsv($csvOutput, $headers); // Usar los nombres de las columnas como encabezados

            // Escribir los datos en el archivo CSV
            foreach ($data as $row) {
                fputcsv($csvOutput, $row); // Escribir cada fila de datos
            }

            fclose($csvOutput);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se encontraron datos para el tipo proporcionado']);
        }

        exit; // Terminar el script para evitar salida adicional
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Tipo de datos no proporcionado']);
}
