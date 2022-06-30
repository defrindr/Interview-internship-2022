<?php

class Pivot
{
    public function getData($data, $menu)
    {
        $result = array();
        $categories = array();

        foreach ($menu as $value) :
            $categories[$value['kategori']][] = $value;
        endforeach;

        foreach ($categories as $category => $menu) :
            for ($s = 0; $s < count($menu); $s++) :
                for ($i = 0; $i < count($data); $i++) :
                    if ($menu[$s]['menu'] == $data[$i]['menu']) :
                        if (isset($result[$category][$s]['month']) == false) :
                            $result[$category][$s]['month'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                        endif;
                        $month = intval(date('n', strtotime($data[$i]['tanggal']))) - 1;
                        $result[$category][$s]['menu'] = $menu[$s]['menu'];
                        $result[$category][$s]['month'][$month] = $data[$i]['total'];
                    endif;
                endfor;
            endfor;
        endforeach;
        return $result;
    }
}
