<?php

class NodePeminjaman {
    public $id;
    public $id_member;
    public $id_buku;
    public $tanggal_pinjam;
    public $tanggal_kembali;
    public $status_id;
    public array $detailBuku = [];


    public function __construct($id, $id_member, $tanggal_pinjam, $tanggal_kembali, $status_id, $detailBuku) {
        $this->id = $id;
        $this->id_member = $id_member;
        $this->tanggal_pinjam = $tanggal_pinjam;    
        $this->tanggal_kembali = $tanggal_kembali;
        $this->status_id = $status_id;
        $this->detailBuku = $detailBuku;

    }
}