<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	require(APPPATH . 'controllers/animator/Animator.php');
	class ActivitiesController extends Animator
	{
		private $user_id;

		public function __construct()
		{
			parent::__construct();

			$this->load->model(
				array(
					'animator/cluster_model' => 'clusterModel',
					'messages/message_model' => 'messageModel'
				)
			);

			$this->user_id = $this->session->userdata('user_id');
		}

		public function loadLists()
		{
			$this->data['org_id']                   = $this->getOrgId();
			$this->data['cluster_id']               = $this->getClusterId();
			$this->data['center_id']                = $this->getActiveCenterId();
			$this->data['user_role']                = '5';
			$this->data['cluster_list']             = $this->clusterModel->read_as_list_by_org($this->getOrgId());
			$this->data['district_list']            = getDistrictListAsArray();
		}

		public function getSessionStudentsByStatus($category,$status)
		{
			$objFilter = new Filter();
			$filterObject = (object) $objFilter->toArray( $this->getOrgId(), $this->getClusterId(), $this->getActiveCenterId(),$this->input);
			$filterObject->selfId = $this->session->userdata('user_id');
			// $totalCount = $this->ActivitiesModel->getFilteredUserTotalCount($filterObject);
			// Fetch users data with pagination and filters
			$users = $this->ActivitiesModel->getUsersWithPagination( $filterObject );
			return  $users;
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
		public $studentFilter;
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
				'studentFilter' => $this->studentFilter,
			];
		}

		private function extractPaginationParameters($orgId, $clusterId, $centerId, $input): void
		{
			if ($input === null) {
				return; // Handle the case when input is null
			}

			$this->orgId = $orgId;
			$this->clusterId = $clusterId;
			$this->centerId = $centerId;

			// Check and assign user_role
			$this->userRole = !empty($input->post('user_role')) ? $input->post('user_role') : '5';

			// Check and assign date
			$this->date = !empty($input->post('date')) ? $input->post('date') : date('Y-m-d');

			$this->page = (int)($input->post('page') ?? 1);
			$this->itemsPerPage = (int)$input->post('length') ?? 10;

			// Check if 'order' array is set and not empty
			if (isset($input->post('order')[0])) {
				$orderColumnIndex = (int)$input->post('order')[0]['column'] ?? 1;
				$this->sortOrder = $input->post('order')[0]['dir'] === 'desc' ? 'desc' : 'asc';
			} else {
				// Provide default values when 'order' array is not set
				$orderColumnIndex = 1;
				$this->sortOrder = 'asc';
			}

			$this->searchValue = $input->post('search')['value'] ?? null;

			// Columns data
			$columnsData = array();
			$columnsInput = $input->post('columns');
			if (is_array($columnsInput)) {
				foreach ($columnsInput as $column) {
					$columnData = array(
						'data' => $column['data'] ?? null,
						'orderable' => isset($column['orderable']) && $column['orderable'] === 'true',
						'searchable' => isset($column['searchable']) && $column['searchable'] === 'true',
						'searchValue' => isset($column['search']['value']) ? $column['search']['value'] : null,
						'searchRegex' => isset($column['search']['regex']) && $column['search']['regex'] === 'true',
					);
					$columnsData[] = $columnData;
				}
			}
			// Check if $orderColumnIndex is within valid range before using it
			if ($orderColumnIndex >= 0 && $orderColumnIndex < count($columnsData)) {
				$this->sortBy = $columnsData[$orderColumnIndex]['data'];
			} else {
				// Provide a default value when $orderColumnIndex is out of range
				$this->sortBy = '';
			}
			// category

			$this->studentFilter = new StudentFiler($input->post('category'),$input->post('status'));
		}
		// Not Used
		function handleStudentStatus( $category, $status ): void
		{
			switch ($status) {
				case StudentStatus::ALL_STUDENTS:
					// Handle All Students
					break;

				case StudentStatus::NOT_SUBMITTED_STUDENTS:
					// Handle Not Submitted Students
					break;

				case StudentStatus::PENDING_APPROVAL:
					// Handle Pending Approval
					break;

				case StudentStatus::COMPLETED_APPROVED:
					// Handle Completed/Approved
					break;

				default:
					// Handle the default case if status doesn't match any constant
					break;
			}
		}

	}
	class StudentFiler {
		public $category;
		public $status;
		public $objCategory;
		public $objStatus;
		public function __construct( $category, $status ) {
			$this->category    = $category;
			$this->status      = $status;
			$this->objCategory = new Category();
			$this->objStatus   = new StudentStatus();
		}
	}
	class Category
	{
		const SESSION_COMPLETED_STUDENTS = "session_completed";
		const CNCP_ENROLLED = "2";
		const CNCP_SUPPORTED = "3";
		const PSYCHO_EDUCATED = "4";
		const PRIMARY_COUNSELING = "5";
		const SECONDARY_TERTIARY_SERVICE = "6";
		const PSYCHO_SOCIAL_WELL_BEING = "7";
		const CARE_PLANS = "8";

	}

	class StudentStatus
	{
		const ALL_STUDENTS = [0,1,2];
		const NOT_SUBMITTED_STUDENTS = 0;
		const PENDING_APPROVAL = 1;
		const COMPLETED_APPROVED = 2;
	}