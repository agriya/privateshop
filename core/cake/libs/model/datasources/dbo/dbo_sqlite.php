<?php
/**
 * SQLite layer for DBO
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake.libs.model.datasources.dbo
 * @since         CakePHP(tm) v 0.9.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * DBO implementation for the SQLite3 DBMS.
 *
 * A DboSource adapter for SQLite 3 using PDO
 *
 * @package       cake.libs.model.datasources.dbo
 */
class DboSqlite extends DboSource {

/**
 * Datasource Description
 *
 * @var string
 * @access public
 */
	var $description = "SQLite DBO Driver";

/**
 * Quote Start
 *
 * @var string
 * @access public
 */
	var $startQuote = '"';

/**
 * Quote End
 *
 * @var string
 * @access public
 */
	var $endQuote = '"';

/**
 * Base configuration settings for SQLite3 driver
 *
 * @var array
 * @access public
 */
	var $_baseConfig = array(
		'persistent' => false,
		'database' => null
	);

/**
 * SQLite3 column definition
 *
 * @var array
 * @access public
 */
	var $columns = array(
		'primary_key' => array('name' => 'integer primary key autoincrement'),
		'string' => array('name' => 'varchar', 'limit' => '255'),
		'text' => array('name' => 'text'),
		'integer' => array('name' => 'integer', 'limit' => null, 'formatter' => 'intval'),
		'float' => array('name' => 'float', 'formatter' => 'floatval'),
		'datetime' => array('name' => 'datetime', 'format' => 'Y-m-d H:i:s', 'formatter' => 'date'),
		'timestamp' => array('name' => 'timestamp', 'format' => 'Y-m-d H:i:s', 'formatter' => 'date'),
		'time' => array('name' => 'time', 'format' => 'H:i:s', 'formatter' => 'date'),
		'date' => array('name' => 'date', 'format' => 'Y-m-d', 'formatter' => 'date'),
		'binary' => array('name' => 'blob'),
		'boolean' => array('name' => 'boolean')
	);

/**
 * List of engine specific additional field parameters used on table creating
 *
 * @var array
 * @access public
 */
	var $fieldParameters = array(
		'collate' => array(
			'value' => 'COLLATE',
			'quote' => false,
			'join' => ' ',
			'column' => 'Collate',
			'position' => 'afterDefault',
			'options' => array(
				'BINARY', 'NOCASE', 'RTRIM'
			)
		),
	);

/**
 * Connects to the database using config['database'] as a filename.
 *
 * @param array $config Configuration array for connecting
 * @return mixed
 * @access public
 */
	function connect() {
		$config = $this->config;
		$flags = array(PDO::ATTR_PERSISTENT => $config['persistent']);
		try {
			$this->_connection = new PDO('sqlite:' . $config['database'], null, null, $flags);
			$this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->connected = true;
		}
		catch(PDOException $e) {
			$this->errors[] = $e->getMessage();
		}
		return $this->connected;
	}

/**
 * Check whether the MySQL extension is installed/loaded
 *
 * @return boolean
 */
	function enabled() {
		return in_array('sqlite', PDO::getAvailableDrivers());
	}

/**
 * Returns an array of tables in the database. If there are no tables, an error is raised and the application exits.
 *
 * @return array Array of tablenames in the database
 * @access public
 */
	function listSources($data = null) {
		$cache = parent::listSources();
		if ($cache != null) {
			return $cache;
		}

		$result = $this->fetchAll("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name;", false);

		if (!$result || empty($result)) {
			return array();
		} else {
			$tables = array();
			foreach ($result as $table) {
				$tables[] = $table[0]['name'];
			}
			parent::listSources($tables);
			return $tables;
		}
		return array();
	}

/**
 * Returns an array of the fields in given table name.
 *
 * @param string $tableName Name of database table to inspect
 * @return array Fields in table. Keys are name and type
 * @access public
 */
	function describe($model) {
		$cache = parent::describe($model);
		if ($cache != null) {
			return $cache;
		}
		$fields = array();
		$result = $this->_execute('PRAGMA table_info(' . $model->tablePrefix . $model->table . ')');

		foreach ($result as $column) {
			$column = (array) $column;
			$default = ($column['dflt_value'] === 'NULL') ? null : trim($column['dflt_value'], "'");

			$fields[$column['name']] = array(
				'type'		=> $this->column($column['type']),
				'null'		=> !$column['notnull'],
				'default'	=> $default,
				'length'	=> $this->length($column['type'])
			);
			if ($column['pk'] == 1) {
				$fields[$column['name']]['key'] = $this->index['PRI'];
				$fields[$column['name']]['null'] = false;
				if (empty($fields[$column['name']]['length'])) {
					$fields[$column['name']]['length'] = 11;
				}
			}
		}

		$result->closeCursor();
		$this->__cacheDescription($model->tablePrefix . $model->table, $fields);
		return $fields;
	}

/**
 * Generates and executes an SQL UPDATE statement for given model, fields, and values.
 *
 * @param Model $model
 * @param array $fields
 * @param array $values
 * @param mixed $conditions
 * @return array
 * @access public
 */
	function update($model, $fields = array(), $values = null, $conditions = null) {
		if (empty($values) && !empty($fields)) {
			foreach ($fields as $field => $value) {
				if (strpos($field, $model->alias . '.') !== false) {
					unset($fields[$field]);
					$field = str_replace($model->alias . '.', "", $field);
					$field = str_replace($model->alias . '.', "", $field);
					$fields[$field] = $value;
				}
			}
		}
		return parent::update($model, $fields, $values, $conditions);
	}

/**
 * Deletes all the records in a table and resets the count of the auto-incrementing
 * primary key, where applicable.
 *
 * @param mixed $table A string or model class representing the table to be truncated
 * @return boolean	SQL TRUNCATE TABLE statement, false if not applicable.
 * @access public
 */
	function truncate($table) {
		$this->_execute('DELETE FROM sqlite_sequence where name=' . $this->fullTableName($table));
		return $this->execute('DELETE FROM ' . $this->fullTableName($table)); 
	}

/**
 * Converts database-layer column types to basic types
 *
 * @param string $real Real database-layer column type (i.e. "varchar(255)")
 * @return string Abstract column type (i.e. "string")
 * @access public
 */
	function column($real) {
		if (is_array($real)) {
			$col = $real['name'];
			if (isset($real['limit'])) {
				$col .= '('.$real['limit'].')';
			}
			return $col;
		}

		$col = strtolower(str_replace(')', '', $real));
		$limit = null;
		@list($col, $limit) = explode('(', $col);

		if (in_array($col, array('text', 'integer', 'float', 'boolean', 'timestamp', 'date', 'datetime', 'time'))) {
			return $col;
		}
		if (strpos($col, 'varchar') !== false) {
			return 'string';
		}
		if (in_array($col, array('blob', 'clob'))) {
			return 'binary';
		}
		if (strpos($col, 'numeric') !== false || strpos($col, 'decimal') !== false) {
			return 'float';
		}
		return 'text';
	}

/**
 * Generate ResultSet
 *
 * @param mixed $results
 * @access public
 */
	function resultSet($results) {
		$this->results = $results;
		$this->map = array();
		$num_fields = $results->columnCount();
		$index = 0;
		$j = 0;

		//PDO::getColumnMeta is experimental and does not work with sqlite3,
		//	so try to figure it out based on the querystring
		$querystring = $results->queryString;
		if (stripos($querystring, 'SELECT') === 0) {
			$last = stripos($querystring, 'FROM');
			if ($last !== false) {
				$selectpart = substr($querystring, 7, $last - 8);
				$selects = explode(',', $selectpart);
			}
		} elseif (strpos($querystring, 'PRAGMA table_info') === 0) {
			$selects = array('cid', 'name', 'type', 'notnull', 'dflt_value', 'pk');
		} elseif(strpos($querystring, 'PRAGMA index_list') === 0) {
			$selects = array('seq', 'name', 'unique');
		} elseif(strpos($querystring, 'PRAGMA index_info') === 0) {
			$selects = array('seqno', 'cid', 'name');
		}
		while ($j < $num_fields) {
			if (preg_match('/\bAS\s+(.*)/i', $selects[$j], $matches)) {
				 $columnName = trim($matches[1],'"');
			} else {
				$columnName = trim(str_replace('"', '', $selects[$j]));
			}

			if (strpos($selects[$j], 'DISTINCT') === 0) {
				$columnName = str_ireplace('DISTINCT', '', $columnName);
			}

			if (strpos($columnName, '.')) {
				$parts = explode('.', $columnName);
				$this->map[$index++] = array(trim($parts[0]), trim($parts[1]));
			} else {
				$this->map[$index++] = array(0, $columnName);
			}
			$j++;
		}
	}

/**
 * Fetches the next row from the current result set
 *
 * @return mixed array with results fetched and mapped to column names or false if there is no results left to fetch
 */
	function fetchResult() {
		if ($row = $this->_result->fetch()) {
			$resultRow = array();
			foreach ($this->map as $col => $meta) {
				list($table, $column) = $meta;
				$resultRow[$table][$column] = $row[$col];
			}
			return $resultRow;
		} else {
			$this->_result->closeCursor();
			return false;
		}
	}


/**
 * Returns a limit statement in the correct format for the particular database.
 *
 * @param integer $limit Limit of results returned
 * @param integer $offset Offset from which to start results
 * @return string SQL limit/offset statement
 * @access public
 */
	function limit($limit, $offset = null) {
		if ($limit) {
			$rt = '';
			if (!strpos(strtolower($limit), 'limit') || strpos(strtolower($limit), 'limit') === 0) {
				$rt = ' LIMIT';
			}
			$rt .= ' ' . $limit;
			if ($offset) {
				$rt .= ' OFFSET ' . $offset;
			}
			return $rt;
		}
		return null;
	}

/**
 * Generate a database-native column schema string
 *
 * @param array $column An array structured like the following: array('name'=>'value', 'type'=>'value'[, options]),
 *    where options can be 'default', 'length', or 'key'.
 * @return string
 * @access public
 */
	function buildColumn($column) {
		$name = $type = null;
		$column = array_merge(array('null' => true), $column);
		extract($column);

		if (empty($name) || empty($type)) {
			trigger_error('Column name or type not defined in schema', E_USER_WARNING);
			return null;
		}

		if (!isset($this->columns[$type])) {
			trigger_error(__('Column type %s does not exist', $type), E_USER_WARNING);
			return null;
		}

		$real = $this->columns[$type];
		$out = $this->name($name) . ' ' . $real['name'];
		if (isset($column['key']) && $column['key'] == 'primary' && $type == 'integer') {
			return $this->name($name) . ' ' . $this->columns['primary_key']['name'];
		}
		return parent::buildColumn($column);
	}

/**
 * Sets the database encoding
 *
 * @param string $enc Database encoding
 * @access public
 */
	function setEncoding($enc) {
		if (!in_array($enc, array("UTF-8", "UTF-16", "UTF-16le", "UTF-16be"))) {
			return false;
		}
		return $this->_execute("PRAGMA encoding = \"{$enc}\"") !== false;
	}

/**
 * Gets the database encoding
 *
 * @return string The database encoding
 * @access public
 */
	function getEncoding() {
		return $this->fetchRow('PRAGMA encoding');
	}

/**
 * Removes redundant primary key indexes, as they are handled in the column def of the key.
 *
 * @param array $indexes
 * @param string $table
 * @return string
 * @access public
 */
	function buildIndex($indexes, $table = null) {
		$join = array();

		foreach ($indexes as $name => $value) {

			if ($name == 'PRIMARY') {
				continue;
			}
			$out = 'CREATE ';

			if (!empty($value['unique'])) {
				$out .= 'UNIQUE ';
			}
			if (is_array($value['column'])) {
				$value['column'] = join(', ', array_map(array(&$this, 'name'), $value['column']));
			} else {
				$value['column'] = $this->name($value['column']);
			}
			$t = trim($table, '"');
			$out .= "INDEX {$t}_{$name} ON {$table}({$value['column']});";
			$join[] = $out;
		}
		return $join;
	}

/**
 * Overrides DboSource::index to handle SQLite indexe introspection
 * Returns an array of the indexes in given table name.
 *
 * @param string $model Name of model to inspect
 * @return array Fields in table. Keys are column and unique
 * @access public
 */
	function index($model) {
		$index = array();
		$table = $this->fullTableName($model);
		if ($table) {
			$indexes = $this->query('PRAGMA index_list(' . $table . ')');
			
		 	if (is_bool($indexes)) {
				return array();
			}
			foreach ($indexes as $i => $info) {
				$key = array_pop($info);
				$keyInfo = $this->query('PRAGMA index_info("' . $key['name'] . '")');
				foreach ($keyInfo as $keyCol) {
					if (!isset($index[$key['name']])) {
						$col = array();
						if (preg_match('/autoindex/', $key['name'])) {
							$key['name'] = 'PRIMARY';
						}
						$index[$key['name']]['column'] = $keyCol[0]['name'];
						$index[$key['name']]['unique'] = intval($key['unique'] == 1);
					} else {
						if (!is_array($index[$key['name']]['column'])) {
							$col[] = $index[$key['name']]['column'];
						}
						$col[] = $keyCol[0]['name'];
						$index[$key['name']]['column'] = $col;
					}
				}
			}
		}
		return $index;
	}

/**
 * Overrides DboSource::renderStatement to handle schema generation with SQLite-style indexes
 *
 * @param string $type
 * @param array $data
 * @return string
 * @access public
 */
	function renderStatement($type, $data) {
		switch (strtolower($type)) {
			case 'schema':
				extract($data);
				if (is_array($columns)) {
					$columns = "\t" . join(",\n\t", array_filter($columns));
				}
				if (is_array($indexes)) {
					$indexes = "\t" . join("\n\t", array_filter($indexes));
				}
				return "CREATE TABLE {$table} (\n{$columns});\n{$indexes}";
			break;
			default:
				return parent::renderStatement($type, $data);
			break;
		}
	}

/**
 * PDO deals in objects, not resources, so overload accordingly.
 *
 * @return boolean
 * @access public
 */
	function hasResult() {
		return is_object($this->_result);
	}

/**
 * Generate a "drop table" statement for the given Schema object
 *
 * @param object $schema An instance of a subclass of CakeSchema
 * @param string $table Optional.  If specified only the table name given will be generated.
 *   Otherwise, all tables defined in the schema are generated.
 * @return string
 */
	public function dropSchema(CakeSchema $schema, $table = null) {
		$out = '';
		foreach ($schema->tables as $curTable => $columns) {
			if (!$table || $table == $curTable) {
				$out .= 'DROP TABLE IF EXISTS ' . $this->fullTableName($curTable) . ";\n";
			}
		}
		return $out;
	}
}
