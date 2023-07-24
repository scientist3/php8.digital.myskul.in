<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

	private $table = "user";
	private $table_std = "student";

	public function valid_url($url)
	{
		//$pattern = "/^((ht|f)tp(s?)\:\/\/|~/|/)?([w]{2}([\w\-]+\.)+([\w]{2,5}))(:[\d]{1,5})?/";
		$pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
		if (!preg_match($pattern, $url)) {
			return FALSE;
		}

		return TRUE;
	}
	public function check_user($data = [])
	{
		return $this->db->select("*")
			->from($this->table)
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
			->from($table_std)
			->join('department', 'department.dprt_id = user.department_id', 'left')
			->where('user.user_id', $user_id)
			->get()
			->row();
	}

	public function profile($user_id = null)
	{
		return $this->db->select("*")
			->from("student")
			->where('user_id', $user_id)
			->get()
			->row();
	}

	// public function get_user_roles1()
	// {
	// 	return $this->db->select('ur_id,ur_role')
	// 		->from('user_role')
	// 		->where('ur_status', '1')
	// 		->get()
	// 		->result_array();
	// }

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


	public function update($data = [])
	{
		return $this->db->where('user_id', $data['user_id'])
			->update("user", $data);
	}


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

	
}
