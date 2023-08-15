<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/UsersController.php');

class CUser extends UsersController
{
	private $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'center_model',
			'cluster_model',
		));
	}

	public function index(): void
	{
		$this->initializeData('list_user', 'list_user', 'menu-open', 'active');
		$this->data['district_list'] = getDistrictListAsArray();
		$this->data['users'] = $this->user_model->read_members($this->getOrgId());
		$this->renderView('organisation/user/member',$this->data);
	}
	private function renderView($viewName, $data = [])
	{
		$this->data['content'] = $this->load->view($viewName, $data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function addUser(): void
	{
		$this->initializeData('add_member', 'add_member', 'menu-open', 'active');

		$keysToRemove = [Userrole::ORGANISATION, Userrole::STUDENT];
		$this->data['designation_list'] = array_filter($this->data['user_role_list'], function ($key) use ($keysToRemove) {
			return !in_array($key, $keysToRemove);
		}, ARRAY_FILTER_USE_KEY);

		$this->data['district_list'] = getDistrictListAsArray();
		$this->data['center_list'] = $this->center_model->read_as_list1($this->getOrgId());
		$this->data['cluster_list'] = $this->cluster_model->read_as_list_by_org($this->getOrgId());

		$this->loadFormValidation();
		$this->handleUserFormSubmission();

		$this->renderView('organisation/user/member_form',$this->data);
	}

	public function viewUserProfile($user_id = null)
	{
		$this->initializeUserProfileData($user_id);
		$this->displayUserProfileView();
	}

	private function initializeUserProfileData($user_id)
	{
		$this->initializeData('user_info', 'user_info');
		$this->data['profile'] = $this->user_model->read_user_by_id($user_id);
	}

	private function displayUserProfileView()
	{
		$this->renderView('organisation/user/profile', $this->data);
	}

	public function editUser($user_id = null)
	{
		$this->prepareUserEditData($user_id);
		// $this->filterUserRoles();
		$keysToRemove = [Userrole::ORGANISATION, Userrole::STUDENT];
		$this->data['designation_list'] = array_filter($this->data['user_role_list'], function ($key) use ($keysToRemove) {
			return !in_array($key, $keysToRemove);
		}, ARRAY_FILTER_USE_KEY);

		$this->renderView('organisation/user/member_form', $this->data);
	}

	private function prepareUserEditData($user_id)
	{
		$this->initializeData('user_edit', 'user_edit');
		$this->data['district_list'] = getDistrictListAsArray();
		$this->data['center_list'] = $this->center_model->read_as_list();
		$this->data['cluster_list'] = $this->cluster_model->read_as_list_by_org($this->getOrgId());
		$this->data['student'] = $this->user_model->read_user_by_id($user_id);
	}


	public function deleteUser($user_id = null)
	{
		$this->handleUserDeletion($user_id);
		redirect('organisation/cuser/index');
	}

	public function user_delete($user_id = null)
	{
		$this->handleUserDeletion($user_id);
		redirect('organisation/user/members');
	}

	private function initializeData($title, $pageTitle, $userMenu = null, $memberOption = null)
	{
		$this->data['title'] = display($title);
		$this->data['PageTitle'] = display($pageTitle);
		$this->data['user_menu'] = $userMenu;
		$this->data['member_list_option'] = $memberOption;
	}

	private function filterUserRoles()
	{
		$keysToKeep = [4];
		$this->data['user_role_list'] = array_intersect_key($this->data['user_role_list'], array_flip($keysToKeep));
	}

	private function loadFormValidation()
	{
		$this->form_validation->set_rules('firstname', display('first_name'), 'required|max_length[50]');
		$this->form_validation->set_rules('email', display('email'), 'required');
		$this->form_validation->set_rules('mobile', display('mobile'), 'required|numeric|max_length[13]');
		$this->form_validation->set_rules('age', display('age'), 'numeric');
		$this->form_validation->set_rules('user_role', display('designation'), 'required');
		$this->form_validation->set_rules('sex', display('sex'), 'required');
	}

	private function handleUserFormSubmission()
	{
		$this->data['student']= (object) $postData = $this->prepareUserData();
		if ($this->form_validation->run() === true) {

			if (empty($postData['user_id'])) {
				$this->createUser($postData);
			} else {
				$this->updateUser($postData);
			}
		} else {
			$this->data['content'] = $this->load->view('organisation/user/member_form', $this->data, true);
			$this->load->view('organisation/starter/starter_layout', $this->data);
		}
	}

	private function handleUserDeletion($user_id)
	{
		if ($this->user_model->delete($user_id)) {
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
	}
	private function prepareUserData()
	{
		// Prepare and sanitize user input data here...
		// For example:
		$picture = $this->uploadUserPicture(); // Implement this function

		return [
			'user_id' => $this->input->post('user_id'),
			'firstname' => $this->input->post('firstname', true),
			'mobile' => $this->input->post('mobile', true),
			'email' => $this->input->post('email'),
			'user_role' => $this->input->post('user_role'),
			'picture' => (!empty($picture) ? $picture : $this->input->post('old_picture')),
			'password' => !empty($this->input->post('mobile')) ? md5($this->input->post('mobile')):md5('password'),
			'district' => $this->input->post('district'),
			'block' => $this->input->post('block'),
			'village' => $this->input->post('village'),
			'age' => $this->input->post('age'),
			'sex' => $this->input->post('sex'),
			'org_idd' => $this->getOrgId(),
			'cluster_idd' => $this->input->post('cluster_idd'),
			'created_by' => $this->session->userdata('user_id'),
			'create_date' => date('Y-m-d'),
			'update_date' => '',
			'status' => 1
		];
	}

	private function uploadUserPicture()
	{
		$picture = $this->fileupload->do_upload('siteassets/images/student/', 'picture');

		if ($picture !== false && $picture != null) {
			$this->fileupload->do_resize($picture, 200, 200);
		}

		return (!empty($picture) ? $picture : $this->input->post('old_picture'));
	}

	private function createUser($postData)
	{
		if ($this->user_model->create($postData)) {
			//$u_id = $this->db->insert_id();
			$this->session->set_flashdata('message', display('save_successfully'));
			redirect('organisation/cuser/index/');
		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));
			redirect('organisation/cuser/addUser');
		}
	}

	private function updateUser($postData)
	{
		if ($this->user_model->update($postData)) {
			$this->session->set_flashdata('message', display('update_successfully'));
			redirect('organisation/cuser/editUser/' . $postData['user_id']);
		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));
			redirect('organisation/cuser/editUser/' . $postData['user_id']);
		}
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


}
