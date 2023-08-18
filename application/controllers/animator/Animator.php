<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Animator extends CI_Controller
{
	private $userId;
	private $orgId;
	private $clusterId;

	private $objUserService;

	public $data = array();

	public function __construct()
	{
		parent::__construct();

		// Load necessary libraries, User Service and Dashboard Service
		//$this->load->library(['UserService']);
		$this->load->library(['session']);
		$this->load->model(
			array(
				'cluster_model' => 'clusterModel',
				'center_model' => 'centerModel',
				'user_model' => 'userModel',
				'material_model',
			)
		);
		// Authenticate User
		$this->authenticateUser();
		// Load Common Data;
		$this->loadCommonData();
	}

	private function authenticateUser()
	{
		// Authenticate User
		if (
			$this->session->userdata('isRepLogIn') == false
			|| $this->session->userdata('user_role') != Userrole1::ANIMATOR
		) {
			redirect('login');
			// throw new Exception("User not logged in or invalid role");
		}
	}

	// Add other methods specific to OrganisationController here.
	private function loadCommonData()
	{
		$this->userId = $this->session->userdata('user_id');
		//$this->objUserService = $this->userservice;
		// Load Data for Views
		$this->data['organisation'] = $this->getLoggedInUserOrganization();
		$this->data['cluster'] = $this->getLoggedInUserCluster();
		//
		$this->data['user_role_list'] = Userrole1::getBasicRoleNamesAsArray();
	}

	public function getLoggedInUserOrganization()
	{
		// Get the organization ID from the session
		$this->orgId = $this->session->userdata('org_id');

		if (!$this->orgId) {
			throw new Exception('Organization ID is missing.');
		}
		// Load the organization model
		$this->load->model('organisation_model'); // Make sure you have the correct model name

		// Retrieve organization details from the database based on org_id
		$organization = $this->organisation_model->read_by_id($this->orgId);

		return $organization;
	}
	public function getLoggedInUserCluster()
	{
		// Retrieve the cluster head ID (stored as user_id in session)
		$clusterHeadId = $this->session->userdata('user_id');

		if ($clusterHeadId) {
			// Query the cluster table to find the cluster details
			$this->db->select('*');
			$this->db->from('cluster');
			$this->db->where('cluster_head_id', $clusterHeadId);
			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				return $query->row(); // Return the cluster details
			} else {
				return null; // No cluster found for the cluster head
			}
		} else {
			return null; // Cluster head ID is not available in the session
		}
	}
	public function renderView($viewName, $data = [])
	{
		$this->data['content'] = $this->load->view($viewName, $data, true);
		$this->load->view('coordinator/starter/starter_layout', $this->data);
	}

	public function getUserId()
	{
		return $this->userId;
	}
	public function fetchLogedInUserDetails()
	{
		return $this->userModel->read_user_by_id($this->getUserId());
	}
	public function getOrgId()
	{
		return !empty($this->orgId) ? $this->orgId : throw new Exception('Organisation id is missing.');
	}

	public function getClusterId()
	{
		return isset($this->data['cluster']->cluster_id) ? $this->data['cluster']->cluster_id : throw new Exception('Cluster id is missing.');
	}
	public function getObjUserService()
	{
		return $this->objUserService;
	}
}
class Userrole1
{
	const ADMIN = 1;
	const ORGANISATION = 2;
	const CLUSTER_COORDINATOR = 3;
	const ANIMATOR = 4;
	const STUDENT = 5;

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
