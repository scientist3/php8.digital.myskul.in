<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/CenterController.php');
class CCenter extends CenterController
{
	public $data;
	public $objCenterService;
	public $user_id;
	public $organisation;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('CenterService');
		$this->load->model(
			array(
				'setting_model',
				'dashboard_model',
				'organisation_model',
				'cluster_model',
				'center_model',
				'user_model',
			)
		);

		if ($this->session->userdata('isRepLogIn') == false || $this->session->userdata('user_role') != 2) {
			redirect('login');
		}

		$this->user_id                = $user_id = $this->session->userdata('user_id');
		$this->organisation           = $this->organisation_model->read_orgheads_org($user_id);
		//$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();

		$this->objCenterService 			= new $this->centerservice();
		$this->data['center_type'] 		= $this->objCenterService->fetchCenterTypeAsList();
		//print_r($this->organisation);
	}
	public function index()
	{
		// $this->data['centers']     = $this->objCenterService->fetchCentersByOrgId($this->organisation->org_id);
		// $this->data['content']     = $this->load->view('organisation/center/list', $this->data, true);
		// $this->load->view('organisation/starter/starter_layout', $this->data);
		$this->create();
	}

	public function create()
	{
		$this->data['title']					= display('add_cluster');
		$this->data['PageTitle']			= 'Add/ View Interventional Areas';
		$this->data['left_title']			= display('list_center');
		$this->data['right_title']		=	display('add_cluster');
		$this->data['center_menu']							= 'menu-open';
		$this->data['center_add_list_option']		= 'active';



		$this->data['animator_list']	= $this->objCenterService->fetchAnimatorListByOrgId($this->organisation->org_id);
		$this->data['cluster_list']		= $this->objCenterService->fetchClusterListByOrgId($this->organisation->org_id);
		$this->data['centers']				= $this->objCenterService->fetchCentersByOrgId($this->organisation->org_id);

		$this->form_validation->set_rules('center_name', display('center_name'), 'required|max_length[150]');
		$this->form_validation->set_rules('center_cluster_id', display('cluster_name'), 'required');
		$this->form_validation->set_rules('center_head_id', display('animator'), 'required');

		#-------------------------------# create an Organisation
		// center_id    center_name    center_head_id    center_cluster_id
		//if ($org_id == null) {
		$this->data['center'] = (object) $postData = [
			'center_id'         => $this->input->post('center_id'),
			'center_name'       => $this->input->post('center_name', true),
			'center_head_id'    => $this->input->post('center_head_id'),
			'center_cluster_id' => $this->input->post('center_cluster_id'),
			'center_type_id' 		=> $this->input->post('center_type_id'),
		]; // update patient

		#-------------------------------#
		if ($this->form_validation->run() === true) {
			#if empty $id then insert data
			if (empty($postData['center_id'])) {
				if ($this->center_model->create($postData)) {

					#set success message
					$this->session->set_flashdata('message',  display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('organisation/ccenter');
			} else {
				if ($this->center_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				// redirect('organisation/ccenter/edit/' . $postData['center_id']);
				redirect('organisation/ccenter');
			}
		} else {
			$this->data['content'] = $this->load->view('organisation/center/form', $this->data, true);
			$this->load->view('organisation/starter/starter_layout', $this->data);
		}
	}

	public function edit($center_id = null)
	{
		$this->data['title']          = display('edit_center');
		$this->data['PageTitle']			= 'Add/ Edit Interventional Areas';
		$this->data['left_title']			= display('list_center');
		$this->data['right_title']		= display('edit_cluster');
		$this->data['show_cancel_btn']					= 1;


		$this->data['animator_list']  = $this->user_model->read_as_list_ani();
		$this->data['centers']				= $this->objCenterService->fetchCentersByOrgId($this->organisation->org_id);
		$this->data['cluster_list']   = $this->cluster_model->read_as_list();
		#-------------------------------#
		$this->data['center']  = $this->center_model->read_by_id($center_id);
		$this->data['content'] = $this->load->view('organisation/center/form', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function delete($center_id = null)
	{
		$this->deleteCenter($center_id);
		redirect('organisation/ccenter');
	}
}
