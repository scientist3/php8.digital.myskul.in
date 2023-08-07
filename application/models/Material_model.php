<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Material_model extends CI_Model {

	private $table = "material";
	private $mat_log_tbl ="material_log";
 
	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 	public function add_view_entry($mat_id= null , $user_id= null)
 	{
 		$added = $this->db->from($this->mat_log_tbl)
 			->where('ml_mat_id',$mat_id)
 			->where('ml_user_id',$user_id)
			->count_all_results();
		//echo $added; die();
		if (!$added) {
			$data = [
	            'ml_id'      	=> null,
	            'ml_mat_id'  	=> $mat_id,
	            'ml_user_id'   	=> $user_id,
	            'ml_seen'  		=> '1'
        	]; 
			$this->db->insert($this->mat_log_tbl,$data);
		}
 	}
 	public function read_for_org($org_id= null,$cluster_id= null)
 	{
 		if ($cluster_id!=null) {
 			$material = $this->db->select("material.*,center.center_name,cluster.cluster_name,organisation.org_name")
			->from($this->table)
			->join('center','center.center_id=material.center_idd','left')
			->join('cluster','cluster_id=material.cluster_idd','left')
			->join('organisation','org_id=material.org_idd','left')
			->where('org_idd',$org_id)
			->where('cluster_idd',$cluster_id)
			->order_by('material.mat_date','desc')
			->get()
			->result();
 		}else{
 			$material = $this->db->select("material.*,center.center_name,cluster.cluster_name,organisation.org_name")
			->from($this->table)
			->join('center','center.center_id=material.center_idd','left')
			->join('cluster','cluster_id=material.cluster_idd','left')
			->join('organisation','org_id=material.org_idd','left')
			->where('org_idd',$org_id)
			->order_by('material.mat_date','desc')
			->get()
			->result();
 		}

		$mat_view = $this->db->select("material_log.*")
				->from($this->mat_log_tbl)
				->get()
				->result();
		$final = [];
			foreach ($material as $key => $mat) {
				$mat->seenby=[];
				foreach ($mat_view as $k => $s) {
					if ($s->ml_mat_id== $mat->mat_id) {
						# code...
						//print_r($s);
						$mat->seenby[$s->ml_user_id] = $s->ml_date;
					}
				}
				
				$final[$mat->mat_id] =$mat;
				//$final[$mat->mat_id]['v'] ='';
				//print_r($mat);
			}
			// print_r((object)$final);
			// die();

		return $final;
 	}


	public function read($limit=0, $offset=0,$center_id=null,$user_id = null)
	{
		// center_id	center_name	center_head_id	center_cluster_id
		if($center_id==null){
			return $this->db->select("material.*,material_log.*,count(material_log.ml_mat_id) as total_views,student.firstname")
				->from($this->table)
				->where('mat_status','1')
				->join('material_log','material.mat_id=ml_mat_id','left')
				->group_by('ml_mat_id')
				->join('student','student.user_id= material.mat_by','left')
				->order_by('mat_date','desc')
				->limit($limit,$offset)
				->get()
				->result();
			/*
			return $this->db->select("material.*,material_log.*,student.firstname")
				->from($this->table)
				->where('mat_status','1')
				->join('material_log','material.mat_id=ml_mat_id','left')
				->join('student','student.user_id= material.mat_by','left')
				->order_by('mat_date','desc')
				->limit($limit,$offset)
				->get()
				->result(); */
		}else{
			$data = $this->db->select("material.*")
				->from($this->table)
				->where('mat_status','1')
				->where('mat_for',$center_id)
				//->join('material_log','material.mat_id=ml_mat_id','left') ,material_log.*
				//->group_by('ml_user_id')
				//->join('student','student.user_id= material.mat_by','left')
				//->where('ml_user_id',$user_id)
				//->or_where('ml_user_id IS NULL')
				->order_by('mat_date','desc')
				->limit($limit,$offset)
				//->get_compiled_select();
				->get()
				->result();

			//print_r($data);
			//echo "<br> ------------------------------------------------------ <br>";
			$data1 = $this->db->select("material_log.*")
				->from($this->mat_log_tbl)
				//->where('mat_status','1')
				//->where('mat_for',$center_id)
				//->join('material_log','material.mat_id=ml_mat_id','left') ,material_log.*
				//->group_by('ml_user_id')
				//->join('student','student.user_id= material.mat_by','left')
				//->where('ml_user_id',$user_id)
				//->or_where('ml_user_id IS NULL')
				//->order_by('mat_date','desc')
				//->limit($limit,$offset)
				//->get_compiled_select();
				->get()
				->result();
			//print_r($data1); 

			$final = [];
			foreach ($data as $key => $mat) {
				$mat->seenby=[];
				foreach ($data1 as $k => $s) {
					if ($s->ml_mat_id== $mat->mat_id) {
						# code...
						//print_r($s);
						$mat->seenby[$s->ml_user_id] = $s->ml_date;
					}
				}
				
				$final[$mat->mat_id] =$mat;
				//$final[$mat->mat_id]['v'] ='';
				//print_r($mat);
			}
			// print_r((object)$final);
			// die();

			return $final;
			/*
			return $this->db->select("material.*,material_log.*,student.firstname")
				->from($this->table)
				->where('mat_status','1')
				->where('mat_for',$center_id)
				->join('material_log','material.mat_id=ml_mat_id','left')
				//->group_by('ml_mat_id')
				->join('student','student.user_id= material.mat_by','left')
				->order_by('mat_date','desc')
				->limit($limit,$offset)
				->get()
				->result();
				*/
		}
	}
	
	public function read_as_list()
	{
		$result = $this->db->select("*")
			->from($this->table)
			->order_by('center_name','asc')
			->get()
			->result();
		$list['']=display('select_cluster');
		foreach($result as $row){
			$list[$row->center_id] = $row->center_name;
		}
		return $list;
	}
	public function read_by_id($id = null)
	{
		return $this->db->select("material.*,student.firstname")
			->from($this->table)
			->where('mat_id',$id)
			->join('student','student.user_id= material.mat_by','left')
			->get()
			->row();
	}
	public function update($data = [])
	{
		return $this->db->where('mat_id',$data['mat_id'])
			->update($this->table,$data); 
	} 
	public function delete($id = null)
	{
		$this->db->where('mat_id',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}
	public function count()
	{
		return $this->db->from($this->table)
			->count_all_results();
	}
	
	public function total_views($mat_id)
	{
		return $this->db->from($this->mat_log_tbl)
			->where('ml_mat_id',$mat_id)
			->count_all_results();
	}

	public function new_videos($std_id=null,$center_id=null)
	{
		$data= $this->read(0,0,$center_id,$std_id);
		//print_r($data);
		//echo $std_id;
		$new_vids =0;
		foreach ($data as $k => $mat) {
			if ($mat->mat_type==1) {
				if (!array_key_exists($std_id, $mat->seenby)) {
					$new_vids+=1;
				}
			}
		}
		return $new_vids;
		/*
		$total_videos = $this->db->from($this->table)
			->where('mat_type','1')
			->where('mat_for',$center_id)
			->join('material_log','material_log.ml_mat_id=material.mat_id','left')
			//->where('ml_user_id !=',$std_id)
			->count_all_results();

		$seen_videos = $this->db->from($this->table)
			->where('mat_type','1')
			->where('mat_for',$center_id)
			->join('material_log','material_log.ml_mat_id=material.mat_id','left')
			->where('ml_user_id =',$std_id)
			->count_all_results();
		$new_videos = $total_videos-$seen_videos;
		return $new_videos; * /
		$new_vid = $this->db->from($this->table)
			->where('mat_type','1')
			->where('mat_for',$center_id)
			->join('material_log','material_log.ml_mat_id=material.mat_id','left')
			->where('ml_id IS NULL')
			->count_all_results();
		return $new_vid; */
	}

	public function new_docs($std_id=null,$center_id=null)
	{
		$data= $this->read(0,0,$center_id,$std_id);
		//print_r($data);
		//echo $std_id;
		$new_docs =0;
		foreach ($data as $k => $mat) {
			if ($mat->mat_type==2) {
				if (!array_key_exists($std_id, $mat->seenby)) {
					$new_docs+=1;
				}
			}
		}
		return $new_docs;
		/*die();
		$total_docs = $this->db->distinct('true')->from($this->table)
			->where('mat_type','2')
			->where('mat_for',$center_id)
			->join('material_log','material_log.ml_mat_id=material.mat_id','left')
			//->having('ml_seen')
			//->get_compiled_select();
			->count_all_results();
		//echo $total_docs;
		//die();
		$seen_docs = $this->db->from($this->table)
			->where('mat_type','2')
			->where('mat_for',$center_id)
			->join('material_log','material_log.ml_mat_id=material.mat_id','left')
			->where('ml_user_id =',$std_id)
			->count_all_results();
		$new_new = $total_docs-$seen_docs;
		return $new_new;
		

		/*$new_docs = $this->db->from($this->table)
			->where('mat_type','2')
			->where('mat_for',$center_id)
			->join('material_log','material_log.ml_mat_id=material.mat_id','left')
			->where('ml_id IS NULL')
			->count_all_results();
		return $new_docs;*/
	}
}