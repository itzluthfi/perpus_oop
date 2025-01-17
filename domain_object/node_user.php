<?php
require_once __DIR__ . '/node_role.php';

class NodeUser extends Role{
    public $id;
    public $user_username;
    public $user_password;
    public $role_id;
    public $no_telp;

    
    public function __construct($id,$user_username,$user_password,$role_id,$no_telp, $role_nama, $role_deskripsi, $role_status)
    {
        parent::__construct($role_id,$role_nama,$role_deskripsi,$role_status);
        $this->id = $id;
        $this->user_username = $user_username;
        $this->user_password = $user_password;
        $this->role_id = $role_id;
        $this->no_telp = $no_telp;
    }
}

?>