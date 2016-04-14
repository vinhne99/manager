<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page_ajax
{
    public function initialize($config )
    {
        $page_total = $config['page_total'];
        $page_current = $config['page_current'];
       $function =  $config['function'];
        $temp = "<div class='dataTables_paginates pull-right'>";
        if ($page_total != null) {
            if ($page_current == 0)
                $temp = $temp . "<span><<</span>";
            else
                $temp = $temp . "<a href='javascript:void(0);' onclick='" . $function . "(" . ($page_current - 1) . ");' ><<</a>";


            if ($page_total > 10) {
                for ($i = 0; $i < 3; $i++) {
                    if ($page_current != $i)
                        $temp = $temp . "<a href='javascript:void(0);' onclick='" . $function . "(" . $i . ");' >" . ($i + 1) . "</a>";
                    else
                        $temp = $temp . "<span>" . ($i + 1) . "</span>";
                }


                if ($page_current >= 2 && $page_current <= ($page_total - 4)) {

                    if ($page_current >= 4) {
                        if ($page_current > 4)
                            $temp = $temp . "...";

                        $temp = $temp . "<a href='javascript:void(0);' onclick='" . $function . "(" . ($page_current - 1) . ");' >" . ($page_current) . "</a>";
                    }
                    if ($page_current != ($page_total - 4)) {
                        if ($page_current != 2)
                            $temp = $temp . "<span>" . ($page_current + 1) . "</span>";

                        $temp = $temp . "<a href='javascript:void(0);' onclick='" . $function . "(" . ($page_current + 1) . ");' >" . ($page_current + 2) . "</a>";
                    }

                }

                $temp = $temp . "...";

                for ($i = ($page_total - 4); $i < $page_total; $i++) {
                    if ($page_current != $i)
                        $temp = $temp . "<a href='javascript:void(0);' onclick='" . $function . "(" . $i . ");' >" . ($i + 1) . "</a>";
                    else
                        $temp = $temp . "<span>" . ($i + 1) . "</span>";
                }
            } else {
                for ($i = 0; $i < $page_total; $i++) {
                    if ($page_current != $i)
                        $temp = $temp . "<a href='javascript:void(0);' onclick='" . $function . "(" . $i . ");' >" . ($i + 1) . "</a>";
                    else
                        $temp = $temp . "<span>" . ($i + 1) . "</span>";
                }
            }

            if ($page_current == ($page_total - 1))
                $temp = $temp . "<span>>></span>";
            else
                $temp = $temp . "<a href='javascript:void(0);' onclick='" . $function . "(" . ($page_current + 1) . ");' >>></a>";


        }
        return $temp."</div>";

    }
}