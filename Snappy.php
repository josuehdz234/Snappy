<?php	
	/* new namespace*/
	namespace Snappy;
	/*Access to the clas MySQL*/
	use MySQLi;
	/**
	 * @author Snappy
	 * @version 1.2
	 * Snappy PHP Query builder	 
	 * ult. accs. 11/08/2018
	 */	
	/* functions */
	include dirname(__FILE__).'\src\complement.php';
	include dirname(__FILE__).'\src\assistant.php';
	
	/** 
	 * @package Snappy
	 * @author Snappy
	 * ---------------------------------------
	 *		DB_CONNECTOR
	 * ---------------------------------------
	 */
	abstract class DB_CONECTOR{
		public $db;
		public $db_config = [];
		/**
		  * --------------------------------
		  *			new_data_base
		  * --------------------------------
		  */
		public function new_mysql(){
			$this->db = new MySQLi($this->db_config['server'], $this->db_config['user'], $this->db_config['pass'], $this->db_config['name']);
    		if ($this->db->connect_errno) {
      			die( "ERROR: (" . $this->db->mysqli_connect_errno() . ") " . $this->db->mysqli_connect_error());
    		}
    		else{
    			return $this->db;
    		}
		}
	}
	/**
	 * @author Snappy
	 * @package Snappy
	 * -----------------------------------
	 *      Snappy class
	 * -----------------------------------
	 */
	class Snappy extends DB_CONECTOR{
		private $snappy_operator;

		/**
		 * -----------------------------------
		 *			costruct
		 * -----------------------------------
		 * @param str $url
		 * @param str $url
		 */
		public function __construct($options = []){			
			$this->db_config['server']  = filter_var($options['server'], FILTER_SANITIZE_URL);
			$this->db_config['user'] = filter_var($options['user'], FILTER_SANITIZE_STRING);
			$this->db_config['pass'] = filter_var($options['pass'], FILTER_SANITIZE_STRING);
			$this->db_config['name'] = filter_var($options['name'], FILTER_SANITIZE_STRING);
			$this->db_config['type'] = filter_var($options['type'], FILTER_SANITIZE_STRING);
			switch ($options['type']) {
				case 'mysql':
					$this->new_mysql();
					break;
				
				case 'pgsql':
					break;

				default:
					print_r('Not option');
					break;
			}
		}

		private $snappy_table;
		/**
		 * ------------------------------------------
		 *		to asigna el nombre de la tabla
		 * ------------------------------------------
		 * @param strign $table_get
		 */
		public function to($table_get = ''){
			$this->snappy_table = filter_var($table_get, FILTER_SANITIZE_STRING);
			return $this;
		}

		private $snappy_condition = null;
		/**
		 * ----------------------------------------------
		 *                      condition
		 *  asigna la condicion que se desea, y retorna un valor concatenado
		 * ----------------------------------------------
		 * @param string $Array
		 * @param string $condition
		 * @return string
		 */		
		public function condition($condition_check_array = [], $condition = '='){
			foreach ($condition_check_array as $loop_result_key => $loop_result_val){
				$final_result_key = filter_var($loop_result_key, FILTER_SANITIZE_STRING);
				$final_result_val = filter_var($loop_result_val, FILTER_SANITIZE_STRING);
				$this->snappy_condition = $final_result_key." = '".$final_result_val."'";
				if ($condition != '=') {
					$this->snappy_condition = $final_result_key." ".$condition." '".$final_result_val."'";
				}			
				return $this->snappy_condition; 
			}
		}

		private $snappy_when;
		/**
		 * -----------------------------------------
		 *				when
		 * -----------------------------------------
		 * @param string $when
		 */
		public function when($when = [], $condition = '='){			
			if (is_array($when)) {
				$when = $this->condition($when, $condition);
			}
			else{
				$when = filter_var($when, FILTER_SANITIZE_STRING);
			}
			$this->snappy_when = ' WHERE ('.$when.')';
			return $this;
		}

		private $snappy_between;
		/**
		 * -------------------------------------------
		 *					middle
		 * -------------------------------------------
		 * @param string $valor_1 
		 * @param string $valor_2
		 */
		public function middle($value_01, $value_02){			
			$this->snappy_between .= 'BETWEEN '.filter_var($value_01, FILTER_VALIDATE_INT).' AND '.filter_var($value_01, FILTER_VALIDATE_INT);
			return $this;
		}

		private $snappy_when_no;
		/**
		 * -----------------------------------------
		 *				when_not
		 * -----------------------------------------
		 * @param string $when_not
		 */
		public function when_not($when_not = [], $condition = '='){
			if (is_array($when_not)) {
				$when_not = $this->condition($when_not, $condition);
			}
			else{
				$when_not = filter_var($when_not, FILTER_SANITIZE_STRING);
			}
			$this->snappy_when_no = 'WHERE NOT ('.$when_not.')';
			return $this;
		}

		private $snappy_like;
		/**
		 * -----------------------------------------
		 *				like
		 * -----------------------------------------		
		 * @param string $object
		 */
		public function like($object_like = []){
			foreach ($object_like as $campo => $valor){
				$like = 'WHERE '.filter_var($campo, FILTER_SANITIZE_STRING)." LIKE '%".filter_var($valor, FILTER_SANITIZE_STRING)."%'";
			}
			$this->snappy_like = $like;
			return $this;
		}

		private $snappy_in;
		/**
		 * -----------------------------------------
		 *				in
		 * -----------------------------------------		
		 * @param string $object_in
		 */
		public function in($object_in = []){
			foreach ($object_in as $campo => $valor){
				$like = 'WHERE '.filter_var($campo, FILTER_SANITIZE_STRING)." IN('".filter_var($valor, FILTER_SANITIZE_STRING)."')";
			}
			$this->snappy_in = $like;
			return $this;
		}

		/**
		 * -------------------------------------------
		 *	super like
		 * -------------------------------------------
		 *
		 *
		private $des_str = null;
		public function super_like($param, $array = ''){			
			$this->des_str = explode(" ", $array);
			for ($i=0; $i < count($this->des_str); $i++) {				
				$sql[$i] = $this->db->query("SELECT * FROM conversations_messages WHERE 'message' LIKE '%".$this->des_str[$i]."%'") or die('error');
				echo count($sql[$i]);
			}
		}
		*/

		/**
		 * -----------------------------------------
		 *				and
		 * -----------------------------------------
		 * @param string $and
		 */
		public function and($and = '', $condition = '='){
			$and = $this->condition($and, $condition);
			$this->snappy_operator.= 'AND ('.$and.')';
			return $this;
		}

		/**
		 * -----------------------------------------
		 *				or
		 * -----------------------------------------
		 * @param string $or
		 */
		public function or($or = '', $condition = '='){
			$or = $this->condition($or, $condition);
			$this->snappy_operator.= 'or ('.$or.')';
			return $this;
		}

		private $snappy_order;
		/**
		 * -----------------------------------------
		 *				order
		 * -----------------------------------------
		 * @param string $order_sentense_in_get
		 */
		public function order($order_sentense_in_get = [], $condition='='){			
			$add_new_order_column = null;
			$i = 0;
			if (is_array($order_sentense_in_get)) {
				foreach ($order_sentense_in_get as $column_foreach_loop => $value) {
					$i++;
					if ($i > 1) {
						$add_new_order_column.= ', '.$column_foreach_loop.' '.$value;	
					}
					else{
						$add_new_order_column.= ' '.$column_foreach_loop.' '.$value;
					}
				}				
			}
			else{
				print_r('This content no is an array');
			}
			$this->snappy_order .= 'ORDER BY'.$add_new_order_column;
			return $this;
		}

		private $snappy_limit;
		/**
		 * ---------------------------------------
		 *			limit
		 * ---------------------------------------
		 * @param string $limit_param_in_get
		 */
		public function limit($limit_param_in_get = ''){
			$this->snappy_limit .= 'LIMIT '.$limit_param_in_get;
			return $this;
		}

		private $snappy_distinct = null;
		/**
		 * ---------------------------------------
		 *			distinct
		 * ---------------------------------------
		 * @param array $sub_in_get_array
		 */
		public function distinct($sub_in_get_array = []){
			$add_new_param_of_distinct = null;
			$i = 0;
			if (is_array($sub_in_get_array)) {
				foreach ($sub_in_get_array as $key) {
					$i++;
					if ($i > 1) {
						$add_new_param_of_distinct.= ', '.$key;
					}
					else{
						$add_new_param_of_distinct.= $key;
					}
				}
			}
			else{
				$add_new_param_of_distinct = $sub_in_get_array;
			}
			$this->snappy_distinct = $add_new_param_of_distinct;
			return $this;
		}

		private $snappy_sub = null;
		/**
		 * ---------------------------------------
		 *			sub
		 * ---------------------------------------
		 * @param array $sub_in_get_array
		 */
		public function sub($sub_in_get_array = []){
			$add_new_param_of_sub = null;
			$i = 0;
			if (is_array($sub_in_get_array)) {
				foreach ($sub_in_get_array as $key) {
					$i++;
					if ($i > 1) {
						$add_new_param_of_sub.= ', '.$key;
					}
					else{
						$add_new_param_of_sub.= $key;
					}
				}
			}
			else{
				$add_new_param_of_sub = $sub_in_get_array;
			}
			$this->snappy_sub = $add_new_param_of_sub;
			return $this;
		}

		/**
		 * -------------------------------------
		 *			add
		 * -------------------------------------
		 * @param array $add_new_array		 
		 * @return boolean
		 */
		public function add($add_new_array = []){			
			$_count_ = count($add_new_array);
			$_key_cons = null;
			$_value_cons = null;
			$i = 0;
			foreach ($add_new_array as $_object => $_value){
				$i++;
				if ($i < $_count_) {
					$_key_cons .= $_object.',';
					$_value_cons .= "'".$_value."',";
				}				
				else{
					$_key_cons .= $_object;
					$_value_cons .= "'".$_value."'";				
				}
			}
			$rescu_query = $this->db->prepare("INSERT INTO $this->snappy_table($_key_cons) VALUES($_value_cons)") or die(_MESSEGE($this->db->error, 'ERROR_INSERT_001', 'INSERT INTO '.$snappy_table.'('.$_key_cons.') VALUES('.$_value_cons.')', $this->db_config['name']));
			$rescu_query->execute();
			$rtn = $rescu_query->get_result();
			return $rtn;
		}

		/**
		 * -------------------------------------------
		 *			get
		 * -------------------------------------------
		 * @return array
		 */
		public function get(){
			if (!is_null($this->snappy_distinct)) {
				$rescu_query = $this->db->prepare("SELECT DISTINCT $this->snappy_distinct FROM $this->snappy_table $this->snappy_when_no $this->snappy_when $this->snappy_operator $this->snappy_like $this->snappy_in $this->snappy_between $this->snappy_limit $this->snappy_order") or die(_MESSEGE($this->db->error, 'ERROR_SELECT_002', 'SELECT * FROM '.$this->snappy_table.' '.$this->snappy_when_no.' '.$this->snappy_when.' '.$this->snappy_operator.' '.$this->snappy_like.' '.$this->snappy_between.' '.$this->snappy_limit.' '.$this->snappy_order.'', $this->db_config['name']));
			}
			elseif (!is_null($this->snappy_sub)) {
				$rescu_query = $this->db->prepare("SELECT $this->snappy_sub FROM $this->snappy_table $this->snappy_when_no $this->snappy_when $this->snappy_operator $this->snappy_like $this->snappy_in $this->snappy_between $this->snappy_limit $this->snappy_order") or die(_MESSEGE($this->db->error, 'ERROR_SELECT_002', 'SELECT * FROM '.$this->snappy_table.' '.$this->snappy_when_no.' '.$this->snappy_when.' '.$this->snappy_operator.' '.$this->snappy_like.' '.$this->snappy_between.' '.$this->snappy_limit.' '.$this->snappy_order.'', $this->db_config['name']));
			}
			else{
				$rescu_query = $this->db->prepare("SELECT * FROM $this->snappy_table $this->snappy_when_no $this->snappy_when $this->snappy_operator $this->snappy_like $this->snappy_in $this->snappy_between $this->snappy_limit $this->snappy_order") or die(_MESSEGE($this->db->error, 'ERROR_SELECT_002', 'SELECT * FROM '.$this->snappy_table.' '.$this->snappy_when_no.' '.$this->snappy_when.' '.$this->snappy_operator.' '.$this->snappy_like.' '.$this->snappy_between.' '.$this->snappy_limit.' '.$this->snappy_order.'', $this->db_config['name']));
			}
			$rescu_query->execute();
			$rtn = $rescu_query->get_result();
			return $rtn;
		}

		/**
		 * -------------------------------------------
		 *			remove
		 * -------------------------------------------
		 * @return array
		 */
		public function remove(){			
			$rescu_query = $this->db->prepare("DELETE FROM $this->snappy_table $this->snappy_when_no $this->snappy_when $this->snappy_operator $this->snappy_like $this->snappy_in $this->snappy_between $this->snappy_limit") or die(_MESSEGE($this->db->error, 'ERROR_DELETE_003', 'DELETE FROM '.$this->snappy_table.' '.$this->snappy_when_no.' '.$this->snappy_when.' '.$this->snappy_operator.' '.$this->snappy_between.' '.$this->snappy_like.'', $this->db_config['name']));	
			$rescu_query->execute();
			$rtn = $rescu_query->get_result();
			return $rtn;
		}

		/**
		 * -------------------------------------
		 *			replace
		 * -------------------------------------
		 * @param array $replace_hold_array		 
		 */
		public function replace($replace_hold_array = []){
			$_count_ = count($replace_hold_array);
			$_key_cons = null;
			$_value_cons = null;
			$i = 0;
			foreach ($replace_hold_array as $_object => $_value){
				$i++;
				if ($i < $_count_) {
					$_key_cons.= " ".$_object." = '".$_value."',";
				}				
				else{
					$_key_cons.= " ".$_object." = '".$_value."'";
				}
			}			
			$rescu_query = $this->db->prepare("UPDATE $this->snappy_table SET $_key_cons $this->snappy_when") or die(_MESSEGE($this->db->error, 'ERROR_UPDATE_003', 'UPDATE '.$this->snappy_table.' SET '.$this->_key_cons.' '.$this->snappy_when.'', $this->db_config['name']));			
			$rescu_query->execute();
			$rtn = $rescu_query->get_result();
			return $rtn;
		}

		/**
		 * -----------------------------------------
		 *			Info
		 * -----------------------------------------
		 */
		public function info(){
			_INFO('GDBD STATE', 'Server: '.$this->db->get_server_info(), 'Client-info: '.$this->db->get_client_info(), 'Server: '.$this->db->host_info, 'Server versión:'.$this->db->server_version, 'Protocol:'.$this->db->protocol_version);
		}

		/**
		 * ---------------------------------------
		 *		Help
		 * ---------------------------------------
		 * @param str $desc
		 */
		public function help($desc = ''){
			help_fn($desc, $this->db_config['name']);
		}

		/**
		 * -------------------------------------------
		 *			Destruct
		 * -------------------------------------------
		 */
		public function __destruct(){
			
			$this->db->close();
		}
	}		
?>