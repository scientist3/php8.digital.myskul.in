<?php defined('BASEPATH') or exit('No direct script access allowed');

class OrgnisationClusterModel extends CI_Model
{

	private $table = "cluster";

	public function read($org_id = null)
	{
		// if ($org_id == null) {
		// 	return $this->db->select("cluster.*,organisation.org_name,student.firstname")
		// 		->from($this->table)
		// 		->join('student','cluster_head_id=student.user_id','left')
		// 		->join('organisation','cluster_org_id=org_id','left')
		// 		->order_by('cluster_id','asc')
		// 		->get()
		// 		->result();
		// }else{
		// 	return $this->db->select("cluster.*,organisation.org_name,student.firstname")
		// 		->from($this->table)
		// 		->where('cluster_org_id',$org_id)
		// 		->join('student','cluster_head_id=student.user_id','left')
		// 		->join('organisation','cluster_org_id=org_id','left')
		// 		->order_by('cluster_id','asc')
		// 		->get()
		// 		->result();
		// }
	}

	public function read_clusters_of_org_as_list($org_id = null)
	{
		$list[''] = display('select_cluster');

		if ($org_id != null) {
			$result = $this->db->select("cluster_id,cluster_name")
				->from($this->table)
				->where('cluster_org_id', $org_id)
				->order_by('cluster_name', 'asc')
				->get()
				->result();

			foreach ($result as $row) {
				$list[$row->cluster_id] = $row->cluster_name;
			}
			return $list;
		} else {
			return $list;
		}
	}

	public function get_cluster_ids_of_org($org_id = null)
	{
		$clusters = $this->read_clusters_of_org_as_list($org_id);
		$cluster_ids = [];
		foreach (array_keys($clusters) as $key => $value) {
			if (!empty($value)) {
				$cluster_ids[] = $value;
			}
		}
		return $cluster_ids;
	}
}
