<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Exception;
use Config\Services;
use App\Models\TenantModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class TenantUserController extends ResourceController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->tenantmodel = new TenantModel();
        // $this->session = Services::session();
        $this->db = db_connect();
    }
    public function index()
    {
        //
    }
//Register The New Tenant of User....
    public function create_tenant()
    {
        helper(['form']);
		$rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required',
			'email' => 'required|valid_email',
            'business_name' => 'required',
            'number_branches' => 'required',
            'postion_title' => 'required',
            'country' => 'required',
            'state' => 'required',
            'address' => 'required',
            'zipcode' => 'required',
            'paymentmode' => 'required',
        'image' => 'required|uploaded',

            'cash' => 'required',
            'plan_name' => 'required',
            'billing_type' => 'required',
            'domin_name' => 'required',
		];
		if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
		$data = [
            'firstname' => $this->request->getVar('firstname'),
            'lastname' => $this->request->getVar('lastname'),
            'phone_number' => $this->request->getVar('phone_number'),
			'email' 	=> $this->request->getVar('email'),
            'business_name' => $this->request->getVar('business_name'),
            'number_branches' => $this->request->getVar('number_branches'),
            'postion_title' => $this->request->getVar('postion_title'),
            'country' => $this->request->getVar('country'),
            'state' => $this->request->getVar('state'),
            'address' => $this->request->getVar('address'),
            'zipcode' => $this->request->getVar('zipcode'),
            'paymentmode' => $this->request->getVar('paymentmode'),
         'image' => $this->request->getFile('image'),

            'cash' => $this->request->getVar('cash'),
            'plan_name' => $this->request->getVar('plan_name'),
            'billing_type' => $this->request->getVar('billing_type'),
            'domin_name' => $this->request->getVar('domin_name'),
		];
		
    // }catch(Exception $aamir){
    //     var_dump($aamir);
    //     die;
    // }
        // if ($cash = "1") {
        //     echo "cash";
        // } elseif ($cheque = "2") {

        //     $rules = [
        //         'amount' => 'required',
        //         'bank_name' => 'required',
        //         'payee_name' => 'required',
        //         'cheque_number' => 'required',
        //         'image_cheque' => 'required|uploaded[image_cheque]|max_size[image_cheaque,1024]|mime_in[file, image/png, image/jpg, image/jpeg]',,
        //     ];
        //     $data = [
        //         'amount' => $this->request->getVar('amount'),
        //         'bank_name' => $this->request->getVar('bank_name'),
        //         'payee_name' => $this->request->getVar('payee_name'),
        //         'cheque_number' => $this->request->getVar('cheque_number'),
        //         $image_cheque = $this->request->getFile('image_cheque'),
        //         $image_cheque->move('/assets/uploads')
        //     ];
        // } elseif ($bank_transfer = "3") {
        //     $rules = [
        //         'form_account_number' => 'required',
        //         'to_account_number' => 'required',
        //         'bank_name' => 'required',
        //         'amount' => 'required',
        //         'image_transfer' => 'required|uploaded[image_transfer]|max_size[image_transfer,1024]|mime_in[image_transfer, image/png, image/jpg, image/jpeg]',


        //     ];

        //     $data = [
        //         'amount' => $this->request->getVar('amount'),
        //         'payee_name' => $this->request->getVar('payee_name'),
        //         'cheque_number' => $this->request->getVar('cheque_number'),
        //         $image_transfer = $this->request->getFile('image_transfer'),
        //         $image_transfer->move('/assets/uploads')
        //     ];
        // };

// var_dump($data);
// die;
        $tenantmodel = new TenantModel();
        $savedata = $tenantmodel->save($data);
        $this->respondCreated($savedata);
        
        // }catch(Exception $aamir){
        //     var_dump($aamir);
        //     die;
        // }
    }
//Delete The Tenant User Record......
    public function Delete_Tenant($id = null)

    {
        $tenantmodel = new TenantModel();
        if (!empty($id)) {
            $tenantmodel->delete($id);
            $reponse = [
                'message' => 'Tenant User Is SuccessFully Unregister',
            ];
        } else {
            $reponse = [
                'message' => 'Tenant User is Found',
            ];
        }
        return $this->respond($reponse);
    }

    //view single record.....
    public function Tenant_single($id = null)
    {
        $tenantmodel = new TenantModel();

        $data = $tenantmodel->find($id);
        if (!empty($data)) {
            $response = [
                'Message' => 'Single Data',
                'data' => $data
            ];
        } else {
            $response = [
                'Message' => 'No Data Found',
            ];
        }
        return $this->respondCreated($response);
    } 
   
//View All the data of User...
    public function view_Tenant()
    {
        $tenantmodel = new TenantModel();
        $response = [
            'Message' => 'All Data of Tenant',
            'data' => $tenantmodel->findAll()
        ];
        return $this->respondCreated($response);
    }

    //Update the  Data of User Tenant....
    public function update_tenant($id = null)
    {
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|valid_email',
            'phone_number' => 'required|min_length[6]',
            'business_name' => 'required',
            'number_business' => 'required',
            'postion_title' => 'required',
            'country' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'address' => 'required',
           
            'domin_name' => 'required',

        ];

        // var_dump($this->request->getJSON());
        // die;
        if (!$this->validate($rules)) {
            $response = [
                'message' => $this->validator->getError(),
            ];
        } else {
            $tenantmodel = new TenantModel();
            if ($tenantmodel->find($id)) {
                $data['firstname'] = $this->request->getVar("firstname");
                $data['lastname'] = $this->request->getVar("lastname");
                $data['email'] = $this->request->getVar("email");
                $data['phone_number'] = $this->request->getVar("phone_number");
                $data['business_name'] = $this->request->getVar("business_name");
                $data['postion_title'] = $this->request->getVar("postion_title");
                $data['state'] = $this->request->getVar("state");
                $data['zipcode'] = $this->request->getVar("zipcode");
                $data['domin_name'] = $this->request->getVar("domin_name");
                $tenantmodel->update($id, $data);
                $response = [
                    'Message' => 'Tenant User Successfully Update',
                ];
            } else {
                if (!$id) {
                    throw PageNotFoundException::forPageNotFound('User Not Found');
                }
                $response = [
                    'message' => 'No Tenant User Found',
                ];
            }
        }
        return $this->respondCreated($response);
    }
}
