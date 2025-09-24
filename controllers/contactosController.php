<?php
require_once __DIR__ . '/../models/contactos.php';

class contactosController{

    private $contactoModel;

    public function__construct(): void{
        $this->contactosModel = new contactos();

    }

    public function index(): void{
        $contactos = $this->contactosModel->obternerTodo();
        $mensaje = $_GET['mensaje'] ?? '';
        $error = $_GET['error'] ?? '';

        include __DIR__ . '/../views/index.php';

    }

    public function crear(): void{
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nombre = $_POST['nombre'];
            $telefono =$_POST['telefono'];
            $direccion =$_POST['direccion'];
            $correo =$_POST['correo'];

            if($this->contactosModel->crear(nombre: $nombre, telefono: $telefono, direccion: $direccion, correo: $correo)){
                header(header: "Location: index.php?mensaje=contacto creado exitosamente");
                exit();

            } else {
                $error = "Error al crear el contacto";
                include __DIR__ . '/../views/crear.php';

            }

        } else {
            include __DIR__ . '/../views/crear.php';

        }

    }
public function editar(): void{
    if(isset($_GET['id'])){
    $id = $_GET['id'];
    $contactos= $this->contactosModel->obtenerPorId(id: $id);
    if(!$contactos){
        header(header: "Location: index.php?error=contacto no proporcionado");
        exit();
    }

    require __DIR__ . '/../views/editar.php';

}
}
public function actualizar(): void{
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $telefono =$_POST['telefono'];
            $direccion =$_POST['direccion'];
            $correo =$_POST['correo'];

            if($this->contactosModel->actualizar(id: $id, nombre: $nombre, telefono: $telefono, direccion: $direccion, correo: $correo)){
                header(header: "Location: index.php?mensaje=contacto actualizado exitosamente");
                exit();

            } else {
                $error = "Error al actualizar el contacto";
                $contactos = $this->contactosModel->obtenerPorId(id: $id);
                include __DIR__ . '/../views/editar.php';

            }

        }

        }

        public function eliminar(): void{
    if(isset($_GET['id'])){
    $id = $_GET['id'];
    $contactos= $this->contactosModel->eliminar(id: $id);
        header(header: "Location: index.php?error=contacto eliminado exitosamente");
        exit();
    } else {
        header(header: "Location: index.php?error=Error al eliminar el contacto");
        exit();


}
}
}
    
    




?>