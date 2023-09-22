<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Animator extends CI_Controller
{
	private int $intUserId;
	private int $intOrgId;
	private int $intClusterId;
	private int $active_center_id;
	private array $arrCenterIds;
	public array $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->library(['session']);
		$this->load->model(
			array(
				'cluster_model' => 'clusterModel',
				'center_model' => 'centerModel',
				'user_model' => 'userModel',
				'material_model',
				'activities_model' => 'ActivitiesModel',
				'stakeholder_model' => 'StakeholderModel',
				'Stakeholder_type_model' => 'StakeholderTypeModel',
				'SocialParityModel' => 'SocialParty'
			)
		);
		$this->authenticateUser();
		$this->loadCommonData();
		$this->loadActiveCenter();
	}

	private function authenticateUser(): void
	{
		if (
			$this->session->userdata('isRepLogIn') == false
			|| $this->session->userdata('user_role') != Userrole1::ANIMATOR
		) {
			redirect('login');
		}
	}

	/**
	 * @throws Exception
	 */
	private function loadCommonData(): void
	{
		$this->intUserId                = $this->session->userdata('user_id');
		$this->intClusterId             = $this->session->userdata('cluster_id');
		$this->data['organisation'] 	  = $this->getLoggedInUserOrganization();
		$this->data['cluster']          = $this->getLoggedInUserCluster();
		$this->data['assigned_centers'] = $this->fetchLoggedInUserCenterList();
		$this->data['user_role_list'] 	= Userrole1::getBasicRoleNamesAsArray();
		$this->arrCenterIds				      = rekeyStdClassArray('center_id',$this->data['assigned_centers']);
		$this->data['center_list']  = $this->getAllocatedCentersAsList();
	}

	private function loadActiveCenter(): void
	{
		if ( count( $this->arrCenterIds ) == 0 ) {
			//top_menu_center_list
			$this->session->set_flashdata('exception', 'No center assigned yet. please contact cluster head/ organisation head/ admin.');
			$this->session->set_userdata('isRepLogIn','');
			redirect('login');
		}

		if(!$this->session->has_userdata('active_center_id')){
			$this->session->set_userdata('active_center_id',key($this->arrCenterIds));
		}

		$this->session->set_userdata('top_menu_center_list',$this->arrCenterIds);

		// Optional Check
		if (!$this->session->has_userdata('active_center_id') ) {
			$this->session->set_flashdata('exception', 'Please select active center displayed on the top menu __^');
		}else{
			$this->active_center_id = $this->session->userdata('active_center_id');
			$ActiveCenterName = $this->centerModel->read_by_id($this->active_center_id)->center_name;
			$this->session->set_flashdata('active_center', 'Active Center is [ '.$ActiveCenterName.' ]');
			//header("refresh"current_url());
		}
	}

	public function getLoggedInUserOrganization()
	{
		$this->intOrgId = $this->session->userdata('org_id');

		if (!$this->intOrgId) {
			//throw new Exception('Organization ID is missing.');
			redirect('login');
		}
		$this->load->model('organisation_model');
		return $this->organisation_model->read_by_id($this->intUserId);
	}

	public function getLoggedInUserCluster()
	{
		$userId = $this->session->userdata('user_id');

		if ($userId) {
			$this->db->select('c.*');
			$this->db->from('student s');
			$this->db->join('cluster c', 's.cluster_idd = c.cluster_id');
			$this->db->where('s.user_id', $userId);

			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return null;
			}
		} else {
			return null;
		}
	}

	public function getSessionClusterId()
	{
		return $this->session->userdata('cluster_id');
	}

	public function fetchLoggedInUserCenterList()
	{
		$centerHeadId = $this->session->userdata('user_id');
		$this->db->where('center_head_id', $centerHeadId);
		$query = $this->db->get('center');

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return array();
		}
	}

	public function renderView($viewName, $data = [])
	{
		$this->data['content'] = $this->load->view($viewName, $data, true);
		$this->load->view('animator/starter/starter_layout', $this->data);
	}

	public function getUserId()
	{
		return $this->intUserId;
	}

	public function fetchLogedInUserDetails()
	{
		return $this->userModel->read_user_by_id($this->getUserId());
	}

	public function getOrgId()
	{
		if (empty($this->intOrgId) && empty($this->session->userdata('org_id'))) {
			throw new Exception('Organisation id is missing.');
		}
		return $this->intOrgId ?? $this->session->userdata('org_id');
	}

	public function getClusterId()
	{
		if (isset($this->data['cluster']->cluster_id)) {
			return $this->data['cluster']->cluster_id;
		} else {
			throw new Exception('Cluster id is missing.');
		}
	}

	public function getActiveCenterId(): int
	{
		return $this->active_center_id;
	}
	public function getArrCenterIds(): array
	{
		return $this->arrCenterIds;
	}

	public function getAllocatedCentersAsList(): array
	{
		$data = [];
		foreach ($this->arrCenterIds as $centerId => $center) {
			$data[$centerId] = $center->center_name;
		}
		return $data;
	}
}

class Userrole1
{
	const ADMIN = 1;
	const ORGANISATION = 2;
	const CLUSTER_COORDINATOR = 3;
	const ANIMATOR = 4;
	const STUDENT = 5;

	const STAKEHOLDER= 6;

		public static function getRoleName($role)
		{
			switch ($role) {
				case self::ADMIN:
					return 'Admin';
				case self::ORGANISATION:
					return 'Organisation';
				case self::CLUSTER_COORDINATOR:
					return 'Cluster Coordinator';
				case self::ANIMATOR:
					return 'Animator';
				case self::STUDENT:
					return 'Student';
				case self::STAKEHOLDER:
					return 'Stakeholder';
				default:
					return 'Unknown';
			}
		}

		public static function getAllRoleNamesAsArray()
		{
			return array(
				self::ADMIN => 'Admin',
				self::ORGANISATION => 'Organisation',
				self::CLUSTER_COORDINATOR => 'Cluster Coordinator',
				self::ANIMATOR => 'Animator',
				self::STUDENT => 'Student'
			);
		}

		public static function getBasicRoleNamesAsArray()
		{
			return array(
				" " => 'Select User Role',
				self::ORGANISATION => 'Organisation',
				self::CLUSTER_COORDINATOR => 'Cluster Coordinator',
				self::ANIMATOR => 'Animator',
				self::STUDENT => 'Student'
			);
		}
		public static function getCASRoleNamesAsArray()
		{
			return array(
				" " => 'Select User Role',
				self::CLUSTER_COORDINATOR => 'Cluster Coordinator',
				self::ANIMATOR => 'Animator',
				self::STUDENT => 'Student'
			);
		}

		// public static function getStatus($type)
		// {
		// 	switch ($type) {
		// 		case self::CHILD_FRIENDLY_SPACE:
		// 		case self::ADOLESCENT_RESOURCE_CENTRE:
		// 			return 1;
		// 		default:
		// 			return 0;
		// 	}
		// }
	}

