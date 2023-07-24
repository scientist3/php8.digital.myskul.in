<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cluster_model extends CI_Model
{

	private $table = "cluster";

	public function create($data = [])
	{
		return $this->db->insert($this->table, $data);
	}

	public function read($org_id = null)
	{
		if ($org_id == null) {
			return $this->db->select("cluster.*,organisation.org_name,student.firstname")
				->from($this->table)
				->join('student', 'cluster_head_id=student.user_id', 'left')
				->join('organisation', 'cluster_org_id=org_id', 'left')
				->order_by('cluster_id', 'asc')
				->get()
				->result();
		} else {
			return $this->db->select("cluster.*,organisation.org_name,student.firstname")
				->from($this->table)
				->where('cluster_org_id', $org_id)
				->join('student', 'cluster_head_id=student.user_id', 'left')
				->join('organisation', 'cluster_org_id=org_id', 'left')
				->order_by('cluster_id', 'asc')
				->get()
				->result();
		}
	}
	public function read_by_id($id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('cluster_id', $id)
			->get()
			->row();
	}

	public function read_as_list()
	{
		$result = $this->db->select("*")
			->from($this->table)
			->order_by('cluster_name', 'asc')
			->get()
			->result();
		$list[''] = display('select_cluster');
		foreach ($result as $row) {
			$list[$row->cluster_id] = $row->cluster_name;
		}
		return $list;
	}

	public function read_as_list_by_org($org_id = null)
	{
		$result = $this->db->select("cluster.*")
			->from($this->table)
			->where('cluster_org_id', $org_id)
			//->join('student','cluster_head_id=student.user_id','left') ,organisation.org_name,student.firstname
			->join('organisation', 'cluster_org_id=org_id', 'left')
			->order_by('cluster_id', 'asc')
			->get()
			->result();
		$list[''] = display('select_cluster');
		foreach ($result as $row) {
			$list[$row->cluster_id] = $row->cluster_name;
		}
		return $list;
	}

	public function update($data = [])
	{
		return $this->db->where('cluster_id', $data['cluster_id'])
			->update($this->table, $data);
	}

	public function delete($id = null)
	{
		$this->db->where('cluster_id', $id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}
	public function total_clusters_of_org($org_id = '')
	{
		return $this->db->from($this->table)
			->where('cluster_org_id', $org_id)
			->count_all_results();
	}
	public function total_clusters()
	{
		return $this->db->from($this->table)
			->count_all_results();
	}
}