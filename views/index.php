<?php
require_once __DIR__ . '/../config/database.php'; 
require_once __DIR__ . '/../models/contactos.php'; 


$action = $_GET['action'] ?? 'index'; 
$id = $_GET['id'] ?? ''; 


$contacto = new contacto(); 


$mensaje = $_GET['mensaje'] ?? ''; 
$error = $_GET['error'] ?? ''; 


switch($action) { 
    case 'crear': 
        header("Location: crear.php"); 
        exit(); /
        break;
        
    case 'editar': 
        header("Location: editar.php?id=" . $id); 
        exit(); 
        break;
        
    case 'eliminar': 
        if($id && $usuario->eliminar($id)) { 
            header("Location: index.php?mensaje=contacto eliminado exitosamente"); 
        } else { 
            header("Location: index.php?error=Error al eliminar contacto"); 
        }
        exit(); 
        break;
        
    case 'index': 
    default: 
       
        $contactos = $contacto->obtenerTodos(); 
        break;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Sistema de contactos</title> 
    
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
</head>
<body>
    <div class="container mt-4"> 
        <h1 class="mb-4">Sistema de Gestión de contactos</h1> 
        
        
        <?php if(!empty($mensaje)): ?> 
            <div class="alert alert-success"><?= htmlspecialchars($mensaje) ?></div> 
        <?php endif; ?>
        
        <?php if(!empty($error)): ?> 
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div> 
        <?php endif; ?>
        
        
        <a href="index.php?action=crear" class="btn btn-success mb-3">+ Nuevo contacto</a> 
        
        
        <table class="table table-striped table-hover"> 
            <thead class="table-dark"> 
                <tr>
                    <th>ID</th> 
                    <th>Nombre</th> 
                    <th>Telefono</th> 
                    <th>Direccion</th> 
                    <th>Correo</th>
                    <th>Fecha Creación</th> 
                    <th>Acciones</th> 
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($contactos)): ?> 
                    <?php foreach($contactos as $contact): ?> 
                        <tr>
                            <td><?= $user['id'] ?></td> 
                            <td><?= htmlspecialchars($contact['nombre']) ?></td>
                            <td><?= htmlspecialchars($contact['telefono']) ?></td> 
                            <td><?= htmlspecialchars($contact['direccion']) ?></td> 
                            <td><?= htmlspecialchars($contact['correo']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($user['fecha_creacion'])) ?></td> 
                            <td>
                                <a href="index.php?action=editar&id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Editar</a> 
                                <a href="index.php?action=eliminar&id=<?= $user['id'] ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirmarEliminacion('<?= htmlspecialchars($contact['nombre']) ?>')">Eliminar</a> 
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?> 
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay contactos registrados</td> 
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
    <script>
        function confirmarEliminacion(nombre) { 
            return confirm('¿Está seguro de eliminar al contacto "' + nombre + '"?\nEsta acción no se puede deshacer.'); 
        }
    </script>
</body>
</html>