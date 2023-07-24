<?php defined('BASEPATH') or exit('No direct script access allowed');

class Userrole_model extends CI_Model
{
	private $table = "user_role";

	public function create($data = [])
	{
		return $this->db->insert($this->table, $data);
	}
	public function read_all_as_list()
	{
		return Userrole::getAllRoleNamesAsArray();
	}
	public function read_basic_as_list()
	{
		return Userrole::getBasicRoleNamesAsArray();
	}
	public function update($data = [])
	{
		return $this->db->where('user_id', $data['user_id'])
			->update($this->table, $data);
	}

	public function delete($id = null)
	{
		$this->db->where('user_id', $id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}
}

class Userrole
{
	const ADMIN = 1;
	const ORGANISATION = 2;
	const CLUSTER_COORDINATOR = 3;
	const ANIMATOR = 4;
	const STUDENT = 5;

	public static function getRoleName($role)
	{
		switch ($role) {
			case self::ADMIN:
				return 'Admin';
			case self::ORGANISATION:
				return 'Organisation';
			case self::CLUSTER_COORDINATOR:
				return 'Cluster Coordinator';
			case self::ANIMATOR:
				return 'Animator';
			case self::STUDENT:
				return 'Student';
			default:
				return 'Unknown';
		}
	}

	public static function getAllRoleNamesAsArray()
	{
		return array(
			self::ADMIN => 'Admin',
			self::ORGANISATION => 'Organisation',
			self::CLUSTER_COORDINATOR => 'Cluster Coordinator',
			self::ANIMATOR => 'Animator',
			self::STUDENT => 'Student'
		);
	}

	public static function getBasicRoleNamesAsArray()
	{
		return array(
			" " => 'Select User Role',
			self::ORGANISATION => 'Organisation',
			self::CLUSTER_COORDINATOR => 'Cluster Coordinator',
			self::ANIMATOR => 'Animator',
			self::STUDENT => 'Student'
		);
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
