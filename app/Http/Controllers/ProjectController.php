<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Form;
use Input;
use App\Http\Requests\ProjectRequest;

use League\Csv\Reader;
use App\Http\Requests\UploadRequest;
use App\Mongo;
use Session;

use Auth;
use App\User;
use App\Project;
use App\ClientFile;


class ProjectController extends Controller
{

    protected $headers = "";

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function intro()
    {
        return view('home');
    }

    public function home()
    {
        $projects = Auth::user()->projects()->get();
        if(count($projects) > 0){
        	return view('projects/index', compact('projects'));
        }else{
        	return redirect('projects/new');
        }
        
    }

    public function projectlists()
    {
        $data = array();
        $results = Auth::user()->projects()->get();
        $count = 0;
        foreach($results as $result){
            $id = $result->id;
            $slug = $result->slug;
            $name = $result->name;
            $data[$count]['id'] = $id;
            $data[$count]['slug'] = $slug;
            $data[$count]['name'] = $name;
          $count++;    
        }
        
        return json_encode($data);
    }

    public function create()
    {
        return view('projects/upload');
    }

    public function store(UploadRequest $request, Mongo $mongo)
    {
        $csv_file = $request->file('csv');
        $name = $request->input('name');
        $slug = str_replace(" ", "-", strtolower($name));
        $data_title = str_replace(" ", "_", strtolower($name));

        //insert to projects table
        Auth::user()->projects()->create(['name' => $name, 'slug' => $slug, 'data_title' => $data_title]);

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

            $collection = $mongo->getCollection($data_title);
            try{
                $collection->insertMany($insert_array);
                Session::flash('mongo_insert_success', 'Successfully uploaded');
                 return view('projects/upload');
            }catch(Exception $e){
                Session::flash('mongo_insert_error', 'Oops! Something went wrong. Please check the file and re-submit.');
                return view('projects/upload');
            }
            
        }
        
    }

    public function showdetaildata($slug, Project $project, Mongo $mongo){
        $project = $project->where('slug', '=', $slug)->first();
        $data_title = $project->data_title;
        $collection = $mongo->getCollection($data_title);
        $cursor = $collection->find();
        $data_group = array();
        $count = 1;
        foreach($cursor as $doc){
            $doc['_id'] = $count;
            array_push($data_group, $doc);
          $count++;
        }

        return json_encode($data_group);
/*        $count = 0;
        foreach($cursor as $doc){
            $arrayDoc = (array)$doc;
            if($count == 0){
               $this->headers = array_keys($arrayDoc);
            }

            foreach($this->headers as $header){
               echo $doc[$header].' | ';
            }

            echo '<br><br>';
          $count++;
        }*/
    }

    public function showdetail($slug, Project $project){

        $result = $project->where('slug', '=', $slug)->first();
        $name = $result->name;
        return view('projects/detail', compact('name'));

    }


}
