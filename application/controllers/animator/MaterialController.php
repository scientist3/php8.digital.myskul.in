<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/animator/Animator.php');
class MaterialController extends Animator
{

	public function __construct()
	{
		parent::__construct();
		// Load Common Data;
		$this->loadCommonData();
	}

	private function loadCommonData()
	{
	}

	public function fetchMaterialByOrgByCluster($intOrgid, $intClusterId){
		return $this->material_model->fetchMaterialByOrgByCluster($intOrgid, $intClusterId);
	}

	public function getFilePathOrName($material_id)
	{
		return $this->material_model->getFilePathOrName($material_id);
	}
	public function valid_url($url)
	{
		//$pattern = "/^((ht|f)tp(s?)\:\/\/|~/|/)?([w]{2}([\w\-]+\.)+([\w]{2,5}))(:[\d]{1,5})?/";
		$pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
		if (!preg_match($pattern, $url)) {
			return FALSE;
		}

		return TRUE;
	}
}

	class Material
	{
		private $mat_id;
		private $mat_title;
		private $mat_desc;
		private $mat_type;
		private $mat_video_link;
		private $mat_doc_link;
		private $mat_date;
		private $org_idd;
		private $cluster_idd;
		private $center_idd;
		private $mat_by;
		private $mat_status;

		public function setValues($data)
		{
			if (isset($data['mat_id'])) {
				$this->mat_id = $data['mat_id'];
			}
			$this->mat_title = $data['mat_title'];
			$this->mat_desc = $data['mat_desc'];
			$this->mat_type = $data['mat_type'];
			$this->mat_video_link = $data['mat_video_link'];
			$this->mat_doc_link = $data['mat_doc_link'];
			$this->mat_date = $data['mat_date'];
			$this->org_idd = $data['org_idd'];
			$this->cluster_idd = $data['cluster_idd'];
			$this->center_idd = $data['center_idd'];
			$this->mat_by = $data['mat_by'];
			$this->mat_status = $data['mat_status'];
		}

		public function toArray()
		{
			return [
				'mat_id' => $this->getMatId(),
				'mat_title' => $this->getMatTitle(),
				'mat_desc' => $this->getMatDesc(),
				'mat_type' => $this->getMatType(),
				'mat_video_link' => $this->getMatVideoLink(),
				'mat_doc_link' => $this->getMatDocLink(),
				'mat_date' => $this->getMatDate(),
				'org_idd' => $this->getOrgId(),
				'cluster_idd' => $this->getClusterId(),
				'center_idd' => $this->getCenterId(),
				'mat_by' => $this->getMatBy(),
				'mat_status' => $this->getMatStatus()
			];
		}

		// Getter methods
		public function getMatId()
		{
			return $this->mat_id;
		}

		public function getMatTitle()
		{
			return $this->mat_title;
		}

		public function getMatDesc()
		{
			return $this->mat_desc;
		}

		public function getMatType()
		{
			return $this->mat_type;
		}

		public function getMatVideoLink()
		{
			return $this->mat_video_link;
		}

		public function getMatDocLink()
		{
			return $this->mat_doc_link;
		}

		public function getMatDate()
		{
			return $this->mat_date;
		}

		public function getOrgId()
		{
			return $this->org_idd;
		}

		public function getClusterId()
		{
			return $this->cluster_idd;
		}

		public function getCenterId()
		{
			return $this->center_idd;
		}

		public function getMatBy()
		{
			return $this->mat_by;
		}

		public function getMatStatus()
		{
			return $this->mat_status;
		}
	}

