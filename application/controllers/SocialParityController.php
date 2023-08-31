<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class SocialParityController extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model('SocialParityModel');
		}

		public function index() {
			$this->load->view('socialparity/list');
		}

		public function form(){
			$this->load->view('socialparity/form');
		}

		public function get_all_records() {
			$data = $this->SocialParityModel->get_all();
			echo json_encode(['data' => $data]);
		}
	}
