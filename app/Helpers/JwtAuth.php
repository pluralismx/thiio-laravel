<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class JwtAuth {

    public $key;

    public function __construct() {
        $this->key = 'secret_word';
    }

    public function signup($email, $password, $getToken = null) {

        $user = User::where([
            'email' => $email,
            'password' => $password
        ])->first();

        // Check if user exists

        $signup = false;

        if(is_object($user)){
            $signup = true;
        }
        
        // Validate username and password
        if($signup) {
            
            $token = array(
                'sub' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'surname' => $user->surname,
                'iat' => time(),
                'exp' => time() + (7 * 24 * 60 * 60)
            );

            $jwt = JWT::encode($token, $this->key, 'HS256');
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
            
            if(!is_null($getToken)){
                $data = $jwt;
            }else{
                $data = $decoded;
            }
                
            
        }else{
            $data = array(
                'status' => 'error',
                'message' => 'loggin failed'
            );
        }

        return $data;

    }

    public function checkToken($jwt, $getIdentity = false) {
        
        $auth = false;

        try{
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
        }catch(\UnexpectedValueException $e){
            $auth = false;
        }catch(\DomainException $e) {
            $auth = false;
        }

        if(!empty($decoded) && is_object($decoded) && isset($decoded->sub)){
            $auth = true;
        }else{
            $auth = false;
        }

        if($getIdentity){
            return $decoded;
        }

        return $auth;
        
    }

}