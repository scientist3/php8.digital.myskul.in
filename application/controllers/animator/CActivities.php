<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/animator/Animator.php');

class CActivities extends Animator
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

	#-------------------- Student -------------------#
	public function index()
	{
//		$this->data['title'] = display('list_student');
//		$this->data['PageTitle'] = display('list_student');
//		$this->data['activities_menu'] = 'menu-open';
//		$this->data['std_sess_comp_option'] = 'active';
//
//		$this->data['district_list'] = getDistrictListAsArray();
//		$this->loadLists();
//		$this->renderView('animator/activities/student', $this->data);
		$this->studentSessionListing();
	}
	public function studentSessionListing()
	{
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['std_sess_comp_option'] = 'active';

		$this->loadLists();

		$this->renderView('animator/activities/student_session_listing', $this->data);
	}

	private function loadLists()
	{
		$this->data['org_id']                   = $this->getOrgId();
		$this->data['cluster_id']               = $this->getClusterId();
		$this->data['center_id']                = $this->getActiveCenterId();
		$this->data['user_role']                = '5';
		$this->data['cluster_list']             = $this->clusterModel->read_as_list_by_org($this->getOrgId());
		$this->data['district_list']            = getDistrictListAsArray();

		$this->data['all_students']             = $this->getStudentsByStatus('all');
		$this->data['not_submitted_students']   = $this->getStudentsByStatus('not_submitted');
		$this->data['pending_students']         = $this->getStudentsByStatus('pending');
		$this->data['approved_students']        = $this->getStudentsByStatus('approved');
	}

	private function getStudentsByStatus($status)
	{
		// Logic to fetch students based on the given status
		// ...
		// Return an array of students
	}
	public function session_completed_students()
	{
		$this->data['title'] = "New Enrolment for CNCP"; //display('list_student');
		$this->data['PageTitle'] = display('list_student');
		$this->data['user_menu'] = 'menu-open';
		$this->data['user_list_option'] = 'active';
		/*---------- Read Center List And District List ----------*/
		$this->data['district_list'] = getDistrictListAsArray();
//		$this->data['users'] = $this->userModel->read_by_center($this->active_center_id);

		$this->renderView('animator/activities/enroll_new_for_cncp', $this->data);
	}
	public function cncp_enrolled()
	{
		$this->data['title'] = "Enroll For CNCP"; //display('list_student');
		/*---------- Read Center List And District List ----------*/
		$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['district_list'] = $this->dashboard_model->district_list();
		$this->data['users'] = $this->user_model->read_by_center($this->active_center_id);

		$this->data['content'] = $this->load->view('dashboard_ani/user/student_cncp_enrolled', $this->data, true);
		$this->load->view('dashboard_ani/layout/main_wrapper_lte', $this->data);
	}

	public function cncp_enrolled_new()
	{
		$this->data['title'] = "New Enrolment for CNCP"; //display('list_student');
		/*---------- Read Center List And District List ----------*/
		$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['district_list'] = $this->dashboard_model->district_list();
		$this->data['users'] = $this->user_model->read_by_center($this->active_center_id);

		$this->data['content'] = $this->load->view('dashboard_ani/user/enroll_new_for_cncp', $this->data, true);
		$this->load->view('dashboard_ani/layout/main_wrapper_lte', $this->data);
	}
	public function cncp_supported()
	{
		$this->data['title'] = "New Enrolment for CNCP"; //display('list_student');
		/*---------- Read Center List And District List ----------*/
		$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['district_list'] = $this->dashboard_model->district_list();
		$this->data['users'] = $this->user_model->read_by_center($this->active_center_id);

		$this->data['content'] = $this->load->view('dashboard_ani/user/enroll_new_for_cncp', $this->data, true);
		$this->load->view('dashboard_ani/layout/main_wrapper_lte', $this->data);
	}
	public function psycho_educated()
	{
		$this->data['title'] = "New Enrolment for CNCP"; //display('list_student');
		/*---------- Read Center List And District List ----------*/
		$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['district_list'] = $this->dashboard_model->district_list();
		$this->data['users'] = $this->user_model->read_by_center($this->active_center_id);

		$this->data['content'] = $this->load->view('dashboard_ani/user/enroll_new_for_cncp', $this->data, true);
		$this->load->view('dashboard_ani/layout/main_wrapper_lte', $this->data);
	}
	public function primary_counseling_status()
	{
		$this->data['title'] = "New Enrolment for CNCP"; //display('list_student');
		/*---------- Read Center List And District List ----------*/
		$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['district_list'] = $this->dashboard_model->district_list();
		$this->data['users'] = $this->user_model->read_by_center($this->active_center_id);

		$this->data['content'] = $this->load->view('dashboard_ani/user/enroll_new_for_cncp', $this->data, true);
		$this->load->view('dashboard_ani/layout/main_wrapper_lte', $this->data);
	}
	public function secondary_territiary_service()
	{
		$this->data['title'] = "New Enrolment for CNCP"; //display('list_student');
		/*---------- Read Center List And District List ----------*/
		$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['district_list'] = $this->dashboard_model->district_list();
		$this->data['users'] = $this->user_model->read_by_center($this->active_center_id);

		$this->data['content'] = $this->load->view('dashboard_ani/user/enroll_new_for_cncp', $this->data, true);
		$this->load->view('dashboard_ani/layout/main_wrapper_lte', $this->data);
	}
	public function psycho_social_well_being()
	{
		$this->data['title'] = "New Enrolment for CNCP"; //display('list_student');
		/*---------- Read Center List And District List ----------*/
		$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['district_list'] = $this->dashboard_model->district_list();
		$this->data['users'] = $this->user_model->read_by_center($this->active_center_id);

		$this->data['content'] = $this->load->view('dashboard_ani/user/enroll_new_for_cncp', $this->data, true);
		$this->load->view('dashboard_ani/layout/main_wrapper_lte', $this->data);
	}
	public function care_plans()
	{
		$this->data['title'] = "New Enrolment for CNCP"; //display('list_student');
		/*---------- Read Center List And District List ----------*/
		$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['district_list'] = $this->dashboard_model->district_list();
		$this->data['users'] = $this->user_model->read_by_center($this->active_center_id);

		$this->data['content'] = $this->load->view('dashboard_ani/user/enroll_new_for_cncp', $this->data, true);
		$this->load->view('dashboard_ani/layout/main_wrapper_lte', $this->data);
	}
	public function create_student()
	{
		$this->data['title'] = display('add_student');
		$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['district_list'] = $this->dashboard_model->district_list();
		//$this->data['cluster_list'] = $this->cluster_model->read_as_list_by_org($this->organisation->org_id);
		//$this->data['center_list'] =$this->center_model->read_as_list1($this->organisation->org_id);
		$this->data['center_list'] = $this->center_id;
		$id = $this->input->post('user_id');

		#-------------------------------#
		$this->form_validation->set_rules('firstname', display('first_name'), 'required|max_length[50]');
		$this->form_validation->set_rules('center_id', display('center_name'), 'required');
		$this->form_validation->set_rules('mobile', display('mobile'), 'required|numeric|min_length[10]|max_length[13]');
		$this->form_validation->set_rules('sex', display('sex'), 'required');
		$this->form_validation->set_rules('age', display('age'), 'required');
		//$this->form_validation->set_rules('cluster_idd',	display('cluster_name'),	'required');
		//$this->form_validation->set_rules('email', 			display('email'),		'required');
		//$this->form_validation->set_rules('password', 		display('password'),	'required|max_length[32]|md5');
		//$this->form_validation->set_rules('district', 		display('district'),	'required');
		//$this->form_validation->set_rules('block', 			display('block'),		'alpha');
		//$this->form_validation->set_rules('village', 		display('village'),		'alpha');
		//$this->form_validation->set_rules('school_type', 	display('school_type'),	'alpha');
		//$this->form_validation->set_rules('school_level', 	display('school_level'),'max_length[13]');
		//$this->form_validation->set_rules('school_name', 	display('school_name'),	'max_length[13]');
		//$this->form_validation->set_rules('sex', 			display('sex'),			'max_length[13]');
		//$this->form_validation->set_rules('sex', 			display('sex'),			'required|max_length[10]');
		//$this->form_validation->set_rules('address', 		display('address'),		'required|max_length[255]');
		//$this->form_validation->set_rules('status', 		display('status'),		'required');

		//picture upload
		$picture = $this->fileupload->do_upload(
			'siteassets/images/student/',
			'picture'
		);
		// if picture is uploaded then resize the picture
		if ($picture !== false && $picture != null) {
			$this->fileupload->do_resize(
				$picture,
				200,
				200
			);
		}

		// user_id	firstname	mobile	email	password	user_role	picture	district	block	village	school_type	school_level	school_name	sex	age	class	school_status	father_name	father_occup	mother_name	mother_occup	socail_status	center_id remarks	created_by	create_date	update_date	status

		#-------------------------------#//create a patient
		if ($id == null) {
			$this->data['student'] = (object) $postData = [
				'user_id' => $this->input->post('user_id'),
				'firstname' => $this->input->post('firstname', true),
				'mobile' => $this->input->post('mobile', true),
				'email' => "std" . $this->randStrGen(3, 4) . "@gmail.com",
				//$this->input->post('email'),
				'user_role' => '5',
				'picture' => (!empty($picture) ? $picture : $this->input->post('old_picture')),
				'password' => md5('password' /*$this->input->post('password')*/),
				'district' => $this->input->post('district'),
				'block' => $this->input->post('block'),
				'village' => $this->input->post('village'),
				'school_type' => $this->input->post('school_type'),
				'school_level' => $this->input->post('school_level'),
				'school_name' => $this->input->post('school_name'),
				'sex' => $this->input->post('sex'),
				'age' => $this->input->post('age'),
				'class' => $this->input->post('class'),
				'school_status' => $this->input->post('school_status'),
				'father_name' => $this->input->post('father_name'),
				'father_occup' => $this->input->post('father_occup'),
				'mother_name' => $this->input->post('mother_name'),
				'mother_occup' => $this->input->post('mother_occup'),
				'org_idd' => $this->org_id,
				'cluster_idd' => $this->cluster_id,
				'center_id' => $this->input->post('center_id'),
				'remarks' => $this->input->post('remarks'),
				'socail_status' => $this->input->post('socail_status'),
				'created_by' => $this->session->userdata('user_id'),
				'create_date' => $this->input->post('create_date'),
				'update_date' => '',
				//$this->input->post('update_date'),
				'status' => 1 //$this->input->post('status')
			]; // update patient
		} else {
			$this->data['student'] = (object) $postData = [
				'user_id' => $this->input->post('user_id'),
				'firstname' => $this->input->post('firstname', true),
				'mobile' => $this->input->post('mobile', true),
				//'email'			=> $this->input->post('email'),
				'user_role' => '5',
				'picture' => (!empty($picture) ? $picture : $this->input->post('old_picture')),
				'password' => md5('password' /*$this->input->post('password')*/),
				'district' => $this->input->post('district'),
				'block' => $this->input->post('block'),
				'village' => $this->input->post('village'),
				'school_type' => $this->input->post('school_type'),
				'school_level' => $this->input->post('school_level'),
				'school_name' => $this->input->post('school_name'),
				'sex' => $this->input->post('sex'),
				'age' => $this->input->post('age'),
				'class' => $this->input->post('class'),
				'school_status' => $this->input->post('school_status'),
				'father_name' => $this->input->post('father_name'),
				'father_occup' => $this->input->post('father_occup'),
				'mother_name' => $this->input->post('mother_name'),
				'mother_occup' => $this->input->post('mother_occup'),
				'org_idd' => $this->org_id,
				'cluster_idd' => $this->cluster_id,
				'center_id' => $this->input->post('center_id'),
				'remarks' => $this->input->post('remarks'),
				'socail_status' => $this->input->post('socail_status'),
				'created_by' => $this->session->userdata('user_id'),
				'create_date' => $this->input->post('create_date'),
				'update_date' => date('Y-m-d'),
				'status' => 1 //$this->input->post('status')
			];
		}
		#-------------------------------#
		if ($this->form_validation->run() === true) {
			#if empty $id then insert data
			if (empty($postData['user_id'])) {
				if ($this->user_model->create($postData)) {
					$std_id = $this->db->insert_id();
					/*$user=$this->data['patient']->std_id;
										$numb=$postData['phone'];
										$response =$this->sms_model->send_sms($numb,'Welcome to Valley Diagnostic Centre. Your userid and password has been generated. Your userid='.$user.' and password= <YourPhoneNumber>.');*/
					#set success message
					$this->session->set_flashdata('message', $response . display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('dashboard_ani/user/stdprofile/' . $std_id);
			} else {
				if ($this->user_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('dashboard_ani/user/stdedit/' . $postData['user_id']);
			}
		} else {
			$this->data['content'] = $this->load->view('dashboard_ani/user/std_form', $this->data, true);
			$this->load->view('dashboard_ani/layout/main_wrapper_lte', $this->data);
		}
	}

	public function stdedit($std_id = '')
	{
		$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['district_list'] = $this->dashboard_model->district_list();
		//$this->data['cluster_list'] = $this->cluster_model->read_as_list_by_org($this->organisation->org_id);
		$this->data['student'] = $this->user_model->read_by_id($std_id);
		//$this->data['center_list'] =$this->center_model->read_as_list1($this->organisation->org_id);
		$this->data['center_list'] = $this->center_id;
		// print_r($this->data['student']); die();
		$this->data['content'] = $this->load->view('dashboard_ani/user/std_form', $this->data, true);
		$this->load->view('dashboard_ani/layout/main_wrapper_lte', $this->data);
	}

	public function stdprofile($std_id = '')
	{
		$this->data['title'] = display('student_info');
		$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['student'] = $this->user_model->read_by_id($std_id);
		$this->data['content'] = $this->load->view('dashboard_ani/user/std_profile2', $this->data, true);
		$this->load->view('dashboard_ani/layout/main_wrapper_lte', $this->data);
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
		redirect('dashboard_ani/user/');
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
		$this->data['document'] = (object) $postData = array(
			'patient_id' => $this->input->post('patient_id'),
			'doctor_id' => $this->input->post('doctor_id'),
			'description' => $this->input->post('description'),
			'hidden_attach_file' => $this->input->post('hidden_attach_file'),
			'date' => date('Y-m-d'),
			'upload_by' => (($urole == 10) ? 0 : $this->session->userdata('user_id'))
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
			$filename = $_FILES['attach_file']['name'];
			$filename = strstr($filename, '.', true);
			$email = $this->session->userdata('email');
			$filename = strstr($email, '@', true) . "_" . $filename;
			$filename = strtolower($filename);
			/*-----------------------------*/

			$config['upload_path'] = FCPATH . './assets/attachments/';
			// $config['allowed_types'] = 'csv|pdf|ai|xls|ppt|pptx|gz|gzip|tar|zip|rar|mp3|wav|bmp|gif|jpg|jpeg|jpe|png|txt|text|log|rtx|rtf|xsl|mpeg|mpg|mov|avi|doc|docx|dot|dotx|xlsx|xl|word|mp4|mpa|flv|webm|7zip|wma|svg';
			$config['allowed_types'] = '*';
			$config['max_size'] = 0;
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$config['file_ext_tolower'] = true;
			$config['file_name'] = $filename;
			$config['overwrite'] = false;

			$this->load->library('upload', $config);

			$name = 'attach_file';
			if (!$this->upload->do_upload($name)) {
				$this->data['exception'] = $this->upload->display_errors();
				$this->data['status'] = false;
				echo json_encode($this->data);
			} else {
				$upload = $this->upload->data();
				$this->data['message'] = display('upload_successfully');
				$this->data['filepath'] = './assets/attachments/' . $upload['file_name'];
				$this->data['status'] = true;
				echo json_encode($this->data);
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
		$cluster_idd = $this->input->post('cluster_idd');
		return $this->center_model->center_by_cluster($cluster_idd);
	}
}
