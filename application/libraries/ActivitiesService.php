<?php

	class ActivitiesService
	{
		private $CI; // CodeIgniter instance
		// private $objCenter;
		private $user_id;
		public $objUser;
		public function __construct()
		{
			$this->CI = &get_instance();
			$this->CI->load->model(
				array(
					'user_model',
					'activities_model' => 'ActivitiesModel',
				)
			);

			$this->user_id = $this->CI->session->userdata('user_id');
		}
		public function fetchStudentWithPaginationAndCountByFilters($filterObject): array
		{
			// Call the model method to get the count of users with filters
			$totalCount = $this->CI->ActivitiesModel->getFilteredUserTotalCount(
				$filterObject->orgId,
				$filterObject->clusterId,
				$filterObject->centerId,
				(($filterObject->userRole == 'all') ? null : $filterObject->userRole),
				$filterObject->selfId,
				$filterObject->searchValue // Add search value to the count query
			);
			// Call the model method to get the paginated users and the total count
			// Fetch users data with pagination and filters
			$users = $this->CI->ActivitiesModel->getUsersWithPagination(
				$filterObject->orgId,
				$filterObject->clusterId,
				$filterObject->centerId,
				(($filterObject->userRole == 'all') ? null : $filterObject->userRole),
				$filterObject->date,
				$filterObject->selfId,
				$filterObject->sortBy,
				$filterObject->sortOrder,
				$filterObject->searchValue,
				$filterObject->itemsPerPage,
				$filterObject->page
			);

			// Calculate the total count from the paginated result
			// $totalCount = count($users);

			return array($users, $totalCount);
		}

	}