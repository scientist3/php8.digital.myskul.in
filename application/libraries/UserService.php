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
class User
{
	// Define all the fields of the users table
	private $user_id;
	private $firstname;
	private $user_role;
	private $org_idd;
	private $cluster_idd;
	private $center_id;
	private $mobile;
	private $email;
	private $password;
	private $picture;
	private $district;
	private $block;
	private $village;
	private $school_type;
	private $school_level;
	private $school_name;
	private $sex;
	private $age;
	private $className;
	private $school_status;
	private $father_name;
	private $father_occup;
	private $mother_name;
	private $mother_occup;
	private $socail_status;
	private $remarks;
	private $created_by;
	private $create_date;
	private $update_date;
	private $status;
	protected $_REQUEST_FORM_STUDENT = [
		'user_id' => NULL,
		'firstname' => NULL,
		'user_role' => NULL,
		'org_idd' => NULL,
		'cluster_idd' => NULL,
		'center_id' => NULL,
		'mobile' => NULL,
		'email' => NULL,
		'password' => NULL,
		'picture' => NULL,
		'district' => NULL,
		'block' => NULL,
		'village' => NULL,
		'school_type' => NULL,
		'school_level' => NULL,
		'school_name' => NULL,
		'sex' => NULL,
		'age' => NULL,
		'class' => NULL,
		'school_status' => NULL,
		'father_name' => NULL,
		'father_occup' => NULL,
		'mother_name' => NULL,
		'mother_occup' => NULL,
		'socail_status' => NULL,
		'remarks' => NULL,
		'created_by' => NULL,
		'create_date' => NULL,
		'update_date' => NULL,
		'status' => NULL,
	];
	// Constructor to set initial values if needed
	public function __construct()
	{
		// You can set initial values here if needed
	}

	// Getters
	public function getUserId()
	{
		return $this->user_id;
	}

	public function getFirstname()
	{
		return $this->firstname;
	}

	public function getUserRole()
	{
		return $this->user_role;
	}

	public function getOrgIdd()
	{
		return $this->org_idd;
	}

	public function getClusterIdd()
	{
		return $this->cluster_idd;
	}

	public function getCenterId()
	{
		return $this->center_id;
	}

	public function getMobile()
	{
		return $this->mobile;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getPicture()
	{
		return $this->picture;
	}

	public function getDistrict()
	{
		return $this->district;
	}

	public function getBlock()
	{
		return $this->block;
	}

	public function getVillage()
	{
		return $this->village;
	}

	public function getSchoolType()
	{
		return $this->school_type;
	}

	public function getSchoolLevel()
	{
		return $this->school_level;
	}

	public function getSchoolName()
	{
		return $this->school_name;
	}

	public function getSex()
	{
		return $this->sex;
	}

	public function getAge()
	{
		return $this->age;
	}

	public function getClass()
	{
		return $this->className;
	}

	public function getSchoolStatus()
	{
		return $this->school_status;
	}

	public function getFatherName()
	{
		return $this->father_name;
	}

	public function getFatherOccup()
	{
		return $this->father_occup;
	}

	public function getMotherName()
	{
		return $this->mother_name;
	}

	public function getMotherOccup()
	{
		return $this->mother_occup;
	}

	public function getSocailStatus()
	{
		return $this->socail_status;
	}

	public function getRemarks()
	{
		return $this->remarks;
	}

	public function getCreatedBy()
	{
		return $this->created_by;
	}

	public function getCreateDate()
	{
		return $this->create_date;
	}

	public function getUpdateDate()
	{
		return $this->update_date;
	}

	public function getStatus()
	{
		return $this->status;
	}

	// Setters
	public function setUserId($user_id)
	{
		$this->user_id = $user_id;
	}

	public function setFirstname($firstname)
	{
		$this->firstname = $firstname;
	}

	public function setUserRole($user_role)
	{
		$this->user_role = $user_role;
	}

	public function setOrgIdd($org_idd)
	{
		$this->org_idd = $org_idd;
	}

	public function setClusterIdd($cluster_idd)
	{
		$this->cluster_idd = $cluster_idd;
	}

	public function setCenterId($center_id)
	{
		$this->center_id = $center_id;
	}

	public function setMobile($mobile)
	{
		$this->mobile = $mobile;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function setPicture($picture)
	{
		$this->picture = $picture;
	}

	public function setDistrict($district)
	{
		$this->district = $district;
	}

	public function setBlock($block)
	{
		$this->block = $block;
	}

	public function setVillage($village)
	{
		$this->village = $village;
	}

	public function setSchoolType($school_type)
	{
		$this->school_type = $school_type;
	}

	public function setSchoolLevel($school_level)
	{
		$this->school_level = $school_level;
	}

	public function setSchoolName($school_name)
	{
		$this->school_name = $school_name;
	}

	public function setSex($sex)
	{
		$this->sex = $sex;
	}

	public function setAge($age)
	{
		$this->age = $age;
	}

	public function setClass($className)
	{
		$this->className = $className;
	}

	public function setSchoolStatus($school_status)
	{
		$this->school_status = $school_status;
	}

	public function setFatherName($father_name)
	{
		$this->father_name = $father_name;
	}

	public function setFatherOccup($father_occup)
	{
		$this->father_occup = $father_occup;
	}

	public function setMotherName($mother_name)
	{
		$this->mother_name = $mother_name;
	}

	public function setMotherOccup($mother_occup)
	{
		$this->mother_occup = $mother_occup;
	}

	public function setSocailStatus($socail_status)
	{
		$this->socail_status = $socail_status;
	}

	public function setRemarks($remarks)
	{
		$this->remarks = $remarks;
	}

	public function setCreatedBy($created_by)
	{
		$this->created_by = $created_by;
	}

	public function setCreateDate($create_date)
	{
		$this->create_date = $create_date;
	}

	public function setUpdateDate($update_date)
	{
		$this->update_date = $update_date;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}

	// toArray() function to convert object properties to an array
	public function toArray()
	{
		return array(
			'user_id' => $this->getUserId(),
			'firstname' => $this->getFirstname(),
			'user_role' => $this->getUserRole(),
			'org_idd' => $this->getOrgIdd(),
			'cluster_idd' => $this->getClusterIdd(),
			'center_id' => $this->getCenterId(),
			'mobile' => $this->getMobile(),
			'email' => $this->getEmail(),
			'password' => $this->getPassword(),
			'picture' => $this->getPicture(),
			'district' => $this->getDistrict(),
			'block' => $this->getBlock(),
			'village' => $this->getVillage(),
			'school_type' => $this->getSchoolType(),
			'school_level' => $this->getSchoolLevel(),
			'school_name' => $this->getSchoolName(),
			'sex' => $this->getSex(),
			'age' => $this->getAge(),
			'class' => $this->getClass(),
			'school_status' => $this->getSchoolStatus(),
			'father_name' => $this->getFatherName(),
			'father_occup' => $this->getFatherOccup(),
			'mother_name' => $this->getMotherName(),
			'mother_occup' => $this->getMotherOccup(),
			'socail_status' => $this->getSocailStatus(),
			'remarks' => $this->getRemarks(),
			'created_by' => $this->getCreatedBy(),
			'create_date' => $this->getCreateDate(),
			'update_date' => $this->getUpdateDate(),
			'status' => $this->getStatus()
		);
	}

	public function setValues($arrValues, $allowDifferentialUpdate = true, $boolDirectSet = false)
	{
		if (true == valArr($arrValues)) {
			if (false == $allowDifferentialUpdate) {
				$arrValues = mergeIntersectArray($this->_REQUEST_FORM_STUDENT, $arrValues);
			} else {
				if (false == valArr($arrValues) || false == valArr($this->_REQUEST_FORM_STUDENT)) {
					$arrValues = [];
				}
				$arrValues = array_intersect_key($arrValues, $this->_REQUEST_FORM_STUDENT);
			}
		}

		if (isset($arrValues['user_id'])) $this->setUserId(trim($arrValues['user_id']));
		if (isset($arrValues['firstname'])) $this->setFirstname(trim($arrValues['firstname']));
		if (isset($arrValues['user_role'])) $this->setUserRole(trim($arrValues['user_role']));
		if (isset($arrValues['org_idd'])) $this->setOrgIdd(trim($arrValues['org_idd']));
		if (isset($arrValues['cluster_idd'])) $this->setClusterIdd(trim($arrValues['cluster_idd']));
		if (isset($arrValues['center_id'])) $this->setCenterId(trim($arrValues['center_id']));
		if (isset($arrValues['mobile'])) $this->setMobile(trim($arrValues['mobile']));
		if (isset($arrValues['email'])) $this->setEmail(trim($arrValues['email']));
		if (isset($arrValues['password'])) $this->setPassword(trim($arrValues['password']));
		if (isset($arrValues['picture'])) $this->setPicture(trim($arrValues['picture']));
		if (isset($arrValues['district'])) $this->setDistrict(trim($arrValues['district']));
		if (isset($arrValues['block'])) $this->setBlock(trim($arrValues['block']));
		if (isset($arrValues['village'])) $this->setVillage(trim($arrValues['village']));
		if (isset($arrValues['school_type'])) $this->setSchoolType(trim($arrValues['school_type']));
		if (isset($arrValues['school_level'])) $this->setSchoolLevel(trim($arrValues['school_level']));
		if (isset($arrValues['school_name'])) $this->setSchoolName(trim($arrValues['school_name']));
		if (isset($arrValues['sex'])) $this->setSex(trim($arrValues['sex']));
		if (isset($arrValues['age'])) $this->setAge(trim($arrValues['age']));
		if (isset($arrValues['class'])) $this->setClass(trim($arrValues['class']));
		if (isset($arrValues['school_status'])) $this->setSchoolStatus(trim($arrValues['school_status']));
		if (isset($arrValues['father_name'])) $this->setFatherName(trim($arrValues['father_name']));
		if (isset($arrValues['father_occup'])) $this->setFatherOccup(trim($arrValues['father_occup']));
		if (isset($arrValues['mother_name'])) $this->setMotherName(trim($arrValues['mother_name']));
		if (isset($arrValues['mother_occup'])) $this->setMotherOccup(trim($arrValues['mother_occup']));
		if (isset($arrValues['socail_status'])) $this->setSocialStatus(trim($arrValues['socail_status']));
		if (isset($arrValues['remarks'])) $this->setRemarks(trim($arrValues['remarks']));
		if (isset($arrValues['created_by'])) $this->setCreatedBy(trim($arrValues['created_by']));
		if (isset($arrValues['create_date'])) $this->setCreateDate(trim($arrValues['create_date']));
		if (isset($arrValues['update_date'])) $this->setUpdateDate(trim($arrValues['update_date']));
		if (isset($arrValues['status'])) $this->setStatus(trim($arrValues['status']));


		// Add other setters for each property...
	}
}

// // Usage example:
// $user = new User();
// $user->setUserId(1);
// $user->setFirstname('John');
// $user->setLastname('Doe');
// $user->setEmail('john@example.com');

// // Get the user data as an array
// $userData = $user->toArray();
// print_r($userData);
