<?php

class ZfLanguageSectionDatabase extends DBEntity
{

	/* ZPHP Generated Code ------------------------------------------ */

	const ENTITY_TABLE = '`zf_language_section`';

	protected static $_table_sql = self::ENTITY_TABLE;

	protected static $_entity_fields = array(
		'id_language_section',
		'system',
		'user',
	);

	protected static $_primary_keys = array(
		'id_language_section',
	);

	//-----------------------------------------------------------------------

	
	/**
	* @return ZfLanguageSection[]
	*/	
	protected static function _entity_collection_from_array($array_rows) {

		$entities = array();

		foreach((array) $array_rows as $row) $entities[] = self::_entity_from_array($row);

		return $entities;

	}

	/**
	* @return ZfLanguageSection
	*/
	protected static function _entity_from_array($array) {

		if($array && is_array($array))
		{
			$entity = new ZfLanguageSection();
			$entity->__fromDatabase = true;
			$entity->update_fields($array);
			$entity->__fromDatabase = false;
			return $entity;
		}
		else
		{
			return null;
		}
	}
	
	//-----------------------------------------------------------------------

	
	/**
	* @return ZfLanguageSection
	*/
	public static function get_by_id_language_section($id_language_section, $column=null) {

		return ZfLanguageSection::get_row(array('id_language_section' => $id_language_section), $column);

	}
	
	/**
	* @return ZfLanguageSection
	*/
	public static function get_row($conditions, $column=null) {


		$row = DBConnection::get_default_connection()->select_row('SELECT * FROM '.self::$_table_sql, $conditions);

		if($row) {

			$entity = self::_entity_from_array($row);

			if($column) return $entity->$column;

			else return $entity;

		} else {

			return null;

		}

	}

	
	/**
	* @return ZfLanguageSection[]
	*/	
	public static function list_all($conditions=null, $order=null, $limit=null) {

		$rows = DBConnection::get_default_connection()->select_rows('SELECT * FROM '.self::$_table_sql, $limit, $conditions, $order);

		return self::_entity_collection_from_array($rows);

	}

	public static function list_all_column($column, $conditions=null, $order=null, $limit=null) {

		$rows = self::list_all($conditions, $order, $limit);
		$column_data = array();

		foreach($rows as $row)
		{
			$column_data[] = $row->$column;
		}

		return $column_data;

	}

		
	public static function search_all(&$rows=null, $conditions=null, $order=null, $limit=null, $group_by=null) {

		$count = DBConnection::get_default_connection()->search_rows('SELECT * FROM '.self::$_table_sql, $rows, $limit, $conditions, $order, $group_by);

		$rows = self::_entity_collection_from_array($rows);

		return $count;

	}
	
	public static function count_all($conditions=null) {

		return DBConnection::get_default_connection()->count_rows('SELECT * FROM '.self::$_table_sql, $conditions);

	}
	
	/**
	* @return ZfLanguageSection
	*/
	public static function saveEntity(ZfLanguageSection $entity) {

		$entity_row = $entity->to_array(false);

		$primary_keys_values = array();
		$primary_keys_values['id_language_section'] = $entity_row['id_language_section'];

		if(DBConnection::get_default_connection()->select_value('SELECT COUNT(*) FROM '.self::ENTITY_TABLE.' '.SQLHelper::prepare_conditions($primary_keys_values, true)) == 1) {

			DBConnection::get_default_connection()->query_update('zf_language_section', $entity_row, $primary_keys_values);

		} else {

			DBConnection::get_default_connection()->query_insert('zf_language_section', $entity_row, true);

			$newEntity = self::_entity_from_array(DBConnection::get_default_connection()->select_row('SELECT * FROM '.self::ENTITY_TABLE.' '.SQLHelper::prepare_conditions($primary_keys_values, true)));
		}  

	}

	public static function __callStatic($method, $args)
	{
		if($method == 'save')
		{
			call_user_func_array(array('ZfLanguageSection', 'saveEntity'), $args);
		}
		else
		{
			call_user_func_array(array(get_parent_class(self), $method), $args);
		}
	}

	
	
	public static function delete_by_id_language_section($id_language_section) {

		$conditions = array();
		$conditions['id_language_section'] = $id_language_section;
		return ZfLanguageSection::delete_rows($conditions);

	}
	
	
	public static function delete_rows($conditions=array()) {	
	
		$conditions = (array) $conditions;	
	
		if(count($conditions) == 0) return;
		return DBConnection::get_default_connection()->query('DELETE FROM '.self::ENTITY_TABLE.' '.SQLHelper::prepare_conditions($conditions));

	}

	//-----------------------------------------------------------------------


	protected $_id_language_section;
	protected $_system;
	protected $_user;


	public function __construct($data = null) {

		parent::__construct();

		if($data !== null) {

			if(is_array($data) || (is_object($data) && $data instanceof DBEntity)) {

				$this->update_fields($data);

			} else if(func_num_args() == count(self::$_primary_keys)) { 

				$args = func_get_args();
				$conditions = array_combine(self::$_primary_keys, $args);
				$entity = ZfLanguageSection::get_row($conditions);
				$this->update_fields($entity);

			}

		}
	}

	public function __toString() {
		return var_export($this, true);
	}


	protected function _get_entity_fields() {
		return self::$_entity_fields;
	}


	protected function _get_primary_keys() {
		return self::$_primary_keys;
	}

	public function __call($method, $args)
	{
		if($method == 'save')
		{
			ZfLanguageSection::saveEntity($this);
		}
		else
		{
			throw new Exception('Method '.get_class(self).'::'.$method.' does not exists');
		}
	}

	//-----------------------------------------------------------------------



	public function get_id_language_section() {
		return $this->_id_language_section;
	}


	/**
	* @return ZfLanguageSection
	*/
	public function set_id_language_section($value) {
		$this->_id_language_section = $value;
		return $this;
	}


	public function get_system() {
		return $this->_system;
	}


	/**
	* @return ZfLanguageSection
	*/
	public function set_system($value) {
		$this->_system = $value;
		return $this;
	}


	public function get_user() {
		return $this->_user;
	}


	/**
	* @return ZfLanguageSection
	*/
	public function set_user($value) {
		$this->_user = $value;
		return $this;
	}

	//-----------------------------------------------------------------------

	public function delete()
	{
		$keys = array_merge(self::$_primary_keys, array());

		if(!empty($keys))
		{
			$conditions = [];

			foreach($keys as $key)
			{
				$conditions[$key] = $this->$key;
			}

			return ZfLanguageSection::delete_rows($conditions);
		}
		else
		{
			return false;
		}
	}


	/* /ZPHP Generated Code ------------------------------------------ */

}

