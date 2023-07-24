<?php defined('BASEPATH') or exit('No direct script access allowed');

class Organisation_model extends CI_Model
{

	private $table = "organisation";

	public function create($data = [])
	{
		return $this->db->insert($this->table, $data);
	}

	public function read()
	{
		return $this->db->select("organisation.*,student.firstname")
			->from($this->table)
			->join('student', 'org_head_id=student.user_id')
			->order_by('org_id', 'asc')
			->get()
			->result();
	}

	public function read_orgheads_org($org_head_id = null)
	{
		return $this->db->select("organisation.*,student.*")
			->from($this->table)
			->join('student', 'org_head_id=student.user_id')
			->where('org_head_id', $org_head_id)
			//->order_by('org_id','asc')
			->get()
			->row();
	}
	public function read_as_list()
	{
		$result = $this->db->select("*")
			->from($this->table)
			->order_by('org_name', 'asc')
			->get()
			->result();
		$list[''] = display('select_org');
		foreach ($result as $row) {
			$list[$row->org_id] = $row->org_name;
		}
		return $list;
	}

	public function read_by_id($id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('org_id', $id)
			->get()
			->row();
	}
	public function new_messages()
	{
		return $this->db->where('f_read', '0')
			->from($this->table)
			->count_all_results();
	}

	public function total_messages()
	{
		return $this->db->where('f_status', '1')
			->from($this->table)
			->count_all_results();
	}
	public function update($data = [])
	{
		return $this->db->where('org_id', $data['org_id'])
			->update($this->table, $data);
	}
	public function delete($id = null)
	{
		$this->db->where('org_id', $id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}
	public function total_org()
	{
		return $this->db->from($this->table)
			->count_all_results();
	}
}