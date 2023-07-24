<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	 private $org_id;
    private $cluster_id;
    private $user_id;
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'user_model',
			'center_model',
			'cluster_model',
			'dashboard_model',
			'organisation_model',
			
		));
		if ($this->session->userdata('isLogIn') == false || $this->session->userdata('user_role') != 3)
            redirect('login');
        $this->org_id       = $this->session->userdata('org_id');
        $this->cluster_id   = $this->session->userdata('cluster_id');
        $this->user_id      = $this->session->userdata('user_id');
	}
 
	#-------------------- Member -------------------#
	
	public function members($value='') {
		$data['title'] 			= display('list_user');
		/*---------- Read Center List And District List ----------*/
		$data['user_role_list']	= $this->dashboard_model->get_user_roles();
		$data['district_list']	= $this->dashboard_model->district_list();
		//echo $org_id;
		$data['users'] 			= $this->user_model->read_members_for_coodinator($this->org_id,$this->cluster_id);
		$data['content'] = $this->load->view('dashboard_cor/user/member',$data,true);
		$this->load->view('dashboard_cor/layout/main_wrapper_lte',$data);
	}

	public function create_member($value='') {
		$data['title'] = display('add_member');
		$data['user_role_list']=$this->dashboard_model->get_user_roles();
		$l=[];
		foreach ($data['user_role_list'] as $k => $v) {
			if ($k==4) {
				$l[$k]=$v;
			}
		}
		$data['user_role_list1']= $l;
		$data['district_list']=$this->dashboard_model->district_list();
		$data['center_list'] = $this->center_model->read_as_list($this->org_id,$this->cluster_id);
		//$data['cluster_list']		= $this->cluster_model->read_as_list_by_org($this->org_id);
        $id = $this->input->post('user_id');
        
		#-------------------------------#
		$this->form_validation->set_rules('firstname', 	display('first_name'),	'required|max_length[50]');
		$this->form_validation->set_rules('email', 		display('email'),		'required|callback_email_check['.$this->input->post('user_id').']');
		$this->form_validation->set_rules('mobile', 	display('mobile'),		'required|numeric|min_length[10]|max_length[13]');
		$this->form_validation->set_rules('age', 		display('age'),			'numeric');
		// $this->form_validation->set_rules('user_role',	display('user_role'),	'required');
		$this->form_validation->set_rules('sex', 		display('sex'),			'required');
		//$this->form_validation->set_rules('cluster_idd',display('cluster_name'),'required');
		//$this->form_validation->set_rules('password', 		display('password'),	'required|max_length[32]|md5');
		//$this->form_validation->set_rules('district', 		display('district'),	'required');
		//$this->form_validation->set_rules('block', 			display('block'),		'alpha');
		//$this->form_validation->set_rules('village', 		display('village'),		'alpha');
		//$this->form_validation->set_rules('school_type', 	display('school_type'),	'alpha');
		//$this->form_validation->set_rules('school_level', 	display('school_level'),'max_length[13]');
		//$this->form_validation->set_rules('school_name', 	display('school_name'),	'max_length[13]');
		//$this->form_validation->set_rules('sex', 			display('sex'),			'required|max_length[10]');
		//$this->form_validation->set_rules('address', 		display('address'),		'required|max_length[255]');
		//$this->form_validation->set_rules('status', 		display('status'),		'required');

		//picture upload
        $picture = $this->fileupload->do_upload(
            'siteassets/images/staff/',
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
			$data['student'] = (object)$postData = [
				'user_id'		=> $this->input->post('user_id'),
				'firstname'		=> $this->input->post('firstname',true),
				'mobile'		=> $this->input->post('mobile',true),
				'email'			=> /*"std".$this->randStrGen(3,4)."@gmail.com",// */ $this->input->post('email'),
				'user_role'		=> '4',
				'picture'      	=> (!empty($picture)?$picture:$this->input->post('old_picture')),
				'password'		=> md5($this->input->post('mobile')),
				'district'		=> $this->input->post('district'),
				'block'			=> $this->input->post('block'),
				'village'		=> $this->input->post('village'),
				'age'			=> $this->input->post('age'),
				'sex'			=> $this->input->post('sex'),
				'org_idd'		=> $this->org_id,
				'cluster_idd'	=> $this->cluster_id,
				'center_id'		=> $this->input->post('center_id'),
				'created_by'   	=> $this->session->userdata('user_id'),
				'create_date' 	=> date('Y-m-d'),
				'update_date' 	=> '',//$this->input->post('update_date'),
				'status'       	=> 1 //$this->input->post('status')
				/*'school_type'	=> $this->input->post('school_type'),
				'school_level'	=> $this->input->post('school_level'),
				'school_name'	=> $this->input->post('school_name'),
				'class'			=> $this->input->post('class'),
				'school_status'	=> $this->input->post('school_status'),
				'father_name'	=> $this->input->post('father_name'),
				'father_occup'	=> $this->input->post('father_occup'),
				'mother_name'	=> $this->input->post('mother_name'),
				'mother_occup'	=> $this->input->post('mother_occup'),
				'center_id'		=> $this->input->post('center_id'),
				'remarks'		=> $this->input->post('remarks'),
				'socail_status'	=> $this->input->post('socail_status'),*/
			]; // update patient
		} else { 
			$data['student'] = (object)$postData = [
				'user_id'		=> $this->input->post('user_id'),
				'firstname'		=> $this->input->post('firstname',true),
				'mobile'		=> $this->input->post('mobile',true),
				'email'			=> /*"std".$this->randStrGen(3,4)."@gmail.com",// */ $this->input->post('email'),
				'user_role'		=> '4',
				'picture'      	=> (!empty($picture)?$picture:$this->input->post('old_picture')),
				'password'		=> md5($this->input->post('mobile')),
				'district'		=> $this->input->post('district'),
				'block'			=> $this->input->post('block'),
				'village'		=> $this->input->post('village'),
				'age'			=> $this->input->post('age'),
				'sex'			=> $this->input->post('sex'),
				'org_idd'		=> $this->org_id,
				'cluster_idd'	=> $this->cluster_id,
				'center_id'		=> $this->input->post('center_id'),
				'created_by'   	=> $this->session->userdata('user_id'),
				'create_date' 	=> date('Y-m-d'),
				'update_date' 	=> '',//$this->input->post('update_date'),
				'status'       	=> 1 //$this->input->post('status')
				/*'school_type'	=> $this->input->post('school_type'),
				'school_level'	=> $this->input->post('school_level'),
				'school_name'	=> $this->input->post('school_name'),
				'class'			=> $this->input->post('class'),
				'school_status'	=> $this->input->post('school_status'),
				'father_name'	=> $this->input->post('father_name'),
				'father_occup'	=> $this->input->post('father_occup'),
				'mother_name'	=> $this->input->post('mother_name'),
				'mother_occup'	=> $this->input->post('mother_occup'),
				'center_id'		=> $this->input->post('center_id'),
				'remarks'		=> $this->input->post('remarks'),
				'socail_status'	=> $this->input->post('socail_status'),*/
			]; 
		}
		#-------------------------------#
		if ($this->form_validation->run() === true) {
			#if empty $id then insert data
			if (empty($postData['user_id'])) {
				if ($this->user_model->create($postData)) {
					$u_id = $this->db->insert_id();
					/*$user=$data['patient']->std_id;
					$numb=$postData['phone'];
					$response =$this->sms_model->send_sms($numb,'Welcome to Valley Diagnostic Centre. Your userid and password has been generated. Your userid='.$user.' and password= <YourPhoneNumber>.');*/
					#set success message
					$this->session->set_flashdata('message', $response.display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('dashboard_cor/user/user_profile/' . $u_id);
			} else {
				if ($this->user_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('dashboard_cor/user/user_edit/'.$postData['user_id']);
			}
		} else {
			$data['content'] = $this->load->view('dashboard_cor/user/member_form',$data,true);
			$this->load->view('dashboard_cor/layout/main_wrapper_lte',$data);
		}
	}

	public function email_check($email, $id) { 
        $emailExists = $this->db->select('email')
            ->where('email',$email) 
            ->where_not_in('user_id',$id) 
            ->get('student')
            ->num_rows();

        if ($emailExists > 0) {
            $this->form_validation->set_message('email_check', 'The {field} field must contain a unique value.');
            return false;
        } else {
            return true;
        }
    }

    public function user_profile($user_id = null) { 
		$data['title'] =  display('user_info');
		#-------------------------------#
		$data['user_role_list']=$this->dashboard_model->get_user_roles();
		$data['profile'] = $this->user_model->read_user_by_id($user_id);
		$data['content'] = $this->load->view('dashboard_cor/user/user_profile',$data,true);
		$this->load->view('dashboard_cor/layout/main_wrapper_lte',$data);
	}

	public function user_edit($user_id = null) { 
		$data['title'] = display('user_edit');
		$data['user_role_list']=$this->dashboard_model->get_user_roles();
		$l=[];
		foreach ($data['user_role_list'] as $k => $v) {
			if ($k!=5 && $k !=1&& $k !=2) {
				$l[$k]=$v;
			}
		}
		$data['user_role_list1']= $l;
		$data['district_list']	=$this->dashboard_model->district_list();
		$data['center_list'] = $this->center_model->read_as_list($this->org_id,$this->cluster_id);
		// $data['center_list'] 	=$this->center_model->read_as_list();
		// $data['cluster_list']	= $this->cluster_model->read_as_list_by_org($this->organisation->org_id);
		#-------------------------------#
		//$data['patient'] = $this->patient_model-$data['user_role_list']=$this->dashboard_model->get_user_roles();
		//$data['district_list']=$this->dashboard_model->district_list();
		//$data['center_list'] =$this->center_model->read_as_list();
		$data['student'] = $this->user_model->read_user_by_id($user_id);
		$data['content'] = $this->load->view('dashboard_cor/user/member_form',$data,true);
		$this->load->view('dashboard_cor/layout/main_wrapper_lte',$data);
	}
 
	public function user_delete($user_id = null) {
		if ($this->user_model->delete($user_id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('dashboard_cor/user/members');
	}

	#-------------------- Student -------------------#
	public function index() { 
		$data['title'] 			= display('list_student');
		/*---------- Read Center List And District List ----------*/
		$data['user_role_list']	= $this->dashboard_model->get_user_roles();
		$data['district_list']	= $this->dashboard_model->district_list();
		$data['users'] 			= $this->user_model->read_students($this->org_id,$this->cluster_id);
		
		$data['content'] = $this->load->view('dashboard_cor/user/student',$data,true);
		$this->load->view('dashboard_cor/layout/main_wrapper_lte',$data);
	}

	public function create_student() {
		$data['title'] = display('add_student');
		$data['user_role_list']=$this->dashboard_model->get_user_roles();
		$data['district_list']=$this->dashboard_model->district_list();
		//$data['cluster_list'] = $this->cluster_model->read_as_list_by_org($this->organisation->org_id);
		//$data['center_list'] =$this->center_model->read_as_list1($this->organisation->org_id);
		$data['center_list'] = $this->center_model->read_as_list($this->org_id,$this->cluster_id);
        $id = $this->input->post('user_id');
        
		#-------------------------------#
		$this->form_validation->set_rules('firstname', 		display('first_name'),	'required|max_length[50]');
		$this->form_validation->set_rules('center_id', 		display('center_name'),	'required');
		$this->form_validation->set_rules('mobile', 		display('mobile'),		'required|numeric|min_length[10]|max_length[13]');
		$this->form_validation->set_rules('sex', 			display('sex'),			'required|trim');
		$this->form_validation->set_rules('age', 			display('age'),			'required|trim');
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
			$data['student'] = (object)$postData = [
				'user_id'		=> $this->input->post('user_id'),
				'firstname'		=> $this->input->post('firstname',true),
				'mobile'		=> $this->input->post('mobile',true),
				'email'			=> "std".$this->randStrGen(3,4)."@gmail.com",//$this->input->post('email'),
				'user_role'		=> '5',
				'picture'      	=> (!empty($picture)?$picture:$this->input->post('old_picture')),
				'password'		=> md5('password'/*$this->input->post('password')*/),
				'district'		=> $this->input->post('district'),
				//'block'			=> $this->input->post('block'),
				//'village'		=> $this->input->post('village'),
				//'school_type'	=> $this->input->post('school_type'),
				'school_level'	=> $this->input->post('school_level'),
				//'school_name'	=> $this->input->post('school_name'),
				'sex'			=> $this->input->post('sex'),
				'age'			=> $this->input->post('age'),
				//'class'			=> $this->input->post('class'),
				'school_status'	=> $this->input->post('school_status'),
				'father_name'	=> $this->input->post('father_name'),
				//'father_occup'	=> $this->input->post('father_occup'),
				'mother_name'	=> $this->input->post('mother_name'),
				//'mother_occup'	=> $this->input->post('mother_occup'),
				'org_idd'		=> $this->org_id,
				'cluster_idd'	=> $this->cluster_id,
				'center_id'		=> $this->input->post('center_id'),
				//'remarks'		=> $this->input->post('remarks'),
				//'socail_status'	=> $this->input->post('socail_status'),
				'created_by'   	=> $this->session->userdata('user_id'),
				'create_date' 	=> $this->input->post('create_date'),
				'update_date' 	=> '',//$this->input->post('update_date'),
				'status'       	=> 1 //$this->input->post('status')
			]; // update patient
		} else { 
			$data['student'] = (object)$postData = [
				'user_id'		=> $this->input->post('user_id'),
				'firstname'		=> $this->input->post('firstname',true),
				'mobile'		=> $this->input->post('mobile',true),
				//'email'			=> $this->input->post('email'),
				'user_role'		=> '5',
				'picture'      	=> (!empty($picture)?$picture:$this->input->post('old_picture')),
				'password'		=> md5('password'/*$this->input->post('password')*/),
				'district'		=> $this->input->post('district'),
				//'block'			=> $this->input->post('block'),
				//'village'		=> $this->input->post('village'),
				//'school_type'	=> $this->input->post('school_type'),
				'school_level'	=> $this->input->post('school_level'),
				//'school_name'	=> $this->input->post('school_name'),
				'sex'			=> $this->input->post('sex'),
				'age'			=> $this->input->post('age'),
				//'class'			=> $this->input->post('class'),
				'school_status'	=> $this->input->post('school_status'),
				'father_name'	=> $this->input->post('father_name'),
				//'father_occup'	=> $this->input->post('father_occup'),
				'mother_name'	=> $this->input->post('mother_name'),
				//'mother_occup'	=> $this->input->post('mother_occup'),
				'org_idd'		=> $this->org_id,
				'cluster_idd'	=> $this->cluster_id,
				'center_id'		=> $this->input->post('center_id'),
				//'remarks'		=> $this->input->post('remarks'),
				//'socail_status'	=> $this->input->post('socail_status'),
				'created_by'   	=> $this->session->userdata('user_id'),
				'create_date' 	=> $this->input->post('create_date'),
				'update_date' 	=> date('Y-m-d'),
				'status'       	=> 1 //$this->input->post('status')
			]; 
		}
		#-------------------------------#
		if ($this->form_validation->run() === true) {
			#if empty $id then insert data
			if (empty($postData['user_id'])) {
				if ($this->user_model->create($postData)) {
					$std_id = $this->db->insert_id();
					/*$user=$data['patient']->std_id;
					$numb=$postData['phone'];
					$response =$this->sms_model->send_sms($numb,'Welcome to Valley Diagnostic Centre. Your userid and password has been generated. Your userid='.$user.' and password= <YourPhoneNumber>.');*/
					#set success message
					$this->session->set_flashdata('message', $response.display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('dashboard_cor/user/stdprofile/' . $std_id);
			} else {
				if ($this->user_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('dashboard_cor/user/stdedit/'.$postData['user_id']);
			}
		} else {
			$data['content'] = $this->load->view('dashboard_cor/user/std_form',$data,true);
			$this->load->view('dashboard_cor/layout/main_wrapper_lte',$data);
		}	
	}
	
	public function stdedit($std_id='') {
		$data['user_role_list']=$this->dashboard_model->get_user_roles();
		$data['district_list']=$this->dashboard_model->district_list();
		//$data['cluster_list'] = $this->cluster_model->read_as_list_by_org($this->organisation->org_id);
		$data['student'] = $this->user_model->read_by_id($std_id);
		//$data['center_list'] =$this->center_model->read_as_list1($this->organisation->org_id);
		$data['center_list'] = $this->center_model->read_as_list($this->org_id,$this->cluster_id);
		// print_r($data['student']); die();
		$data['content'] = $this->load->view('dashboard_cor/user/std_form',$data,true);
		$this->load->view('dashboard_cor/layout/main_wrapper_lte',$data);
	}
	
	public function stdprofile($std_id='') {
		$data['title']=display('student_info');
		$data['user_role_list']=$this->dashboard_model->get_user_roles();
		$data['student'] = $this->user_model->read_by_id($std_id);
		$data['content'] = $this->load->view('dashboard_cor/user/std_profile2',$data,true);
		$this->load->view('dashboard_cor/layout/main_wrapper_lte',$data);
	}

	public function stddelete($std_id = null) {
		if ($this->user_model->delete($std_id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('dashboard_cor/user/');
	}


    /*
    |----------------------------------------------
    |        id genaretor
    |----------------------------------------------     
    */
    public function randStrGen($mode = null, $len = null){
        $result = "";
        if($mode == 1):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 2):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif($mode == 3):
            $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 4):
            $chars = "0123456789";
        endif;

        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++) {
                $randItem = array_rand($charArray);
                $result .="".$charArray[$randItem];
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
		$data['title'] = display('document_list');
		$data['documents'] = $this->document_model->read();
		$data['content'] = $this->load->view('document',$data,true);
		if($this->session->userdata('user_role')==1)
			$this->load->view('layout/main_wrapper_lte',$data);
		else if ($this->session->userdata('user_role')==2) {
			$this->load->view('dashboard_incharge/main_wrapper_lte',$data);
		}
	}

    public function document_form()
    {  
        $data['title'] = display('add_document'); 
        /*----------VALIDATION RULES----------*/
        $this->form_validation->set_rules('patient_id', display('patient_id') ,'required|max_length[30]');
        $this->form_validation->set_rules('doctor_name', display('doctor_id'),'max_length[11]');
        $this->form_validation->set_rules('description', display('description'),'trim');
        $this->form_validation->set_rules('hidden_attach_file', display('attach_file'),'required|max_length[255]');
        /*-------------STORE DATA------------*/
        $urole = $this->session->userdata('user_role');
        $data['document'] = (object)$postData = array( 
            'patient_id'  => $this->input->post('patient_id'),
            'doctor_id'   => $this->input->post('doctor_id'),
            'description' => $this->input->post('description'),
            'hidden_attach_file' => $this->input->post('hidden_attach_file'),
            'date'        => date('Y-m-d'),
            'upload_by'   => (($urole==10)?0:$this->session->userdata('user_id'))
        );  

        /*-----------CREATE A NEW RECORD-----------*/
        if ($this->form_validation->run() === true) { 
 
            if ($this->document_model->create($postData)) {
                #set success message
                $this->session->set_flashdata('message', display('save_successfully'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception',display('please_try_again'));
            }
            redirect('patient/document_form');
        } else {
            $data['doctor_list'] = $this->doctor_model->doctor_list(); 
            $data['content'] = $this->load->view('document_form',$data,true);
            if($this->session->userdata('user_role')==1)
				$this->load->view('layout/main_wrapper_lte',$data);
			else if ($this->session->userdata('user_role')==2) {
				$this->load->view('dashboard_incharge/main_wrapper_lte',$data);
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
            $email    = $this->session->userdata('email');
            $filename = strstr($email, '@', true)."_".$filename;
            $filename = strtolower($filename);
            /*-----------------------------*/

            $config['upload_path']   = FCPATH .'./assets/attachments/';
            // $config['allowed_types'] = 'csv|pdf|ai|xls|ppt|pptx|gz|gzip|tar|zip|rar|mp3|wav|bmp|gif|jpg|jpeg|jpe|png|txt|text|log|rtx|rtf|xsl|mpeg|mpg|mov|avi|doc|docx|dot|dotx|xlsx|xl|word|mp4|mpa|flv|webm|7zip|wma|svg';
            $config['allowed_types'] = '*';
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
                $data['filepath'] = './assets/attachments/'.$upload['file_name'];
                $data['status'] = true;
                echo json_encode($data);
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
