<?php
require_once __DIR__ . '/../config/database.php'; 
require_once __DIR__ . '/../models/contactos.php'; 

$errores = []; /
$contacto = new $contacto(); 


$id = isset($_GET['id']) ? (int)$_GET['id'] : 0; 

if($id <= 0) { 
    header("Location: index.php?error=ID de contacto inválido"); 
    exit(); 
}


$contacto = $contacto->obtenerPorId($id); 
if(!$contactoData) { 
    header("Location: index.php?error=contacto no encontrado"); 
    exit(); 
}


$nombre = $contactoData['nombre']; 
$telefono = $contactoData['telefono']; 
$direccion = $contactoData['direccion']; 
$correo = $correoData['correo']; 



if($_POST) { 
    $nombre = trim($_POST['nombre']); 
    $telefono = trim($_POST['telefono']); 
    $direccion = trim($_POST['direccion']); 
    $correo = trim($_POST['correo']); 
    
    
    if(empty($nombre)) { 
        $errores[] = "El nombre es obligatorio"; 
    }
    
    if(empty($correo)) { 
        $errores[] = "El correo es obligatorio"; 
    } elseif(!filter_var($correo, FILTER_VALIDATE_CORREO)) { 
        $errores[] = "El correo no es válido"; 
    }
    
    
    if(empty($errores)) { 
        if($contacto->actualizar($id, $nombre, $telefono, $direccion, $correo)) { 
            header("Location: index.php?mensaje=contacto actualizado exitosamente"); 
            exit(); 
        } else { 
            $errores[] = "Error al actualizar contacto"; 
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Editar contacto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
</head>
<body>
    <div class="container mt-4"> 
        <div class="row justify-content-center"> 
            <div class="col-md-6"> 
                <h1 class="mb-4">Editar contacto</h1> 
                
            
                <?php if(!empty($errores)): ?> 
                    <div class="alert alert-danger"> 
                        <ul class="mb-0"> 
                            <?php foreach($errores as $error): ?> 
                                <li><?= htmlspecialchars($error) ?></li> 
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                
                <form method="POST"> 
                    <div class="mb-3"> 
                        <label for="nombre" class="form-label">Nombre *</label> 
                        <input type="text" class="form-control" id="nombre" name="nombre" 
                               value="<?= htmlspecialchars($nombre) ?>" required> 
                    </div>
                    
                    <div class="mb-3"> 
                        <label for="telefono" class="form-label">telefono *</label> 
                        <input type="telefono" class="form-control" id="telefono" name="telefono" 
                               value="<?= htmlspecialchars($telefono) ?>" required> 
                    </div>

                       <div class="mb-3"> 
                        <label for="direccion" class="form-label">direccion *</label> 
                        <input type="direccion" class="form-control" id="direccion" name="direccion" 
                               value="<?= htmlspecialchars($direccion) ?>" required> 
                    </div>
                    


                    
                    <div class="mb-3"> 
                        <label for="correo" class="form-label">correo</label> 
                        <input type="text" class="form-control" id="correo" name="correo" 
                               value="<?= htmlspecialchars($correo) ?>"> 
                    </div>
                    
                    <div class="d-grid gap-2 d-md-block"> 
                        <button type="submit" class="btn btn-primary">Actualizar contacto</button> 
                        <a href="index.php" class="btn btn-secondary">Cancelar</a> 
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>