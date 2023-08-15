<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Center_model extends CI_Model
	{
		private $table = "center";

		public function create($data = [])
		{
			return $this->db->insert($this->table, $data);
		}

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
			$this->db->select("center.*, cluster.cluster_name, student.firstname")
				->from($this->table)
				->join('student', 'center_head_id = student.user_id', 'left')
				->join('cluster', 'cluster_id = center_cluster_id', 'left')
				->join('organisation', 'org_id = cluster_org_id', 'left');

			if ($org_id !== null) {
				$this->db->where('org_id', $org_id);
			}

			if ($cluster_id !== null) {
				$this->db->where('cluster_id', $cluster_id);
			}

			$this->db->order_by('center_name', 'asc');

			return $this->db->get()->result();
		}

		public function read_as_list($org_id = null, $cluster_id = null)
		{
			$result = $this->read($org_id, $cluster_id);

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

			return $this->db->affected_rows() > 0;
		}

		public function total_centers()
		{
			return $this->db->from($this->table)
				->count_all_results();
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
		public function total_centers_of_org($org_id = null)
		{
			$this->db->select("center.*, cluster.cluster_name, student.firstname")
				->from($this->table)
				->join('student', 'center_head_id = student.user_id', 'left')
				->join('cluster', 'cluster_id = center_cluster_id', 'left')
				->join('organisation', 'org_id = cluster_org_id', 'left')
				->where('org_id', $org_id);

			return $this->db->count_all_results();
		}

		public function total_centers_of_cluster($cluster_id = null)
		{
			$d = $this->db->select("center_cluster_id as cluster_id, count(*) as center_count")
				->from($this->table)
				->group_by('center_cluster_id')
				->get()
				->result();

			$list['cluster_id'] = 'Center_count';
			foreach ($d as $row) {
				$list[$row->cluster_id] = $row->center_count;
			}

			return $list;
		}

		public function read_centers_by_cluster($cluster_id = null)
		{
			$d = $this->db->select("center_id, center_name")
				->from($this->table)
				->where('center_cluster_id', $cluster_id)
				->order_by('center_name')
				->get()
				->result();

			return $d;
		}

		public function center_by_cluster($cluster_id = null)
		{
			if (!empty($cluster_id)) {
				$query = $this->db->select('center.*')
					->from($this->table)
					->where('center_cluster_id', $cluster_id)
					->get();

				$option = "<option value=\"\">" . display('select_option') . "</option>";
				if ($query->num_rows() > 0) {
					foreach ($query->result() as $center) {
						$option .= "<option value=\"$center->center_id\">$center->center_name</option>";
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
	}
