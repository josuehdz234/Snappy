<?php
	/*Access to function in _async_alert.php*/
	
	/**	 
	 * -------------------------------------------------
	 *				Consultas Permitidas
	 * -------------------------------------------------
	 *
	 * assignar tabla -> to(-table)	 
	 * seleccionar cuando (WHERE) -> when([-param, -value], -condition) 'campo' => 'valor', condition = >, <, <>, <=, >=, = 
	 * seleccionar cuando (WHERE NOT) -> when_no([-param, -value]) 'campo' => 'valor'
	 * and-> and(array, condition)
	 * or-> or(array, condition)
	 * seleccionar hasta (LIMIT) -> limit(int) 'from, to'
	 * ordenar (ORDER BY) -> order([-param, -order]) 'ASC', 'DESC', 'RAND()''
	 * contiene (LIKE %i%) ->like([-param, -like]) 
	 * entre dos (BETWEEN) ->middle(-start, -end)
	 * insertar (INSERT INTO) -> add([-param, -value])
	 * seleccionar (SELECT * FROM) -> to(-table)->get()
	 * borrar (DELETE FROM) ->remove() 
	 * editar (UPDATE) ->replace([-param => -value])	 
	 * informacion sobre la conexión ->info()
	 */	

	function help_fn($desc, $db){
		switch ($desc) {
			case 'query':
				$msg = "query(-url, -user, -pass, -name)";
				$str = "<br>url: Direccón donde se aloja tu DB<br>user: Usuario de acceso a MySQL<br>pass: Contraseña de acceso a MySQL <br>name: Nombre de la base de datos a acceder";
				_HELP($msg, 'Asistente de ayuda', $db, $str);
				break;
			case 'to':
				$msg = "to(-table);";
				$str = "
					-table: nombre de la tabla a acceder
				";
				_HELP($msg, 'Asistente de ayuda', $db, $str);
				break;
			case 'add':
				$msg = "add([-param => -value, -param => -value])";
				$str = "
					-param: columna a acceder<br>
	 				-value: valor de la columna
				";
				_HELP($msg, 'Asistente de ayuda', $db, $str);
				break;
			case 'remove':
				$msg = "when([-param => -value])->remove()";
				$str = "
					-param: columna a acceder<br>
	 				-value: valor de la columna
				";
				_HELP($msg, 'Asistente de ayuda', $db, $str);
				break;
			case 'replace':
				$msg = "when([-param => -value])->replace([-set => -value]);";
				$str = "
					-param: columna a acceder<br>
	                -set: columna de la cual deseas borrar su contenido<br>
	                -value: valor de la columna
					";
				_HELP($msg, 'Asistente de ayuda', $db, $str);
				break;
			case 'get':
				$msg = "when([-param => -value])->get()";
				$str = "
					-param: columna a acceder<br>
	 				-value: valor de la columna
				";
				_HELP($msg, 'Asistente de ayuda', $db, $str);
				break;
			case 'when':
				$msg = "when([-param => -value], -condition)";
				$str = "
					-param: columna a acceder<br>
	 				-value: valor de la columna<br>
	 				-condition: condicion de la sentencia: >, <, =, !=, <>
				";
				_HELP($msg, 'Asistente de ayuda', $db, $str);
				break;
			case 'middle':
				$msg = "middle(-start, -end)";
				$str = "
					-start: int inicio del BETWEEN <br>
	 				-end: int Fin del BETWEEN	 				
				";
				_HELP($msg, 'Asistente de ayuda', $db, $str);
				break;
			case 'limit':
				$msg = "limit(-start, -end)";
				$str = "
					-start: int inicio del LIMIT<br>
	 				-end: int Fin del LIMIT
				";
				_HELP($msg, 'Asistente de ayuda', $db, $str);
				break;
			case 'order':
				$msg = "order([-param => -order])";
				$str = "
					-param: columna a la cual se va a acceder<br>
	 				-order: orden de la columna: ASC DESC RAND()
				";
				_HELP($msg, 'Asistente de ayuda', $db, $str);
				break;			
			case 'like':
				$msg = "like([-param => -like])";
				$str = "
					-param: columna a la cual se va a acceder<br>
	 				-like: Valor a buscar
				";
				_HELP($msg, 'Asistente de ayuda', $db, $str);
				break;
			default:
				$msg = "Has usado el asistente de ayuda, por el momento no podemos ayudarte con esta opcion <br>";
				_HELP($msg, 'Asistente de ayuda', $db, $desc);
				break;
		}			
	}
?>