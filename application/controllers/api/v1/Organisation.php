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
		if (!$this->session->userdata('isLogIn') || $this->session->userdata('user_role') != 2) {
			redirect('login');
		}

		$this->user_id = $this->session->userdata('user_id');
		$this->objUserService = new $this->userservice();
		$this->data['organisation'] = $this->objUserService->fetchOrganisationHeadDetailsByUserId($this->user_id);
	}

	public function usersListAsJson()
	{
		// Get the page number from the request, default to 1 if not provided
		$page = $this->input->post('page') ? (int) $this->input->post('page') : 1;
		$itemsPerPage = 10; // Number of records per page

		// Other filters (you can update these based on your requirements)
		$this->data['cluster_id'] = $this->input->post('cluster_id');
		$this->data['center_id'] = $this->input->post('center_id');
		$this->data['user_role'] = !empty($this->input->post('user_role')) ? $this->input->post('user_role') : '4';
		$this->data['date'] = !empty($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');

		// Fetch total count of users (you need to implement the method in UserService)
		$totalCount = $this->objUserService->countUsersByFilters(
			$this->data['organisation']['org_id'],
			$this->data['cluster_id'],
			$this->data['center_id'],
			$this->data['user_role'],
			$this->data['date'],
			$this->user_id
		);

		// Calculate the offset for pagination
		$offset = ($page - 1) * $itemsPerPage;

		// Fetch users data with pagination (you need to implement the method in UserService)
		$this->data['users'] = $this->objUserService->fetchUsersByFiltersWithPagination(
			$this->data['organisation']['org_id'],
			$this->data['cluster_id'],
			$this->data['center_id'],
			$this->data['user_role'],
			$this->data['date'],
			$this->user_id,
			$itemsPerPage,
			$offset
		);

		// Construct the JSON response with pagination details
		$response = array(
			'draw' => $this->input->post('draw'), // Required for DataTables to function properly
			'recordsTotal' => $totalCount,
			'recordsFiltered' => $totalCount, // In this case, it's the same as 'recordsTotal'
			'data' => $this->data['users'] // The actual data to be displayed in the DataTable
		);

		// Output the JSON response
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function usersListWithParemsAsJson($page = 1, $itemsPerPage = 10)
	{
		// Get the page number from the request, default to 1 if not provided
		$page = $this->input->post('page') ? (int) $this->input->post('page') : 1;
		$itemsPerPage = 10; // Number of records per page
		// ----------------------------------------------------------------
		$draw = intval($this->input->post('draw')); // Current draw counter
		$start = intval($this->input->post('start')); // Start index of the current page
		$length = intval($this->input->post('length')); // Number of records to show per page


		// Other filters (you can update these based on your requirements)
		$this->data['cluster_id'] = $this->input->post('cluster_id');
		$this->data['center_id'] = $this->input->post('center_id');
		$this->data['user_role'] = !empty($this->input->post('user_role')) ? $this->input->post('user_role') : '4';
		$this->data['date'] = !empty($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');

		// Fetch total count of users (you need to implement the method in UserService)
		$totalCount = $this->objUserService->countUsersByFilters(
			$this->data['organisation']['org_id'],
			$this->data['cluster_id'],
			$this->data['center_id'],
			$this->data['user_role'],
			$this->data['date'],
			$this->user_id
		);

		// Calculate the offset for pagination
		$offset = ($page - 1) * $itemsPerPage;

		// Fetch users data with pagination (you need to implement the method in UserService)
		$this->data['users'] = $this->objUserService->fetchUsersByFiltersWithPagination(
			$this->data['organisation']['org_id'],
			$this->data['cluster_id'],
			$this->data['center_id'],
			$this->data['user_role'],
			$this->data['date'],
			$this->user_id,
			$length,
			$start
		);

		// Construct the JSON response with pagination details
		$response = array(
			'draw' => $this->input->post('draw'), // Required for DataTables to function properly
			'recordsTotal' => $totalCount,
			'recordsFiltered' => $totalCount, // In this case, it's the same as 'recordsTotal'
			'data' => $this->data['users'] // The actual data to be displayed in the DataTable
		);

		$response = array(
			'draw' => $draw,
			'recordsTotal' => $totalCount,
			'recordsFiltered' => $totalCount, // In this case, it's the same as 'recordsTotal'
			'data' => $this->data['users'] // The paginated user data to be displayed in the DataTable
		);
		// Output the JSON response
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}
}

/*defined('BASEPATH') or exit('No direct script access allowed');

class Organisation extends CI_Controller
{
	private $user_id;
	private $objUserService;
	private $data;


	public function __construct()
	{
		parent::__construct();
		$this->load->library('UserService');
		// Authencatication
		if (
			$this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 2
		) {
			redirect('login');
		}

		$this->user_id				= $this->session->userdata('user_id');

		$this->objUserService	= new $this->userservice();

		$this->data['organisation'] = $this->objUserService->fetchOrganisationHeadDetailsByUserId($this->user_id);


		// $this->data['user_role_list'] = $this->objUserService->getUserRoleListAsArray();
		// $this->data['designation'] 		= $this->objUserService->getUserRoleBasicAsDesignationListAsArray();
		// $this->data['district_list']	= $this->objUserService->getDistrictListAsArray();
	}

	public function usersListAsJson()
	{
		// / * ----------------------------------------------  * /
		$this->data['cluster_id']			= $this->input->post('cluster_id');
		$this->data['center_id']			= $this->input->post('center_id');
		$this->data['user_role']			= !empty($this->input->post('user_role')) ? $this->input->post('user_role') : '4';
		$this->data['date']						= !empty($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');
		/ ******************** User Data ************************** /
		$this->data['users'] =
			$this->objUserService->fetchUserAttendenceByOrgIdByClusterIdByCenterByUserRoleByDateByUserId(
				$this->data['organisation']['org_id'],
				$this->data['cluster_id'],
				$this->data['center_id'],
				$this->data['user_role'],
				$this->data['date'],
				$this->user_id
			);
		// echo json_encode($this->data['cluster_list']);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($this->data['users']));
	}
}*/
