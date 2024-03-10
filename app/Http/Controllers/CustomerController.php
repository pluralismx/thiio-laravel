<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helpers\JwtAuth;

class CustomerController extends Controller
{

    public function save (Request $request) {
        $token = $request->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        if($checkToken){

            $json = $request->input('json', null);
            $params_array = json_decode($json, true);

            if(!empty($params_array)){
                $validate = \Validator::make($params_array, [
                    'name' => 'required',
                    'surname' => 'required',
                    'email' => 'required|email|unique:customers',
                    'phone' => 'required|numeric'
                ]);

                if($validate->fails()){
                    $data = array(
                        'status' => 'error'
                    );
                }else{

                    $customer = new Customer();
                    $customer->name = $params_array['name'];
                    $customer->surname = $params_array['surname'];
                    $customer->email = $params_array['email'];
                    $customer->phone = $params_array['phone'];

                    $customer->save();

                    $data = array(
                        'status' => 'success'
                    );
                }
            }

            return response()->json($data);
        }
    }

    public function records(Request $request) {

        $token = $request->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        if($checkToken){
            $customers = Customer::all();
            $data = array(
                'status' => 'success',
                'code' => 200,
                'customers' => $customers
            );
        }else {
            $data = array(
                'status' => 'error',
                'code' => 400,
            );
        }
        
        return response()->json($data); 
    }
    
    public function update($id, Request $request) {

        $token = $request->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        $customer = Customer::find($id);

        if($checkToken && isset($customer)){

            $json = $request->input('json', null);
            $params_array = json_decode($json, true);

            if(!empty($params_array)){
                $validate = \Validator::make($params_array, [
                    'email' => 'email|unique:customers,email,'.$id,
                    'phone' => 'numeric'
                ]);

                if($validate->fails()){
                    $data = array(
                        'status' => 'error',
                        'code' => 400
                    );
                }else{

                    $updated = $customer->update($params_array);

                    if($updated){   
                        $data = array(
                            'status' => 'success',
                            'code' => 200
                        );
                    }
                }
            }else{
                $data = array(
                    'status' => 'Data error'
                );
            }
        }else{
            $data = array(
                'status' => 'error'
            );
        }
                 
        return response()->json($data);
    }

    public function delete(Request $request, $id) {

        $token = $request->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        if($checkToken){
            $customer = Customer::find($id);
            
            if(isset($customer)){
                $customer->delete();
                $data = array(
                    'status' => 'success',
                    'code' => 200
                );
            }else{
                $data = array(
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'User not exists'
                );
            }
        }else {
            $data = array(
                'status' => 'error',
                'code' => 400
            );
        }

        return response()->json($data);
    }
}