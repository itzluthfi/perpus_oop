<?php

class Status {
    public $status_id;
    public $status_nama;
    public $status_color;
    public function __construct($status_id,$status_nama,$status_color)
    {
        $this->status_id = $status_id;
        $this->status_nama = $status_nama;
        $this->status_color = $status_color;
        
    }

}

?>