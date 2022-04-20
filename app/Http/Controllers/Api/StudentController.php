<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class StudentController extends Controller
{
    //!!!!!!!!!!Register api
    public function register(Request $request){

        //validate
        $request->validate([
            "name"=>"required",
            "email"=>"required|email|unique:students,email",
            "password"=>"required|confirmed",
        ]);
        //create
        $student =new Student();
        $student->name=$request->name;
        $student->email=$request->email;
        $student->password=Hash::make($request->password);
        $student->phone_no=isset($request->phone_no)?$request->phone_no:"";
        $student->save();

        //response
        return response()->json([
                    "status"=>"1",
                    "message"=>"Student succesfully registered!!!!"

        ]);

    }
        //Login api
    public function login(Request $request){
                //validation
                $request->validate([
                    "email"=>"required|email",
                    "password"=>"required"
                ]);
                 //check student
                 $student=Student::where("email","=",$request->email)->first();

                 if(isset($student->id))
                 {

                     if(Hash::check($request->password, $student->password))
                     {
                    //create a token

                    $token=$student->createToken("auth_token")->plainTextToken;

                        return response()->json([
                            "status"=>1,
                            "message"=>"Successfully logged in",
                            "access token"=>$token
                        ]);

                     }
                     else
                     {
                        return response()->json([
                            "status"=>0,
                            "message"=>"Password doesnt match"
                        ]);

                     }


                 }
                    else
                    {
                        return response()->json([
                            "status"=>0,
                            "message"=>"Student not found"
                        ]);
                    }


                //send response



    }
        //Profile api
    public function profile(){

        return response()->json([
            "status"=>1,
            "message"=>"Student profile information",
            "data"=>auth()->user()
        ]);


    }
        //Logout api
    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            "status"=>1,
            "message"=>"Student logged out successfully"

        ]);
    }
}
