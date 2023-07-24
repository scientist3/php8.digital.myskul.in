<?php defined('BASEPATH') or exit('No direct script access allowed');

class User1_model extends CI_Model
{

	private $table = "student";
	private $user_log_tbl = "user_log";

	public function get_users($org_id = null, $cluster_id = null, $center_id = null, $user_role = null, $date = null, $self_id = null)
	{
		$this->db->select('user_id,firstname,user_role,org_idd,cluster_idd,center_id,picture');
		$this->db->from($this->table);
		$this->db->where_not_in($this->table . '.user_id', $self_id);
		($org_id != null) ? $this->db->where('org_idd', $org_id) : null;
		($cluster_id != null) ? $this->db->where('cluster_idd', $cluster_id) : null;
		($center_id != null) ? $this->db->where('center_id', $center_id) :  null;
		($user_role != null) ? $this->db->where('user_role', $user_role) : null;
		//$this->db->join($this->user_log_tbl,$this->user_log_tbl.'.user_id='.$this->table.'.user_id','left');
		//$this->db->where($this->user_log_tbl.'.date="'.date('Y-m-d').'"');
		$users = $this->db->get()->result();

		// $user_log =	$this->db->select('*')
		// 	->from($this->user_log_tbl)
		// 	->where($this->user_log_tbl . '.date="' . date('Y-m-d', strtotime($date)) . '"')
		// 	->get()->result();
		$user_log = $this->db->select('*')
			->from($this->user_log_tbl)
			->where('DATE(' . $this->user_log_tbl . '.date) =', $date)
			->get()
			->result();
		// print_r($users);
		// print_r($user_log); 
		// print_r($date);
		// die();

		$list = [];
		foreach ($users as $k => $user) {
			$list[$k] = $user;
			$users[$k]->log = (object)[
				'id'   => null,
				'date' => $date, //date('Y-m-d'),//,strtotime($date)),
				'login_time' => null,
				'logout_time' => null
			];
			// print_r($users[$k]->log);die();
			foreach ($user_log as $key => $log) {
				if ($users[$k]->user_id == $log->user_id) {
					$users[$k]->log = [
						'id'   => $log->user_id,
						'date' => $log->date,
						'login_time' => $log->login_time,
						'logout_time' => $log->logout_time
					];
					$users[$k]->log = $log;
				}
			}
		}

		//print_r($list); die();
		return $list;
		// return $this->db->get_compiled_select();	
	}

	public function get_absent_users($org_id = null, $cluster_id = null, $center_id = null, $user_role = null, $date = null, $self_id = null)
	{
		$users = $this->get_users($org_id, $cluster_id, $center_id, $user_role, $date, $self_id);
		//echo "<pre>"; print_r($users); echo "</pre>";
		$list = [];
		foreach ($users as $key => $user) {
			if (empty($user->log->id)) {
				$list[] = $user;
			}
		}
		return $list;
		//return $users;
	}

	public function user_log_from_to_date($user_id, $start_date, $end_date)
	{
		$user_data = $this->db->select('student.user_id,firstname,student.user_role,org_idd,cluster_idd,center_id,picture')
			->from($this->table)
			->where($this->table . '.user_id', $user_id)
			->get()->row();

		$user_log  = $this->db->select('student.user_id,firstname,student.user_role,org_idd,cluster_idd,center_id,picture,date,login_time,logout_time')
			->from($this->user_log_tbl)
			->where($this->user_log_tbl . '.user_id', $user_id)
			->where($this->user_log_tbl . '.date >="' . date('Y-m-d', strtotime($start_date)) . '"')
			->where($this->user_log_tbl . '.date <="' . date('Y-m-d', strtotime($end_date)) . '"')
			->join('student', 'student.user_id=' . $this->user_log_tbl . '.user_id')
			->get()->result();
		//$user_log =(object) $user_log1;
		//print_r($user_log);

		//echo $start_date.'<br>';
		$list = [];
		for ($day = $start_date; $day <= $end_date; $day = date('Y-m-d', strtotime($day . '+1 day'))) {
			$log = (object)[
				'date' => $day,
				'login_time' => null,
				'logout_time' => null
			];
			foreach ($user_log as $key => $user) {
				if ($user->date == $day) {
					$log = (object)[
						'date' 			=> $day,
						'login_time' 	=> $user->login_time,
						'logout_time' 	=> $user->logout_time
					];
					break;
				}
			}

			$list[] = (object)[
				'user_id' 		=> $user_data->user_id,
				'firstname' 	=> $user_data->firstname,
				'user_role' 	=> $user_data->user_role,
				'org_idd' 		=> $user_data->org_idd,
				'cluster_idd' 	=> $user_data->cluster_idd,
				'center_id' 	=> $user_data->center_id,
				'picture' 		=> $user_data->picture,
				'log'			=> $log
			];

			//echo $day.'<br>';
			//for

		}
		//print_r($list);

		//die();

		return $list;
	}

	public function user_absentee_log_from_to_date($user_id, $start_date, $end_date)
	{
		$users = $this->user_log_from_to_date($user_id, $start_date, $end_date);
		//echo "<pre>"; print_r($users); echo "</pre>";

		$list = [];
		foreach ($users as $key => $user) {
			if (empty($user->log->login_time)) {
				$list[] = $user;
			}
		}
		return $list;
	}

	public function total_logedin_today($org_id = null, $self_id = null)
	{
		$today = date('Y-m-d');
		$users = $this->get_users($org_id, null, null, null, $today, $self_id);
		$count = 0;
		foreach ($users as $key => $user) {
			if (!empty($user->log->id)) {
				$count++;
			}
		}
		return $count;
	}
	public function total_cor_loggedin_today($org_id = null, $self_id = null)
	{
		$today = date('Y-m-d');
		$users = $this->get_users($org_id, null, null, 3, $today, $self_id);
		$count = 0;
		foreach ($users as $key => $user) {
			if (!empty($user->log->id)) {
				$count++;
			}
		}
		return $count;
	}

	public function total_ani_loggedin_today($org_id = null, $self_id = null)
	{
		$today = date('Y-m-d');
		$users = $this->get_users($org_id, null, null, 4, $today, $self_id);
		$count = 0;
		foreach ($users as $key => $user) {
			if (!empty($user->log->id)) {
				$count++;
			}
		}
		return $count;
	}

	public function total_std_loggedin_today($org_id = null, $self_id = null)
	{
		$today = date('Y-m-d');
		$users = $this->get_users($org_id, null, null, 5, $today, $self_id);
		$count = 0;
		foreach ($users as $key => $user) {
			if (!empty($user->log->id)) {
				$count++;
			}
		}
		return $count;
	}

	public function total_absentee_today($org_id = null, $self_id = null)
	{
		$today = date('Y-m-d');
		$users = $this->get_users($org_id, null, null, null, $today, $self_id);
		// echo "<pre>"; print_r($users); echo "</pre>"; 
		// die();
		$count = 0;
		foreach ($users as $key => $user) {
			if (empty($user->log->id)) {
				$count++;
			}
		}
		return $count;
	}

	public function total_cor_absentee_today($org_id = null, $self_id = null)
	{
		$today = date('Y-m-d');
		$users = $this->get_users($org_id, null, null, 3, $today = null, $self_id = null);
		$count = 0;
		foreach ($users as $key => $user) {
			if (empty($user->log->id)) {
				$count++;
			}
		}
		return $count;
	}

	public function total_ani_absentee_today($org_id = null, $self_id = null)
	{
		$today = date('Y-m-d');
		$users = $this->get_users($org_id, null, null, 4, $today, $self_id = null);
		$count = 0;
		foreach ($users as $key => $user) {
			if (empty($user->log->id)) {
				$count++;
			}
		}
		return $count;
	}
	public function total_std_absentee_today($org_id = null, $self_id = null)
	{
		$today = date('Y-m-d');
		$users = $this->get_users($org_id, null, null, 5, $today, $self_id);
		$count = 0;
		foreach ($users as $key => $user) {
			if (empty($user->log->id)) {
				$count++;
			}
		}
		return $count;
	}

	// Used In UserService
	public function count_users($orgId, $clusterId, $centerId, $userRole, $date, $userId)
	{
		// Construct your SQL query to count the users based on the provided filters
		// For example:
		$this->db->select('COUNT(*) as total_count');
		$this->db->from($this->table);
		// $this->db->where('org_idd', $orgId);
		$this->db->where_not_in($this->table . '.user_id', $userId);
		($orgId != null) ? $this->db->where('org_idd', $orgId) : null;
		($clusterId != null) ? $this->db->where('cluster_idd', $clusterId) : null;
		($centerId != null) ? $this->db->where('center_id', $centerId) :  null;
		($userRole != null) ? $this->db->where('user_role', $userRole) : null;
		// Execute the query and get the result
		$result = $this->db->get()->row();

		// If there is a result, return the total count
		if ($result) {
			return $result->total_count;
		}

		// If no result, return 0 (no users found)
		return 0;
	}
	// Used In UserService 
	public function get_users_with_pagination($orgId, $clusterId, $centerId, $userRole, $date, $userId, $itemsPerPage, $offset)
	{
		// Construct your base query to fetch users' data
		$this->db->select('user_id, firstname, user_role, org_idd, cluster_idd, center_id, picture');
		$this->db->from($this->table);
		$this->db->where_not_in($this->table . '.user_id', $userId);
		($orgId != null) ? $this->db->where('org_idd', $orgId) : null;
		($clusterId != null) ? $this->db->where('cluster_idd', $clusterId) : null;
		($centerId != null) ? $this->db->where('center_id', $centerId) :  null;
		($userRole != null) ? $this->db->where('user_role', $userRole) : null;

		// Apply pagination
		$this->db->limit($itemsPerPage, $offset);

		// Fetch users' data from the base query
		$users = $this->db->get()->result();

		// Fetch user log data for the specified date
		$user_log = $this->db->select('*')
			->from($this->user_log_tbl)
			->where($this->user_log_tbl . '.date', date('Y-m-d', strtotime($date)))
			->get()->result();

		// Create an associative array to hold user logs for easy lookup
		$user_logs_by_user_id = array();
		foreach ($user_log as $log) {
			$user_logs_by_user_id[$log->user_id] = $log;
		}

		// Combine user logs with users' data
		foreach ($users as &$user) {
			$user_id = $user->user_id;
			$log = isset($user_logs_by_user_id[$user_id]) ? $user_logs_by_user_id[$user_id] : (object)[
				'id'   => null,
				'date' => $date,
				'login_time' => null,
				'logout_time' => null
			];
			$user->log = $log;
		}

		return $users;
	}
}
