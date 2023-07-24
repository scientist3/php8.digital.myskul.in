<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Center extends CI_Controller {
	private $org_id;
	private $cluster_id;
	private $user_id;
	public function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'setting_model',
			'dashboard_model',
			'organisation_model',
			'cluster_model',
			'center_model',
			'user_model',
		));

		if ($this->session->userdata('isLogIn') == false || $this->session->userdata('user_role') != 3)
            redirect('login');
        $this->org_id = $this->session->userdata('org_id');
        $this->cluster_id =$this->session->userdata('cluster_id');
        $this->user_id = $this->session->userdata('user_id');
        // if (empty($this->cluster_id)) {
        //     $this->session->set_flashdata('message','You dont have any cluster assigned. Please Contact organisation head/admin.');
        // }
        //$this->user_id = $user_id = $this->session->userdata('user_id');
        //$this->organisation=$this->organisation_model->read_orgheads_org($user_id);
        //print_r($this->organisation);
	}
	public function index()
	{
		$data['']='';
		$data['title']			= display('list_center');
		$data['centers']		= $this->center_model->read($this->org_id,$this->cluster_id);
        $data['user_role_list']	= $this->dashboard_model->get_user_roles();
        $data['content']  		= $this->load->view('dashboard_cor/center/list',$data,true);
        $this->load->view('dashboard_cor/layout/main_wrapper_lte',$data);
	}

	public function create() {
		$data['title'] 				= display('add_cluster');
		$data['user_role_list']		= $this->dashboard_model->get_user_roles();
		$data['animator_list']		= $this->user_model->read_as_list_of_animator_of_cluster($this->cluster_id);
		//$data['cluster_list']		= $this->cluster_model->read_as_list_by_org($this->organisation->org_id);

        //$org_id = $this->input->post('org_id');
		#-------------------------------#
		$this->form_validation->set_rules('center_name', display('center_name'),'required|max_length[150]');
		//$this->form_validation->set_rules('center_cluster_id', display('cluster_name'),'required');
		$this->form_validation->set_rules('center_head_id', display('animator'),'required');
		// if (empty($this->cluster_id)) {
			
		// 	$this->session->set_flashdata('exception','You cannot add center unless have any cluster assigned. Please Contact organisation head/admin.');
		// 	redirect('dashboard_cor/dashboard_cor');
		// 	//$this->form_validation->set_message('cluster_id', 'The {field} field is required.');
		// }

		#-------------------------------# create an Organisation
		// center_id	center_name	center_head_id	center_cluster_id
		//if ($org_id == null) { 
			$data['center'] = (object)$postData = [
				'center_id'   		=> $this->input->post('center_id'),
				'center_name'    	=> $this->input->post('center_name',true),
				'center_head_id'	=> $this->input->post('center_head_id'),
				'center_cluster_id'	=> $this->cluster_id
			]; // update patient
		/*} else { 
			$data['center'] = (object)$postData = [
				'center_id'   		=> $this->input->post('center_id'),
				'center_name'    	=> $this->input->post('center_name',true),
				'center_head_id'	=> $this->input->post('center_head_id'),
				'center_cluster_id'	=> $this->input->post('center_cluster_id')
			]; 
		}*/
		#-------------------------------#
		if ($this->form_validation->run() === true) {
			#if empty $id then insert data
			if (empty($postData['center_id'])) {
				if ($this->center_model->create($postData)) {
					/*
					$patient_id = $this->db->insert_id();
					$user=$data['patient']->patient_id;
					$numb=$postData['phone'];
					$response =$this->sms_model->send_sms($numb,'Welcome to Valley Diagnostic Centre. Your userid and password has been generated. Your userid='.$user.' and password= <YourPhoneNumber>.');
					*/
					#set success message
					$this->session->set_flashdata('message', $response.display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('dashboard_cor/center');
			} else {
				if ($this->center_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('dashboard_cor/center/edit/'.$postData['center_id']);
			}
		} else {
			$data['content'] = $this->load->view('dashboard_cor/center/form',$data,true);
			$this->load->view('dashboard_cor/layout/main_wrapper_lte',$data);
		}	
	}

	public function edit($center_id = null) 
	{ 
		$data['title'] = display('edit_center');
		$data['user_role_list']=$this->dashboard_model->get_user_roles();
		$data['animator_list']		= $this->user_model->read_as_list_of_animator_of_cluster($this->cluster_id);
		#-------------------------------#
		$data['center'] = $this->center_model->read_by_id($center_id);
		$data['content'] = $this->load->view('dashboard_cor/center/form',$data,true);
		$this->load->view('dashboard_cor/layout/main_wrapper_lte',$data);
	}
 
	public function delete($center_id = null) 
	{
		if ($this->center_model->delete($center_id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('dashboard_cor/center');
	}
}