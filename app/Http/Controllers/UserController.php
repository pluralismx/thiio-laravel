<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\JwtAuth;


class UserController extends Controller
{

    public function register(Request $request) {

        // Collect user's data from POST

        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        if(!empty($params) && !empty($params_array)){

            // Validate user's input

            $params_array = array_map('trim', $params_array);
            $validate = \Validator::make($params_array, [
                'name' => 'required|alpha',
                'surname' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]);

            if($validate->fails()){

                $data = array(
                    'status' => 'error',
                    //'code' => 404,
                    //'message' => 'Could not create user',
                    //'errors' => $validate->errors()
                );
    
            }else{

                // Hash password

                $pwd = hash('sha256', $params->password);

                $user = new User();
                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->email = $params_array['email'];
                $user->password = $pwd;

                // Save user

                $user->save();

                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'User created'
                );
            }

        }else{
            $data = array(
                'status' => 'success',
                'code' => 400,
                'message' => 'Input not valid'
            );
        }

        return response()->json($data);

    }

    public function login(Request $request) {

        $jwtAuth = new \JwtAuth();

        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        if(!empty($params) && !empty($params_array)){

            // Validate user's input

            $params_array = array_map('trim', $params_array);
            $validate = \Validator::make($params_array, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validate->fails()){
                $signup = array(
                    'status' => 'error',
                    'code' => 404,
                    'errors' => $validate->errors()
                );
            }else{

                $pwd = hash('sha256', $params->password);
                $signup = $jwtAuth->signup($params->email, $pwd);
                
                if(!isset($params->getToken)){
                    $signup = $jwtAuth->signup($params->email, $pwd, true);
                }

            }
        }else{
            $signup = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Input error'
            );
        }

        return response()->json($signup, 200);
    }
    
}
