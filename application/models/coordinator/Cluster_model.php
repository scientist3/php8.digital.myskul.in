<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Cluster_model extends CI_Model
	{
		private $table = "cluster";

		public function create($data = [])
		{
			return $this->db->insert($this->table, $data);
		}

		public function read($org_id = null, $cluster_id = null)
		{
			$this->db->select("$this->table.*, centre.head_id")
				->from($this->table)
				->join('centre', 'centre_id = head_id', 'left');

			if ($cluster_id !== null) {
				$this->db->where("$this->table.cluster_id", $cluster_id);
			}

			return $this->db->get()->result();
		}

		public function read_by_id($id = null)
		{
			return $this->db->select("*")
				->from($this->table)
				->where("$this->table.cluster_id", $id)
				->get()
				->row();
		}

		public function update($data = [])
		{
			return $this->db->where("$this->table.cluster_id", $data['cluster_id'])
				->update($this->table, $data);
		}

		public function delete($id = null)
		{
			$this->db->where("$this->table.cluster_id", $id)
				->delete($this->table);

			return $this->db->affected_rows() > 0;
		}

		public function total_clusters()
		{
			return $this->db->from($this->table)
				->count_all_results();
		}
	}
