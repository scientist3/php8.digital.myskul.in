<?php

class OrganisationDashboardService
{
	private $CI; // CodeIgniter instance
	private $user_id;

	public function __construct()
	{
		$this->CI = &get_instance(); // Get the CodeIgniter instance
		$this->CI->load->model(
			array(
				'cluster_model' 						=> 'Cluster',
				'center_model' 							=> 'Center',
				'user_model'								=> 'User',
				'center_model' 							=> 'Center',
				'user_model'								=> 'User',
				'organisation/user1_model' 	=> 'OrgUser',
				'messages/message_model'		=> 'Message',
				'activities_model'          => 'ActivitiesModel'
			)
		);

		$this->user_id								= $this->CI->session->userdata('user_id');
	}

	public function fetchTotalOfClusterCenterAnimatorSuByOrgId($OrgId)
	{
		$data['total_clusters']				= $this->CI->Cluster->total_clusters_of_org($OrgId);
		$data['total_centers']				= $this->CI->Center->total_centers_of_org($OrgId);
		$data['new_messages']					= $this->CI->Message->new_messages_for_user($this->user_id);
		$data['total_animators']			= $this->CI->User->total_animators_of_org($OrgId);
		$data['total_students']				= $this->CI->User->total_students_of_org($OrgId);
		$data['total_logedin_today']	= $this->CI->OrgUser->total_logedin_today($OrgId, $this->user_id);
		$data['total_cor_logedin']		= $this->CI->OrgUser->total_cor_loggedin_today($OrgId, $this->user_id);
		$data['total_ani_logedin']		= $this->CI->OrgUser->total_ani_loggedin_today($OrgId, $this->user_id);
		$data['total_std_logedin']		= $this->CI->OrgUser->total_std_loggedin_today($OrgId, $this->user_id);
		$data['total_absentee_today']	= $this->CI->OrgUser->total_absentee_today($OrgId, $this->user_id);
		$data['total_cor_absentee']		= $this->CI->OrgUser->total_cor_absentee_today($OrgId, $this->user_id);
		$data['total_ani_absentee']		= $this->CI->OrgUser->total_ani_absentee_today($OrgId, $this->user_id);
		$data['total_std_absentee']		= $this->CI->OrgUser->total_std_absentee_today($OrgId, $this->user_id);
		return (object) $data;
	}

	public function fetchTotalOfActivitiesByOrgId($OrgId)
	{
		$data = $this->CI->ActivitiesModel->countActivitiesStatusFields($OrgId);
		$jsonString = json_encode($data);

		// Convert the JSON string to an object
		return json_decode($jsonString);

	}
}
