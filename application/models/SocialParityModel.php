<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	class SocialParityModel extends CI_Model
	{
		protected $table = 'social_parity';

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
		public function getById($id)
		{
			return $this->db->get_where($this->table, array('id' => $id))->row();
		}

		// Update a record by ID
		public function update($id, $data)
		{
			$this->db->where('id', $id);
			return $this->db->update($this->table, $data);
		}

		// Delete a record by ID
		public function delete($id)
		{
			$this->db->where('id', $id);
			return $this->db->delete($this->table);
		}
	}
	class SocialParity {
		const APL = 1;
		const BPL = 2;
		const AAY = 3;
		const SC = 4;
		const ST = 5;
		const OBC = 6;
		const OM = 7;

		public static function getCategoryName($category)
		{
			switch ($category) {
				case self::APL:
					return 'Above Poverty Line (APL)';
				case self::BPL:
					return 'Below Poverty Line (BPL)';
				case self::AAY:
					return 'Antyodaya Anna Yojana (AAY)';
				case self::SC:
					return 'Scheduled Caste (SC)';
				case self::ST:
					return 'Scheduled Tribe (ST)';
				case self::OBC:
					return 'Other Backward Class (OBC)';
				case self::OM:
					return 'Open Category (OM)';
				default:
					return 'Unknown';
			}
		}

		public static function getAllCategoriesAsArray()
		{
			return array(
				self::APL => 'Above Poverty Line (APL)',
				self::BPL => 'Below Poverty Line (BPL)',
				self::AAY => 'Antyodaya Anna Yojana (AAY)',
				self::SC => 'Scheduled Caste (SC)',
				self::ST => 'Scheduled Tribe (ST)',
				self::OBC => 'Other Backward Class (OBC)',
				self::OM => 'Open Category (OM)'
			);
		}
	}