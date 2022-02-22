<?php
error_reporting(0);
$a=autores();
$q = $_REQUEST["q"];
$sugerencias="";
$libros="";
//Entramos en el bucle si el parametros del GET no está vacío
if ($q!=="") {
    //Convertimos los datos a minuscula
    $q= strtolower($q);
    //guardamos la longitud de la palabra
    $longitud= strlen($q);
    //Buscamos la coincidencia
    $valor = "";
    $index=0;
    foreach ($a as $nombre) {
        //Buscamos el nombre que tenga la cadena insertada
        if (stristr($q, substr($nombre, 0, $longitud))) {
            $sugerencias.=$nombre."<br>";
            $valor=$index;
        }
        $index++;
    } 
}

echo $sugerencias === "" ? "no se encuentran sugerencias" : $sugerencias;

echo"<p>".Libros($valor)."<br>";
/**
 * Funcion que nos devuelve el nombre y apellidos de los autores.
 *
 * @return a es un array que devuelve el nombre y el apellido del autor
 */
    function autores(){
        $conexion = new mysqli("localhost","root","","libros");
        $sql="SELECT nombre, apellidos FROM autor";
        $resultado = mysqli_query($conexion,$sql);
        $datos=$resultado->fetch_all(MYSQLI_ASSOC);
        $i=0;
        foreach($datos as $clave){
            $return=$clave["nombre"]." ".$clave["apellidos"];
            $a[$i]=$return;
            $i++;
        }
        return $a;
    }
/**
 * Funcion que permite devolver una lista con los 
 * libros del autor que tenga un determinado id
 * 
 * @param id al que se le debe pasar un valor id
 * @return libros recorremos un array que nos devuelve los titulos de los libros.
 */
    function Libros($id){
        $conexion = new mysqli("localhost","root","","libros");
        $sql="SELECT titulo FROM libro WHERE id_autor=$id;";
        $resultado = mysqli_query($conexion,$sql);
        $datos=$resultado->fetch_all(MYSQLI_ASSOC);
        $libros=array();
        $i=0;
        foreach($datos as $clave){
            $return=$clave["titulo"];
            $libros[$i]= $return;
            $i++;
        }
        //return $libros;
        for($i=0 ; $i<count($libros);$i++){
            echo"<ul>";
            echo "<li>";
            echo $libros[$i];
            echo"</li>";
            echo"</ul>";
        };
    }

?>