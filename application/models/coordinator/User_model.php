<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class User_model extends CI_Model
	{
		private $table = "student";

		public function create($data = [])
		{
			return $this->db->insert($this->table, $data);
		}

		public function read($user_id = null)
		{
			if ($user_id !== null) {
				return $this->db->get_where($this->table, ['user_id' => $user_id])->row();
			} else {
				return $this->db->get($this->table)->result();
			}
		}

		public function update($data = [])
		{
			return $this->db->where('user_id', $data['user_id'])
				->update($this->table, $data);
		}

		public function delete($user_id = null)
		{
			if ($user_id !== null) {
				$this->db->where('user_id', $user_id)
					->delete($this->table);

				return $this->db->affected_rows() > 0;
			} else {
				return false;
			}
		}

		public function fetchAnimatorsByOrgIdByClusterId($orgId, $clusterId)
		{
			return $this->db->select('COUNT(user_id) as total_animators')
				->from($this->table)
				->where('org_idd', $orgId)
				->where('cluster_idd', $clusterId)
				->where('user_role', Userrole::ANIMATOR)
				->get()
				->row()
				->total_animators;
		}

		public function fetchStudentsByOrgIdByClusterId($orgId, $clusterId)
		{
			return $this->db->select('COUNT(user_id) as total_students')
				->from($this->table)
				->where('org_idd', $orgId)
				->where('cluster_idd', $clusterId)
				->where('user_role', Userrole::STUDENT)
				->get()
				->row()
				->total_students;
		}
	}
