<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/coordinator/Coordinator.php');

class Cgroups extends Coordinator
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['session']);
		$this->load->model(
			array(
				'groups_model' => 'groupsModel'
			)
		);
	}
	public function index()
	{
		$this->create();
	}
	
	public function create()
	{
		$this->data['title']					= display('add_list_group');
		$this->data['PageTitle']			= 'Add/List Groups';
		$this->data['left_title']			= display('add_group');
		$this->data['right_title']		=	display('list_group');
		$this->data['group_menu']							= 'menu-open';
		$this->data['group_add_list_option']		= 'active';

		$this->data['groups'] = $this->groupsModel->getAll();

		$this->form_validation->set_rules('group_name', display('group_name'), 'required|max_length[150]');
		$this->form_validation->set_rules('status', display('group_status'), 'required');

		# create a Group
		$this->data['group'] = (object) $postData = [
			'g_id'        => $this->input->post('g_id'),
			'group_name'  => $this->input->post('group_name', true),
			'status' 		  => $this->input->post('status'),
		];

		if ($this->form_validation->run() === true) {
			#if empty $id then insert data
			if (empty($postData['g_id'])) {
				if ($this->groupsModel->create($postData)) {

					#set success message
					$this->session->set_flashdata('message',  display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('coordinator/cgroups');
			} else {
				if ($this->groupsModel->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('coordinator/cgroups');
			}
		} else {
			$this->renderView('coordinator/group/form', $this->data);
		}
	}

	public function edit($g_id = null)
	{
		$this->data['title']          = display('edit_center');
		$this->data['PageTitle']			= 'Add/List Groups';
		$this->data['left_title']			= display('edit_group');
		$this->data['right_title']		=	display('list_group');
		$this->data['group_menu']							= 'menu-open';
		$this->data['group_add_list_option']		= 'active';
		$this->data['show_cancel_btn']					= 1;

		$this->data['groups'] = $this->groupsModel->getAll();
		$this->data['group']  = $this->groupsModel->read_by_id($g_id);
		$this->renderView('coordinator/group/form', $this->data);
	}

	public function delete($g_id = null)
	{
		$this->groupsModel->delete($g_id);
		redirect('coordinator/cgroups/index');
	}
}
