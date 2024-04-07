<?php


class TemplateBuilder{

    private $TABLE_LIST_ASSIGN_START = "[T#";
    private $LIST_ASSIGN_START = "[#";
    private $TABLE_LIST_ASSIGN_END = "#T]";
    private $LIST_ASSIGN_END = "#]";



    public function __construct(

    ){}

    function setListData($data, $data_object, $parent_name, $codings = null) {
        $res = $this->setVariableValue($data, $data_object, $parent_name, $codings);
        return $res;
    }

    function getLastEndIndex($data, $first_index, $s_symbol, $e_symbol) {
        try {
            $idx_1 = $first_index + strlen($s_symbol) + strpos($data, $s_symbol, $first_index + strlen($s_symbol));
            $first_idx_2 = strpos($data, $e_symbol);
            if ($first_idx_2 > $idx_1) {
                $res = $this->getLastEndIndex($data, $idx_1, $s_symbol, $e_symbol);

                if ($res == $idx_1) {
                    $idx_2 = $first_index + strlen($s_symbol) + strpos($data, $e_symbol, $first_index + strlen($s_symbol)) + strlen($e_symbol);
                    return $idx_2;
                } else {
                    $idx_2 = $res + strpos($data, $e_symbol, $res) + strlen($e_symbol);
                    return $idx_2;
                }
            }
            throw new Exception('end loop');

        } catch (Exception $e) {
            return $first_index;
        }
    }

    function setVariableValue($html_text, $data_object, $parent_name, $codings = null) {
        foreach ($data_object as $key => $value) {
            if (is_array($value)) {
                $new_parent_name = $key;
                $html_text = $this->setVariableValue($html_text, $value, $new_parent_name, $codings);
            } else {
                $find_value = null;
                // if (!empty($codings)) {
                //     foreach ($codings as $i) {
                //         if ($i['name'] == $key) {
                //             // $res = getRecords($i['table']);
                //             // foreach ($res as $j) {
                //             //     if ($j['pk'] == $value) {
                //             //         $find_value = $j['title'];
                //             //         break;
                //             //     }
                //             // }
                //         }
                //     }
                // }

                $format_val = '{' . $key . '}';
                if ($find_value) {

                    $html_text = str_replace($format_val, $find_value, $html_text);

                } else {
                    if (is_bool($value)) {
                        $value = $value ? 'فعال' : 'غیر فعال';
                    }
                    $html_text = str_replace($format_val, $value, $html_text);
                }
            }
        }
        return $html_text;
    }

    function setTableListData($data, $data_object, $parent_name, $codings = null) {
        $new_data = substr($data, strpos($data, '<tbody>'), strrpos($data, '</tbody>') + strlen('</tbody>') - strpos($data, '<tbody>'));
        $root = simplexml_load_string($new_data);
        $res = $root->tr[0]->asXML();
        $for_area_tag = $root->tr[1];
        $for_area_tag_str = $for_area_tag->asXML();
        $set_variable_res = '';
        foreach ($data_object as $item) {
            $set_variable_res .= $this->setVariableValue($for_area_tag_str, $item, $parent_name, $codings);
        }
        if ($set_variable_res == '') {
            $set_variable_res = '<td style="text-align: center">اطلاعاتی وجود ندارد</td>';
        }
        $res .= $set_variable_res;

        $res = '<tbody>\n' . $res . '\n</tbody>';
        $res = str_replace($new_data, $res, $data);

        return $res;
    }

    public function setListVariable($temp_data, $database_object, $coding=null){
        $idx_t = null;
        $idx_l = null;

        try{
            $idx_t = strpos($temp_data, $this->TABLE_LIST_ASSIGN_START);
        }catch(Exception $ex){}

        try{
            $idx_l = strpos($temp_data, $this->LIST_ASSIGN_START);
        }catch(Exception $ex){}

        if($idx_l != null && $idx_t != null){
            if($idx_l < $idx_t){

                $idx_1 = $idx_l;

                $kind = 'list';

                $assign_start = $this->LIST_ASSIGN_START;
                $assign_end = $this->LIST_ASSIGN_END;

            }else{
                $idx_1 = $idx_t;
                $kind = 'table_list';
                $assign_start = $this->TABLE_LIST_ASSIGN_START;
                $assign_end = $this->TABLE_LIST_ASSIGN_END;
            }
        }else if($idx_l != null){
            $idx_1 = $idx_l;
            $kind = 'list';
            $assign_start = $this->LIST_ASSIGN_START;
            $assign_end = $this->LIST_ASSIGN_END;
        }else if($idx_t != null){
            $idx_1 = $idx_t;
            $kind = 'table_list';
            $assign_start = $this->TABLE_LIST_ASSIGN_START;
            $assign_end = $this->TABLE_LIST_ASSIGN_END;
        }else{
            return $temp_data;
        }

        $result = $this->getLastEndIndex($temp_data, $idx_1, $assign_start, $assign_end);
        $idx_2 = $result + strpos(substr($temp_data, $result), $assign_end);
        $start = substr($temp_data, 0, $idx_1);
        $start = substr($start, 0, strrpos($start, '<'));

        $between = substr($temp_data, $idx_1 + strlen($assign_start), $idx_2 - ($idx_1 + strlen($assign_start)));
        $between = substr($between, 0, strrpos($between, '<'));
        $var_name = substr($between, 0, strpos($between, '<'));
        $between = substr($between, strpos($between, '>') + 1);

        $new_var_name = explode('.', $var_name);
        $new_var_name = end($new_var_name);

        if ($kind == 'table_list') {
            $between = $this->setTableListData($between, $database_object[$new_var_name], $var_name, $coding);
        } else {
            if (is_array($database_object[$new_var_name]) || is_a($database_object[$new_var_name], 'ReturnList')) {
                $between_res = '';
                foreach ($database_object[$new_var_name] as $i) {
                    $between_inner = $this->setListVariable($between, $i, $coding);
                    $between_res .= $this->setListData($between_inner, $i, $var_name, $coding);
                }
                $between = $between_res;
            } else {
                $between = $this->setListData($between, $database_object[$new_var_name], $var_name, $coding);
            }
        }

        $end = substr($temp_data, $idx_2);
        $end = substr($end, strpos($end, '>') + 1);
        $end = $this->setListVariable($end, $database_object, $coding);
        return $start . $between . $end;




    }
}
