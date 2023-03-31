<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temp extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
        parent::__construct();
        error_reporting(0);
        $this->load->database();
        $this->load->model('Model_functions','model');
        $this->load->helper(array('form', 'url','date'));
	}


	/**
	*

		@HATH NA LAIE

	*
	*/
	/*     TEMPLATE     */

	public function template($page = '', $data = '')
	{
		$this->load->view($page,$data);
	}


	public function index()
	{
		$data['cats'] = $this->model->get_sub_cats('all',0);
		$this->template('temp/index',$data);
	}
	public function upload()
	{
		$this->template('temp/upload');
	}
	public function get_companies()
	{
		$resp = $this->model->get_companies_by_cat($_POST['cat']);
		if ($resp) {
			$html = '';
			foreach ($resp as $key => $cat) {
				$html .= '<tr>';
					$html .= '<td>'.$cat['company_id'].'</td>';
					$html .= '<td>'.$cat['company_name'].'</td>';
				$html .= '</tr>';
			}
			echo json_encode(array("status"=>true,"html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false));
		}
	}
	public function uploadimages()
	{
		error_reporting(E_ALL);
		if($_FILES["file"]["size"] > 0){
            $config['upload_path'] = 'uploads/';
        	$config['allowed_types'] = 'zip';
			$config['file_name'] = $_FILES["file"]['name'];
			$resp = $this->load->library('upload', $config);
            if($this->load->library('upload', $config))
            {
            	$this->upload->do_upload('file');
                redirect('temp/upload');
            }
            else
            {
                $error = array('error' => $this->upload->display_errors());
                echo json_encode($error);
            }
        }
	}
}
