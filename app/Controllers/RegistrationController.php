<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use App\Models\RegistrationModel;
use CodeIgniter\API\ResponseTrait;
use Exception;
use Config\Services;

use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use \Firebase\JWT\JWT;
class RegistrationController extends ResourceController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->RegistrationModel = new RegistrationModel();
        $this->session = Services::session();
        $this->db = db_connect();
    }
    public function index()
    {
        
    }
    // New User Registration 
    public function user_register()
    {
        helper(['form']);
		$rules = [
            'name' => 'required',
            'username' => 'required',
			'email' => 'required|valid_email',
			'password' => 'required|min_length[6]',
            'address' => 'required',
            'mobile_number' => 'required',
		];
		if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
		$data = [
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('name'),
			'email' 	=> $this->request->getVar('email'),
			'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'address' => $this->request->getVar('address'),
            'mobile_number' => $this->request->getVar('mobile_number')
		];
		$RegistrationModel = new RegistrationModel();
		$register = $RegistrationModel->save($data);
		$this->respondCreated($register);
    // }catch(Exception $aamir){
    //     var_dump($aamir);
    //     die;
    // }
    }
    
    
    // New User Login...
    public function user_Login()
    { 	$registerModel = new RegistrationModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
          
        $user = $registerModel->where('email', $email)->first();
  
        // var_dump($user);
        // die;
        if(is_null($user)) {
            return $this->respond(['error' => 'User is Not Found.'], 401);
        }
//   var_dump($user);
//   die;
        $pwd_verify = password_verify($password, $user['password']);

        // var_dump($user);
        // die;
        if(!$pwd_verify) {
            // var_dump($user);
            // die;
            return $this->respond(['error' => 'Invalid username or password.'], 401);
            // var_dump($pwd_verify);
            //  die;
        }
 
        $key = getenv('TOKEN_SECRET');
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;
 
        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "email" => $user['email'],
          
        ); 
        //  var_dump($user);
        // die;
         
        $token = JWT::encode($payload, $key,'HS256');
 
        $response = [
            'message' => 'Login Succesful',
            'token' => $token
        ];
         
        return $this->respond($response, 200);
    
    }
    public function User_logout()
        
    {
        $this->session->remove('user');
        
        return redirect()->to('/login');
    }
}
    
    

