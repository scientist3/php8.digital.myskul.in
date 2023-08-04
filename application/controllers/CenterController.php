<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CenterController extends CI_Controller
{
	public $userId;
	public $data = array();
	public $objUserService;

	public function __construct()
	{
		parent::__construct();

		// Load necessary libraries, User Service and Dashboard Service
		$this->load->library(['UserService']);
		$this->load->library(['session']);
		$this->load->model(
			array(
				'cluster_model',
				'user_model',
			)
		);

		// Load Common Data;
		$this->loadCommonData();
		// Authenticate User
		$this->authenticateUser();
	}

	private function authenticateUser()
	{
		// Authenticate User
		if (
			$this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != Userrole::ORGANISATION
		) {
			redirect('login');
			// throw new Exception("User not logged in or invalid role");
		}
	}
	private function loadCommonData()
	{
		$this->userId									= $this->session->userdata('user_id');
		$this->objUserService					= $this->userservice;

		// Load Data for Views
		$this->data['organisation']		= $this->objUserService->fetchOrganisationHeadDetailsByUserId($this->userId);
		$this->data['user_role_list']	= $this->objUserService->getUserRoleListAsArray();
		$_POST['cluster_org_id'] 			= $this->data['organisation']['org_id'];

		$this->data['coodinator_list'] 					= $this->getUserService()->getCoordinatorList($this->data['organisation']['org_id']);
		$this->data['clusters'] 								= $this->fetchClusterList($this->data['organisation']['org_id']);
	}

	public function getUserService()
	{
		return $this->objUserService;;
	}
	/* -------- Start Section CCluster ------------ */
	public function getClusterObject()
	{
		$objCluster = new Cluster();
		$objCluster->setValues($this->input->post());
		return $objCluster;
	}

	public function validateClusterForm()
	{
		$this->form_validation->set_rules('cluster_name', display('cluster_name'), 'required|max_length[150]');
		$this->form_validation->set_rules('cluster_head_id', display('cluster_head_id'), 'required');
		$this->form_validation->set_error_delimiters('<p class="text-sm mb-0">', '</p>');
	}

	public function fetchClustersByOrganizationId($org_id)
	{
		$this->objUserService->user_model->fetchClustersByOrgIdAsList($org_id);
	}
	/**
	 * Fetches the list of clusters with additional details such as organization name and coordinator's firstname.
	 *
	 * @param int|null $org_id Optional. The organization ID to filter the clusters by. Default is null.
	 *
	 * @return array An array of cluster objects with details. Each object contains properties like 'cluster_id',
	 *               'org_name', 'firstname', etc.
	 */
	public function fetchClusterList($org_id)
	{
		return $this->cluster_model->fetchClusterListWithDetails($org_id);
	}

	public function fetchClusterDetailsWithCentersWithCounts($org_id)
	{
		return $this->cluster_model->fetchClusterDetailsWithCentersWithCounts($org_id);
	}

	public function fetchInterventionAreasDetailsWithStudentCountByClusterId($clusterId)
	{
		if ($clusterId != null) {
			return $this->cluster_model->fetchInterventionAreasDetailsWithStudentCountByClusterId($clusterId);
		} else {
			return [];
		}
	}

	public function addOrUpdateCenter($objCluster)
	{
		if (empty($objCluster->getClusterId())) {
			/*********** Create new cluster*************/
			if ($this->form_validation->run() === true) {
				if ($this->cluster_model->create($objCluster->toArray())) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
					throw new Exception("Please Try Again.");
				}
				redirect('organisation/ccluster/create');
			} else {
				$this->data['content'] = $this->load->view('organisation/cluster/form', $this->data, true);
				$this->load->view('organisation/starter/starter_layout', $this->data);
			}
		} else {
			/*********** Update cluster*************/
			if ($this->form_validation->run() === true) {
				if ($this->cluster_model->update($objCluster->toArray())) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
					throw new Exception("Please Try Again.");
				}
				redirect('organisation/ccluster/create');
			} else {
				$this->session->set_flashdata('exception', display('please_try_again') . "" . validation_errors());
				throw new Exception("Please Try Again.");
			}
		}
	}

	public function deleteCenter($center_id)
	{
		// Check if this center is being used anywhere
		if ($this->center_model->fetchCountByCenterId($center_id)) {
			$this->session->set_flashdata('exception', 'This Center is being used with User');
			return;
		}
		if ($this->center_model->delete($center_id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
	}
}

class Cluster
{
	private $cluster_id;
	private $cluster_name;
	private $cluster_org_id;
	private $cluster_head_id;

	// Getter and Setter for clusterId
	public function getClusterId()
	{
		return $this->cluster_id;
	}

	public function setClusterId($clusterId)
	{
		$this->cluster_id = $clusterId;
	}

	// Getter and Setter for clusterName
	public function getClusterName()
	{
		return $this->cluster_name;
	}

	public function setClusterName($clusterName)
	{
		$this->cluster_name = $clusterName;
	}

	// Getter and Setter for clusterOrgId
	public function getClusterOrgId()
	{
		return $this->cluster_org_id;
	}

	public function setClusterOrgId($clusterOrgId)
	{
		$this->cluster_org_id = $clusterOrgId;
	}

	// Getter and Setter for clusterHeadId
	public function getClusterHeadId()
	{
		return $this->cluster_head_id;
	}

	public function setClusterHeadId($clusterHeadId)
	{
		$this->cluster_head_id = $clusterHeadId;
	}

	// Set values from an associative array
	public function setValues($data)
	{
		if (is_array($data)) {
			if (isset($data['cluster_id'])) {
				$this->setClusterId($data['cluster_id']);
			}
			if (isset($data['cluster_name'])) {
				$this->setClusterName($data['cluster_name']);
			}
			if (isset($data['cluster_org_id'])) {
				$this->setClusterOrgId($data['cluster_org_id']);
			}
			if (isset($data['cluster_head_id'])) {
				$this->setClusterHeadId($data['cluster_head_id']);
			}
		}
	}

	// Convert object properties to an associative array using getter methods
	public function toArray()
	{
		$data = [
			'cluster_id' 			=> $this->getClusterId(),
			'cluster_name' 		=> $this->getClusterName(),
			'cluster_org_id' 	=> $this->getClusterOrgId(),
			'cluster_head_id' => $this->getClusterHeadId(),
		];

		return $data;
	}

	// Convert only set values to an associative array
	public function toArraySetValuesOnly()
	{
		$data = [];
		$properties = get_object_vars($this);

		foreach ($properties as $key => $value) {
			if ($value !== null) {
				$data[$key] = $value;
			}
		}

		return $data;
	}
}
