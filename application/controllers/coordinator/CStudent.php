<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/coordinator/Coordinator.php');

class CStudent extends Coordinator
{
	//private $organisation;
	private $user_id;
	public function __construct()
	{
		parent::__construct();
	}

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

		$this->renderView('coordinator/student/student', $this->data);
	}

	private function loadLists()
	{
		$this->data['org_id']       = $this->getOrgId();
		$this->data['cluster_id']   = $this->getClusterId();
		$this->data['center_id']    = $this->input->post('center_id');
		$this->data['user_role']    = '5';
		$this->data['cluster_list'] = $this->clusterModel->read_as_list_by_org($this->getOrgId());
	}

	public function processStudentForm(): void
	{
		$this->data['title'] = display('add_student');
		$this->data['PageTitle'] = display('add_student');
		$this->data['user_menu'] = 'menu-open';
		$this->data['user_add_option'] = 'active';

		$this->data['district_list'] = getDistrictListAsArray();
		$this->data['cluster_list'] = $this->clusterModel->read_as_list_by_org($this->getOrgId());
		//$this->data['center_list'] = $this->centerModel->read_as_list1($this->getOrgId());

		// Handle POST data
		$postData = $this->preparePostData();
		$this->data['student'] = (object) $postData;
		// Form validation
		$this->form_validation->set_rules('firstname', display('first_name'), 'required|max_length[50]');
//		$this->form_validation->set_rules('cluster_idd', display('cluster_name'), 'required');
		$this->form_validation->set_rules('center_id', display('center_name'), 'required');
		$this->form_validation->set_rules('sex', display('sex'), 'required');
		$this->form_validation->set_rules('age', display('age'), 'required');

		// Perform picture upload and resizing
		// $picture = $this->handlePictureUpload();

		if ($this->form_validation->run() === true) {
			$std_id = $this->saveOrUpdateStudent($postData);
			$this->handleRedirect($postData, $std_id);
		} else {
			$this->renderView('coordinator/student/std_form', $this->data);
		}
	}

	private function preparePostData()
	{
		$postData = [
			'user_id' => $this->input->post('user_id'),
			'firstname' => $this->input->post('firstname', true),
			'mobile' => $this->input->post('mobile', true),
			'user_role' => '5',
			'picture' => $this->handlePictureUpload1(),
			'password' => md5('password'/*$this->input->post('password')*/),
			'district' => $this->input->post('district'),
			'school_level' => $this->input->post('school_level'),
			'sex' => $this->input->post('sex'),
			'age' => $this->input->post('age'),
			'school_status' => $this->input->post('school_status'),
			'father_name' => $this->input->post('father_name'),
			'mother_name' => $this->input->post('mother_name'),
			'org_idd' => $this->getOrgId(),
			'cluster_idd' => $this->getClusterId(),
			'center_id' => $this->input->post('center_id'),
			'created_by' => $this->session->userdata('user_id'),
			'create_date' => $this->input->post('create_date'),
			'update_date' => date('Y-m-d'),
			'status' => 1
		];

		return $postData;
	}

	private function handlePictureUpload1()
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
			if ($this->userModel->create($postData)){
				$std_id = $this->db->insert_id();
				$this->session->set_flashdata('message',  display('save_successfully'));
			}else{
				$this->session->set_flashdata('exception', display('please_try_again'));
			}

		} else {
			$std_id = $this->userModel->update($postData);
			if ($this->userModel->update($postData)){
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

			redirect('coordinator/cstudent/profile/' . $std_id);
		} else {
			redirect('coordinator/cstudent/edit/' . $postData['user_id']);
		}
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
		$this->data['cluster_list'] = $this->clusterModel->read_as_list_by_org($this->getOrgId());
		$this->data['student'] = $this->userModel->read_by_id($std_id);
		if(empty($this->data['student'])){
			$this->session->set_flashdata('exception', display('no_record_found'));
			redirect('coordinator/cstudent/index');
		}
		$this->data['center_list'] = $this->centerModel->readCenterByClusterIdAsList($this->getClusterId());
	}

	private function loadStudentEdit(): void
	{
		$this->data['content'] = $this->load->view('coordinator/student/std_form', $this->data, true);
		$this->load->view('coordinator/starter/starter_layout', $this->data);
	}

	public function profile($std_id = '')
	{
		$this->data['title']        = display('student_info');
		$this->data['PageTitle']    = display('student_info');

		//$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['student'] = $this->userModel->read_by_id($std_id);
		$this->data['content'] = $this->load->view('coordinator/student/std_profile2', $this->data, true);
		$this->load->view('coordinator/starter/starter_layout', $this->data);
	}

	public function stddelete($std_id = null)
	{
		if ($this->userModel->delete($std_id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('coordinator/cstudent/');
	}

	public function handlePictureUpload()
	{
		$this->configureUploadSettings();

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$filename = $this->generateFilename();

			$uploadPath = $this->getUploadPath();

			$config = $this->getUploadConfig($filename, $uploadPath);

			$this->load->library('upload', $config);

			$name = 'picture';

			if (!$this->upload->do_upload($name)) {
				$this->handleUploadError();
			} else {
				$uploadData = $this->upload->data();
				$responseData = $this->prepareResponseData($uploadData);
				echo json_encode($responseData);
			}
		}
	}

	private function configureUploadSettings()
	{
		ini_set('memory_limit', '200M');
		ini_set('upload_max_filesize', '200M');
		ini_set('post_max_size', '200M');
		ini_set('max_input_time', 3600);
		ini_set('max_execution_time', 3600);
	}

	private function generateFilename()
	{
		$filename = $_FILES['picture']['name'];
		$filename = strstr($filename, '.', true);
		$email = $this->session->userdata('email');
		$filename = strstr($email, '@', true) . "_" . $filename;
		return strtolower($filename);
	}

	private function getUploadPath()
	{
		if (1 == $this->input->post('is_student_form')) {
			return FCPATH . '/uploads/student/';
		} else {
			return FCPATH . '/uploads/user/';
		}
	}

	private function getUploadConfig($filename, $uploadPath)
	{
		return [
			'upload_path' => $uploadPath,
			'allowed_types' => '*',
			'max_size' => 0,
			'max_width' => 0,
			'max_height' => 0,
			'file_ext_tolower' => true,
			'file_name' => $filename,
			'overwrite' => false,
		];
	}

	private function handleUploadError()
	{
		$data['exception'] = $this->upload->display_errors();
		$data['status'] = false;
		echo json_encode($data);
	}

	private function prepareResponseData($uploadData)
	{
		$responseData = [
			'message' => display('upload_successfully'),
			'filepath' => '/uploads/student/' . $uploadData['file_name'],
			'preview' => (( 1 == $this->input->post( 'is_student_form' ) ) ? base_url('/uploads/student/'): base_url('/uploads/user/') ) . $uploadData['file_name'],
			'status' => true,
		];
		return $responseData;
	}
	public function center_by_cluster()
	{
		$cluster_idd = $this->input->post('cluster_id');
		$selectedCenterId = $this->input->post('center_idd');
		return $this->centerModel->center_by_cluster($cluster_idd, $selectedCenterId);
	}

	public function cluster_by_intervention_area()
	{
		$cluster_idd = $this->input->post('cluster_id');
		return $this->centerModel->center_by_cluster($cluster_idd);
	}
}
