<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Authenticate extends CI_Model {

    function check_admin($user, $pass) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $user);
        $this->db->where('type', 'Admin');
        $this->db->where('password', MD5($pass));
        $this->db->limit(1);


        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    
      function check_user($user, $pass) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $user);
        //$this->db->where('type', 'regular');
        $this->db->where('password', MD5($pass));
        $this->db->limit(1);


        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    

    function check_user_acivation($user_id) {
        $this->db->select('status');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function forgot_password($email) {
        $this->db->select('id,email,name');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->limit(1);


        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function paypal_email($data) {
        $data = array(
            'paypal_email' => $data['paypal_email'],
            'mode' => $data['mode']
        );
        $this->db->where('id', '1');
        $this->db->update('paypal', $data);
        return true;
    }

    function get_paypal_email() {
        $this->db->select('*');
        $this->db->from('paypal');
        $this->db->where('id', '1');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function email_exists($email) {

        $sql = "select email from users where email='" . $email . "'";
        $query = $this->db->query($sql);
        $rows = $query->num_rows();
        return $rows;
    }

    public function insert($data) {
        $this->db->insert('users', $data);
        return '123';
    }

    function update_user_information($id_data, $user_id_info) {
        $data = array();
        $data = array(
            'activation_code' => $id_data
        );
        $this->db->where('id', $user_id_info);
        $this->db->update('users', $data);
        return true;
    }

    function get_user_information($user_id) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $user_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function update_user_info_status($user_id) {
        $data = array();
        $data = array(
            'status' => '1',
            'activation_code' => ''
        );
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
        return true;
    }

    function get_user_name($user_id) {
        $this->db->select('name');
        $this->db->from('users');
        $this->db->where('id', $user_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function user_shipping_address($user_id) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $user_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function update_address($user_id, $data) {
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
        return true;
    }

    function check_subscriber_email($email) {
        $this->db->select('*');
        $this->db->from('subscribe');
        $this->db->where('subscription_email', $email);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function insert_subscriber_email($email) {
        $data = array('subscription_email' => $email);
        $this->db->insert('subscribe', $data);
        return true;
    }
    function insert_contact($data) {
        $this->db->insert('contact', $data);
        return true;
    }
    
}
