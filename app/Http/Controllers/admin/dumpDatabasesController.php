<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminController;
class dumpDatabasesController extends AdminController
{
    public function backup_database(){

        //ENTER THE RELEVANT INFO BELOW
        $mysqlHostName      = env('DB_HOST');
        $mysqlUserName      = env('DB_USERNAME');
        $mysqlPassword      = env('DB_PASSWORD');
        $DbName             = env('DB_DATABASE');


        // INSERT TABLES IN DATABASE
        $tables             = array("tbl_feeship","tbl_province","tbl_city","tbl_ward","tbl_admin",
                                    "tbl_brand_code_product","tbl_category_product","tbl_contact","tbl_count","tbl_customer",
                                    "tbl_info_contact","tbl_logo_website","tbl_news","tbl_orders","tbl_product","tbl_review",
                                    "tbl_sliders","tbl_template_mail","tbl_configmail_receiver"); //here your tables...
        $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $statement->fetchAll();

        $output_data = "";
        $output = '';
        foreach($tables as $table)
        {
            $show_table_query = "SHOW CREATE TABLE " . $table . "";
            $statement = $connect->prepare($show_table_query);
            $statement->execute();
            $show_table_result = $statement->fetchAll();

            $select_query = "SELECT * FROM " . $table ;
            $statement = $connect->prepare($select_query);

            $statement->execute();
            $total_row = $statement->rowCount();

            foreach($show_table_result as $show_table_row)
            {
                $output_data .= "\nDROP TABLE IF EXISTS ". "`$table` ;";
                $output_data .= "\n" . $show_table_row["Create Table"] . ";\n\n";
            }
            for($count=0; $count < $total_row; $count++)
            {
                $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
                $table_column_array = array_keys($single_result);
                $table_value_array = array_values($single_result);
                $output .= "INSERT INTO $table (";
                $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                $output .= '"' . implode('","', str_replace('"',"'",$table_value_array)) . '");'."\n";
            }
        }
        $file_name_data      = 'database_aodaixinh_data_' . date('d-m-y') . '.sql';
        $file_name_structure = 'database_aodaixinh_structure_' . date('d-m-y') . '.sql';



        $file_handle_data    = fopen($file_name_data, 'w+');
        $file_name_structure = fopen($file_name_structure, 'w+');
        //write
        fwrite($file_handle_data, $output);
        fclose($file_handle_data);
        fwrite($file_name_structure, $output_data);
        fclose($file_name_structure);
        return back();
    }
}

    //DEMO
    // public function backup_database(){

    //     //ENTER THE RELEVANT INFO BELOW
    //     $mysqlHostName      = env('DB_HOST');
    //     $mysqlUserName      = env('DB_USERNAME');
    //     $mysqlPassword      = env('DB_PASSWORD');
    //     $DbName             = env('DB_DATABASE');


    //     // INSERT TABLES IN DATABASE
    //     $tables             = array("tbl_feeship","tbl_province","tbl_city","tbl_ward","tbl_admin",
    //                                 "tbl_brand_code_product","tbl_category_product","tbl_contact","tbl_count","tbl_customer",
    //                                 "tbl_info_contact","tbl_logo_website","tbl_news","tbl_orders","tbl_product","tbl_review",
    //                                 "tbl_sliders","tbl_template_mail","tbl_configmail_receiver"); //here your tables...
    //     $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    //     $get_all_table_query = "SHOW TABLES";
    //     $statement = $connect->prepare($get_all_table_query);
    //     $statement->execute();
    //     $result = $statement->fetchAll();


    //     $output = '';
    //     foreach($tables as $table)
    //     {
    //         $show_table_query = "SHOW CREATE TABLE " . $table . "";
    //         $statement = $connect->prepare($show_table_query);
    //         $statement->execute();
    //         $show_table_result = $statement->fetchAll();

    //         foreach($show_table_result as $show_table_row)
    //         {
    //             $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
    //         }
    //         $select_query = "SELECT * FROM " . $table . "";
    //         $statement = $connect->prepare($select_query);
    //         $statement->execute();
    //         $total_row = $statement->rowCount();

    //         for($count=0; $count<$total_row; $count++)
    //         {
    //             $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
    //             $table_column_array = array_keys($single_result);
    //             $table_value_array = array_values($single_result);
    //             $output .= "\nINSERT INTO $table (";
    //             $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
    //             $output .= '"' . implode('","', str_replace('"',"'",$table_value_array)) . '");';
    //         }
    //     }
    //     $file_name = 'database_aodaixinh_' . date('d-m-y') . '.sql';

    //     //SAVE DATABASE IN FOLDER
    //     $file_handle = fopen('public/'.$file_name, 'w+');

    //     //write
    //     fwrite($file_handle, $output);
    //     fclose($file_handle);
    //     header('Content-Description: File Transfer');
    //     header('Content-Type: application/octet-stream');
    //     //Dowload Database
    //     header('Content-Disposition: attachment; filename=' . basename($file_name));
    //     header('Content-Transfer-Encoding: binary');
    //     header('Expires: 0');
    //     header('Cache-Control: must-revalidate');
    //     header('Pragma: public');
    //     header('Content-Length: ' . filesize($file_name));
    //     ob_clean();
    //     flush();
    //     readfile($file_name);
    //     return back();

    // }

