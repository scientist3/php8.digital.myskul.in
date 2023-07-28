<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('display')) {

	function display($text = null)
	{
		$ci = &get_instance();
		$ci->load->database();
		$table  = 'language';
		$phrase = 'phrase';
		$setting_table = 'setting';
		$default_lang  = 'english';

		//set language  
		$data = $ci->db->get($setting_table)->row();
		if (!empty($data->language)) {
			$language = $data->language;
		} else {
			$language = $default_lang;
		}

		if (!empty($text)) {

			if ($ci->db->table_exists($table)) {

				if ($ci->db->field_exists($phrase, $table)) {

					if ($ci->db->field_exists($language, $table)) {

						$row = $ci->db->select($language)
							->from($table)
							->where($phrase, $text)
							->get()
							->row();

						if (!empty($row->$language)) {
							return $row->$language;
						} else {
							return false;
						}
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}

if (!function_exists('number')) {

	function number($text = null)
	{
		if (!empty($text)) {
			return preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $text);
		} else {
			return 0;
		}
	}
}
if (!function_exists('getDistrictListAsArray')) {
	function getDistrictListAsArray()
	{
		//''  => "Select District",
		$district_list = array(
			'' => 'Select District',
			'Anantnag' => 'Anantnag',
			'Bandipore' => 'Bandipore',
			'Baramulla' => 'Baramulla',
			'Budgam' => 'Budgam',
			'Doda' => 'Doda',
			'Ganderbal' => 'Ganderbal',
			'Jammu' => 'Jammu',
			'Kargil' => 'Kargil',
			'Kathua' => 'Kathua',
			'Kishtwar' => 'Kishtwar',
			'Kulgam' => 'Kulgam',
			'Kupwara' => 'Kupwara',
			'Leh' => 'Leh',
			'Poonch' => 'Poonch',
			'Pulwama' => 'Pulwama',
			'Rajouri' => 'Rajouri',
			'Ramban' => 'Ramban',
			'Reasi' => 'Reasi',
			'Samba' => 'Samba',
			'Shopian' => 'Shopian',
			'Srinagar' => 'Srinagar',
			'Udhampur' => 'Udhampur'
		);
		return $district_list;
	}
}

/**
 * Helper function to check if a given variable is an array with a certain length.
 *
 * @param mixed $arrmixValues The variable to check.
 * @param int $intCount The expected length of the array.
 * @param bool $boolCheckForEquality If true, the array length must be exactly equal to $intCount.
 * @return bool Returns true if the variable is an array with the expected length, false otherwise.
 */
if (!function_exists('valArr')) {
	function valArr($arrmixValues, $intCount = 1, $boolCheckForEquality = false)
	{
		$boolIsValid = (is_array($arrmixValues) && $intCount <= count($arrmixValues)) ? true : false;
		if ($boolCheckForEquality && $boolIsValid) {
			$boolIsValid = ($intCount == count($arrmixValues)) ? true : false;
		}

		return $boolIsValid;
	}
}
// $autoload['helper'] =  array('language_helper');

/*display a language*/
// echo display('helloworld'); 

/*display language list*/
// $lang = languageList(); 
