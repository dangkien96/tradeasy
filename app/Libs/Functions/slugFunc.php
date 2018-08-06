<?php 
    function sanitizeTitle($string) {
   //php composer.phar dump-autoload
        if(!$string) return false;
        $utf8 = array(
                'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
                'd'=>'đ|Đ',
                'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
                'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
                'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
                'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
                'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
                );
        foreach($utf8 as $ascii=>$uni) $string = preg_replace("/($uni)/i",$ascii,$string);
        $string = utf8Url($string);
        $string = slug($string);
        return $string;
    }
 
    function utf8Url($string){        
        // $string = strtolower($string);
        // $string = str_replace( "ß", "ss", $string);
        // $string = str_replace( "%", "", $string);
        // $string = preg_replace("/[^_a-zA-Z0-9 -]/", "",$string);
        $string = str_replace(array('%20', ' '), '-', $string);
        $string = str_replace("----","-",$string);
        $string = str_replace("---","-",$string);
        $string = str_replace("--","-",$string);
        return $string;
    } 

    function slug($str, $limit = null) {
            if ($limit) {
                $str = mb_substr($str, 0, $limit, "utf-8");
            }
            $text = html_entity_decode($str, ENT_QUOTES, 'UTF-8');
            $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
            $text = trim($text, '-');
            return $text;
        }

    function locationSelect ($locations, $parents, $char = " -- ", $selected = []) {
        foreach ($parents as $key => $parent) {
            if (!empty($parent->big_area)) {
                echo '<optgroup label="*** '.$parent->big_area.' ***">';
            }
            foreach ($locations as $key => $location) {
                if ($parent->big_area == $location->big_area) {
                    if (in_array($location->id, $selected)) {
                         echo '<option selected="selected" value="'.$location->id.'">'.$location->name_2.'</option>';
                    }  else {
                        echo '<option value="'.$location->id.'">'.$location->name_2.'</option>';
                    }
                }
            }
            if (!empty($parent->big_area)) {
                echo "</optgroup>";
            }
        }
    }

 ?>