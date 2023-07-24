<?php defined('BASEPATH') or exit('No direct script access allowed');

class Center1_model extends CI_Model
{

	private $table = "center";

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
