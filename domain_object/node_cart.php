<?php
// require_once __DIR__ . '/node_buku.php';

class NodeCart   {
    public $id;
    public $buku_id;
    public $user_id;
    public $jumlah;
   

    public function __construct($id, $buku_id, $user_id, $jumlah) {
        $this->id = $id;
        $this->buku_id = $buku_id;
        $this->user_id = $user_id;
        $this->jumlah = $jumlah;
       
    }
}


?>