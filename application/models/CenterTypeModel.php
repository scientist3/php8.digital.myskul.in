<?php

class CenterTypeModel extends CI_Model
{
	protected $table = 'center_type';


	public function __construct()
	{
		parent::__construct();
	}

	public function getAllCenterTypes()
	{
		return $this->db->get($this->table)->result();
	}

	public function getCenterTypeById($ct_id)
	{
		return $this->db->where('ct_id', $ct_id)->get($this->table)->row();
	}

	public function addCenterType($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function updateCenterType($ct_id, $data)
	{
		$this->db->where('ct_id', $ct_id)->update($this->table, $data);
		return $this->db->affected_rows();
	}

	public function deleteCenterType($ct_id)
	{
		$this->db->where('ct_id', $ct_id)->delete($this->table);
		return $this->db->affected_rows();
	}

	function get_center_as_list(): array
	{
		return CenterTypes::getCenterTypeAsList();
	}
}

class CenterTypes
{
	const CHILD_FRIENDLY_SPACE = 1;
	const ADOLESCENT_RESOURCE_CENTRE = 2;

	public static function getTypeName($type)
	{
		switch ($type) {
			case self::CHILD_FRIENDLY_SPACE:
				return 'Child Friendly Space';
			case self::ADOLESCENT_RESOURCE_CENTRE:
				return 'Adolescent Resource Centre';
			default:
				return 'Unknown';
		}
	}

	public static function getAgeGroup($type)
	{
		switch ($type) {
			case self::CHILD_FRIENDLY_SPACE:
				return '6-10';
			case self::ADOLESCENT_RESOURCE_CENTRE:
				return '11-18';
			default:
				return 'Unknown';
		}
	}

	public static function getCenterTypeAsList()
	{
		return [
			// "" => "Select Center Type",
			self::CHILD_FRIENDLY_SPACE => "CHILD FRIENDLY SPACE",
			self::ADOLESCENT_RESOURCE_CENTRE => "ADOLESCENT RESOURCE CENTRE"
		];
	}


	// public static function getStatus($type)
	// {
	// 	switch ($type) {
	// 		case self::CHILD_FRIENDLY_SPACE:
	// 		case self::ADOLESCENT_RESOURCE_CENTRE:
	// 			return 1;
	// 		default:
	// 			return 0;
	// 	}
	// }
}

// class UserRoles
// {
// 	const ADMIN = 1;
// 	const ORGANISATION = 2;
// 	const ANIMATOR = 3;
// 	const STUDENT = 4;

// 	public static function getRoleName($role)
// 	{
// 		switch ($role) {
// 			case self::ADMIN:
// 				return 'Admin';
// 			case self::ORGANISATION:
// 				return 'Organisation';
// 			case self::ANIMATOR:
// 				return 'Animator';
// 			case self::STUDENT:
// 				return 'Student';
// 			default:
// 				return 'Unknown';
// 		}
// 	}
// }
