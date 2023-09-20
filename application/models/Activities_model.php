<?php defined('BASEPATH') or exit('No direct script access allowed');

class Activities_model extends CI_Model
{
	private $table = "student";
	private $user_log_tbl = "user_log";
	//  USED FUNCTION IN CSTUDENT >> API >> ORGANISATION >> USER-SERVICE >> fetchUsersWithPaginationAndCountByFilters
	public function getUsersWithPagination($filterObject): array
	{
		$this->db->select('user_id, student.org_idd, student.cluster_idd, student.center_id, session_status, cncp_status, cncp_supported_status, psycho_educated_status, primary_counselling_status, secondary_counselling_status,well_being_status, care_plan_status, age, block, student.center_id, class, cluster_idd, create_date, created_by, district, email,
            father_name, father_occup, firstname, mobile, mother_name, mother_occup, org_idd, 
            picture, remarks, school_level, school_name, school_status, school_type, sex, socail_status,
            status, update_date, user_role,  village,center.center_name, org_name,cluster_name');
		$this->db->from($this->table);
		$this->db->join('organisation', 'organisation.org_id=student.org_idd', 'left');
		$this->db->join('cluster', 'cluster.cluster_id=student.cluster_idd', 'left');
		$this->db->join('center', 'center.center_id=student.center_id', 'left');

		if (!empty($filterObject->selfId)) {
			$this->db->where_not_in($this->table . '.user_id', $filterObject->selfId);
		}

		if (!empty($filterObject->orgId)) {
			$this->db->where('org_idd', $filterObject->orgId);
		}

		if (!empty($filterObject->clusterId)) {
			$this->db->where($this->table . '.cluster_idd', $filterObject->clusterId);
		}

		if (!empty($filterObject->centerId)) {
			$this->db->where($this->table . '.center_id', $filterObject->centerId);
		}

		$userRole = ($filterObject->userRole == 'all') ? null : $filterObject->userRole;
		if (!empty($userRole)) {
			$this->db->where($this->table . '.user_role', $userRole);
		}

		// Support for searching
		if (!empty($search)) {
			$this->db->like('firstname', $search);
		}

		// Support for ordering and sorting
		if (!empty($filterObject->sortBy)) {
			$this->db->order_by($filterObject->sortBy, $filterObject->sortOrder);
		}

		if (!empty($filterObject->searchValue)) {
			$this->db->group_start();
			$this->db->like('firstname', $filterObject->searchValue);
			$this->db->group_end();
		}
		// Pagination
		//			if ($filterObject->itemsPerPage != -1) {
		//				$offset = ($filterObject->page - 1) * $filterObject->itemsPerPage;
		//				$this->db->limit($filterObject->itemsPerPage, $offset);
		//			}
		$this->db->where_in($filterObject->studentFilter->category, explode(",", $filterObject->studentFilter->status));

		//			$this->db->where_in($filterObject->studentFilter->category, explode(",",$filterObject->studentFilter->status));
		//echo $this->db->get_compiled_select();
		$users = $this->db->get()->result();
		return $users;
	}

	public function updateByColumn($data = [])
	{
		if (valArr($data['user_ids'])) {
			return $this->db->where_in('user_id', $data['user_ids'])->update($this->table, $data['set']);
		}
	}

	public function getApprovalStudentsByCategoryByOrgByClusterId($intOrgId, $intClusterId, $strCategory, $arrStatus)
	{

		$this->db->select('user_id, student.org_idd, student.cluster_idd, student.center_id, session_status, cncp_status, cncp_supported_status, psycho_educated_status, primary_counselling_status, secondary_counselling_status,well_being_status, care_plan_status, age, block, student.center_id, class, cluster_idd, create_date, created_by, district, email,
            father_name, father_occup, firstname, mobile, mother_name, mother_occup, org_idd, 
            picture, remarks, school_level, school_name, school_status, school_type, sex, socail_status,
            status, update_date, user_role,  village,center.center_name, org_name,cluster_name');
		$this->db->from($this->table);
		$this->db->join('organisation', 'organisation.org_id=student.org_idd', 'left');
		$this->db->join('cluster', 'cluster.cluster_id=student.cluster_idd', 'left');
		$this->db->join('center', 'center.center_id=student.center_id', 'left');
		$this->db->where('org_idd', $intOrgId);
		$this->db->where($this->table . '.cluster_idd', $intClusterId);
		$this->db->where($this->table . '.user_role', '5');
		$this->db->where_in($strCategory, explode(",", $arrStatus));
		// $this->db->get_compiled_select();
		return $this->db->get()->result();
	}

	public function countActivitiesStatusFields($intOrgId)
	{
		$this->db->select(
			'SUM(CASE WHEN session_status = 1 THEN 1 ELSE 0 END) as session_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN session_status = 2 THEN 1 ELSE 0 END) as session_approved',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN cncp_status = 1 THEN 1 ELSE 0 END) as cncp_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN cncp_status = 2 THEN 1 ELSE 0 END) as cncp_approved',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN cncp_supported_status = 1 THEN 1 ELSE 0 END) as cncp_supported_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN cncp_supported_status = 2 THEN 1 ELSE 0 END) as cncp_supported_approved',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN psycho_educated_status = 1 THEN 1 ELSE 0 END) as psycho_educated_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN psycho_educated_status = 2 THEN 1 ELSE 0 END) as psycho_educated_approved',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN primary_counselling_status = 1 THEN 1 ELSE 0 END) as primary_counselling_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN primary_counselling_status = 2 THEN 1 ELSE 0 END) as primary_counselling_approved',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN secondary_counselling_status = 1 THEN 1 ELSE 0 END) as secondary_counselling_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN secondary_counselling_status = 2 THEN 1 ELSE 0 END) as secondary_counselling_approved',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN well_being_status = 1 THEN 1 ELSE 0 END) as well_being_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN well_being_status = 2 THEN 1 ELSE 0 END) as well_being_approved',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN care_plan_status = 1 THEN 1 ELSE 0 END) as care_plan_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN care_plan_status = 2 THEN 1 ELSE 0 END) as care_plan_approved',
			false
		);

		$this->db->from('student s');
		$this->db->where('user_role', 5);
		$this->db->where('org_idd', $intOrgId);

		$query = $this->db->get();
		$result = $query->row();

		return [
			'session' => [
				'in_approval' => $result->session_in_approval,
				'approved' => $result->session_approved
			],
			'cncp_enrolled' => [
				'in_approval' => $result->cncp_in_approval,
				'approved' => $result->cncp_approved
			],
			'cncp_supported' => [
				'in_approval' => $result->cncp_supported_in_approval,
				'approved' => $result->cncp_supported_approved
			],
			'psycho_educated' => [
				'in_approval' => $result->psycho_educated_in_approval,
				'approved' => $result->psycho_educated_approved
			],
			'primary_counseling' => [
				'in_approval' => $result->primary_counselling_in_approval,
				'approved' => $result->primary_counselling_approved
			],
			'secondary_counseling' => [
				'in_approval' => $result->secondary_counselling_in_approval,
				'approved' => $result->secondary_counselling_approved
			],
			'psycho_social_well_being' => [
				'in_approval' => $result->well_being_in_approval,
				'approved' => $result->well_being_approved
			],
			'care_plans' => [
				'in_approval' => $result->care_plan_in_approval,
				'approved' => $result->care_plan_approved
			]
		];
	}

	public function countActivitiesStatusFieldsByOrgIdByClusterId($intOrgId, $intClusterId)
	{
		$this->db->select(
			'SUM(CASE WHEN session_status = 1 THEN 1 ELSE 0 END) as session_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN session_status = 2 THEN 1 ELSE 0 END) as session_approved',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN cncp_status = 1 THEN 1 ELSE 0 END) as cncp_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN cncp_status = 2 THEN 1 ELSE 0 END) as cncp_approved',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN cncp_supported_status = 1 THEN 1 ELSE 0 END) as cncp_supported_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN cncp_supported_status = 2 THEN 1 ELSE 0 END) as cncp_supported_approved',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN psycho_educated_status = 1 THEN 1 ELSE 0 END) as psycho_educated_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN psycho_educated_status = 2 THEN 1 ELSE 0 END) as psycho_educated_approved',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN primary_counselling_status = 1 THEN 1 ELSE 0 END) as primary_counselling_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN primary_counselling_status = 2 THEN 1 ELSE 0 END) as primary_counselling_approved',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN secondary_counselling_status = 1 THEN 1 ELSE 0 END) as secondary_counselling_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN secondary_counselling_status = 2 THEN 1 ELSE 0 END) as secondary_counselling_approved',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN well_being_status = 1 THEN 1 ELSE 0 END) as well_being_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN well_being_status = 2 THEN 1 ELSE 0 END) as well_being_approved',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN care_plan_status = 1 THEN 1 ELSE 0 END) as care_plan_in_approval',
			false
		);
		$this->db->select(
			'SUM(CASE WHEN care_plan_status = 2 THEN 1 ELSE 0 END) as care_plan_approved',
			false
		);

		$this->db->from('student s');
		$this->db->where('user_role', 5);
		$this->db->where('org_idd', $intOrgId);
		$this->db->where('cluster_idd', $intClusterId);

		$query = $this->db->get();
		$result = $query->row();

		return [
			'session' => [
				'in_approval' => $result->session_in_approval,
				'approved' => $result->session_approved
			],
			'cncp_enrolled' => [
				'in_approval' => $result->cncp_in_approval,
				'approved' => $result->cncp_approved
			],
			'cncp_supported' => [
				'in_approval' => $result->cncp_supported_in_approval,
				'approved' => $result->cncp_supported_approved
			],
			'psycho_educated' => [
				'in_approval' => $result->psycho_educated_in_approval,
				'approved' => $result->psycho_educated_approved
			],
			'primary_counseling' => [
				'in_approval' => $result->primary_counselling_in_approval,
				'approved' => $result->primary_counselling_approved
			],
			'secondary_counseling' => [
				'in_approval' => $result->secondary_counselling_in_approval,
				'approved' => $result->secondary_counselling_approved
			],
			'psycho_social_well_being' => [
				'in_approval' => $result->well_being_in_approval,
				'approved' => $result->well_being_approved
			],
			'care_plans' => [
				'in_approval' => $result->care_plan_in_approval,
				'approved' => $result->care_plan_approved
			]
		];
	}
	public function getClusterActivitiesStatusSummaryByOrgId($intOrgId)
	{
		$this->db->select('
			    c.cluster_name,
			    cn.center_name,
			    SUM(CASE WHEN s.session_status in (0,1,2) THEN 1 ELSE 0 END) as total_students,
			    SUM(CASE WHEN s.session_status = 1 THEN 1 ELSE 0 END) as session_in_approval,
			    SUM(CASE WHEN s.session_status = 2 THEN 1 ELSE 0 END) as session_approved,
			    SUM(CASE WHEN s.cncp_status = 1 THEN 1 ELSE 0 END) as cncp_in_approval,
			    SUM(CASE WHEN s.cncp_status = 2 THEN 1 ELSE 0 END) as cncp_approved,
			    SUM(CASE WHEN s.cncp_supported_status = 1 THEN 1 ELSE 0 END) as cncp_supported_in_approval,
			    SUM(CASE WHEN s.cncp_supported_status = 2 THEN 1 ELSE 0 END) as cncp_supported_approved,
			    SUM(CASE WHEN s.psycho_educated_status = 1 THEN 1 ELSE 0 END) as psycho_educated_in_approval,
			    SUM(CASE WHEN s.psycho_educated_status = 2 THEN 1 ELSE 0 END) as psycho_educated_approved,
			    SUM(CASE WHEN s.primary_counselling_status = 1 THEN 1 ELSE 0 END) as primary_counselling_in_approval,
			    SUM(CASE WHEN s.primary_counselling_status = 2 THEN 1 ELSE 0 END) as primary_counselling_approved,
			    SUM(CASE WHEN s.secondary_counselling_status = 1 THEN 1 ELSE 0 END) as secondary_counselling_in_approval,
			    SUM(CASE WHEN s.secondary_counselling_status = 2 THEN 1 ELSE 0 END) as secondary_counselling_approved,
			    SUM(CASE WHEN s.well_being_status = 1 THEN 1 ELSE 0 END) as well_being_in_approval,
			    SUM(CASE WHEN s.well_being_status = 2 THEN 1 ELSE 0 END) as well_being_approved,
			    SUM(CASE WHEN s.care_plan_status = 1 THEN 1 ELSE 0 END) as care_plan_in_approval,
			    SUM(CASE WHEN s.care_plan_status = 2 THEN 1 ELSE 0 END) as care_plan_approved
			', false);

		$this->db->from('student s');
		$this->db->join('cluster c', 's.cluster_idd = c.cluster_id', 'inner');
		$this->db->join('center cn', 's.center_id = cn.center_id', 'inner');

		$this->db->where('s.user_role', 5);
		$this->db->where('s.org_idd', $intOrgId);
		$this->db->group_by('c.cluster_name,cn.center_name');

		$query = $this->db->get();
		return $query->result();
	}

	public function getCenterActivitiesStatusSummaryByOrgIdByClusterId($intOrgId, $intClusterId)
	{
		$this->db->select(
			'cn.center_name,
	    SUM(CASE WHEN s.session_status IN (0, 1, 2) THEN 1 ELSE 0 END) as total_students,
	    SUM(CASE WHEN s.session_status = 1 THEN 1 ELSE 0 END) as session_in_approval,
	    SUM(CASE WHEN s.session_status = 2 THEN 1 ELSE 0 END) as session_approved,
	    SUM(CASE WHEN s.cncp_status = 1 THEN 1 ELSE 0 END) as cncp_in_approval,
	    SUM(CASE WHEN s.cncp_status = 2 THEN 1 ELSE 0 END) as cncp_approved,
	    SUM(CASE WHEN s.cncp_supported_status = 1 THEN 1 ELSE 0 END) as cncp_supported_in_approval,
	    SUM(CASE WHEN s.cncp_supported_status = 2 THEN 1 ELSE 0 END) as cncp_supported_approved,
	    SUM(CASE WHEN s.psycho_educated_status = 1 THEN 1 ELSE 0 END) as psycho_educated_in_approval,
	    SUM(CASE WHEN s.psycho_educated_status = 2 THEN 1 ELSE 0 END) as psycho_educated_approved,
	    SUM(CASE WHEN s.primary_counselling_status = 1 THEN 1 ELSE 0 END) as primary_counselling_in_approval,
	    SUM(CASE WHEN s.primary_counselling_status = 2 THEN 1 ELSE 0 END) as primary_counselling_approved,
	    SUM(CASE WHEN s.secondary_counselling_status = 1 THEN 1 ELSE 0 END) as secondary_counselling_in_approval,
	    SUM(CASE WHEN s.secondary_counselling_status = 2 THEN 1 ELSE 0 END) as secondary_counselling_approved,
	    SUM(CASE WHEN s.well_being_status = 1 THEN 1 ELSE 0 END) as well_being_in_approval,
	    SUM(CASE WHEN s.well_being_status = 2 THEN 1 ELSE 0 END) as well_being_approved,
	    SUM(CASE WHEN s.care_plan_status = 1 THEN 1 ELSE 0 END) as care_plan_in_approval,
	    SUM(CASE WHEN s.care_plan_status = 2 THEN 1 ELSE 0 END) as care_plan_approved',
			false
		);
		$this->db->from('student s');
		$this->db->join('center cn', 's.center_id = cn.center_id', 'inner');
		$this->db->where('s.user_role', 5);
		$this->db->where('s.org_idd', $intOrgId);
		$this->db->where('s.cluster_idd', $intClusterId);
		$this->db->group_by('cn.center_name');
		$query = $this->db->get();
		return $query->result();
	}
}
