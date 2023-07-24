<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	private $table = "student";

	public function create($data = [])
	{
		return $this->db->insert($this->table, $data);
	}

	public function read_students_by_org_cluster_center($org_id = null, $cluster_id = null, $center_id = null, $user_role = 5)
	{
		if ($cluster_id != null) {
			$this->db->select('student.*, center.center_name');
			$this->db->from($this->table);
			//$this->db->where_not_in($this->table.'.user_id',$self_id);
			($org_id != null) ? $this->db->where('org_idd', $org_id) : null;
			($cluster_id != null) ? $this->db->where('cluster_idd', $cluster_id) : null;
			($center_id != null) ? $this->db->where('student.center_id', $center_id) : null;
			($user_role != null) ? $this->db->where('user_role', $user_role) : null;
			//$this->db->join($this->user_log_tbl,$this->user_log_tbl.'.user_id='.$this->table.'.user_id','left');
			//$this->db->where($this->user_log_tbl.'.date="'.date('Y-m-d').'"');
			$this->db->join('center', 'center.center_id=student.center_id', 'left');
			$this->db->order_by('firstname', 'asc');
			$users = $this->db->get()->result();
			return $users;
		} else {
			return null;
		}
	}

	public function read_students_by_org_id($org_id = null, $user_role = 5)
	{
		//return $this->db->select("*")->from($this->table)->where(['org_idd'=>$org_id,'user_role'=>$user_role])->get()->result();
		$this->db->select('student.*, center.center_name');
		$this->db->from($this->table);
		($org_id != null) ? $this->db->where('org_idd', $org_id) : null;
		($user_role != null) ? $this->db->where('user_role', $user_role) : null;
		$this->db->join('center', 'center.center_id=student.center_id', 'left');
		$this->db->order_by('firstname', 'asc');
		$users = $this->db->get()->result();
		return $users;
	}

	public function read_as_list_of_animator_of_cluster($cluster_id = null)
	{
		$result = $this->db->select("student.user_id,student.firstname as fullname")
			->from($this->table)
			->where('user_role =', '4')
			->where('cluster_idd =', $cluster_id)
			//->join('center','center.center_id=student.center_id')
			->order_by('user_id', 'desc')
			->get()
			->result();
		$list[''] = display('select_user');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->user_id] = $value->fullname;
			}
			return $list;
		} else {
			return false;
		}
	}
	public function read_members_for_coodinator($org_id = null, $cluster_id = null)
	{
		if ($org_id != null && $cluster_id != null) {
			return $this->db->select("student.*,center.center_name")
				->from($this->table)
				->where('user_role =', '4')
				->where('org_idd ', $org_id)
				->where('cluster_idd ', $cluster_id)
				->join('center', 'center.center_id=student.center_id', 'left')
				->order_by('firstname', 'asc')
				->get()
				->result();
		}
	}
	public function read_members($org_id = null, $user_role = null)
	{
		if ($org_id == null) {
			return $this->db->select("student.*")
				->from($this->table)
				->where('user_role !=', '5')
				->where('user_role !=', '1')
				//->join('center','center.center_id=student.center_id')
				->order_by('user_id', 'desc')
				->get()
				->result();
		} else {
			$d2 = $this->db->select('*')
				->from($this->table)
				->where('user_role', '3')
				->where('org_idd', $org_id)
				->or_where('user_role', '4')
				->where('org_idd', $org_id)
				//->get_compiled_select();
				->get()
				->result();
			return $d2;


		}
	}

	public function read_students($org_id = null, $cluster_id = null)
	{
		if ($cluster_id != null) {
			return $this->db->select("student.*, center.center_name")
				->from($this->table)
				->where('user_role', '5')
				->where('org_idd', $org_id)
				->where('cluster_idd', $cluster_id)
				->join('center', 'center.center_id=student.center_id', 'left')
				->order_by('user_id', 'desc')
				->get()
				->result();
		} else {
			return $this->db->select("student.*, center.center_name")
				->from($this->table)
				->where('user_role', '5')
				->where('org_idd', $org_id)
				->join('center', 'center.center_id=student.center_id', 'left')
				->order_by('user_id', 'desc')
				->get()
				->result();
		}
	}
	public function read_std_center_id($std_id = '')
	{
		return $this->db->select("student.center_id, center.center_name")
			->from($this->table)
			->where('student.user_id', $std_id)
			->join('center', 'center.center_id=student.center_id')
			//->join('student as st','st.user_id = center.center_head_id')
			//->order_by('user_id','desc')
			->get()
			->row();
	}

	public function read_by_role_as_list_for_message($user_role = null, $self_user_id = null, $org_id = null)
	{
		if ($user_role == null) {
			if ($org_id == null) {
				$result = $this->db->select('user_id, firstname AS fullname')
					->from($this->table)
					//->where('user_role',$user_role)
					->where_not_in('user_id', $self_user_id)
					->order_by('fullname', 'asc')
					->get()
					->result();
			} else {
				$result = $this->db->select('user_id, firstname AS fullname')
					->from($this->table)
					->where('org_idd', $org_id)
					->where_not_in('user_id', $self_user_id)
					->order_by('fullname', 'asc')
					->get()
					->result();
			}
		} else {
			$result = $this->db->select('user_id, firstname AS fullname')
				->from($this->table)
				->where('user_role', $user_role)
				->where_not_in('user_id', $self_user_id)
				->order_by('fullname', 'asc')
				->get()
				->result();
		}
		$list[''] = display('select_user');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->user_id] = $value->fullname;
			}
			return $list;
		} else {
			return false;
		}
	}
	public function user_by_role_as_list_for_coordinator_nojson($user_role = null, $self_user_id = null, $org_id = null, $cluster_id = null)
	{
		$list[''] = display('select_user');

		$query = $this->db->select('user_id, firstname AS fullname')
			->from('organisation')
			->join('student', 'student.user_id= organisation.org_head_id')
			->where('org_id', $org_id)
			->order_by('fullname', 'asc')
			->get()->result();
		if (!empty($query)) {
			foreach ($query as $value) {
				$list[$value->user_id] = $value->fullname;
			}
		}

		$query1 = $this->db->select('user_id, firstname AS fullname')
			->from($this->table)
			->where('user_role', '4')
			->where('cluster_idd', $cluster_id)
			->or_where('user_role', '5')
			->where('cluster_idd', $cluster_id)
			//->where_not_in('user_id', $self_user_id)
			//->where('org_idd',$org_id)
			->order_by('fullname', 'asc')
			->get()->result();

		if (!empty($query1)) {
			foreach ($query1 as $value) {
				$list[$value->user_id] = $value->fullname;
			}
		}

		if (count($list)) {
			return $list;
		} else {
			return false;
		}
	}
	public function user_by_role_as_list($user_role = null, $self_user_id = null, $org_id = null, $cluster_id = null)
	{
		//$department_id = $this->input->post('department_id');

		if (!empty($user_role)) {
			// When user role is organisation
			if ($user_role == 2) {
				$query = $this->db->select('user_id, firstname AS fullname')
					->from($this->table)
					->where('user_role', $user_role)
					->where_not_in('user_id', $self_user_id)
					//->where('org_idd',$org_id)
					->order_by('fullname', 'asc')
					->get();
			} else {
				$query = $this->db->select('user_id, firstname AS fullname')
					->from($this->table)
					->where('user_role', $user_role)
					->where_not_in('user_id', $self_user_id)
					->where('org_idd', $org_id)
					->order_by('fullname', 'asc')
					->get();
			}


			$option = "<option value=\"\">" . display('select_option') . "</option>";
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $user) {
					$option .= "<option value=\"$user->user_id\">$user->fullname</option>";
				}
				$data['message'] = $option;
				$data['status'] = true;
			} else {
				$data['message'] = 'No user available';
				$data['status'] = false;
			}
		} else {
			$data['message'] = 'Invalid user group';
			$data['status'] = null;
		}

		echo json_encode($data);
	}
	public function user_by_role_as_list_for_coordinator($user_role = null, $self_user_id = null, $org_id = null, $cluster_id = null)
	{
		//$department_id = $this->input->post('department_id');

		if (!empty($user_role)) {
			// When user role is organisation
			if ($user_role == 2) {
				$query = $this->db->select('user_id, firstname AS fullname')
					->from('organisation')
					->join('student', 'student.user_id= organisation.org_head_id')
					->where('org_id', $org_id)
					->order_by('fullname', 'asc')
					->get();
			} else {
				$query = $this->db->select('user_id, firstname AS fullname')
					->from($this->table)
					->where('user_role', $user_role)
					->where_not_in('user_id', $self_user_id)
					->where('org_idd', $org_id)
					->where('cluster_idd', $cluster_id)
					->order_by('fullname', 'asc')
					->get();
			}


			$option = "<option value=\"\">" . display('select_option') . "</option>";
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $user) {
					$option .= "<option value=\"$user->user_id\">$user->fullname</option>";
				}
				$data['message'] = $option;
				$data['status'] = true;
			} else {
				$data['message'] = 'No user available';
				$data['status'] = false;
			}
		} else {
			$data['message'] = 'Invalid user group';
			$data['status'] = null;
		}

		echo json_encode($data);
	}
	public function read_stds_aco($std_id = null)
	{
		$animator = $this->db->select("st.user_id,st.firstname")
			->from($this->table)
			->where('student.user_id', $std_id)
			->join('center', 'center.center_id=student.center_id')
			->join('student as st', 'st.user_id = center.center_head_id')
			->order_by('user_id', 'desc')
			->get()
			->row()->user_id;
		$coodinator = $this->db->select("st2.user_id, st2.firstname")
			->from($this->table)
			->where('student.user_id', $std_id)
			->join('center', 'center.center_id=student.center_id')
			->join('cluster', 'cluster.cluster_id=center.center_cluster_id')
			->join('student as st2', 'st2.user_id = cluster.cluster_head_id')
			->order_by('user_id', 'desc')
			->get()
			->row()->user_id;

		$org = $this->db->select("st2.user_id, st2.firstname")
			->from($this->table)
			->where('student.user_id', $std_id)
			->join('center', 'center.center_id=student.center_id')
			->join('cluster', 'cluster.cluster_id=center.center_cluster_id')
			->join('organisation', 'organisation.org_id=cluster.cluster_org_id')
			->join('student as st2', 'st2.user_id = organisation.org_head_id')
			->order_by('user_id', 'desc')
			->get()
			->row()->user_id;
		//echo $animator;die();
		//echo $coodinator;die();
		//echo $org;die();
		return array($animator, $coodinator, $org);
	}
	public function read_as_list_org()
	{
		$result = $this->db->select("*")
			->from($this->table)
			->where('user_role', '2')
			->order_by('firstname', 'asc')
			->get()
			->result();
		$list[''] = display('select_user');
		foreach ($result as $row) {
			$list[$row->user_id] = $row->firstname;
		}
		return $list;
	}

	public function read_as_list_cor($org_id = null)
	{
		if ($org_id == null) {
			$result = $this->db->select("*")
				->from($this->table)
				->where('user_role', '3')
				->order_by('firstname', 'asc')
				->get()
				->result();
		} else {
			$result = $this->db->select("*")
				->from($this->table)
				->where('user_role', '3')
				->where('org_idd', $org_id)
				->order_by('firstname', 'asc')
				->get()
				->result();
		}

		$list[''] = display('select_user');
		foreach ($result as $row) {
			$list[$row->user_id] = $row->firstname;
		}
		return $list;
	}

	public function read_as_list_ani($org_id = null)
	{
		if ($org_id == null) {
			$result = $this->db->select("*")
				->from($this->table)
				->where('user_role', '4')
				->order_by('firstname', 'asc')
				->get()
				->result();
		} else {
			$result = $this->db->select("*")
				->from($this->table)
				->where('user_role', '4')
				->where('org_idd', $org_id)
				->order_by('firstname', 'asc')
				->get()
				->result();
		}
		$list[''] = display('select_user');
		foreach ($result as $row) {
			$list[$row->user_id] = $row->firstname;
		}
		return $list;
	}

	public function read_by_center($centerid = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('center', $centerid)
			->order_by('id', 'desc')
			->get()
			->result();
	}

	public function read_by_id($id = null)
	{
		return $this->db->select("student.*, center.center_name")
			->from($this->table)
			->where('user_id', $id)
			->join('center', 'center.center_id=student.center_id', 'left')
			->order_by('user_id', 'desc')
			->get()
			->row();
	}

	public function read_user_by_id($user_id = null)
	{
		return $this->db->select("student.*")
			->from($this->table)
			->where('user_id', $user_id)
			//->join('center','center.center_id=student.center_id')
			//->order_by('user_id','desc')
			->get()
			->row();
	}

	public function update($data = [])
	{
		return $this->db->where('user_id', $data['user_id'])
			->update($this->table, $data);
	}

	public function delete($id = null)
	{
		$this->db->where('user_id', $id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	public function total_users($user_role = null)
	{
		return $this->db->where('user_role', $user_role)
			->from($this->table)
			->count_all_results();
	}

	public function total_animators_of_org($org_id = null)
	{
		$d2 = $this->db->select('*')
			->from($this->table)
			->where('user_role', '4')
			->where('org_idd', $org_id)
			->count_all_results();
		return $d2;
	}

	public function total_students_of_org($org_id = null)
	{
		$d2 = $this->db->select("student.*, center.center_name")
			->from($this->table)
			->where('user_role', '5')
			->where('org_idd', $org_id)
			->join('center', 'center.center_id=student.center_id', 'left')
			->count_all_results();
		return $d2;
	}

	public function boys_6_11($org_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('user_role', '5')
			->where('org_idd', $org_id)
			->where('LOWER(sex)', 'male')
			->where('LOWER(age)', '6-11')
			->count_all_results();
	}

	public function boys_12_18($org_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('user_role', '5')
			->where('org_idd', $org_id)
			->where('LOWER(sex)', 'male')
			->where('LOWER(age)', '12-18')
			->count_all_results();
	}

	public function girls_6_11($org_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('user_role', '5')
			->where('org_idd', $org_id)
			->where('LOWER(sex)', 'female')
			->where('LOWER(age)', '6-11')
			->count_all_results();
	}

	public function girls_12_18($org_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('user_role', '5')
			->where('org_idd', $org_id)
			->where('LOWER(sex)', 'female')
			->where('LOWER(age)', '12-18')
			->count_all_results();
	}

	public function tot_orphans($org_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('user_role', '5')
			->where('org_idd', $org_id)
			->where('LOWER(school_status)', 'orphan')
			->count_all_results();
	}

	public function tot_disabled($org_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('user_role', '5')
			->where('org_idd', $org_id)
			->where('LOWER(school_status)', 'Disable')
			->count_all_results();
	}

	public function tot_drop_out($org_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('user_role', '5')
			->where('org_idd', $org_id)
			->where('LOWER(school_status)', 'school drop out')
			->count_all_results();
	}

	public function total_students($org_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('user_role', '5')
			->where('org_idd', $org_id)
			->count_all_results();
	}

	public function total_student_of_cluster()
	{
		$d = $this->db->select("cluster_idd as cluster_id,count(*) as std_count")
			->from($this->table)
			//->join('student','center_head_id=student.user_id','left')
			//->join('cluster','cluster_id=center_cluster_id','left')
			//->join('organisation','org_id=cluster_org_id','left')
			->where('user_role', '5')
			->group_by('cluster_idd')
			->get()
			->result();
		$list['cluster_id'] = 'std_count';
		foreach ($d as $row) {
			$list[$row->cluster_id] = $row->std_count;
		}
		//print_r($list);die();
		return $list;
	}

	public function total_student_of_center()
	{
		$d = $this->db->select("center_id as center_id,count(*) as std_count")
			->from($this->table)
			//->join('student','center_head_id=student.user_id','left')
			//->join('cluster','cluster_id=center_cluster_id','left')
			//->join('organisation','org_id=cluster_org_id','left')
			->where('user_role', '5')
			->group_by('center_id')
			->get()
			->result();
		$list['center_id'] = 'std_count';
		foreach ($d as $row) {
			$list[$row->center_id] = $row->std_count;
		}
		//print_r($list);die();
		return $list;
	}
}