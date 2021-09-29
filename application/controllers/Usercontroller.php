<?php
   
require APPPATH . 'controllers/Logincontroller.php';
class Usercontroller extends Logincontroller {
    function __construct($config = 'Logincontroller') {
        parent::__construct($config);
        $this->cektoken();
    }

    function datauser() {
        $data = $this->db->query("SELECT * FROM tb_user")->result();
        echo json_encode(['data' => $data]);
    }
}
?>