<?php

class RegisterModel extends CI_Model {
    public function insertRegister($nama, $email, $password) {
        $result = false;

        $this->db->set('nama', $nama);
        $this->db->set('email', $email);
        $this->db->set('password', $password);
        $this->db->insert('register');

        $result = true;

        return $result;
    }

    public function isEmailExists($email) {

        $result = false;

        $this->db->where('email',$email);
        $query = $this->db->get('register');
        if ($query->num_rows() > 0){
            $result = true;
        }

        return $result;
    }
}