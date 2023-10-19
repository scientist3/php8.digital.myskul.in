<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/coordinator/Coordinator.php');

class Cstakeholder extends Coordinator
{
	//private $organisation;
	private $user_id;
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['session']);
		$this->load->model(
			array(
				'stakeholder_model' => 'StakeholderModel',
			)
		);
	}

	public function index()
	{
		$this->data['title'] = display('list_stakeholders');
		$this->data['PageTitle'] = display('list_stakeholders');
		$this->data['stakeholder_menu'] = 'menu-open';
		$this->data['list_stakeholders'] = 'active';

		$this->data['stakeholders'] = $this->StakeholderModel->readStakeholdersByOrgId( $this->getOrgId() );
		$this->data['stakeholder_details'] = (object) $this->StakeholderModel->countStakeholdersByClusterIdByStakeholderType( $this->getClusterId() );

		$this->renderView('coordinator/stakeholder/index', $this->data);
	}
}
