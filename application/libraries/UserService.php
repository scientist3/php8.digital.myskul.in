<?php

class UserService
{
	private $CI; // CodeIgniter instance
	// private $objCenter;
	private $user_id;

	public function __construct()
	{
		$this->CI = &get_instance(); // Get the CodeIgniter instance
		$this->CI->load->model(
			array(
				'organisation_model',
				'organisation/user1_model' => 'user1_model',
				'organisation/center1_model' => 'center1_model',
				'user_model',
				'userrole_model' => 'UserRole',
				'organisation/OrgnisationClusterModel' => 'OrgCluster',
			)
		);

		$this->user_id						= $this->CI->session->userdata('user_id');
		// $this->center_type_model	= $this->CI->load->model('CenterTypeModel');
	}

	// public function create($data)
	// {
	// 	$this->objCenter = new CenterEOS($data);
	// 	return $this;
	// }

	public function save()
	{
		// Your business logic goes here
	}

	public function fetchLogedInUserDetails()
	{
		return $this->CI->user_model->read_user_by_id($this->user_id);
	}

	public function getUserRoleListAsArray()
	{
		return $this->CI->UserRole->read_basic_as_list();
	}

	public function getUserRoleBasicAsDesignationListAsArray()
	{
		$designation = $this->CI->UserRole->read_all_as_list();
		$l['all'] = 'All';
		foreach ($designation as $k => $v) {
			if ($k != 1 && $k != 2) {
				$l[$k] = $v;
			}
		}
		return $l;
	}

	public function getDistrictListAsArray()
	{
		return getDistrictListAsArray();
	}

	public function fetchOrganisationHeadDetailsByUserId($userId)
	{
		$result = $this->CI->organisation_model->read_orgheads_org($userId);

		if ($result instanceof stdClass) {
			$data['org_id'] 				= $result->org_id;
			$data['org_name'] 			= $result->org_name;
			// $data['orgUserID'] 			= $result->org_head_id;
			// $data['orgFirstName']	= $result->firstname;
		}
		return is_array($data) ? $data : [];
	}

	public function fetchClustersByOrgIdAsList($orgId)
	{
		return $this->CI->OrgCluster->read_clusters_of_org_as_list($orgId);
	}

	public function fetchCentersByClusterIdAsList($arrClusterIds)
	{
		return $this->CI->center1_model->read_centers_of_cluster_as_list($arrClusterIds);
	}

	public function fetchUserAttendenceByOrgIdByClusterIdByCenterByUserRoleByDateByUserId($orgId, $clusterId, $centerId, $userRole, $date, $userId)
	{
		return
			$this->CI->user1_model->get_users(
				$orgId,
				$clusterId,
				$centerId,
				(($userRole == 'all') ? null : $userRole),
				$date,
				$userId
			);
	}

	public function countUsersByFilters($orgId, $clusterId, $centerId, $userRole, $date, $userId)
	{
		// Call the model method to get the count of users
		$totalCount = $this->CI->user1_model->count_users(
			$orgId,
			$clusterId,
			$centerId,
			(($userRole == 'all') ? null : $userRole),
			$date,
			$userId
		);

		return $totalCount;
	}

	public function fetchUsersByFiltersWithPagination(
		$orgId,
		$clusterId,
		$centerId,
		$userRole,
		$date,
		$userId,
		$itemsPerPage,
		$offset
	) {
		// Call the model method to get the paginated users' data
		$usersData = $this->CI->user1_model->get_users_with_pagination(
			$orgId,
			$clusterId,
			$centerId,
			(($userRole == 'all') ? null : $userRole),
			$date,
			$userId,
			$itemsPerPage,
			$offset
		);

		return $usersData;
	}

	public function fetchUserAbsenteesByOrgIdByClusterIdByCenterByUserRoleByDateByUserId($orgId, $clusterId, $centerId, $userRole, $date, $userId)
	{
		return
			$this->CI->user1_model->get_absent_users(
				$orgId,
				$clusterId,
				$centerId,
				(($userRole == 'all') ? null : $userRole),
				$date,
				$userId
			);
	}

	public function countAbsenteesUsersByFilters($orgId, $clusterId, $centerId, $userRole, $date, $userId)
	{
		// Call the model method to get the count of users
		$totalCount = $this->CI->user1_model->count_users(
			$orgId,
			$clusterId,
			$centerId,
			(($userRole == 'all') ? null : $userRole),
			$date,
			$userId
		);

		return $totalCount;
	}

	public function fetchAbsenteesUsersByFiltersWithPagination(
		$orgId,
		$clusterId,
		$centerId,
		$userRole,
		$date,
		$userId,
		$itemsPerPage,
		$offset
	) {
		// Call the model method to get the paginated users' data
		$usersData = $this->CI->user1_model->get_users_with_pagination(
			$orgId,
			$clusterId,
			$centerId,
			(($userRole == 'all') ? null : $userRole),
			$date,
			$userId,
			$itemsPerPage,
			$offset
		);

		return $usersData;
	}
}
// class CenterEOS
// {
// 	private $center_id;
// 	private $center_name;
// 	private $center_head_id;
// 	private $center_cluster_id;
// 	private $center_type_id;

// 	public function __construct($data)
// 	{
// 		if (!empty($data)) {
// 			$this->setData($data);
// 		}
// 	}
// 	// Getter methods

// 	public function getCenterId()
// 	{
// 		return $this->center_id;
// 	}

// 	public function getCenterName()
// 	{
// 		return $this->center_name;
// 	}

// 	public function getCenterHeadId()
// 	{
// 		return $this->center_head_id;
// 	}

// 	public function getCenterClusterId()
// 	{
// 		return $this->center_cluster_id;
// 	}

// 	public function getCenterTypeId()
// 	{
// 		return $this->center_type_id;
// 	}

// 	// Setter methods

// 	public function setCenterId($center_id)
// 	{
// 		$this->center_id = $center_id;
// 	}

// 	public function setCenterName($center_name)
// 	{
// 		$this->center_name = $center_name;
// 	}

// 	public function setCenterHeadId($center_head_id)
// 	{
// 		$this->center_head_id = $center_head_id;
// 	}

// 	public function setCenterClusterId($center_cluster_id)
// 	{
// 		$this->center_cluster_id = $center_cluster_id;
// 	}

// 	public function setCenterTypeId($center_type_id)
// 	{
// 		$this->center_type_id = $center_type_id;
// 	}

// 	// Convert object to array...
// 	public function setData($data)
// 	{
// 		if ($data instanceof stdClass) {
// 			$data = convert_object_to_array($data);
// 		}
// 		if (isset($data['center_id'])) {
// 			$this->center_id = $data['center_id'];
// 		}

// 		if (isset($data['center_name'])) {
// 			$this->center_name = $data['center_name'];
// 		}

// 		if (isset($data['center_head_id'])) {
// 			$this->center_head_id = $data['center_head_id'];
// 		}

// 		if (isset($data['center_cluster_id'])) {
// 			$this->center_cluster_id = $data['center_cluster_id'];
// 		}

// 		if (isset($data['center_type_id'])) {
// 			$this->center_type_id = $data['center_type_id'];
// 		}
// 	}
// 	// Convert object to array
// 	public function toArray()
// 	{
// 		return [
// 			'center_id' => $this->center_id,
// 			'center_name' => $this->center_name,
// 			'center_head_id' => $this->center_head_id,
// 			'center_cluster_id' => $this->center_cluster_id,
// 			'center_type_id' => $this->center_type_id,
// 		];
// 	}
// }
