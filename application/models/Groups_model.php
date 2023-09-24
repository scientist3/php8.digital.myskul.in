<?php defined('BASEPATH') or exit('No direct script access allowed');

class Groups_model extends CI_Model
{
	protected $table = 'groups';

	public function __construct()
	{
		parent::__construct();
	}

	// Create a new record
	public function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	// Read all records
	public function getAll()
	{
		return $this->db->get($this->table)->result();
	}

	// Read a single record by ID
	public function read_by_id($id)
	{
		return $this->db->get_where($this->table, array('g_id' => $id))->row();
	}

	// Update a record by ID
	public function update($data)
	{
		$this->db->where('g_id', $data['g_id']);
		return $this->db->update($this->table, $data);
	}

	// Delete a record by ID
	public function delete($id)
	{
		$this->db->where('g_id', $id);
		return $this->db->delete($this->table);
	}
	public function read_as_list()
	{
		$result = $this->db->select("*")
				->from($this->table)
				->where('status',1)
				->order_by('g_id', 'asc')
				->get()
				->result();

		$list[''] = display('select_group');
		foreach ($result as $row) {
			$list[$row->g_id] = $row->group_name;
		}
		return $list;
	}
}