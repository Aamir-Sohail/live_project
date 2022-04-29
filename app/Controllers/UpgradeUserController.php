<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Exception;
use Config\Services;
use App\Models\TenantModel;
use App\Models\UpgradeUserModel;
use phpDocumentor\Reflection\Types\Null_;

class UpgradeUserController extends ResourceController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->upgradeusermodel = new UpgradeUserModel();
        // $this->session = Services::session();
        $this->db = db_connect();
    }
    public function index()
    {
        //
    }
// This Function is Create New Upgrade Plan....
    public function create_upgradeplan()
    {
        helper(['form']);
        $rules = [
            // payements information
            // cash
            'amount' => 'required',
            'recived_by' => 'required',
            'payment_date' => 'required',
            //Cheque Information..
            'image' => 'required',
            'Cheque_amount' => 'required',
            'payee_name' => 'required',
            'bank_name' => 'required',
            'recived_cheque' => 'required',
            'cheque_date' => 'required',
            //Bank Transfer Infromation
            'image_transfer' => 'required',
            'from_account_number' => 'required',
            'to_account_number' => 'required',
            'amount_transfer' => 'required',
            'name_bank' => 'required',
            'payment_transfer_date' => 'required',
            'recived_name' => 'required',
        ];
        //         if($cash != Null)
        //         {
        //             echo $namachief;
        //         }
        //   else if ($namarm != NULL)
        //         {
        //            echo $namarm;
        //         }
        //    else
        //         {
        //             echo "Something wrong. Please contact US";
        //         }
        // 		if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        // if ($cash = 1) {
        //      'amount'=> $this->request->getVar('amount');
        //      'received_by' -> $this->request->getVar('received_by');
        //     'payment_date' -> $this->request->getVar('payment_date');
        // }elseif($cheque =2){
        //     'image'=> $this->request->getFile('amount');
        //     'Cheque_amount' -> $this->request->getVar('Cheque_amount');
        //     'payee_name' -> $this->request->getVar('payee_name');
        //     'bank_name' -> $this->request->getVar('bank_name');
        //     'recived_cheque' -> $this->request->getVar('recived_cheque');
        //     'cheque_date' -> $this->request->getVar('cheque_date');


        // }else{
        //     //Bank Transfer 
        //     // 'image_transfer'=> $this->request->getFile('image_transfer');
        //     // 'from_account_number' -> $this->request->getVar('from_account_number');
        //     // 'to_account_number' -> $this->request->getVar('to_account_number');
        //     // 'name_bank' -> $this->request->getVar('name_bank');
        //     // 'payment_transfer_date' -> $this->request->getVar('payment_transfer_date');
        //     // 'recived_name' -> $this->request->getVar('recived_name');


        // };
        $data = [
            //cash
            'amount' => $this->request->getVar('amount'),
            'received_by'  => $this->request->getVar('received_by'),
            'payment_date'  => $this->request->getVar('payment_date'),
            //cheque
            'image' => $this->request->getFile('image'),
            'Cheque_amount'  => $this->request->getVar('Cheque_amount'),
            'payee_name'  => $this->request->getVar('payee_name'),
            'bank_name'  => $this->request->getVar('bank_name'),
            'recived_cheque'  => $this->request->getVar('recived_cheque'),
            'cheque_date'  => $this->request->getVar('cheque_date'),
            //Bank Transfer 
            'image_transfer' => $this->request->getFile('image_transfer'),
            'from_account_number'  => $this->request->getVar('from_account_number'),
            'to_account_number' => $this->request->getVar('to_account_number'),
            'name_bank'  => $this->request->getVar('name_bank'),
            'payment_transfer_date'  => $this->request->getVar('payment_transfer_date'),
            'recived_name'  => $this->request->getVar('recived_name'),
            //
            'plan_name' => $this->request->getVar('plan_name'),
            'billing_type' => $this->request->getVar('billing_type'),
        ];


        $upgradeusermodel = new UpgradeUserModel();
        $savedata = $upgradeusermodel->save($data);
        $this->respondCreated($savedata);
    }

// This Function is delete upgradeplan......
    public function Delete_upgradeplan($id = null)

    {
        $upgrdeusermodel = new UpgradeUserModel();
        if (!empty($id)) {
            $upgrdeusermodel->delete($id);
            $reponse = [
                'message' => 'Upgrade Plan  Is SuccessFully Remove',
            ];
        } else {
            $reponse = [
                'message' => 'Upgrade Plan  is Found',
            ];
        }
    }
    //This function is view single data of the upgradeplan...
    public function Upgradeplan_single($id = null)
    {
        $upgradeusermodel = new UpgradeUserModel();

        $data =  $upgradeusermodel ->find($id);
        if (!empty($data)) {
            $response = [
                'Message' => 'Single Data of Upgrade Plan',
                'data' => $data
            ];
        } else {
            $response = [
                'Message' => 'No Data Found',
            ];
        }
        return $this->respondCreated($response);
    } 

    //This Function is Show all the Upgrade plan....
    public function Upgradeplan_all()
    {
        $upgradeusermodel = new UpgradeUserModel();
        $response = [
            'Message' => 'All Data of Upgrade Plan',
            'data' => $upgradeusermodel->findAll()
        ];
        return $this->respondCreated($response);
    }

    // This Function update all the felid of the upgrade plan.....
    public function UpgradePlan_Update($id = null)
    {
        $rules = [
            //cash
            'amount' => 'required',
            'received_by' => 'required',
            'payment_date' => 'required|valid_email',
            // cheque
            'image' =>'required',
            'Cheque_amount' => 'required',
            'payee_name' => 'required',
            'bank_name' => 'required',
            'received_cheque' => 'required',
            'cheque_date' => 'required',
            //Bank Information
            'image_transfer' => 'required',
            'form_account_number' => 'required',
            'to_account_number' => 'required',
            'name_bank' => 'required',
            'payment_transfer' => 'required',
            'received_name' => 'required',
           
            'plan_name' => 'required',
            'billing_type' => 'required',

        ];

        // var_dump($this->request->getJSON());
        // die;
        if (!$this->validate($rules)) {
            $response = [
                'message' => $this->validator->getError(),
            ];
        } else {
            $upgradeusermodel = new UpgradeUserModel();
            if ($upgradeusermodel->find($id)) {
                $data['amount'] = $this->request->getVar("amount");
                $data['received_by'] = $this->request->getVar("received_by");
                $data['payment_date'] = $this->request->getVar("payment_date");
                //
                $data['image'] = $this->request->getFile("image");
                $data['Cheque_amount'] = $this->request->getVar("Cheque_amount");
                $data['payee_name'] = $this->request->getVar("payee_name");
                $data['bank_name'] = $this->request->getVar("bank_name");
                $data['received_cheque'] = $this->request->getVar("received_cheque");
                $data['cheque_date'] = $this->request->getVar("cheque_date");

                $data['image_transfer'] = $this->request->getFile("image_transfer");
                $data['form_account_number'] = $this->request->getVar("form_account_number");
                $data['to_account_number'] = $this->request->getVar("to_account_number");
                $data['name_bank'] = $this->request->getVar("name_bank");
                $data['payment_transfer'] = $this->request->getVar("payment_transfer");
                $data['received_name'] = $this->request->getVar("received_name");

                $data['plan_name'] = $this->request->getVar("plan_name");
                $data['billing_type'] = $this->request->getVar("billing_type");
                $upgradeusermodel->update($id, $data);
                $response = [
                    'Message' => ' Upgrade Plan Successfully Update',
                ];
            } else {
                $response = [
                    'message' => 'No Upgrade Plan Found',
                ];
            }
        }
        return $this->respondCreated($response);
    }


}
