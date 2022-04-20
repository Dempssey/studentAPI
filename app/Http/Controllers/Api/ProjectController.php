<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    //Create project api
    public function createProject(Request $request){
         //validate
         $request->validate([
            "name"=>"required",
            "description"=>"required",
            "duration"=>"required",
        ]);
        //create+student id
        $student_id=auth()->user()->id;
        $project =new Project();
        $project->student_id=$student_id;
        $project->name=$request->name;
        $project->description=$request->description;
        $project->duration=$request->duration;

        $project->save();


       return response()->json([
                    "status"=>"1",
                    "message"=>"Student project successfully created!!!!"

        ]);



        //response
        return response()->json([
                    "status"=>"1",
                    "message"=>"Student succesfully registered!!!!"

        ]);

    }
        //List all projects api
    public function listProjects(){

        $student_id=auth()->user()->id;

        $projects=Project::where("student_id",$student_id)->get();
        return response()->json([
            "status"=>"1",
            "data"=>$projects

]);


    }
        //List a single project api
    public function singleProject($id){
        if(Project::where("id",$id)->exists()){

            $details=Project::find($id);
            return response()->json([
                "status"=>1,
                "message"=>"Project details found",
                "data"=>$details

    ]);

        }
        else{

            return response()->json([
                "status"=>0,
                "message"=>"Project not found"

    ]);

        }

    }
        //Delete a project api
    public function deleteProject($id){

        $student_id=auth()->user()->id;
        if(Project::where(["id"=>$id,"student_id"=>$student_id])->exists())
        {
            $project=Project::where(["id"=>$id,"student_id"=>$id])->first();
            $project->delete();

                return response()->json([
                    "status"=>1,
                    "message"=>"Project has been deleted successfully"
                ]);

        }
        else
        {
            return response()->json([
                "status"=>0,
                "message"=>"Project not found"
            ]);

        }

    }
}
