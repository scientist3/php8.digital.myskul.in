<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {

	private $org_id;
    private $cluster_id;
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
		if ($this->session->userdata('isLogIn') == false ||  $this->session->userdata('user_role') != 3	)
			redirect('login');
		$this->load->library("pagination");
		$this->org_id       = $this->session->userdata('org_id');
        $this->cluster_id   = $this->session->userdata('cluster_id');
        $this->user_id      = $this->session->userdata('user_id');
        //print_r($this->session->userdata());
	}
	public function index()
	{
		$data['title']="Study Material";
		$data['user_role_list']=$this->dashboard_model->get_user_roles();
		#------------------------------------------------#
		$data['materials']  =$this->material_model->read_for_org($this->org_id,$this->cluster_id);
		//print_r($data['materials']);
		// print_r($this->organisation);
		// print_r($this->user_id);

		// die();
		$data['content']  = $this->load->view('dashboard_cor/material/list',$data,true);
		$this->load->view('dashboard_cor/layout/main_wrapper_lte',$data);
	}
	/*
	public function timeline_view()
	{
		$data['title']="Material";
		$data['user_role_list']=$this->dashboard_model->get_user_roles();
		#------------------------------------------------#
		$config = array();
        $config["base_url"] = base_url() . "material/timeline_view";
        $config["total_rows"] = $this->material_model->count();
        $config["per_page"] = 4;
        $config["uri_segment"] = 3;
        $config["prev_link"] = "Previous";
        $config['next_link'] = 'Next';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '&nbsp; <li class="active"><a >';
		$config['cur_tag_close'] = '</a></li>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = explode('&nbsp;',$this->pagination->create_links() );

		$data['materials']  =$this->material_model->read($config["per_page"], $page);
		$data['content']  = $this->load->view('material/list_timeline',$data,true);
		$this->load->view('dashboard_std/layout/main_wrapper_lte',$data);
	}*/

	public function view($mat_id='')
	{
		$data['title']="Material";
		$data['user_role_list']=$this->dashboard_model->get_user_roles();
		$user_id =$this->session->userdata('user_id');
		//$this->material_model->add_view_entry($mat_id,$user_id);
		$data['total_views'] = $this->material_model->total_views($mat_id);

		
		$data['material']  =$this->material_model->read_by_id($mat_id);
		$data['content']  = $this->load->view('dashboard_cor/material/view',$data,true);
		$this->load->view('dashboard_cor/layout/main_wrapper_lte',$data);
	}

	public function create(){

		$data['title'] = display('add_material');
		$data['district_list']=$this->dashboard_model->district_list();
		$data['user_role_list']=$this->dashboard_model->get_user_roles();
		#-------------------------------------------------#
		# Fetch Cluster List
		$data['center_list'] = $this->center_model->read_as_list($this->org_id,$this->cluster_id);
		// print_r($data['cluster_list']); die();
		# Fetch Center List
		#-------------------------------------------------#
		
		$id = $this->input->post('mat_id');

		#-------------------------------#
		$this->form_validation->set_rules('mat_title', 	display('title') ,		'required|max_length[100]');
		$this->form_validation->set_rules('mat_desc' , 	display('description'),	'required|max_length[300]');
		//$this->form_validation->set_rules('org_idd',   	display('org_name'),		'required');
		//$this->form_validation->set_rules('cluster_idd',display('cluster_name'),	'required');
		$this->form_validation->set_rules('center_idd', display('center_name'),	'required');
		$this->form_validation->set_rules('mat_type',  	display('type'),		'required');
		if($this->input->post('mat_type')==1){
			$this->form_validation->set_rules('mat_video_link', display('video_link'), 'trim|required|htmlspecialchars|callback_url_check');
		}else{
			$this->form_validation->set_rules('hidden_attach_file', display('attach_file'),'required');
		}
		$this->form_validation->set_rules('mat_status',display('status'),'required');
		#-------------------------------#
		//$mat_date = $this->input->post('mat_date');
		// mat_id  mat_title   mat_desc    mat_type    mat_extra   mat_video_link  mat_doc_link    mat_date    mat_for     mat_by  mat_status 
		$url = $this->input->post('mat_video_link');
		$video_id='';
		if (!empty($url)) {	
			parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
        	$video_id = isset($my_array_of_vars['v'])?$my_array_of_vars['v']:'';
		}
		//create material
		$data['material'] = (object)$postData = [
			'mat_id'		=> $this->input->post('mat_id'),
			'mat_title'		=> $this->input->post('mat_title'),
			'mat_desc'		=> $this->input->post('mat_desc'),
			'mat_type'		=> $this->input->post('mat_type'),
			'mat_video_link'=> $video_id,
			'mat_doc_link'	=> $this->input->post('hidden_attach_file'),
			'mat_date'		=> date('Y-m-d H:m:s'),//date('m/d/Y',strtotime((!empty($mat_date) ? $mat_date : date("m/d/Y")))),
			'org_idd'		=> $this->org_id,
			'cluster_idd'	=> $this->cluster_id,
			'center_idd'	=> $this->input->post('center_idd'),
			'mat_by'		=> $this->session->userdata('user_id'),
			'mat_status'	=> $this->input->post('mat_status'),
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
				redirect('dashboard_cor/material');
			} else { // Update
				if ($this->material_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('dashboard_cor/material/edit/'.$postData['mat_id']);
			}
		} else {
			$data['content'] = $this->load->view('dashboard_cor/material/upload',$data,true);
			$this->load->view('dashboard_cor/layout/main_wrapper_lte',$data);
		}   
	}
	
   	public function edit($mat_id = null) 
	{ 
		$data['title'] = display('edit_material');
		$data['district_list']=$this->dashboard_model->district_list();
		$data['user_role_list']=$this->dashboard_model->get_user_roles();
		$data['center_list'] = $this->center_model->read_as_list($this->org_id,$this->cluster_id);
		#-------------------------------#
		$data['material'] = $this->material_model->read_by_id($mat_id);
		$data['content'] = $this->load->view('dashboard_cor/material/upload',$data,true);
		$this->load->view('dashboard_cor/layout/main_wrapper_lte',$data);
	}

	public function delete($mat_id = null)
    {
    	if ($this->material_model->delete($mat_id)) {
    		if($this->input->get('isfile')){
		    	$file = './uploads/material/'.$this->input->get('file');
		    	if (file_exists($file)) {
		    		@unlink($file);
		    	}
		    }
    		$this->session->set_flashdata('message', display('delete_successfully'));

    	} else {
    		$this->session->set_flashdata('exception', display('please_try_again'));
    	}

    	redirect('dashboard_cor/material');
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
			$filename = strstr($email, '@', true)."_".$filename;
			$filename = strtolower($filename);
			/*-----------------------------*/

			$config['upload_path']   = './uploads/material/';
			// $config['allowed_types'] = 'csv|pdf|ai|xls|ppt|pptx|gz|gzip|tar|zip|rar|mp3|wav|bmp|gif|jpg|jpeg|jpe|png|txt|text|log|rtx|rtf|xsl|mpeg|mpg|mov|avi|doc|docx|dot|dotx|xlsx|xl|word|mp4|mpa|flv|webm|7zip|wma|svg';
			$config['allowed_types'] = 'pdf|xls|ppt|pptx|doc|docx|word|mov|avi|mp4|mpa|flv|webm';
			$config['max_size']      = 0;
			$config['max_width']     = 0;
			$config['max_height']    = 0;
			$config['file_ext_tolower'] = true; 
			$config['file_name']     =  $filename;
			$config['overwrite']     = false;
			$this->load->library('upload', $config);

			$name = 'attach_file';
			if ( ! $this->upload->do_upload($name) ) {
				$data['exception'] = $this->upload->display_errors();
				$data['status'] = false;
				echo json_encode($data);
			} else {
				$upload =  $this->upload->data();
				$data['message'] = display('upload_successfully');
				//$data['filepath'] = './uploads/material/'.$upload['file_name'];
				$data['filepath'] = $upload['file_name'];
				$data['status'] = true;
				echo json_encode($data);
			}
		}  
	}
	public function url_check($str){
		if (!strchr($str,"http")){
			$this->form_validation->set_message('url_check', 'The {field} field must contain a valid URL.');
			return FALSE;
		} else {
        	return TRUE;
        }
	}
	public function download($file) {
        $this->load->helper('download');
        $filepath = "./uploads/material/" . $this->uri->segment(4);
		//echo $filepath;die;
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(4);
        force_download($name, $data);
    }

    public function center_by_cluster()
    {
    	$cluster_idd = $this->input->post('cluster_idd');
    	return $this->center_model->center_by_cluster($cluster_idd);
    }
}
