<?php

class NodePeminjaman  {
    public $id;
    public $user_id;
    public $status_id;
    public $tanggal_pinjam;
    public $tanggal_kembali;
    public array $detailPeminjaman = [];


    public function __construct($id, $user_id, $tanggal_pinjam, $tanggal_kembali, $status_id, $detailPeminjaman) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->tanggal_pinjam = $tanggal_pinjam;    
        $this->tanggal_kembali = $tanggal_kembali;
        $this->status_id = $status_id;
        $this->detailPeminjaman = $detailPeminjaman;

    }
}