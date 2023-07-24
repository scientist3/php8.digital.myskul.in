<?php defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

	private $table = "user";
	private $table_std = "student";
	private $user_log_tbl = "user_log";

	public function save_login_time($user_id, $user_role)
	{
		date_default_timezone_set("Asia/Kolkata");
		# save if not recorded for today
		$today = date('Y-m-d');
		$log = $this->db->select('*')
			->from($this->user_log_tbl)
			->where('user_id', $user_id)
			->where('date', $today)
			->get()
			->row();
		if (count((array)$log) == 0) {
			#insert
			$data = array(
				'id' => null,
				'date' => $today,
				'login_time' => date('Y-m-d H:m:s'),
				'logout_time' => date('Y-m-d H:i:s', strtotime('1 hour')),
				'user_id' => $user_id,
				'user_role' => $user_role
			);
			$this->db->insert($this->user_log_tbl, $data);
		} else {
			#update
			/*$log->logout_time = date('Y-m-d');
														$data = (array)$log;
														$this->db->where('id',$data['id'])
													->update($this->user_log_tbl ,$data);*/
		}
	}

	public function save_logout_time($user_id, $user_role)
	{
		date_default_timezone_set("Asia/Kolkata");
		# save if not
		$today = date('Y-m-d');
		$log = $this->db->select('*')
			->from($this->user_log_tbl)
			->where('user_id', $user_id)
			->where('date', $today)
			->get()
			->row();
		//print_r($log);die();	
		if (count((array)$log) != 0) {
			$log->logout_time = date('Y-m-d H:m:s');
			$data = (array) $log;
			$this->db->where('id', $data['id'])
				->update($this->user_log_tbl, $data);
		}
	}
	public function check_user($data = [])
	{
		return $this->db->select("*")
			->from($this->table_std)
			->where('email', $data['email'])
			->where('password', $data['password'])
			->where('user_role', $data['user_role'])
			->where('status', 1)
			->get();
	}

	public function check_patient($data = [])
	{
		return $this->db->select("*")
			->from("patient")
			->where('email', $data['email'])
			->where('password', $data['password'])
			->where('status', 1)
			->get();
	}

	public function read_by_id($user_id = null)
	{
		return $this->db->select("user.*, department.name AS department")
			->from('user')
			->join('department', 'department.dprt_id = user.department_id', 'left')
			->where('user.user_id', $user_id)
			->get()
			->row();
	}

	public function update($data = [])
	{
		return $this->db->where('user_id', $data['user_id'])
			->update("user", $data);
	}

	public function profile($user_id = null)
	{
		return $this->db->select("*")
			->from("user")
			->where('user_id', $user_id)
			->get()
			->row();
	}

	// public function get_user_roles()
	// {
	// 	$result = $this->db->select('ur_id,ur_role')
	// 		->from('user_role')
	// 		->where('ur_status', '1')
	// 		->get()
	// 		->result();

	// 	$list[''] = display('select_user_role');
	// 	if (!empty($result)) {
	// 		foreach ($result as $value) {
	// 			$list[$value->ur_id] = display($value->ur_role);
	// 		}
	// 		return $list;
	// 	} else {
	// 		return false;
	// 	}
	// }

	// public function get_user_roles_basic()
	// {
	// 	$result = $this->db->select('ur_id,ur_role')
	// 		->from('user_role')
	// 		->where('ur_status', '1')
	// 		->get()
	// 		->result();

	// 	$list[''] = display('select_user_role');
	// 	if (!empty($result)) {
	// 		foreach ($result as $value) {
	// 			if ($value->ur_id != 1) {
	// 				$list[$value->ur_id] = display($value->ur_role);
	// 			}
	// 		}
	// 		return $list;
	// 	} else {
	// 		return false;
	// 	}
	// }

	// Not Used
	public function notify()
	{
		return $this->db->query('
			SELECT COUNT(*) AS total_app,
				(SELECT COUNT(*) FROM patient) AS total_patient,
				(SELECT COUNT(*) FROM user WHERE user_role = 2) AS total_doctor,
				(SELECT COUNT(*) FROM user WHERE user_role = 3) AS total_representative
			FROM appointment
		')
			->row();
	}
	// Not Used
	public function enquiry()
	{
		return $this->db->select('enquiry_id, name, email, enquiry')
			->from('enquiry')
			->limit(4)
			->order_by('checked', 'asc')
			->order_by('created_date', 'desc')
			->order_by('enquiry_id', 'desc')
			->get()
			->result();
	}


	// Not Used
	public function chart()
	{
		$query1 = $this->db->query('
            SELECT  
                create_date AS date,
                EXTRACT(MONTH FROM create_date) AS month,
                COUNT(patient_id) AS patient
            FROM patient
            WHERE create_date >= DATE_SUB(NOW(),INTERVAL 1 YEAR)
            GROUP BY EXTRACT(YEAR_MONTH FROM create_date)
        ')
			->result();

		$query2 = $this->db->query('
            SELECT 
                create_date AS date,
                EXTRACT(MONTH FROM create_date) AS month,
                COUNT(appointment_id) AS appointment
            FROM appointment
            WHERE create_date >= DATE_SUB(NOW(),INTERVAL 1 YEAR)
            GROUP BY EXTRACT(YEAR_MONTH FROM create_date)
        ')
			->result();

		return [$query1, $query2];
	}

	public function district_list()
	{
		//''  => "Select District",
		$district_list = array(
			'' => 'Select District',
			'Anantnag' => 'Anantnag',
			'Bandipore' => 'Bandipore',
			'Baramulla' => 'Baramulla',
			'Budgam' => 'Budgam',
			'Doda' => 'Doda',
			'Ganderbal' => 'Ganderbal',
			'Jammu' => 'Jammu',
			'Kargil' => 'Kargil',
			'Kathua' => 'Kathua',
			'Kishtwar' => 'Kishtwar',
			'Kulgam' => 'Kulgam',
			'Kupwara' => 'Kupwara',
			'Leh' => 'Leh',
			'Poonch' => 'Poonch',
			'Pulwama' => 'Pulwama',
			'Rajouri' => 'Rajouri',
			'Ramban' => 'Ramban',
			'Reasi' => 'Reasi',
			'Samba' => 'Samba',
			'Shopian' => 'Shopian',
			'Srinagar' => 'Srinagar',
			'Udhampur' => 'Udhampur'
		);
		return $district_list;
	}
}
