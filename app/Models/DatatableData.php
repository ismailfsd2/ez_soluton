<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatatableData extends Model
{
    use HasFactory;

    public function data($table,$request,$searching = array()){
        $query = DB::table('employees');
            $output = array(
                "draw" => $request->draw,
                "recordsTotal" => $total_records,
                "recordsFiltered" => 0,
                "data" => array()
            );
            // Output to JSON format
            echo json_encode($output);
    }



}
