<?php
require 'EmailManager.php';

// Establecer el encabezado para JSON
header('Content-Type: application/json');

$emailManager = new EmailManager();

$action = isset($_POST['action']) ? $_POST['action'] : '';

try {
    switch ($action) {
        case 'delete':
            $emailToDelete = isset($_POST['email']) ? $_POST['email'] : '';
            $formNameToDelete = isset($_POST['form_name']) ? $_POST['form_name'] : '';
        
            // Debugging output
            error_log("Email to delete: $emailToDelete");
            error_log("Form name to delete: $formNameToDelete");
        
            if (!empty($emailToDelete) && !empty($formNameToDelete)) {
                $emailManager->deleteEmail($emailToDelete, $formNameToDelete);
                echo json_encode(['success' => 'Correo electrónico eliminado correctamente.']);
            } else {
                echo json_encode(['error' => 'No se proporcionó un correo electrónico o nombre del formulario para eliminar.']);
            }
            break;

        case 'insert':
            $emails = isset($_POST['emails']) ? json_decode($_POST['emails'], true) : [];
            $formName = isset($_POST['form_name']) ? $_POST['form_name'] : '';
            if (!empty($emails) && !empty($formName)) {
                $emailManager->insertEmails($emails, $formName);
                echo json_encode(['success' => 'Correos electrónicos insertados correctamente.']);
            } else {
                echo json_encode(['error' => 'No se proporcionaron correos electrónicos o nombre de formulario.']);
            }
            break;

            case 'update':
                $oldEmail = isset($_POST['old_email']) ? $_POST['old_email'] : '';
                $newEmail = isset($_POST['new_email']) ? $_POST['new_email'] : '';
                $formName = isset($_POST['formName']) ? $_POST['formName'] : '';
            
                if (!empty($oldEmail) && !empty($newEmail) && !empty($formName)) {
                    $emailManager->updateEmail($oldEmail, $newEmail, $formName);
                    echo json_encode(['success' => 'Correo electrónico actualizado correctamente.']);
                } else {
                    echo json_encode(['error' => 'No se proporcionaron todos los datos necesarios para actualizar el correo electrónico.']);
                }
                break;

            case 'get':
                $formName = isset($_POST['form_name']) ? $_POST['form_name'] : '';
                if (!empty($formName)) {
                    $emails = $emailManager->getEmails($formName);
                    echo json_encode(['success' => 'Correos electrónicos recuperados correctamente.', 'emails' => $emails]);
                } else {
                    echo json_encode(['error' => 'No se proporcionó un nombre de formulario.']);
                }
                break;

        default:
            echo json_encode(['error' => 'Acción no válida.']);
            break;
    }

} catch (Exception $e) {
    echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
}
?>
