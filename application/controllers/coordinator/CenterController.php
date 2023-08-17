<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	require(APPPATH . 'controllers/coordinator/Coordinator.php');
	class CenterController extends Coordinator
	{
		private $user_id;

		private $objCenterService;

		public function __construct()
		{
			parent::__construct();
			$this->load->library('CenterService');
			$this->load->model(
				array(
//					'setting_model',
//					'dashboard_model',
//					'organisation_model',
//					'cluster_model',
//					'center_model',
//					'user_model',
				)
			);

			$this->objCenterService 			= new $this->centerservice();
			$this->load->model(
				array(
//					'coordinator/cluster_model'=> 'clusterModel',
//					'coordinator/center_model'=> 'centerModel',
//					'coordinator/user_model'=> 'userModel',
//					'messages/message_model' => 'messageModel'
					'centertypemodel'=>'centerTypeModel',
				)
			);

			$this->user_id = $this->session->userdata('user_id');
			$this->data['center_type'] 		= $this->centerTypeModel->get_center_as_list();

		}

		public function getUserId()
		{
			return $this->user_id;
		}

		public function getObjCenterService(): mixed
		{
			return $this->objCenterService;
		}

		/**
		 * @throws Exception
		 */
		public function getCentersOfLoggedInCluster()
		{
			// Fetch and return the centers of the logged-in cluster
			return  $this->center_model->getCenterDetails($this->getOrgId(),$this->getClusterId());
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
