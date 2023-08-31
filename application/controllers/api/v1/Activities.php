<?php

defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/animator/Animator.php');
class Activities extends 	Animator
{
	private int $user_id;
	private mixed $objActivitiesService;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('ActivitiesService');

		// Authentication
		if (!$this->session->userdata('isRepLogIn') || ($this->session->userdata('user_role') != 2)) {
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
		$this->objActivitiesService = new $this->activitiesservice();
//		var_dump($this->objActivitiesService);
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

	public function studentListWithParemsAsJson(): void
	{
		$this->load->library('ActivitiesService');
		$this->objActivitiesService = new $this->activitiesservice();
		$objFilter = new Filter();
		$filterObject = (object) $objFilter->toArray( $this->getOrgId(), $this->getClusterId(), $this->getActiveCenterId(),$this->input);
		$filterObject->selfId = $this->session->userdata('user_id');

		// Fetch users data with pagination and total count (you need to implement the method in ActivitiesService)

		list($users, $totalCount) = $this->objActivitiesService->fetchStudentWithPaginationAndCountByFilters($filterObject);

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


}
	class Filter
	{
		public $orgId;
		public $clusterId;
		public $centerId;
		public $userRole;
		public $date;
		public $page;
		public $itemsPerPage;
		public $sortBy;
		public $sortOrder;
		public $searchValue;

		public function __construct() {
			// You can initialize any necessary properties here
			// $this->objActivitiesService = ...;
		}
		// Function to convert the object to an array
		public function toArray($orgId, $clusterId, $centerId, $input): array
		{
			$this->extractPaginationParameters($orgId, $clusterId, $centerId, $input);
			return [
				'orgId' => $this->orgId,
				'clusterId' => $this->clusterId,
				'centerId' => $this->centerId,
				'userRole' => $this->userRole,
				'date' => $this->date,
				'page' => $this->page,
				'itemsPerPage' => $this->itemsPerPage,
				'sortBy' => $this->sortBy,
				'sortOrder' => $this->sortOrder,
				'searchValue' => $this->searchValue,
			];
		}

		// Function to set values to properties
		private function extractPaginationParameters($orgId,$clusterId,$centerId, $input): void
		{
			$this->orgId          = $orgId;
			$this->clusterId      = $clusterId;
			$this->centerId       = $centerId;
			$this->userRole       = !empty($input->post('user_role')) ? $input->post('user_role') : '5';
			$this->date           = !empty($input->post('date')) ? $input->post('date') : date('Y-m-d');
			$this->page           = (int)$input->post('page') ?: 1;
			$this->itemsPerPage   = (int)$input->post('length') ?: 10;
			$orderColumnIndex     = (int)$input->post('order')[0]['column'] ?: 1;
			$this->sortOrder      = $input->post('order')[0]['dir'] === 'desc' ? 'desc' : 'asc';
			$this->searchValue    = $input->post('search')['value'] ?: null;

			// Columns data
			$columnsData = array();
			for ($i = 0; $i < count($input->post('columns')); $i++) {
				$columnData = array(
					'data'          => $input->post("columns[$i][data]"),
					'orderable'     => $input->post("columns[$i][orderable]") === 'true',
					'searchable'    => $input->post("columns[$i][searchable]") === 'true',
					'searchValue'   => $input->post("columns[$i][search][value]") ?: null,
					'searchRegex'   => $input->post("columns[$i][search][regex]") === 'true',
				);
				$columnsData[] = $columnData;
			}
			$this->sortBy = $columnsData[$orderColumnIndex]['data'];

		}

	}
