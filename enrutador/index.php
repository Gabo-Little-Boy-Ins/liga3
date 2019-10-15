<?php
function miFuncion($a, $b){
 return $a+$b;
}

 // Cargamos LIGA3
 require_once '../LIGA3/LIGA.php';

 // Creo una ruta básica
 RUTA::nueva('holaMundo', function() {
  echo '<h1>Hola mundo con el enrutador de LIGA.php</h1>';
 });
 RUTA::nueva('Bienvenida/php/Tarea', function() {
  echo "<p>Dia 10/10/2019 Gabirel Cer.</p>";
 });

   //funcion anonima
 RUTA::nueva('Bienvenida ', function() {
  echo "<p>Bienvenid@ Usuari@</p>";
 });
 
 RUTA::nueva('usuario/insertar', function() {
 $liga = LIGA('base.usuarios');
 $resp = $liga ->insertar($_POST);
 if ($resp ==1){
  echo 'USUARIO INSERTADO EXITOSAMENTE';
 }else{
  echo"Error: $resp";
 }
 });
 
RUTA::nueva('usuario/forma/modificar', function() {
		$liga = LIGA('base.usuarios');
		$prop = array('select'=>'id="cual" name="cual"',
																'option'=>'value="@[0]"'
																);
		$selector = HTML::selector($liga, '1', $prop);
		$campos = array('cual'=> $selector, '*');
		$props = array('form'=>'action="../modificar" method="POST"');
		HTML::forma($liga, 'Insertar usuarios', $campos, $props);
	});
  
  
  
  
   RUTA::nueva('usuario/tabla', function() {
  $liga = LIGA('base.usuarios');
    HTML::tabla($liga, 'insertar usuarios');
 });
 
  	RUTA::nueva('usuario/modificar', function() {
		$liga = LIGA('base.usuarios');
		//var_dump($_POST);
		$datos = array($_POST['cual']=>$_POST);
		$resp = $liga->modificar($datos);
		if ($resp == 1) {
			echo 'Usuario modificado exitosamente';
		} else {
			echo "Error: $resp";
		}
		RUTA::run('usuario/tabla');
	});
   
 
  // Imprimo las etiquetas HTML iniciales
  HTML::cabeceras(array('title'      =>'RUTA en LIGA 3',
			'description'=>'Página de pruebas para RUTA de LIGA 3',
			'css'        =>RUTA::$base.'../util/LIGA.css'
			)
		  );

 // Guardo el bufer para colocarlo en el layout
 ob_start();
 // Se ejecuta el enrutador
 RUTA::run();
 $cont = ob_get_clean();
 
  // Estuctura el cuerpo de la página
  HTML::cuerpo(array('cont'=>$cont));
  
  // Cierre de etiquetas HTML
  HTML::pie();
?>
