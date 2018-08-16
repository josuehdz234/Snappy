1.
##Snappy
1.
Es un framework desarrollado para creación de queries(CRUD) para MySQL de PHP.

Licencia de codigo abierto GNU LINUX.

## Caracteristicas
1.
* **Lijero** : menos de 940KB, Portable.
1.
* **Fuerza**: Admite consultas CRUD, es seguro y estable, previene ataques de datos por hackers, al igual que previene la inyeccion de base de datos
1.
* **Compatible**: compatibilidad con MySQL.
1.
* **Facil**: por su sencilles es facil de entender.

1.
##Instanciar.

Usa la clase <b>Snappy</b> para empezar a desarrollar queries(CRUD).
<pre>

	/*
	 * Query
	 *
	 * -sql-type: Tipo de gestor de base de datos
	 * -url: Dirección donde está tu base de datos
	 * -user: nombre de acceso a MySQL
	 * -pass: Contraseña de acceso a MySQL
	 * -db: Nombre de la base de datos
	 */
	include 'Snappy.php';
	use Snappy/Snappy;
	$var = new query([
		'type'   => -sql-type,
		'server' => -url,
		'user'   => -user,
		'pass'   => -db,
	]);

</pre>
<!--<h1>Metodos.</h1>

<table>
	<thead>
		<tr>
			<th>Metodo</th>
			<th>Descripción</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>sring to(table)</th>
			<th>Prepara una el nombre de la tabla mandada por parametro para una futura consulta</th>
		</tr>
		<tr>
			<th>array add([, string $param => string $val])</th>
			<th>Añade un nuevo campo a la tabla prepara en un pasado</th>
		</tr>
		<tr>
			<th>sring to(table)</th>
			<th>Prepara una el nombre de la tabla mandada por parametro para una futura consulta</th>
		</tr>
	</tbody>
</table>-->
<h1>to()</h1>
Selecciona una tabla.
<pre>

	/*
	 * To
	 *
	 * -table: nombre de la tabla a acceder
	 */
	$var->to(-table);

</pre>
<h1>add()</h1>
Añade un nuevo campo a la tabla seleccionada.
<pre>

	/*
	 * Add
	 *
	 * -param: columna a acceder
	 * -value: valor de la columna
	 * -table: nombre de la tabla a acceder
	 */
	$var->to(-table)->add([-param => -value, -param => -value]);

</pre>
<h1>remove()</h1>
Elimina uno o más campos de una tabla.
<pre>

	/*
	 * Remove
	 *
	 * -param: columna a acceder
	 * -value: valor de la columna
	 * -table: nombre de la tabla a acceder
	 */
	$var->to(-table)->when([-param => -value])->remove();

	/*
	 * Remove con condición
	 *
	 * -param: columna a acceder
	 * -value: valor de la columna
	 * -condition: condición de la sentencia: >, <, =, !=, <>
	 * -table: nombre de la tabla a acceder
	 */
	$var->to(-table)->when([-param => -value], -condition)->remove();	
</pre>
<h1>replace()</h1>
Cambia los datos de un campo.
<pre>

	/*
	 * Replace
	 * -param: columna a acceder
	 * -set: columna de la cual deseas borrar su contenido
	 * -value: valor de la columna
	 * -table: nombre de la tabla a acceder
	 */
	$var->to(-table)->when([-param => -value])->replace([-set => -value]);

	/*
	 * Replace
	 * -param: columna a acceder
	 * -set: columna de la cual deseas borrar su contenido
	 * -value: valor de la columna
	 * -condition: condición de la sentencia: >, <, =, !=, <>
	 * -table: nombre de la tabla a acceder
	 */
	$var->to(-table)->when([-param => -value], -condition)->replace(-set => -value);
	
</pre>
<h1>get()</h1>
Retorna los datos buscados.
<pre>

	/*
	 * when en array y sin condición
	 * -param: columna a acceder
	 * -value: valor de la columna
	 * -table: nombre de la tabla a acceder
	 */
	$sql = $var->to(-table)->when([-param => -value])->get();

	/*
	 * when en array y con condición
	 * -param: columna a acceder
	 * -value: valor de la columna
	 * -condition: condición de la sentencia: >, <, =, !=, <>
	 * -table: nombre de la tabla a acceder
	 */
	$sql = $var->to(-table)->when([-param => -value], -condition)->get();

	/*
	 * When sin array
	 * -param: columna a acceder
	 * -table: nombre de la tabla a acceder
	 */
	$sql = $val->to(-table)->when(-param)->get();

	/*
	 * When con subconjunto
	 * -param: columna a acceder
	 * -table: nombre de la tabla a acceder
	 */
	$sql = $val->to(-table)->sub([-param, -other_param])->get();

	/*
	 * When con subconjunto DISTINCT
	 * -param: columna a acceder
	 * -table: nombre de la tabla a acceder
	 */
	$sql = $val->to(-table)->distinct([-param, -other_param])->get();
	
	/*
	 * Middle 
	 * -start: int inicio del BETWEEN 
	 * -end: int Fin del BETWEEN
	 * -table: nombre de la tabla a acceder
	 */
	$sql = $val->to(-table)->when(-param)->middle(-start, -end)->get();
	
	/*
	 * Limit
	 * -start: int inicio del LIMIT 
	 * -end: int Fin del LIMIT
	 * -table: nombre de la tabla a acceder
	 */
	$sql = $val->to(-table)->when(-param)->limit(-start, -end)->get();

	/* 
	 * Order
	 * -param: columna a la cual se va a acceder
	 * -order: orden de la columna: ASC DESC RAND()
	 * -table: nombre de la tabla a acceder
	 */
	$sql = $val->to(-table)->order([-param => -order])->get();

	/*
	 * Like
	 * -param: columna a la cual se va a acceder
	 * -like: Valor a buscar
	 * -table: nombre de la tabla a acceder
	 */
	$sql = $var->to(-table)->like([-param => -like])->get();

	/*
	 * In
	 * -param: columna a la cual se va a acceder
	 * -in: Valor a buscar
	 * -table: nombre de la tabla a acceder
	 */
	$sql = $var->to(-table)->in([-param => -in])->get();

</pre>
<h1>help()</h1>
Asistente de ayuda
<pre>
	
	/*
	 * help
	 * -method: Nombre de la función de la cual quieres ayuda: ('get'), ('replace'), ('add'), etc.
	 */
	$var->help(-method)
</pre>

<p>&copy; 2018 Spic for Developers</p>
