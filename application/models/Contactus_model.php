<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus_model extends CI_Model {

	private $table = "contactus";
 
	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("*")
			->from($this->table)
			->order_by('f_date','desc')
			->get()
			->result();
	} 
 	
	public function read_as_list()
	{
		/*$result = $this->db->select("*")
			->from($this->table)
			->order_by('name','asc')
			->get()
			->result();
		$list['']=display('select_patient');
		foreach($result as $row){
			$list[$row->patient_id] = $row->patient_id." - ".$row->firstname;
		}
		return $list;*/
		return null;
	}

	public function read_by_id($id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('f_id',$id)
			->get()
			->row();
	} 
	public function new_messages(){
		return $this->db->where('f_read','0')
			->from($this->table)
			->count_all_results();
	}
	
	public function total_messages(){
		return $this->db->where('f_status','1')
			->from($this->table)
			->count_all_results();
	}
	public function update($data = [])
	{
		return $this->db->where('f_id',$data['f_id'])
			->update($this->table,$data); 
	} 
	public function read_message($id=null){
		$this->db->where('f_id',$id)
			->update($this->table,array('f_read' => '1'));
	}
	public function delete($id = null)
	{
		$this->db->where('f_id',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
  
}
