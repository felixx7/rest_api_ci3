<?php

require APPPATH . '/libraries/REST_Controller.php';
 
class siswa extends REST_Controller {
 
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
 
    // show data siswa
    function index_get() {
        $nis = $this->get('nis');
        if ($nis == '') {
            $siswa = $this->db->get('siswa')->result();
        } else {
            $this->db->where('nis', $nis);
            $siswa = $this->db->get('siswa')->result();
        }
        $this->response($siswa, 200);
    }
 
    // insert new data to siswa
    function index_post() {
        $data = array(
                    'nis'           => $this->post('nis'),
                    'nama'          => $this->post('nama'),
                    'id_jurusan'    => $this->post('id_jurusan'),
                    'alamat'        => $this->post('alamat'));
        $insert = $this->db->insert('siswa', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // update data siswa
    function index_put() {
        $nis = $this->put('nis');
        $data = array(
                    'nis'       => $this->put('nis'),
                    'nama'      => $this->put('nama'),
                    'id_jurusan'=> $this->put('id_jurusan'),
                    'alamat'    => $this->put('alamat'));
        $this->db->where('nis', $nis);
        $update = $this->db->update('siswa', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // delete siswa
    function index_delete() {
        $nis = $this->delete('nis');
        $this->db->where('nis', $nis);
        $delete = $this->db->delete('siswa');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
}