<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/MaterialController.php');

class CMaterial extends MaterialController
{
	private $organisation;
	private $user_id;

	public function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'dashboard_model',
			'setting_model',
			'contactus_model',
			'user_model',
			'organisation_model',
			'cluster_model',
			'center_model',
			'material_model'
		));
		if ($this->session->userdata('isRepLogIn') == false || $this->session->userdata('user_role') != 2)
			redirect('login');
		$this->load->library("pagination");
		$this->user_id = $user_id = $this->session->userdata('user_id');
		$this->organisation = $this->organisation_model->read_orgheads_org($user_id);
	}

	public function index()
	{
		$this->data['title'] = "Study Material";
		$this->data['PageTitle'] = 'View Study Material';
		$this->data['material_menu'] = 'menu-open';
		$this->data['material_view_option'] = 'active';
		// $this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		#------------------------------------------------#
		$this->data['materials'] = $this->material_model->read_for_org($this->getOrgId());
		//print_r($this->data['materials']);
		// print_r($this->organisation);
		// print_r($this->user_id);

		// die();
		$this->data['content'] = $this->load->view('organisation/material/list', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function view($mat_id = ''): void
	{
		$this->data['title'] = "Material";
		$this->data['PageTitle'] = 'Material';
		$this->data['material_menu'] = 'menu-open';
		$this->data['material_view_option'] = 'active';
		//$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$user_id = $this->session->userdata('user_id');
		//$this->material_model->add_view_entry($mat_id,$user_id);
		$this->data['total_views'] = $this->material_model->total_views($mat_id);


		$this->data['material'] = $this->material_model->read_by_id($mat_id);
		$this->data['content'] = $this->load->view('organisation/material/view', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function create(): void
	{

		$this->data['title'] = display('add_material');
		$this->data['PageTitle'] = 'Add Study Material';
		$this->data['material_menu'] = 'menu-open';
		$this->data['material_add_option'] = 'active';

		$this->data['district_list'] = getDistrictListAsArray();
		//$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		#-------------------------------------------------#
		# Fetch Cluster List
		$this->data['cluster_list'] = $this->cluster_model->read_as_list_by_org($this->getOrgId());
		// print_r($this->data['cluster_list']); die();
		# Fetch Center List
		#-------------------------------------------------#

		$id = $this->input->post('mat_id');

		#-------------------------------#
		$this->form_validation->set_rules('mat_title', display('title'), 'required|max_length[100]');
		$this->form_validation->set_rules('mat_desc', display('description'), 'required|max_length[300]');
		//$this->form_validation->set_rules('org_idd',   	display('org_name'),		'required');
		$this->form_validation->set_rules('cluster_idd', display('cluster_name'), 'required');
		$this->form_validation->set_rules('center_idd', display('center_name'), 'required');
		$this->form_validation->set_rules('mat_type', display('type'), 'required');
		if ($this->input->post('mat_type') == 1) {
			; //$this->form_validation->set_rules('mat_video_link', display('video_link'),'required|valid_url|callback_url_check');
			$this->form_validation->set_rules('mat_video_link', display('video_link'), 'trim|required|htmlspecialchars');
		} else {
			$this->form_validation->set_rules('hidden_attach_file', display('attach_file'), 'required');
		}
		$this->form_validation->set_rules('mat_status', display('status'), 'required');
		#-------------------------------#
		//$mat_date = $this->input->post('mat_date');
		// mat_id  mat_title   mat_desc    mat_type    mat_extra   mat_video_link  mat_doc_link    mat_date    mat_for     mat_by  mat_status 
		//create material
		$url = $this->input->post('mat_video_link');
		$video_id = '';
		if (!empty($url)) {
			$parsed_url = parse_url($url);
			if (isset($parsed_url['query'])) {
				parse_str($parsed_url['query'], $my_array_of_vars);
				$video_id = isset($my_array_of_vars['v']) ? $my_array_of_vars['v'] : $url;
			}else{
				$video_id = $url;
			}
		}

		$this->data['material'] = (object)$postData = [
			'mat_id' => $this->input->post('mat_id'),
			'mat_title' => $this->input->post('mat_title'),
			'mat_desc' => $this->input->post('mat_desc'),
			'mat_type' => $this->input->post('mat_type'),
			'mat_video_link' => $video_id, //$this->input->post('mat_video_link'),
			'mat_doc_link' => $this->input->post('hidden_attach_file'),
			'mat_date' => date('Y-m-d H:m:s'), //date('m/d/Y',strtotime((!empty($mat_date) ? $mat_date : date("m/d/Y")))),
			'org_idd' => $this->getOrgId(),
			'cluster_idd' => $this->input->post('cluster_idd'),
			'center_idd' => $this->input->post('center_idd'),
			'mat_by' => $this->session->userdata('user_id'),
			'mat_status' => $this->input->post('mat_status'),
		];

		#-------------------------------#
		if ($this->form_validation->run() === true) {
			#if empty $id then insert data
			if (empty($id)) {
				if ($this->material_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('organisation/cmaterial');
			} else { // Update
				if ($this->material_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('organisation/cmaterial/edit/' . $postData['mat_id']);
			}
		} else {
			$this->data['content'] = $this->load->view('organisation/material/upload', $this->data, true);
			$this->load->view('organisation/starter/starter_layout', $this->data);
		}
	}

	public function edit($mat_id = null)
	{
		$this->data['title'] = display('edit_material');
		$this->data['PageTitle'] = 'Edit Study Material';
		$this->data['material_menu'] = 'menu-open';
		$this->data['material_add_option'] = 'active';
		$this->data['district_list'] = getDistrictListAsArray();
		//$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['cluster_list'] = $this->cluster_model->read_as_list_by_org($this->getOrgId());
		#-------------------------------#
		$this->data['material'] = $this->material_model->read_by_id($mat_id);
		$this->data['content'] = $this->load->view('organisation/material/upload', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function delete($mat_id = null)
	{
		if ($this->material_model->delete($mat_id)) {
			if ($this->input->get('isfile')) {
				$file = './uploads/material/' . $this->input->get('file');
				if (file_exists($file)) {
					@unlink($file);
				}
			}
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));
		}

		redirect('organisation/cmaterial');
	}

	public function download($material_id)
	{
		// Retrieve the file path or name associated with the material ID from the database
		$filePathOrName = $this->material_model->getFilePathOrName($material_id); // Adjust this line based on your database query

		if ($filePathOrName) {
			// Construct the full path to the file
			$filePath = FCPATH . $filePathOrName;

			// Check if the file exists
			if (file_exists($filePath)) {
				// Set the appropriate headers for downloading
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="' . $filePathOrName . '"');
				header('Content-Length: ' . filesize($filePath));

				// Read the file and output its contents
				readfile($filePath);
			} else {
				// Handle the case where the file does not exist
				echo "File not found.";
			}
		} else {
			// Handle the case where the file data is not found in the database
			echo "File data not found in the database.";
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

			$file_path = "./uploads/material/" . date('Y-m-d') . "/";
			if (!is_dir($file_path))
				mkdir($file_path, 0755, true);
			/*-----------------------------*/

			$config['upload_path'] = $file_path;
			// $config['allowed_types'] = 'csv|pdf|ai|xls|ppt|pptx|gz|gzip|tar|zip|rar|mp3|wav|bmp|gif|jpg|jpeg|jpe|png|txt|text|log|rtx|rtf|xsl|mpeg|mpg|mov|avi|doc|docx|dot|dotx|xlsx|xl|word|mp4|mpa|flv|webm|7zip|wma|svg';
			$config['allowed_types'] = 'pdf|xls|ppt|pptx|doc|docx|word|mov|avi|mp4|mpa|flv|webm';
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
				//$this->data['filepath'] = './uploads/material/'.$upload['file_name'];
				$this->data['filepath'] = $file_path . $upload['file_name'];
				$this->data['status'] = true;
				echo json_encode($this->data);
			}
		}
	}

	public function url_check($str)
	{

		if (!$this->dashboard_model->valid_url($str)) {
			$this->form_validation->set_message('url_check', 'The {field} field must contain a valid URL.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function center_by_cluster()
	{
		$cluster_idd = $this->input->post('cluster_idd');
		$selectedCenterId = $this->input->post('center_idd');
		return $this->center_model->center_by_cluster($cluster_idd, $selectedCenterId);
	}
}
