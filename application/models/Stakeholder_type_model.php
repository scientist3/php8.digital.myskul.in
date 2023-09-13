<?php

class Stakeholder_type_model extends CI_Model
{
	protected $table = 'stakeholder_type';


	public function __construct()
	{
		parent::__construct();
	}

	public function getAllStakeholderTypes()
	{
		return $this->db->get($this->table)->result();
	}

	public function getStakeholderTypeById($id)
	{
		return $this->db->where('id', $id)->get($this->table)->row();
	}

	public function addStakeholderType($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function updateStakeholderType($id, $data)
	{
		$this->db->where('id', $id)->update($this->table, $data);
		return $this->db->affected_rows();
	}

	public function deleteStakeholderType($id)
	{
		$this->db->where('id', $id)->delete($this->table);
		return $this->db->affected_rows();
	}

	public function get_stakeholder_as_list(): array
	{
		return StakeholderType::getTypeAsList();
	}

	public function getStackholderTypeClass(): StakeholderType
	{
		return new StakeholderType();
	}
}

class StakeholderType
{
	const PARENT = 1;
	const VOLUNTEERS = 2;
	const LOCAL_COMMUNITIES = 3;

	public static function getTypeName($type)
	{
		switch ($type) {
			case self::PARENT:
				return 'Parents and Community Stakeholders reach - Parent';
			case self::VOLUNTEERS:
				return 'Volunteers engaged in CFS ARC';
			case self::LOCAL_COMMUNITIES:
				return 'VLCPCs, CPCs, local committee, PRIs and other traditional institutions reach';
			default:
				return 'Unknown';
		}
	}

	public static function getTypeAsList()
	{
		return [
			self::PARENT => "Parent",
			self::VOLUNTEERS => "Volunteers",
			self::LOCAL_COMMUNITIES => "Local Communities"
		];
	}

	public static function getTypeParent()
	{
		return self::PARENT;
	}

	public static function getTypeVolunteers()
	{
		return self::VOLUNTEERS;
	}

	public static function getTypeLocalCommunities()
	{
		return self::LOCAL_COMMUNITIES;
	}
}