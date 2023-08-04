<?php

class CenterService
{
	private $CI; // CodeIgniter instance
	private $objCenter;

	public function __construct()
	{
		$this->CI = &get_instance(); // Get the CodeIgniter instance
		$this->CI->load->model(
			array(
				'center_model',
				'user_model',
				'cluster_model',
				'centertypemodel',
			)
		);

		$this->center_type_model = $this->CI->load->model('CenterTypeModel');
	}

	public function create($data)
	{
		$this->objCenter = new CenterEOS($data);
		return $this;
	}

	public function save()
	{
		// Your business logic goes here
	}
	public function fetchCentersByOrgId($intOrgId)
	{
		return $this->CI->center_model->read($intOrgId);
	}

	public function fetchAnimatorListByOrgId($intOrgId)
	{
		return $this->CI->user_model->read_as_list_ani($intOrgId);
	}

	public function fetchClusterListByOrgId($intOrgId)
	{
		return $this->CI->cluster_model->read_as_list_by_org($intOrgId);
	}

	public function fetchCenterTypeAsList()
	{
		return $this->CI->centertypemodel->get_center_as_list();
	}
}

class CenterEOS
{
	private $center_id;
	private $center_name;
	private $center_head_id;
	private $center_cluster_id;
	private $center_type_id;

	public function __construct($data)
	{
		if (!empty($data)) {
			$this->setData($data);
		}
	}
	// Getter methods

	public function getCenterId()
	{
		return $this->center_id;
	}

	public function getCenterName()
	{
		return $this->center_name;
	}

	public function getCenterHeadId()
	{
		return $this->center_head_id;
	}

	public function getCenterClusterId()
	{
		return $this->center_cluster_id;
	}

	public function getCenterTypeId()
	{
		return $this->center_type_id;
	}

	// Setter methods

	public function setCenterId($center_id)
	{
		$this->center_id = $center_id;
	}

	public function setCenterName($center_name)
	{
		$this->center_name = $center_name;
	}

	public function setCenterHeadId($center_head_id)
	{
		$this->center_head_id = $center_head_id;
	}

	public function setCenterClusterId($center_cluster_id)
	{
		$this->center_cluster_id = $center_cluster_id;
	}

	public function setCenterTypeId($center_type_id)
	{
		$this->center_type_id = $center_type_id;
	}

	// Convert object to array...
	public function setData($data)
	{
		if ($data instanceof stdClass) {
			$data = convert_object_to_array($data);
		}
		if (isset($data['center_id'])) {
			$this->center_id = $data['center_id'];
		}

		if (isset($data['center_name'])) {
			$this->center_name = $data['center_name'];
		}

		if (isset($data['center_head_id'])) {
			$this->center_head_id = $data['center_head_id'];
		}

		if (isset($data['center_cluster_id'])) {
			$this->center_cluster_id = $data['center_cluster_id'];
		}

		if (isset($data['center_type_id'])) {
			$this->center_type_id = $data['center_type_id'];
		}
	}
	// Convert object to array
	public function toArray()
	{
		return [
			'center_id' => $this->center_id,
			'center_name' => $this->center_name,
			'center_head_id' => $this->center_head_id,
			'center_cluster_id' => $this->center_cluster_id,
			'center_type_id' => $this->center_type_id,
		];
	}
}
