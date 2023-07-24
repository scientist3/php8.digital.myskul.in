<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Message_model extends CI_Model {

	private $table = 'message';

	public function create($data = []) {
		return $this->db->insert($this->table,$data);
	}
 
	public function inbox($user_id) {
		return $this->db->select("message.*, 
				CONCAT_WS(' ', user.firstname, user.lastname) as sender_name")
			->from("message")
			->join('user', 'user.user_id = message.sender_id')
			->where('message.receiver_id', $user_id)
			->where_not_in('message.receiver_status', 2)
			->order_by('message.id','desc')
			->order_by('message.datetime','desc')
			->get()
			->result();
	}

	public function new_messages_for_patient($user_id) {
		return $this->db->select("message.*, 
				CONCAT_WS(' ', user.firstname, user.lastname) as sender_name")
			->from("message")
			->join('user', 'user.user_id = message.sender_id')
			->where('message.receiver_id', $user_id)
			->where('message.receiver_status',0)
			->where_not_in('message.receiver_status', 2)
			->order_by('message.id','desc')
			->order_by('message.datetime','desc')
			->count_all_results();
	}
	
	public function new_messages_for_user($user_id) {
		return $this->db->select("message.*, 
				student.firstname as sender_name")
			->from("message")
			->join('student', 'student.user_id = message.sender_id')
			->where('message.receiver_id', $user_id)
			->where('message.receiver_status',0)
			->where_not_in('message.receiver_status', 2)
			->order_by('message.id','desc')
			->order_by('message.datetime','desc')
			->count_all_results();
	}

	public function inboxp($user_id) {
		return $this->db->select("message.*, 
				patient.firstname as sender_name")
			->from("message")
			->join('patient', 'patient.patient_id = message.sender_id')
			->where('message.receiver_id', $user_id)
			->where_not_in('message.receiver_status', 2)
			->order_by('message.id','desc')
			->order_by('message.datetime','desc')
			->get()
			->result();
	}
	
	public function inbox_of_student($user_id,$sender_id){
		return $this->db->select("message.*, 
				student.firstname as sender_name")
			->from("message")
			->join('student', 'student.user_id = message.sender_id')
			->where('message.receiver_id', $user_id)
			->where('message.sender_id', $sender_id)
			->where_not_in('message.receiver_status', 2)
			->order_by('message.id','desc')
			->order_by('message.datetime','desc')
			->get()
			->result();
	}
	
	public function inbox_groupby_sender($user_id) {
		return $this->db->select("message.*, 
				student.firstname as sender_name")
			->from("message")
			->join('student', 'student.user_id = message.sender_id')
			->where('message.receiver_id', $user_id)
			->where_not_in('message.receiver_status', 2)
			->order_by('message.id','desc')
			->order_by('message.datetime','desc')
			->group_by('student.user_id')
			->get()
			->result();
	}
 
	public function sent($user_id) {
		return $this->db->select("message.*, 
				CONCAT_WS(' ', user.firstname, user.lastname) as receiver_name")
			->from("message")
			->join('user', 'user.user_id = message.receiver_id')
			->where('message.sender_id', $user_id)
			->where_not_in('message.sender_status', 2)
			->order_by('message.id','desc')
			->order_by('message.sender_status','asc')
			->get()
			->result();
	}

	public function sentp($user_id) {
		return $this->db->select("message.*, 
				patient.firstname as receiver_name")
			->from("message")
			->join('patient', 'patient.patient_id = message.receiver_id')
			->where('message.sender_id', $user_id)
			->where_not_in('message.sender_status', 2)
			->order_by('message.id','desc')
			->order_by('message.sender_status','asc')
			->get()
			->result();
	} 
	
	public function sent_of_patient($user_id,$receiver_id){
		
		// return $this->db->select("message.*, 
		// 		student.firstname as sender_name")
		// 	->from("message")
		// 	->join('student', 'student.user_id = message.sender_id')
		// 	->where('message.receiver_id', $user_id)
		// 	->where('message.sender_id', $sender_id)
		// 	->where_not_in('message.receiver_status', 2)
		// 	->order_by('message.id','desc')
		// 	->order_by('message.datetime','desc')
		// 	->get()
		// 	->result();

		return $this->db->select("message.*, 
				student.firstname as receiver_name")
			->from("message")
			->join('student', 'student.user_id = message.receiver_id')
			->where('message.sender_id', $user_id)
			->where('student.user_id', $receiver_id)
			->where_not_in('message.sender_status', 2)
			->order_by('message.id','desc')
			->order_by('message.sender_status','asc')
			->get()
			->result();
	}
	
	public function sent_groupby_patient($user_id){
		/*return $this->db->select("message.*, 
				student.firstname as sender_name")
			->from("message")
			->join('student', 'student.user_id = message.sender_id')
			->where('message.receiver_id', $user_id)
			->where_not_in('message.receiver_status', 2)
			->order_by('message.id','desc')
			->order_by('message.datetime','desc')
			->group_by('student.user_id')
			->get()
			->result(); */

		return $this->db->select("message.*, 
				student.firstname as receiver_name")
			->from("message")
			->join('student', 'student.user_id = message.receiver_id')
			->where('message.sender_id', $user_id)
			->where_not_in('message.sender_status', 2)
			->order_by('message.id','desc')
			->order_by('message.sender_status','asc')
			->group_by('student.user_id')
			->get()
			->result();
	}
	
	public function inbox_information($id = null, $sender_id = null, $receiver_id = null) { 
		return $this->db->select("message.*, 
				student.firstname as sender_name")
			->from("message")
			->join('student', 'student.user_id = message.sender_id')
			->where('message.receiver_id', $receiver_id)
			->where('message.id', $id)
			//->where_not_in('message.receiver_status', 2)
			//->order_by('message.id','desc')
			//->order_by('message.receiver_status','asc')
			->get()
			->row();
	} 
 
	public function sent_information($id = null, $user_id = null) {
		/*
		return $this->db->select("message.*, 
				student.firstname as sender_name")
			->from("message")
			->join('student', 'student.user_id = message.sender_id')
			->where('message.receiver_id', $receiver_id)
			->where('message.id', $id)
			//->where_not_in('message.receiver_status', 2)
			//->order_by('message.id','desc')
			//->order_by('message.receiver_status','asc')
			->get()
			->row(); */
		return $this->db->select("message.*, 
				student.firstname as receiver_name")
			->from("message")
			->join('student', 'student.user_id = message.receiver_id')
			->where('message.sender_id', $user_id)
			->where('message.id', $id)
			// ->where_not_in('message.sender_status', 2)
			// ->order_by('message.id','desc')
			// ->order_by('message.sender_status','asc')
			->get()
			->row();
	}

	public function sent_informationp($id = null, $user_id = null) {
		return $this->db->select("message.*, 
				patient.firstname as receiver_name")
			->from("message")
			->join('patient', 'patient.patient_id = message.receiver_id')
			->where('message.sender_id', $user_id)
			->where('message.id', $id)
			->where_not_in('message.sender_status', 2)
			->order_by('message.id','desc')
			->order_by('message.sender_status','asc')
			->get()
			->row();
	} 
 
	public function update($data = []) {
		return $this->db->where('id',$data['id'])
			->update($this->table,$data); 
	} 
 
	public function delete($id = null, $condition = null) {
		$this->db->where('id',$id)
			->set($condition, 2)
			->update($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

	public function user_list($user_id = null, $where = []) {
		$result = $this->db->select("user_id, firstname AS fullname ")
			->from("student")
			->where_not_in('user_id', $user_id)
			->where_in('user_id', $where)
			->where('status',1)
			->order_by('fullname', 'asc')
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

	public function user_list_for_patient($user_id = null)
	{
		$result = $this->db->select("user_id, CONCAT_WS(' ',firstname, lastname) AS fullname ")
			->from("user")
			//->where_not_in('user_id', $user_id)
			->where('user_role',1)
			->where('status',1)
			->order_by('fullname', 'asc')
			->get()
			->result();

		//$list[''] = display('select_user');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->user_id] = $value->fullname; 
			}
			return $list;
		} else {
			return false;
		}
	}

	public function patient_list($user_id = null)
	{
		$result = $this->db->select("id,patient_id, firstname ")
			->from("patient")
			//->where_not_in('user_id', $user_id)
			->where('status',1)
			->order_by('firstname', 'asc')
			->get()
			->result();

		$list[''] = display('select_user');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->patient_id] = $value->patient_id.' - '.$value->firstname; 
			}
			return $list;
		} else {
			return false;
		}
	}
	
}


