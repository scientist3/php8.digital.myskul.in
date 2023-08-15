<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/UsersController.php');

class CStudent extends UsersController
{
	//private $organisation;
	private $user_id;
	public function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			// 	'user_model',
			'center_model',
			'cluster_model',
			// 	'dashboard_model',
			// 	'organisation_model',
			'organisation/cluster1_model',
			// 	'organisation/center1_model',

		));
		// if (
		// 	$this->session->userdata('isLogIn') == false
		// 	|| $this->session->userdata('user_role') != 2
		// )
		// 	redirect('login');
		// $this->user_id = $user_id = $this->session->userdata('user_id');
		// $this->organisation = $this->organisation_model->read_orgheads_org($user_id);
	}

	#-------------------- Student -------------------#
	public function index()
	{
		$this->data['title'] = display('list_student');
		$this->data['PageTitle'] = display('list_student');
		$this->data['user_menu'] = 'menu-open';
		$this->data['user_list_option'] = 'active';

		$this->data['district_list'] = getDistrictListAsArray();
		$this->data['org_id'] = $this->getOrgId();
		$this->data['user_role'] = '5';

		$this->loadLists();

		$this->loadStudentStatistics();

		$this->loadStudentView();
	}

	private function loadLists()
	{
		$this->data['org_id']       = $this->getOrgId();
		$this->data['cluster_id']   = $this->input->post('cluster_id');
		$this->data['center_id']    = $this->input->post('center_id');
		$this->data['user_role']    = '5';
		$this->data['cluster_list'] = $this->cluster1_model->read_clusters_of_org_as_list($this->data['org_id']);
		$cluster_ids = $this->cluster1_model->get_cluster_ids_of_org($this->data['org_id']);
		$this->data['center_list'] = $this->center1_model->read_centers_of_cluster_as_list($cluster_ids);
	}

	private function loadStudentStatistics()
	{
		$this->data['boys_6_11'] = $this->user_model->boys_6_11($this->data['org_id']);
		$this->data['boys_12_18'] = $this->user_model->boys_12_18($this->data['org_id']);
		$this->data['girls_6_11'] = $this->user_model->girls_6_11($this->data['org_id']);
		$this->data['girls_12_18'] = $this->user_model->girls_12_18($this->data['org_id']);
		$this->data['tot_orphans'] = $this->user_model->tot_orphans($this->data['org_id']);
		$this->data['tot_disabled'] = $this->user_model->tot_disabled($this->data['org_id']);
		$this->data['tot_drop_out'] = $this->user_model->tot_drop_out($this->data['org_id']);
		$this->data['tot_students'] = $this->user_model->total_students($this->data['org_id']);
	}

	private function loadStudentView()
	{
		$this->data['content'] = $this->load->view('organisation/student/student', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function processStudentForm(): void
	{
		$this->data['title'] = display('add_student');
		$this->data['PageTitle'] = display('add_student');
		$this->data['user_menu'] = 'menu-open';
		$this->data['user_add_option'] = 'active';

		$this->data['district_list'] = getDistrictListAsArray();
		$this->data['cluster_list'] = $this->cluster_model->read_as_list_by_org($this->getOrgId());
		$this->data['center_list'] = $this->center_model->read_as_list1($this->getOrgId());

		// Handle POST data
		$postData = $this->preparePostData();
		$this->data['student'] = (object) $postData;
		// Form validation
		$this->form_validation->set_rules('firstname', display('first_name'), 'required|max_length[50]');
		$this->form_validation->set_rules('cluster_idd', display('cluster_name'), 'required');
		$this->form_validation->set_rules('center_id', display('center_name'), 'required');
		$this->form_validation->set_rules('sex', display('sex'), 'required');
		$this->form_validation->set_rules('age', display('age'), 'required');

		// Perform picture upload and resizing
		// $picture = $this->handlePictureUpload();

		if ($this->form_validation->run() === true) {
			$std_id = $this->saveOrUpdateStudent($postData);
			$this->handleRedirect($postData, $std_id);
		} else {
			$this->renderStudentFormView();
		}
	}

	private function preparePostData()
	{
		$postData = [
			'user_id' => $this->input->post('user_id'),
			'firstname' => $this->input->post('firstname', true),
			'mobile' => $this->input->post('mobile', true),
			'user_role' => '5',
			'picture' => $this->handlePictureUpload(),
			'password' => md5('password'/*$this->input->post('password')*/),
			'district' => $this->input->post('district'),
			'school_level' => $this->input->post('school_level'),
			'sex' => $this->input->post('sex'),
			'age' => $this->input->post('age'),
			'school_status' => $this->input->post('school_status'),
			'father_name' => $this->input->post('father_name'),
			'mother_name' => $this->input->post('mother_name'),
			'org_idd' => $this->getOrgId(),
			'cluster_idd' => $this->input->post('cluster_idd'),
			'center_id' => $this->input->post('center_id'),
			'created_by' => $this->session->userdata('user_id'),
			'create_date' => $this->input->post('create_date'),
			'update_date' => date('Y-m-d'),
			'status' => 1
		];

		return $postData;
	}

	private function handlePictureUpload()
	{
		$picture = $this->fileupload->do_upload('siteassets/images/student/', 'picture');

		if ($picture !== false && $picture != null) {
			$this->fileupload->do_resize($picture, 200, 200);
		}

		return (!empty($picture) ? $picture : $this->input->post('old_picture'));
	}

	private function saveOrUpdateStudent($postData)
	{
		if (empty($postData['user_id'])) {
			if ($this->user_model->create($postData)){
				$this->session->set_flashdata('message',  display('save_successfully'));
			}else{
				$this->session->set_flashdata('exception', display('please_try_again'));
			}

		} else {
			$std_id = $this->user_model->update($postData);
			if ($this->user_model->update($postData)){
				$this->session->set_flashdata('message', display('update_successfully'));
			}else{
				$this->session->set_flashdata('exception', display('please_try_again'));
			}


		}

		return $std_id;
	}

	private function handleRedirect($postData, $std_id)
	{
		if (empty($postData['user_id'])) {

			redirect('organisation/cstudent/profile/' . $std_id);
		} else {
			redirect('organisation/cstudent/edit/' . $postData['user_id']);
		}
	}

	private function renderStudentFormView()
	{
		$this->data['content'] = $this->load->view('organisation/student/std_form', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function edit($std_id = ''): void
	{
		$this->data['PageTitle'] = display('edit_student');
		$this->loadStudentData($std_id);
		$this->loadStudentEdit();
	}

	private function loadStudentData($std_id): void
	{
		$this->data['district_list'] = getDistrictListAsArray();
		$this->data['cluster_list'] = $this->cluster_model->read_as_list_by_org($this->getOrgId());
		$this->data['student'] = $this->user_model->read_by_id($std_id);
		if(empty($this->data['student'])){
			$this->session->set_flashdata('exception', display('no_record_found'));
			redirect('organisation/cstudent/index');
		}
		$this->data['center_list'] = $this->center_model->read_as_list1($this->getOrgId());
	}

	private function loadStudentEdit(): void
	{
		$this->data['content'] = $this->load->view('organisation/student/std_form', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function profile($std_id = '')
	{
		$this->data['title']        = display('student_info');
		$this->data['PageTitle']    = display('student_info');

		//$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['student'] = $this->user_model->read_by_id($std_id);
		$this->data['content'] = $this->load->view('organisation/student/std_profile2', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function stddelete($std_id = null)
	{
		if ($this->user_model->delete($std_id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('organisation/cstudent/');
	}


	/*
    |----------------------------------------------
    |        id genaretor
    |----------------------------------------------     
    */
	public function randStrGen($mode = null, $len = null)
	{
		$result = "";
		if ($mode == 1) :
			$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		elseif ($mode == 2) :
			$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		elseif ($mode == 3) :
			$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		elseif ($mode == 4) :
			$chars = "0123456789";
		endif;

		$charArray = str_split($chars);
		for ($i = 0; $i < $len; $i++) {
			$randItem = array_rand($charArray);
			$result .= "" . $charArray[$randItem];
		}
		return $result;
	}
	/*
    |----------------------------------------------
    |         Ends of id genaretor
    |----------------------------------------------
    */

	public function document()
	{
		$this->data['title'] = display('document_list');
		$this->data['documents'] = $this->document_model->read();
		$this->data['content'] = $this->load->view('document', $this->data, true);
		if ($this->session->userdata('user_role') == 1)
			$this->load->view('layout/main_wrapper_lte', $this->data);
		else if ($this->session->userdata('user_role') == 2) {
			$this->load->view('dashboard_incharge/main_wrapper_lte', $this->data);
		}
	}

	public function document_form()
	{
		$this->data['title'] = display('add_document');
		/*----------VALIDATION RULES----------*/
		$this->form_validation->set_rules('patient_id', display('patient_id'), 'required|max_length[30]');
		$this->form_validation->set_rules('doctor_name', display('doctor_id'), 'max_length[11]');
		$this->form_validation->set_rules('description', display('description'), 'trim');
		$this->form_validation->set_rules('hidden_attach_file', display('attach_file'), 'required|max_length[255]');
		/*-------------STORE DATA------------*/
		$urole = $this->session->userdata('user_role');
		$this->data['document'] = (object)$postData = array(
			'patient_id'  => $this->input->post('patient_id'),
			'doctor_id'   => $this->input->post('doctor_id'),
			'description' => $this->input->post('description'),
			'hidden_attach_file' => $this->input->post('hidden_attach_file'),
			'date'        => date('Y-m-d'),
			'upload_by'   => (($urole == 10) ? 0 : $this->session->userdata('user_id'))
		);

		/*-----------CREATE A NEW RECORD-----------*/
		if ($this->form_validation->run() === true) {

			if ($this->document_model->create($postData)) {
				#set success message
				$this->session->set_flashdata('message', display('save_successfully'));
			} else {
				#set exception message
				$this->session->set_flashdata('exception', display('please_try_again'));
			}
			redirect('patient/document_form');
		} else {
			$this->data['doctor_list'] = $this->doctor_model->doctor_list();
			$this->data['content'] = $this->load->view('document_form', $this->data, true);
			if ($this->session->userdata('user_role') == 1)
				$this->load->view('layout/main_wrapper_lte', $this->data);
			else if ($this->session->userdata('user_role') == 2) {
				$this->load->view('dashboard_incharge/main_wrapper_lte', $this->data);
			}
		}
	}

	public function do_upload()
	{
		ini_set('memory_limit', '200M');
		ini_set('upload_max_filesize', '200M');
		ini_set('post_max_size', '200M');
		ini_set('max_input_time', 3600);
		ini_set('max_execution_time', 3600);

		if (($_SERVER['REQUEST_METHOD']) == "POST") {
			$filename = $_FILES['picture']['name'];
			$filename = strstr($filename, '.', true);
			$email    = $this->session->userdata('email');
			$filename = strstr($email, '@', true) . "_" . $filename;
			$filename = strtolower($filename);
			/*-----------------------------*/
			if (1 == $this->input->post('is_student_form')) {
				$config['upload_path']   = FCPATH . '/uploads/student/';
			} else {
				$config['upload_path']   = FCPATH . '/uploads/user/';
			}
			if (!is_dir($config['upload_path']))
				mkdir($config['upload_path'], 0755, true);
			// $config['allowed_types'] = 'csv|pdf|ai|xls|ppt|pptx|gz|gzip|tar|zip|rar|mp3|wav|bmp|gif|jpg|jpeg|jpe|png|txt|text|log|rtx|rtf|xsl|mpeg|mpg|mov|avi|doc|docx|dot|dotx|xlsx|xl|word|mp4|mpa|flv|webm|7zip|wma|svg';
			$config['allowed_types'] = '*';
			$config['max_size']      = 0;
			$config['max_width']     = 0;
			$config['max_height']    = 0;
			$config['file_ext_tolower'] = true;
			$config['file_name']     =  $filename;
			$config['overwrite']     = false;

			$this->load->library('upload', $config);

			$name = 'picture';
			if (!$this->upload->do_upload($name)) {
				$data['exception'] = $this->upload->display_errors();
				$data['status'] = false;
				echo json_encode($data);
			} else {
				$upload =  $this->upload->data();
				$data['message'] = display('upload_successfully');
				$data['filepath'] = '/uploads/student/' . $upload['file_name'];
				$data['preview'] = base_url() . '/uploads/student/' . $upload['file_name'];
				$data['status'] = true;
				echo json_encode($data);
			}
		}
	}

	public function document_delete($id = null)
	{
		if ($this->document_model->delete($id)) {

			$file = $this->input->get('file');
			if (file_exists($file)) {
				@unlink($file);
			}
			$this->session->set_flashdata('message', display('save_successfully'));
		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function center_by_cluster()
	{
		$cluster_idd = $this->input->post('cluster_id');
		return $this->center_model->center_by_cluster($cluster_idd);
	}

	public function cluster_by_intervention_area()
	{
		$cluster_idd = $this->input->post('cluster_id');
		return $this->center_model->center_by_cluster($cluster_idd);
	}
}
