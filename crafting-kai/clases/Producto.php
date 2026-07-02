<?php
class Producto {
    private $id;
    private $precio;
    private $nombre;
    private $stock;
    private $descripcion;

    public function __construct($id,$nombre,$precio,$stock,$descripcion) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->descripcion = $descripcion;
    }
    
    public function getid() {
        return $this->id;
    }
    
    public function getprecio() {
        return $this->precio;
    }
    
    public function getnombre() {
        return $this->nombre;
    }
    
    public function getstock() {
        return $this->stock;
    }

    public function getdescripcion() {
        return $this->descripcion;
    }

}
//creamos los productos que ya existen
//$obj = new Producto(1,"Figura Labubu",15.99,10, "Impresión en PLA de alta resolución.");
//$obj2 = new Producto(2,"Soporte para Auriculares Gamer",10.50,20, "Soporte ajustable para auriculares gamers.");
//$obj3 = new Producto(3,"Maceta Geométrica",4.00,30, "Maceta con diseño geométrico.");
//$obj4 = new Producto(4,"Set de Engranajes",13.75,15, "Set de engranajes para impresoras 3D.");
//$obj5 = new Producto(5,"Llavero Personalizado",5.00,5, "Sube tu diseño y lo imprimimos.");
//$obj6 = new Producto(6,"Coleccionable Batman",45.00,8, "Pintado a mano (opcional).");
?>