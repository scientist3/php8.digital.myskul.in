<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/coordinator/Coordinator.php');

class Message extends Coordinator
{
	private $org_id;
	private $cluster_id;
	private $user_id;

	public function __construct()
	{
		parent::__construct();

		$this->load->model(array(
//			'dashboard_model',
//			'user_model',
			'messages/message_model',
//			'organisation_model'
		));
	}

	public function index($sender_id = null)
	{
		$this->data['title']          = display('inbox');
		$this->data['PageTitle']      = display('inbox');
		$this->data['message_menu']   = 'menu-open';
		$this->data['inbox_option']   = 'active' ;

		$this->data['received_emails'] = $this->message_model->getReceivedEmails($this->getUserId());
		$this->renderView('coordinator/messages/inbox', $this->data);
	}

	public function sent($receiver_id = null)
	{
		$this->data['title']          = display('sent');
		$this->data['PageTitle']      = display('sent');
		$this->data['message_menu']   = 'menu-open';
		$this->data['sent_option']    = 'active' ;

		$this->data['sent_emails'] = $this->message_model->getSentEmails($this->getUserId());

		$this->renderView('coordinator/messages/sent', $this->data);
	}

	public function inbox_information($id = null, $sender_id = null)
	{
		$this->data['title']          = display('messages');
		$this->data['PageTitle']      = display('messages');

		$this->data['message_menu']   = 'menu-open';
		$this->data['inbox_option']    = 'active' ;
		$receiver_id = $this->session->userdata('user_id');
		#-------------------------------#
		$this->message_model->update(
			array(
				'id' => $id,
				'receiver_status' => 1
			)
		);
		#-------------------------------#
		$this->data['message'] = $this->message_model->inbox_information($id, $sender_id, $receiver_id);
		$this->renderView('coordinator/messages/inbox_information', $this->data);
	}

	public function sent_information($id = null, $receiver_id = null)
	{
		$this->data['title']          = display('messages');
		$this->data['PageTitle']      = display('messages');
		$this->data['message_menu']   = 'menu-open';
		$this->data['sent_option']    = 'active' ;
		$sender_id = $this->session->userdata('user_id');
		#-------------------------------#
		$this->data['message'] = $this->message_model->sent_information($id, $sender_id, $receiver_id);
		$this->renderView('coordinator/messages/sent_information', $this->data);
	}


	public function new_message()
	{
		$this->data['PageTitle']      = display('new_message');
		$this->data['message_menu']   = 'menu-open';
		$this->data['new_message_option']    = 'active' ;
		/*----------FORM VALIDATION RULES----------*/
		$this->form_validation->set_rules('receiver_id', display('receiver_name'), 'required|max_length[11]');
		//$this->form_validation->set_rules('subject', display('subject'),'required|max_length[255]');
		$this->form_validation->set_rules('message', display('message'), 'required|trim');
		/*-------------STORE DATA------------*/

		$this->data['message'] = (object)$postData = array(
			'id'          => $this->input->post('id'),
			'sender_id'   => $this->getUserId(),
			'receiver_id' => $this->input->post('receiver_id'),
			'message'     => $this->input->post('message', true),
			'datetime'    => date("Y-m-d h:i:s"),
			'sender_status'   => 1,
			'receiver_status' => 0,
		);
		$this->data['user_role'] = $this->input->post('user_role');
		/*-----------CREATE A NEW RECORD-----------*/
		if ($this->form_validation->run() === true) {
			if ($this->message_model->create($postData)) {
				#set success message
				$this->session->set_flashdata('message', display('message_sent'));
			} else {
				#set exception message
				$this->session->set_flashdata('exception', display('please_try_again'));
			}
			redirect('coordinator/message/new_message');
		} else {
			$this->data['title'] = display('new_message');
			$this->data['designation_list'] = UserRole1::getBasicRoleNamesAsArray();
			$this->data['user_list'] = $this->userModel->user_by_role_as_list_for_coordinator_nojson(null, $this->getUserId(), $this->org_id, $this->cluster_id);
			$this->renderView('coordinator/messages/new_message', $this->data);
		}
	}


	public function delete($id = null, $sender_id = null, $receiver_id = null)
	{
		$user_id = $this->session->userdata('user_id');
		if ($user_id == $sender_id) {
			$condition = "sender_status";
			$this->message_model->delete($id, $condition);
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else if ($user_id == $receiver_id) {
			$condition = "receiver_status";
			$this->message_model->delete($id, $condition);
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect($_SERVER['HTTP_REFERER']);
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
			$email    = $this->session->userdata('email');
			$filename = strstr($email, '@', true) . "_" . $filename;
			$filename = strtolower($filename);

			/*-----------------------------*/
			//$file_path = 'siteassets/images/message/'.$this->session->userdata('patient_id').'/';
			$file_path = 'siteassets/images/message/Admin/';
			if (!is_dir($file_path))
				mkdir($file_path, 0755, true);

			$config['upload_path']      = $file_path;
			// $config['allowed_types'] = 'csv|pdf|ai|xls|ppt|pptx|gz|gzip|tar|zip|rar|mp3|wav|bmp|gif|jpg|jpeg|jpe|png|txt|text|log|rtx|rtf|xsl|mpeg|mpg|mov|avi|doc|docx|dot|dotx|xlsx|xl|word|mp4|mpa|flv|webm|7zip|wma|svg';
			$config['allowed_types']    = 'pdf|bmp|gif|jpg|jpeg|jpe|png|mpeg|mpg|mov|avi|mp4';
			$config['max_size']         = 20480;
			$config['max_width']        = 0;
			$config['max_height']       = 0;
			$config['file_ext_tolower'] = true;
			$config['file_name']        =  $filename;
			$config['overwrite']        = false;
			$this->load->library('upload', $config);

			$name = 'attach_file';
			if (!$this->upload->do_upload($name)) {
				$this->data['exception'] = $this->upload->display_errors();
				$this->data['status'] = false;
				echo json_encode($data);
			} else {
				$upload =  $this->upload->data();
				$this->data['message'] = display('upload_successfully');
				$this->data['filepath'] = $file_path . $upload['file_name'];
				$this->data['status'] = true;
				echo json_encode($data);
			}
		}
	}

	public function user_by_role()
	{
		$user_role = $this->input->post('user_role');
		return $this->userModel->user_by_role_as_list_for_coordinator($user_role, $this->getUserId(), $this->getOrgId(), $this->cluster_id);
	}
}
