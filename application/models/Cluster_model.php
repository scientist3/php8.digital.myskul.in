<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cluster_model extends CI_Model
{

	private $table = "cluster";

	public function create($data = [])
	{
		return $this->db->insert($this->table, $data);
	}

	// USED IN CONTROLLER  fetchClusterListWithDetails
	public function fetchClusterListWithDetails($org_id = null)
	{
		$this->db->select("cluster.*, organisation.org_name, student.firstname")
			->from($this->table)
			->join('student', 'cluster_head_id=student.user_id', 'left')
			->join('organisation', 'cluster_org_id=org_id', 'left')
			->order_by('cluster_id', 'asc');

		if ($org_id !== null) {
			$this->db->where('cluster_org_id', $org_id);
		}

		return $this->db->get()->result();
	}

	// USED IN CLUSTER CONTROLLER
	public function fetchCountByClusterId($clusterId)
	{
		$this->db->select("COUNT(student.user_id) as student_count")
			->from('student')
			->where('FIND_IN_SET(' . $clusterId . ', student.cluster_idd) > 0');

		$query = $this->db->get();
		$result = $query->row();

		return ($result !== null) ? $result->student_count : 0;
	}

	public function fetchClusterDetailsWithCentersWithCounts($org_id)
	{
		$this->db->select('c.cluster_id, c.cluster_name, o.org_name');
		$this->db->select('COUNT(DISTINCT ctr.center_id) AS total_centers');
		$this->db->select('COUNT(DISTINCT stu.user_id) AS total_students');
		$this->db->select('GROUP_CONCAT(ctr.center_name SEPARATOR \', \') AS center_names_list');
		$this->db->select('stu.firstname');
		$this->db->from('cluster c');
		$this->db->join('center ctr', 'c.cluster_id = ctr.center_cluster_id', 'left');
		$this->db->join('student stu', 'c.cluster_id = stu.cluster_idd', 'left');
		$this->db->join('organisation o', 'stu.org_idd = o.org_id', 'left');
		$this->db->where('stu.org_idd', $org_id);
		$this->db->where('stu.user_role', 5);
		$this->db->group_by('c.cluster_id, c.cluster_name, o.org_name');

		$query = $this->db->get();
		return $query->result();
	}

	public function fetchInterventionAreasDetailsWithStudentCountByClusterId($clusterId)
	{
		$this->db->select('c.center_id, c.center_name');
		$this->db->select('COUNT(DISTINCT stu.user_id) AS total_students');
		$this->db->from('center c');
		$this->db->join('student stu', 'c.center_id = stu.center_id', 'left');
		$this->db->where('stu.cluster_idd', $clusterId);
		$this->db->group_by('c.center_id, c.center_name');

		$query = $this->db->get();
		return $query->result();
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
