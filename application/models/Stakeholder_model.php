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
		$this->db->select("student.*")->from($this->table);
		$this->db->where('user_role', Userrole1::STAKEHOLDER);

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
}