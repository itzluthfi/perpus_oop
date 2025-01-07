<?php

class NodeBuku {
    public $id;
    public $judul;
    public $pengarang;
    public $penerbit;
    public $tahunTerbit;
    public $stok;
    

    public function __construct($id, $judul, $pengarang, $penerbit, $tahunTerbit, $stok) {
        $this->id = $id;
        $this->judul = $judul;
        $this->pengarang = $pengarang;
        $this->penerbit = $penerbit;
        $this->tahunTerbit = $tahunTerbit;
        $this->stok = $stok;        
    }
}