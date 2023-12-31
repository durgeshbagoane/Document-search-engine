<?php

//////////////////////////////////////////////////////////////////////////////////////////////////
//                   Sardar Vallabhbhai National Institute of Technology.                       //
//                                                                                              //
// Title:            REST API Demo                                                              //
// File:             utils.php                                                                  //
// Since:            14-Mar-2016 : PM 12:29                                                     //
//                                                                                              //
// Author:           Bhavesh Gabani                                                             //
// Email:            ta8@svnit.ac.in                                                            //
//                                                                                              //
/////////////////////////////////////////////////////////////////////////////////////////////////


class Utils {

    public static function getCurrentDate(){
        date_default_timezone_set("Asia/Kolkata");
        return date("Y-m-d H:i:s");
    }


public static function fetchRowAsArray($result)
    {
        $array = array();

        if($result instanceof mysqli_stmt)
        {
            $result->store_result();

            $variables = array();
            $data = array();
            $meta = $result->result_metadata();

            while($field = $meta->fetch_field())
                $variables[] = &$data[$field->name]; // pass by reference

            call_user_func_array(array($result, 'bind_result'), $variables);

            $i=0;
            while($result->fetch())
            {
                $array[$i] = array();
                foreach($data as $k=>$v)
                    $array[$i][$k] = $v;
                $i++;

                // don't know why, but when I tried $array[] = $data, I got the same one result in all rows
            }
        }
        elseif($result instanceof mysqli_result)
        {
            while($row = $result->fetch_assoc())
                $array[] = $row;
        }

        return $array;
    }
}