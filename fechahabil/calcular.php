<?php 
class calculadora
{
	public static function calcularDias($fecha, $dias){	
		//Asigna fecha inicial a variable
		$fechaConteo = date('Y-m-d',strtotime($fecha. ' + 0 days'));	
		//Verificacion de es viernes los dias q hay para el viernes
		if(date('l',strtotime($fechaConteo. ' + 0 days')) == 'Friday'){							
			//Cambia fecha hasta el siguiente lunes		
			$fechaConteo = date('Y-m-d',strtotime($fechaConteo."next Sunday"));			
		}
		while ($dias >= 0) {	
			//Almacena la fecha del siguiente viernes
			$fds = date('Y-m-d',strtotime($fechaConteo."next Friday"));				
			//Calcula la diferencia entre el dia de partida y el siguiente viernes				
			$actualdate = date('d',(strtotime($fds) - strtotime($fechaConteo)));	
			if(($dias - $actualdate) <= 0){		
				$fechaConteo = date('Y-m-d',strtotime($fechaConteo. ' + ' . ($dias)  . ' days'));		
				return $fechaConteo;
			}	
			//Resta los dias corridos
			$dias = $dias - $actualdate;		
			//Refresca la fecha hasta el viernes
			$fechaConteo = date('Y-m-d',strtotime($fechaConteo. ' + ' . ($actualdate - 1)  . ' days'));	
			//Cambia fecha hasta el siguiente lunes		
			$fechaConteo = date('Y-m-d',strtotime($fechaConteo."next Monday"));			
		}
	}
}
	

 ?>	