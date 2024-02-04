<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		error_reporting(0);
		$this->load->model('Model');
	}

	public function index()
	{
		$this->load->view('guest');
	}

	public function snap()
	{
		$updir = "./res/img/guest";
		$s = mktime();
		$file = $updir.$s.".jpg";
		$of = $s - 5;
		unlink($updir.$of.".jpg");
		file_put_contents($file,base64_decode(str_replace(' ','+',str_replace('data:image/png;base64,','',$this->input->post('hdata')))));
	}

	public function pushgps()
	{
		$this->Model->editrowa('2','users','lat',$this->uri->segment(3));
		$this->Model->editrowa('2','users','lot',$this->uri->segment(4));
	}

	public function getgps()
	{
		echo $this->Model->getcolvalid('1','lat','users').", ".$this->Model->getcolvalid('1','lot','users');
	}

	public function msg()
	{
		if($this->Model->editrowa('2','users','msg',$this->input->post('msg'))){
			if($this->input->post('msg')!=''){
				echo $this->Model->getcolvalid('2','msg','users');
			}
		}
		$this->Model->editrowa('2','users','s','0');
	}

	public function sendm()
	{
		$this->Model->editrowa('2','users','s','1');
	}

	public function rec()
	{
		if($this->Model->getcolvalid('1','msg','users')!=""){
			echo $this->Model->getcolvalid('1','msg','users');
		}
	}

	public function nmsg()
	{
		echo $this->Model->getcolvalid('1','s','users');
	}

}
