<?php

class Pivot {

    public function getData($data) {
        $result = array();
        $total = 0;
        for ($i = 0; $i < count($data); $i++) { 
            $month = date("m",strtotime($data[$i]['tanggal']));
            $total = $total + $data[$i]['total'];
            


        }
        return $result;
    }
}

?>