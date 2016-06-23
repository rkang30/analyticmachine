<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Form;
use Input;
use League\Csv\Reader;
use App\Http\Requests\UploadRequest;
use App\Mongo;
use Session;
use Auth;
use App\User;
use App\Project;
use App\ClientFile;

class DataController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

    public function upload()
    {
        return view('imports/upload');
    }

    public function store(UploadRequest $request, Mongo $mongo)
    {
        $csv_file = $request->file('csv');
        if($csv_file){

            $reader = Reader::createFromPath($csv_file);
            $results = $reader->fetchAll();
            $count = 0;
            $header = array();
            $insert_array = array();

            foreach($results as $row){
                if($count == 0){
                    $header = $row;
                }else{
                    //row of data
                    $insert_row = array();
                    for($i=0;$i<count($row);$i++){
                       $insert_row[$header[$i]] = $row[$i];
                    }
                    array_push($insert_array, $insert_row);
                }

              $count++;  
            }//end of foreach

            $collection = $mongo->getCollection('insurances');
            try{
                $collection->insertMany($insert_array);
                Session::flash('mongo_insert_success', 'Successfully uploaded');
                 return view('imports/upload');
            }catch(Exception $e){
                Session::flash('mongo_insert_error', 'Oops! Something went wrong. Please check the file and re-submit.');
                return view('imports/upload');
            }
            
        }
        
    }
}
