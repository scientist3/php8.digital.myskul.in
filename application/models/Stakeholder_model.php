<?php defined('BASEPATH') or exit('No direct script access allowed');

class Stakeholder_model extends CI_Model
{
	private $table = "student";

	public function create($data = [])
	{
		return $this->db->insert($this->table, $data);
	}

	public function readStakeholdersByOrgId($orgId = null)
	{
		$this->db->select("student.*, stakeholder_type.name as stakeholder_name, social_parity.category_name as social_status, groups.group_name,center.center_name")->from($this->table);
		$this->db->where('user_role', Userrole1::STAKEHOLDER);
		$this->db->join('stakeholder_type', 'stakeholder_type.id=student.stakeholder_type_id', 'left');
		$this->db->join('social_parity', 'social_parity.id=student.socail_status', 'left');
		$this->db->join('groups', 'groups.g_id=student.group_id', 'left');
		$this->db->join('center', 'center.center_id=student.center_id', 'left');
		$this->db->order_by('firstname', 'asc');

		if ($orgId !== null) {
			$this->db->where('org_idd', $orgId);
		}

		$this->db->order_by('user_id', 'desc');
		return $this->db->get()->result();
	}


	public function update($data = [])
	{
		return $this->db->where('user_id', $data['user_id'])
			->update($this->table, $data);
	}

	public function delete($id = null): bool
	{
		$this->db->where('user_id', $id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	public function totalStakeholdersByOrgId( $intOrgId )
	{
		return $this->db->where('user_role', $intOrgId)
			->from($this->table)
			->count_all_results();
	}
	public function countStakeholdersByClusterIdByStakeholderType($clusterId) {
		$this->db->select('stakeholder_type_id, COUNT(*) as student_count');
		$this->db->from('student');
		$this->db->where('user_role', Userrole1::STAKEHOLDER);
		$this->db->where('cluster_idd', $clusterId);
		$this->db->group_by('stakeholder_type_id');
		$query = $this->db->get();
		$result1 = $query->result();

		$result = [
			'total_parents' => 0, // Default count for 'parent'
			'total_volunteers' => 0, // Default count for 'volunteer'
			'total_local_communities' => 0, // Default count for 'local communities'
			'total_frontline_workers' => 0
		];

		foreach ($result1 as $row) {
			$stakeholderTypeId = $row->stakeholder_type_id;
			$studentCount = $row->student_count;

			// Map stakeholder_type_id to the desired keys
			switch ($stakeholderTypeId) {
				case StakeholderType1::PARENT:
					$result['total_parents'] = (int)$studentCount;
					break;
				case StakeholderType1::VOLUNTEERS:
					$result['total_volunteers'] = (int)$studentCount;
					break;
				case StakeholderType1::LOCAL_COMMUNITIES:
					$result['total_local_communities'] = (int)$studentCount;
					break;
				case StakeholderType1::FRONTLINE_WORKERS:
					$result['total_frontline_workers'] = (int)$studentCount;
					break;
			}
		}
		return $result;
	}
	
	public function countStakeholdersByOrgIdByStakeholderType($orgId) {
		$this->db->select('stakeholder_type_id, COUNT(*) as student_count');
		$this->db->from('student');
		$this->db->where('user_role', Userrole1::STAKEHOLDER);
		$this->db->where('org_idd', $orgId);
		$this->db->group_by('stakeholder_type_id');
		$query = $this->db->get();
		$result1 = $query->result();
		
		$result = [
			'total_parents' => 0, // Default count for 'parent'
			'total_volunteers' => 0, // Default count for 'volunteer'
			'total_local_communities' => 0, // Default count for 'local communities'
			'total_frontline_workers' => 0
		];
		
		foreach ($result1 as $row) {
			$stakeholderTypeId = $row->stakeholder_type_id;
			$studentCount = $row->student_count;
			
			// Map stakeholder_type_id to the desired keys
			switch ($stakeholderTypeId) {
				case StakeholderType1::PARENT:
					$result['total_parents'] = (int)$studentCount;
					break;
				case StakeholderType1::VOLUNTEERS:
					$result['total_volunteers'] = (int)$studentCount;
					break;
				case StakeholderType1::LOCAL_COMMUNITIES:
					$result['total_local_communities'] = (int)$studentCount;
					break;
				case StakeholderType1::FRONTLINE_WORKERS:
					$result['total_frontline_workers'] = (int)$studentCount;
					break;
			}
		}
		return $result;
	}
}

class StakeholderType1
{
	const PARENT = 1;
	const VOLUNTEERS = 2;
	const LOCAL_COMMUNITIES = 3;
	const FRONTLINE_WORKERS = 4;

	public static function getTypeName($type)
	{
		switch ($type) {
			case self::PARENT:
				return 'Parents and Community Stakeholders reach - Parent';
			case self::VOLUNTEERS:
				return 'Volunteers engaged in CFS ARC';
			case self::LOCAL_COMMUNITIES:
				return 'VLCPCs, CPCs, local committee, PRIs and other traditional institutions reach';
			case self::FRONTLINE_WORKERS:
				return 'Frontline workers';
			default:
				return 'Unknown';
		}
	}

	public static function getTypeAsList()
	{
		return [
			self::PARENT => "Parent",
			self::VOLUNTEERS => "Volunteers",
			self::LOCAL_COMMUNITIES => "Local Communities",
			self::FRONTLINE_WORKERS => "Frontline Workers"
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

	public static function getTypeFrontlineWorkers()
	{
		return self::FRONTLINE_WORKERS;
	}
}