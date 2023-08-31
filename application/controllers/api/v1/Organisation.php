<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Organisation extends CI_Controller
{
	private $user_id;
	private $objUserService;
	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('UserService');

		// Authentication
		if (!$this->session->userdata('isRepLogIn') || $this->session->userdata('user_role') != 2) {
			$response = array(
				'success' => false,
				'message' => "Unauthorized Access"
			);

			// Output the JSON response
			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
		}

		$this->user_id = $this->session->userdata('user_id');
		$this->objUserService = new $this->userservice();
//		var_dump($this->objUserService);
		$this->data['organisation']		= $this->getLoggedInUserOrganization();
		$this->data['organisation'] = $this->getLoggedInUserOrganization();
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
	private function extractPaginationParameters()
	{
		if($this->objUserService == null){
			$this->load->library('UserService');
			$this->data['organisation'] = $this->getLoggedInUserOrganization();
			$this->objUserService = new $this->userservice();
		}
		$page = (int)$this->input->post('page') ?: 1;
		$itemsPerPage = (int)$this->input->post('length') ?: 10;
		$orderColumnIndex = (int)$this->input->post('order')[0]['column'] ?: 1;
		$sortOrder = $this->input->post('order')[0]['dir'] === 'desc' ? 'desc' : 'asc';
		$searchValue = $this->input->post('search')['value'] ?: null;

		// Columns data
		$columnsData = array();
		for ($i = 0; $i < count($this->input->post('columns')); $i++) {
			$columnData = array(
				'data' => $this->input->post("columns[$i][data]"),
				'orderable' => $this->input->post("columns[$i][orderable]") === 'true',
				'searchable' => $this->input->post("columns[$i][searchable]") === 'true',
				'searchValue' => $this->input->post("columns[$i][search][value]") ?: null,
				'searchRegex' => $this->input->post("columns[$i][search][regex]") === 'true',
			);
			$columnsData[] = $columnData;
		}
		$sortBy = $columnsData[$orderColumnIndex]['data'];

		// Additional parameters
		$clusterId = $this->input->post('cluster_id');
		$centerId = $this->input->post('center_id');
		$userRole = !empty($this->input->post('user_role')) ? $this->input->post('user_role') : '4';
		$date = !empty($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');

		$check = !empty($this->input->post('check')) ? $this->input->post('check') : 'P';

		return array(
			$clusterId,
			$centerId,
			$userRole,
			$date,
			$page,
			$itemsPerPage,
			$sortBy,
			$sortOrder,
			$searchValue,
			$check
		);
	}

	public function usersListWithParemsAsJson()
	{
		// Extract pagination parameters using the function
		list(
			$clusterId,
			$centerId,
			$userRole,
			$date,
			$page,
			$itemsPerPage,
			$orderBy,
			$sortOrder,
			$searchValue,
			$check
			) = $this->extractPaginationParameters();


		// Fetch users data with pagination and total count (you need to implement the method in UserService)

		list($users, $totalCount) = $this->objUserService->fetchUsersWithPaginationAndCountByFilters(
			$this->getOrgId(),
			$clusterId,
			$centerId,
			$userRole,
			$date,
			$this->user_id,
			$itemsPerPage,
			$page,
			$orderBy,
			$sortOrder,
			$searchValue,
			$check
		);

		// Construct the JSON response with pagination details
		$response = array(
			'draw' => intval($this->input->post('draw')), // Current draw counter
			'recordsTotal' => $totalCount,
			'recordsFiltered' => $totalCount,
			'data' => $users // The paginated user data to be displayed in the DataTable
		);

		// Output the JSON response
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function studentListWithParemsAsJson()
	{
		// Extract pagination parameters using the function
		list(
			$clusterId,
			$centerId,
			$userRole,
			$date,
			$page,
			$itemsPerPage,
			$orderBy,
			$sortOrder,
			$searchValue,
			$check
			) = $this->extractPaginationParameters();


		// Fetch users data with pagination and total count (you need to implement the method in UserService)

		list($users, $totalCount) = $this->objUserService->fetchStudentWithPaginationAndCountByFilters(
			$this->getOrgId(),
			$clusterId,
			$centerId,
			$userRole,
			$date,
			$this->user_id,
			$itemsPerPage,
			$page,
			$orderBy,
			$sortOrder,
			$searchValue,
			$check
		);

		// Construct the JSON response with pagination details
		$response = array(
			'draw' => intval($this->input->post('draw')), // Current draw counter
			'recordsTotal' => $totalCount,
			'recordsFiltered' => $totalCount,
			'data' => $users // The paginated user data to be displayed in the DataTable
		);

		// Output the JSON response
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function getOrgId()
	{
		return !empty($this->orgId) ? $this->orgId : throw new Exception('Organisation id is missing.');
	}

}
