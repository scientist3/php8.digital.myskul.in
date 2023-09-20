<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/organisation/Organisation.php');

class Cactivities extends Organisation
{
	private $org_id;
	private $cluster_id;
	private $center_id;
	private $active_center_id;
	private $user_id;
	public function __construct()
	{
		parent::__construct();
	}
	private function loadLists()
{
	$this->data['org_id']                   = $this->getOrgId();
	// $this->data['cluster_id']               = $this->getClusterId();
	// $this->data['center_id']                = $this->getActiveCenterId();
	$this->data['user_role']                = '5';
	$this->data['cluster_list']             = $this->clusterModel->read_as_list_by_org($this->getOrgId());
	$this->data['district_list']            = getDistrictListAsArray();


//		$this->data['all_students']             = $this->getStudentsByStatus('all');
//		$this->data['not_submitted_students']   = $this->getStudentsByStatus('not_submitted');
//		$this->data['pending_students']         = $this->getStudentsByStatus('pending');
//		$this->data['approved_students']        = $this->getStudentsByStatus('approved');
}

	public function index( ){
		$this->data['title'] = "Student Activities Report";
		$this->data['PageTitle'] = display('student_activities_report');
		$this->data['dashboard'] = 'active';

		$this->data['activities_statistics'] = $this->ActivitiesModel->getClusterActivitiesStatusSummaryByOrgId( $this->getOrgId() );

		$this->renderView('organisation/activities/index', $this->data);
	}

}
