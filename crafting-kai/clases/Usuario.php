<?php
class Usuario {
    private $id;
    private $nombre;
    private $email;
    private $rol;
    private $password;

    public function __construct($id = null, $nombre = null, $email = null, $rol = null, $password = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->rol = $rol;
        $this->password = $password;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getEmail() { return $this->email; }
    public function getRol() { return $this->rol; }
    //no se incluye password por seguridad
}
?>