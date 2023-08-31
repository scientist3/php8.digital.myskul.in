<?php defined('BASEPATH') or exit('No direct script access allowed');

	class Activities_model extends CI_Model
	{

		private $table = "student";
		private $user_log_tbl = "user_log";
		// Not used
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



		public function user_absentee_log_from_to_date($user_id, $start_date, $end_date)
		{
			$users = $this->getUserLogsByDateRange($user_id, $start_date, $end_date);
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

		//  USED FUNCTION IN ATTENDANCE >> API >> ORGANISATION >> USER-SERVICE >> get_users_with_pagination
		public function getFilteredUserTotalCount($orgId, $clusterId, $centerId, $userRole, $userId, $searchValue, $check = "P")
		{
			// Construct your SQL query to count the users based on the provided filters and search value
			$this->db->select('COUNT(*) as total_count');
			$this->db->from($this->table);
			$this->db->where_not_in($this->table . '.user_id', $userId);

			// Apply searchValue to each field that needs to be searched
			if (!empty($searchValue)) {
				$this->db->group_start();
				$this->db->like('firstname', $searchValue);
				// Add more fields here if needed
				$this->db->group_end();
			}

			// Apply other filters
			if ($orgId != null) {
				$this->db->where('org_idd', $orgId);
			}
			if ($clusterId != null) {
				$this->db->where('cluster_idd', $clusterId);
			}
			if ($centerId != null) {
				$this->db->where('center_id', $centerId);
			}
			if ($userRole != null) {
				$this->db->where('user_role', $userRole);
			}

			// Execute the query and get the result
			$result = $this->db->get()->row();

			// If there is a result, return the total count
			if ($result) {
				return $result->total_count;
			}

			// If no result, return 0 (no users found)
			return 0;
		}

		//  USED FUNCTION IN ATTENDANCE >> API >> ORGANISATION >> USER-SERVICE >> fetchUsersWithPaginationAndCountByFilters
		public function getUsersWithPaginationAndLogs(
			$orgId = null,
			$clusterId = null,
			$centerId = null,
			$userRole = null,
			$date = null,
			$selfId = null,
			$orderBy = null,
			$sortOrder = 'asc',
			$searchValue = null,
			$itemsPerPage = 7,
			$page = 1,
			$check = "P"
		) {
			$this->db->select('user_id, firstname, user_role, org_idd, cluster_idd, center_id, picture');
			$this->db->from($this->table);

			if (!empty($selfId)) {
				$this->db->where_not_in($this->table . '.user_id', $selfId);
			}

			if (!empty($orgId)) {
				$this->db->where('org_idd', $orgId);
			}

			if (!empty($clusterId)) {
				$this->db->where('cluster_idd', $clusterId);
			}

			if (!empty($centerId)) {
				$this->db->where('center_id', $centerId);
			}

			if (!empty($userRole)) {
				$this->db->where('user_role', $userRole);
			}

			// Support for searching
			if (!empty($search)) {
				$this->db->like('firstname', $search);
			}

			// Support for ordering and sorting
			if (!empty($orderBy)) {
				$this->db->order_by($orderBy, $sortOrder);
			}

			if (!empty($searchValue)) {
				$this->db->group_start();
				$this->db->like('firstname', $searchValue);
				$this->db->group_end();
			}
			// Pagination
			if ($itemsPerPage != -1) {
				$offset = ($page - 1) * $itemsPerPage;
				$this->db->limit($itemsPerPage, $offset);
			}

			$users = $this->db->get()->result();

			$rekey_users = array();
			foreach ($users as $user) {
				$rekey_users[$user->user_id] = $user;
			}
			$users = $rekey_users;
			// Fetch user logs for the specified date
			$user_log = $this->getUserLogsByDate($date);

			// Combine user logs with users' data
			foreach ($users as &$user) {
				$user_id = $user->user_id;
				$log = isset($user_log[$user_id]) ? $user_log[$user_id] : (object) [
					'id' => null,
					'date' => $date,
					'login_time' => null,
					'logout_time' => null
				];
				// Check the value of $check variable to include/exclude users
				if ($check == "P" || ($check == "A" && empty($log->id))) {
					$user->log = $log;
					$resultUsers[] = $user;
				} else {
					unset($users[$user_id]);
				}
			}

			$rekey_users = array();
			foreach ($users as $user) {
				$rekey_users[] = $user;
			}
			$users = $rekey_users;
			return $users;
		}
		//  USED FUNCTION IN ATTENDANCE >> API >> ORGANISATION >> USER-SERVICE >> get_users_with_pagination
		private function getUserLogsByDate($date)
		{
			$user_log = $this->db->select('*')
				->from($this->user_log_tbl)
				->where('DATE(' . $this->user_log_tbl . '.date) =', $date)
				->get()
				->result();

			// Create an associative array to hold user logs for easy lookup
			$user_logs_by_user_id = array();
			foreach ($user_log as $log) {
				$user_logs_by_user_id[$log->user_id] = $log;
			}

			return $user_logs_by_user_id;
		}
		// USED FUNCTION IN ATTENDANCE >> VIEW >> USERSERVICE >> getUserLogsByAbsenteeFilter
		public function getUserLogsByDateRange($user_id, $start_date, $end_date)
		{

			$user_data = $this->db->select($this->table . '.user_id, firstname, ' . $this->table . '.user_role, org_idd, cluster_idd, center_id, picture')
				->from($this->table)
				->where($this->table . '.user_id', $user_id)
				->get()
				->row();

			$user_logs = $this->db->select($this->table . '.user_id, firstname, ' . $this->table . '.user_role, org_idd, cluster_idd, center_id, picture, date, login_time, logout_time')
				->from($this->user_log_tbl)
				->where($this->user_log_tbl . '.user_id', $user_id)
				->where($this->user_log_tbl . '.date >=', $start_date)
				->where($this->user_log_tbl . '.date <=', $end_date)
				->join('student', 'student.user_id=' . $this->user_log_tbl . '.user_id', 'right')
				->get()
				->result();

			$list = [];
			$date_range = [];
			for ($day = strtotime($start_date); $day <= strtotime($end_date); $day = strtotime('+1 day', $day)) {
				$date_range[] = date('Y-m-d', $day);
			}

			foreach ($date_range as $day) {
				$log = (object)[
					'date' => $day,
					'login_time' => null,
					'logout_time' => null
				];

				foreach ($user_logs as $user) {
					if ($user->date == $day) {
						$log = (object)[
							'date' => $day,
							'login_time' => $user->login_time,
							'logout_time' => $user->logout_time
						];
						break;
					}
				}

				$list[] = (object)[
					'user_id' => $user_data->user_id,
					'firstname' => $user_data->firstname,
					'user_role' => $user_data->user_role,
					'org_idd' => $user_data->org_idd,
					'cluster_idd' => $user_data->cluster_idd,
					'center_id' => $user_data->center_id,
					'picture' => $user_data->picture,
					'log' => $log
				];
			}

			return $list;
		}

		//  USED FUNCTION IN CSTUDENT >> API >> ORGANISATION >> USER-SERVICE >> fetchUsersWithPaginationAndCountByFilters
		public function getUsersWithPagination(
			$orgId = null,
			$clusterId = null,
			$centerId = null,
			$userRole = null,
			$date = null,
			$selfId = null,
			$orderBy = null,
			$sortOrder = 'asc',
			$searchValue = null,
			$itemsPerPage = 7,
			$page = 1
		): array
		{
			$this->db->select('user_id, student.org_idd, student.cluster_idd, age, block, student.center_id, class, cluster_idd, create_date, created_by, district, email,
            father_name, father_occup, firstname, mobile, mother_name, mother_occup, org_idd, 
            picture, remarks, school_level, school_name, school_status, school_type, sex, socail_status,
            status, update_date, user_role, village,center.center_name, org_name,cluster_name');
			$this->db->from($this->table);
			$this->db->join('organisation', 'organisation.org_id=student.org_idd', 'left');
			$this->db->join('cluster', 'cluster.cluster_id=student.cluster_idd', 'left');
			$this->db->join('center', 'center.center_id=student.center_id', 'left');
			if (!empty($selfId)) {
				$this->db->where_not_in($this->table . '.user_id', $selfId);
			}

			if (!empty($orgId)) {
				$this->db->where('org_idd', $orgId);
			}

			if (!empty($clusterId)) {
				$this->db->where($this->table.'.cluster_idd', $clusterId);
			}

			if (!empty($centerId)) {
				$this->db->where($this->table.'.center_id', $centerId);
			}

			if (!empty($userRole)) {
				$this->db->where($this->table.'.user_role', $userRole);
			}

			// Support for searching
			if (!empty($search)) {
				$this->db->like('firstname', $search);
			}

			// Support for ordering and sorting
			if (!empty($orderBy)) {
				$this->db->order_by($orderBy, $sortOrder);
			}

			if (!empty($searchValue)) {
				$this->db->group_start();
				$this->db->like('firstname', $searchValue);
				$this->db->group_end();
			}
			// Pagination
			if ($itemsPerPage != -1) {
				$offset = ($page - 1) * $itemsPerPage;
				$this->db->limit($itemsPerPage, $offset);
			}
			//echo $this->db->get_compiled_select();
			$users = $this->db->get()->result();
			return $users;
		}
	}
