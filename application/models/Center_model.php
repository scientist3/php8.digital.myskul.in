<?php defined('BASEPATH') or exit('No direct script access allowed');

class Center_model extends CI_Model
{

	private $table = "center";

	public function create($data = [])
	{
		return $this->db->insert($this->table, $data);
	}

	// USED IN CLUSTER CONTROLLER
	public function fetchCountByCenterId($centerId)
	{
		$this->db->select("COUNT(student.user_id) as student_count")
			->from('student')
			->where('FIND_IN_SET(' . $centerId . ', student.center_id) > 0');

		$query = $this->db->get();
		$result = $query->row();

		return ($result !== null) ? $result->student_count : 0;
	}
	public function read($org_id = null, $cluster_id = null)
	{
		// center_id	center_name	center_head_id	center_cluster_id
		/*
			SELECT organisation.*,cluster.*,center.*
			FROM center
			LEFT JOIN cluster ON cluster.cluster_id = center.center_cluster_id
			LEFT JOIN organisation ON organisation.org_id = cluster.cluster_org_id
			WHERE organisation.org_id = 1
			*/
		if ($cluster_id != null) {
			return $this->db->select("center.*,cluster.cluster_name,student.firstname")
				->from($this->table)
				->join('student', 'center_head_id=student.user_id', 'left')
				->join('cluster', 'cluster_id=center_cluster_id', 'left')
				->join('organisation', 'org_id=cluster_org_id', 'left')
				->where('org_id', $org_id)
				->where('cluster_id', $cluster_id)
				->order_by('center_name', 'asc')
				->get()
				->result();
		} else {
			return $this->db->select("center.*,cluster.cluster_name,student.firstname")
				->from($this->table)
				->join('student', 'center_head_id=student.user_id', 'left')
				->join('cluster', 'cluster_id=center_cluster_id', 'left')
				->join('organisation', 'org_id=cluster_org_id', 'left')
				->where('org_id', $org_id)
				->order_by('center_name', 'asc')
				->get()
				->result();
		}
	}

	public function read_as_list($org_id = null, $cluster_id = null)
	{
		if ($org_id != null && $cluster_id != null) {
			$result = $this->db->select("center.*,cluster.cluster_name,student.firstname")
				->from($this->table)
				->join('student', 'center_head_id=student.user_id', 'left')
				->join('cluster', 'cluster_id=center_cluster_id', 'left')
				->join('organisation', 'org_id=cluster_org_id', 'left')
				->where('org_id', $org_id)
				->where('cluster_id', $cluster_id)
				->order_by('center_name', 'asc')
				->get()
				->result();
		} else {
			$result = $this->db->select("*")
				->from($this->table)
				->order_by('center_name', 'asc')
				->get()
				->result();
		}
		$list[''] = display('select_cluster');
		foreach ($result as $row) {
			$list[$row->center_id] = $row->center_name;
		}
		return $list;
	}

	public function read_as_list1($org_id = null)
	{
		$result = $this->read($org_id);
		$list[''] = display('select_cluster');
		foreach ($result as $row) {
			$list[$row->center_id] = $row->center_name;
		}
		return $list;
	}
	public function read_by_id($id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('center_id', $id)
			->get()
			->row();
	}
	public function update($data = [])
	{
		return $this->db->where('center_id', $data['center_id'])
			->update($this->table, $data);
	}
	public function delete($id = null)
	{
		$this->db->where('center_id', $id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	public function total_centers()
	{
		return $this->db->from($this->table)
			->count_all_results();
	}

	public function total_centers_of_org($org_id = null)
	{
		return $this->db->select("center.*,cluster.cluster_name,student.firstname")
			->from($this->table)
			->join('student', 'center_head_id=student.user_id', 'left')
			->join('cluster', 'cluster_id=center_cluster_id', 'left')
			->join('organisation', 'org_id=cluster_org_id', 'left')
			->where('org_id', $org_id)
			->count_all_results();
	}
	public function total_centers_of_cluster($cluster_id = null)
	{
		$d = $this->db->select("center_cluster_id as cluster_id,count(*) as center_count")
			->from($this->table)
			//->join('student','center_head_id=student.user_id','left')
			//->join('cluster','cluster_id=center_cluster_id','left')
			//->join('organisation','org_id=cluster_org_id','left')
			//->where('org_id',$org_id)
			->group_by('center_cluster_id')
			->get()
			->result();
		$list['cluster_id'] = 'Center_count';
		foreach ($d as $row) {
			$list[$row->cluster_id] = $row->center_count;
		}
		//print_r($list);die();
		return $list;
	}

	public function read_centers_by_cluster($cluster_id = null)
	{
		$d = $this->db->select("center_id,center_name")
			->from($this->table)
			//->join('student','center_head_id=student.user_id','left')
			//->join('cluster','cluster_id=center_cluster_id','left')
			//->join('organisation','org_id=cluster_org_id','left')
			->where('center_cluster_id', $cluster_id)
			//->group_by('center_cluster_id')
			->order_by('center_name')
			->get()
			->result();

		//print_r($d); die();
		return $d;
	}
	//read_center_by_cluster_array
	public function center_by_cluster($cluster_id = null,$intSelectedCenterId = null)
	{
		//$department_id = $this->input->post('department_id');

		if (!empty($cluster_id)) {
			$query = $this->db->select('center.*')
				->from($this->table)
				->where('center_cluster_id', $cluster_id)
				//->where('user_role',2)
				//->where('status',1)
				->get();

			$option = "<option value=\"\">" . display('select_option') . "</option>";
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $center) {
					if($center->center_id == $intSelectedCenterId){
						$option .= "<option value=\"$center->center_id\" selected>$center->center_name</option>";

					}else{
						$option .= "<option value=\"$center->center_id\">$center->center_name</option>";
					}
				}
				$data['message'] = $option;
				$data['status'] = true;
			} else {
				$data['message'] = 'No center available';
				$data['status'] = false;
			}
		} else {
			$data['message'] = 'Invalid cluster';
			$data['status'] = null;
		}

		echo json_encode($data);
	}
	// In use
	public function getCenterDetails($orgId = null, $clusterId = null)
	{
		$this->db->select("center.*, cluster.cluster_name, student.firstname")
			->from($this->table)
			->join('student', 'center_head_id=student.user_id', 'left')
			->join('cluster', 'cluster_id=center_cluster_id', 'left')
			->join('organisation', 'org_id=cluster_org_id', 'left')
			->where('org_id', $orgId)
			->order_by('center_name', 'asc');

		if ($clusterId !== null) {
			$this->db->where('cluster_id', $clusterId);
		}

		return $this->db->get()->result();
	}

	public function fetchCenterCountByClusterId($clusterId)
	{
		return $this->db->select('COUNT(center_id) as center_count')
			->from($this->table)
			->where('center_cluster_id', $clusterId)
			->get()
			->row()
			->center_count;
	}

	public function readCenterByClusterIdAsList($clusterId = null)
	{
		$result = $this->db->select("center_id, center_name")
			->from($this->table)
			->where('center_cluster_id', $clusterId)
			//->join('student','cluster_head_id=student.user_id','left') ,organisation.org_name,student.firstname
			//->join('organisation', 'cluster_org_id=org_id', 'left')
			->order_by('center_name', 'asc')
			->get()
			->result();
		$list[''] = display('select_center');
		foreach ($result as $row) {
			$list[$row->center_id] = $row->center_name;
		}
		return $list;
	}

	public function read_centers_of_cluster_as_list($cluster_ids = [])
	{
		$list[''] = display('select_center');

		if (count($cluster_ids) != 0) {
			$result = $this->db->select("center_id,center_name")
				->from($this->table)
				->where_in('center_cluster_id', array_keys($cluster_ids))
				->order_by('center_name', 'asc')
				->get()
				->result();

			foreach ($result as $row) {
				$list[$row->center_id] = $row->center_name;
			}
			return $list;
		} else {
			return $list;
		}
	}
}
