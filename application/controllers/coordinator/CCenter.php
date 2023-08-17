<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/coordinator/CenterController.php');

class CCenter extends CenterController
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->create();
	}

	public function create()
	{
		$this->data['title'] = display('add_cluster');
		$this->data['PageTitle'] = 'Add/ View Interventional Areas';
		$this->data['left_title'] = display('list_center');
		$this->data['right_title'] = display('add_cluster');
		$this->data['center_menu'] = 'menu-open';
		$this->data['center_add_list_option'] = 'active';

		$this->prepareCommonData();

		$this->data['center'] = (object) $postData = $this->getCenterPostData();

		if ($this->form_validation->run() === true) {
			$this->processCenterData($postData);
		} else {
			$this->renderView('coordinator/center/form', $this->data);
		}
	}

	public function edit($center_id = null)
	{
		$this->data['title'] = display('edit_center');
		$this->data['PageTitle'] = 'Add/ Edit Interventional Areas';
		$this->data['left_title'] = display('list_center');
		$this->data['right_title'] = display('edit_cluster');
		$this->data['show_cancel_btn'] = 1;

		$this->prepareCommonData();

		//		$this->data['animator_list'] = $this->user_model->read_as_list_ani();
		//		$this->data['centers'] = $this->getObjCenterService()->fetchCentersByOrgId($this->getOrgId());
		//		$this->data['cluster_list'] = $this->cluster_model->read_as_list();

		$this->data['center'] = $this->center_model->read_by_id($center_id);
		$this->renderView('coordinator/center/form', $this->data);
	}

	public function delete($center_id = null)
	{
		$this->deleteCenter($center_id);
		redirect('coordinator/ccenter');
	}

	/**
	 * @throws Exception
	 */
	private function prepareCommonData()
	{
		$this->data['animator_list'] = $this->getObjCenterService()->fetchAnimatorListByOrgIdByClusterId($this->getOrgId(), $this->getClusterId());
		$this->data['cluster_list'] = $this->getObjCenterService()->fetchClusterListByOrgId($this->getOrgId());
		$this->data['centers'] = $this->getCentersOfLoggedInCluster();

		$this->form_validation->set_rules('center_name', display('center_name'), 'required|max_length[150]');
		$this->form_validation->set_rules('center_cluster_id', display('cluster_name'), 'required');
		$this->form_validation->set_rules('center_head_id', display('animator'), 'required');
	}

	private function getCenterPostData()
	{
		return [
			'center_id' => $this->input->post('center_id'),
			'center_name' => $this->input->post('center_name', true),
			'center_head_id' => $this->input->post('center_head_id'),
			'center_cluster_id' => !empty($this->input->post('center_cluster_id')) ? $this->input->post('center_cluster_id') : $this->getClusterId(),
			'center_type_id' => $this->input->post('center_type_id'),
		];
	}

	private function processCenterData($postData)
	{
		if (empty($postData['center_id'])) {
			$this->createNewCenter($postData);
		} else {
			$this->updateExistingCenter($postData);
		}
	}

	private function createNewCenter($postData)
	{
		if ($this->center_model->create($postData)) {
			$this->session->set_flashdata('message', display('save_successfully'));
		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('coordinator/ccenter');
	}

	private function updateExistingCenter($postData)
	{
		if ($this->center_model->update($postData)) {
			$this->session->set_flashdata('message', display('update_successfully'));
		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('coordinator/ccenter');
	}
}
