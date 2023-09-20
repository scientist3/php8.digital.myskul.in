<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/coordinator/Coordinator.php');
class DashboardController extends Coordinator
{
	private $user_id;

	public function __construct()
	{
		parent::__construct();

		$this->load->model(
			array(
				'coordinator/cluster_model' => 'clusterModel',
				'messages/message_model'    => 'messageModel',
				'activities_model'          => 'ActivitiesModel'
			)
		);

		$this->user_id = $this->session->userdata('user_id');
	}

	public function fetchTotalOfCenterAnimatorStudentMessageByOrgIdByClusterId($orgId, $clusterId)
	{
		$data = new stdClass();
		$data->total_centers = $this->centerModel->fetchCenterCountByClusterId($clusterId);
		$data->total_animators = $this->userModel->fetchAnimatorsByOrgIdByClusterId($orgId, $clusterId);
		$data->total_students = $this->userModel->fetchStudentsByOrgIdByClusterId($orgId, $clusterId);
		$data->new_messages = $this->messageModel->new_messages_for_user($this->user_id);
		return $data;
	}

	public function fetchTotalOfActivitiesByOrgIdByClusterId($intOrgId, $intClusterId)
	{
		$data = $this->ActivitiesModel->countActivitiesStatusFieldsByOrgIdByClusterId($intOrgId, $intClusterId);
		$jsonString = json_encode($data);

		// Convert the JSON string to an object
		return json_decode($jsonString);

	}
}
