<?php

class DetailPeminjaman {
    public $id;
    public $peminjaman_id;
    public $buku_id;
    public $jumlah;

    public function __construct($id,$peminjaman_id,$buku_id, $jumlah) {
        $this->id = $id;
        $this->jumlah = $jumlah;
        $this->buku_id = $buku_id;
        $this->peminjaman_id = $peminjaman_id;
    }
}
?>