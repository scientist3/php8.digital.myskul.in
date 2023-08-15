<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/ClusterController.php');

class CCluster extends ClusterController
{
	private $objCluster;
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
		$this->data['title']										= 'Add/ View Clusters';
		$this->data['PageTitle']								= 'Add/ View Clusters';
		$this->data['cluster_menu']							= 'menu-open';
		$this->data['left_subtitle'] 						= display('add_cluster');
		$this->data['right_subtitle']						= display('list_cluster');
		$this->data['cluster_add_list_option']	= 'active';

		$this->objCluster 											= $this->getClusterObject();

		$this->data['input'] 										= (object) $this->objCluster->toArray();

		$this->data['cluster_list'] 						= $this->getUserService()->fetchClustersByOrgIdAsList($this->getOrgId());


		#-------------------------------# create an Organisation
		$this->validateClusterForm();
		#-------------------------------#
		try {
			$this->addOrUpdateCluster($this->objCluster);
		} catch (\Throwable $th) {
			redirect('organisation/ccluster/edit/' . $this->data['input']->cluster_id);
		}
	}

	public function edit($cluster_id = null)
	{
		if (empty($cluster_id)) {
			redirect('organisation/ccluster/create');
		}
		$this->data['title']										= 'Edit/ View Clusters';
		$this->data['PageTitle']								= 'Edit/ View Clusters';
		$this->data['left_subtitle'] 						= display('edit_cluster');
		$this->data['right_subtitle']						= display('list_cluster');
		$this->data['show_cancel_btn']					= 1;

		#-------------------------------#
		$this->data['input'] = $this->cluster_model->read_by_id($cluster_id);
		$this->data['show_add_button'] = 1;

		$this->data['content'] = $this->load->view('organisation/cluster/form', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function delete($cluster_id = null)
	{
		$this->deleteCluster($cluster_id);
		redirect('organisation/ccluster');
	}

	public function statistics()
	{
		$this->data['title'] 											= display('list_cluster');
		$this->data['PageTitle']									= 'Add/ View Clusters';
		$this->data['cluster_menu']								= 'menu-open';
		$this->data['cluster_statistics_option']	= 'active';


		$this->data['clusters'] = $this->fetchClusterDetailsWithCentersWithCounts($this->getOrgId());
		$this->data['center_list'] = $this->fetchInterventionAreasDetailsWithStudentCountByClusterId($this->uri->segment(4) ?? current($this->data['clusters'])->cluster_id);

		$this->data['is_centers'] = false;
		if (!empty($this->uri->segment(4))) {
			$c_id = $this->uri->segment(4);
			//echo $c_id;die();
			// $this->data['center_list'] = $this->center_model->read_centers_by_cluster($c_id);
			// $this->data['std_by_cen_array'] = $this->user_model->total_student_of_center();
			$this->data['is_centers'] = true;
		}

		$this->data['content'] = $this->load->view('organisation/cluster/statistics', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}
}
