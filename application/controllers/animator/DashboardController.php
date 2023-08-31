<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	require(APPPATH . 'controllers/animator/Animator.php');
	class DashboardController extends Animator
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

		public function fetchTotalOfStudentMessageCenterByOrgIdByClusterId($orgId, $clusterId, $centerId)
		{
			$data = new stdClass();
			$data->total_allocate_centers = count($this->getArrCenterIds());
			$data->total_students = $this->userModel->fetchStudentsByOrgIdByClusterIdByCenterId($orgId, $clusterId, $centerId);
			$data->new_messages = $this->messageModel->new_messages_for_user($this->user_id);
			return $data;
		}
	}
