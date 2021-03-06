<?php

defined('BASEPATH') OR exit('No script access allowed.');

class UserModel extends CI_Model
{
	public function __construct(){
		$this->load->database();
	}

	public function get_user($key, $value)
	{
		$query = $this->db->get_where('users', array($key=>$value));
		if(!empty($query->row_array())) {
			return $query->row_array();
		}

		return false;
	}

	public function is_LoggedIn()
	{
		if(!isset($_SESSION['logged_in'])) {
			return false;
		}

		return true;
	}

	function checkLog($table,$where){
		return $this->db->get_where($table,$where);
	}
}
