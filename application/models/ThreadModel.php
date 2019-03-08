<?php

class ThreadModel extends CI_Model {
    public function insertThread($judul, $isi, $registerCreateId) {
        $result = false;

        $this->db->set('judul', $judul);
        $this->db->set('isi', $isi);
        $this->db->set('register_created_id', $registerCreateId);
        $this->db->insert('thread');

        $result = true;

        return $result;
    }

    public function insertThreadReply($threadId, $balasan, $registerCreateId) {
        $result = false;

        $this->db->set('thread_id', $threadId);
        $this->db->set('balasan', $balasan);
        $this->db->set('register_created_id', $registerCreateId);
        $this->db->insert('thread_reply');

        $result = true;

        return $result;
    }

    public function getThread($id) {
        $sql = "SELECT * FROM thread WHERE id = ? ORDER BY id";
        $query = $this->db->query($sql, array($id));

        return $query->result_array();
    }

    public function giveStarToThread($id, $stars) {

        $result = false;

        $data = array('rating_star' => $stars);
        $this->db->where('id', $id);
        $this->db->update('thread', $data);
        $result = true;

        return $result;
    }

}