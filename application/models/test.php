<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Model {
     

    function add_user($user)
    {
        $query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES (?,?,?,?,?,?)";
        $values = array($user['first_name'], $user['last_name'], $user['email'], $user['password'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s")); 
        return $this->db->query($query, $values);
    }

    function get_user($email)
    {
        return $this->db->query("SELECT * FROM users WHERE email = ?", $email)->row_array();
    }
    

}
