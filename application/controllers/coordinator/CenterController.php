<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	require(APPPATH . 'controllers/coordinator/Coordinator.php');
	class CenterController extends Coordinator
	{
		private $user_id;

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


	}
