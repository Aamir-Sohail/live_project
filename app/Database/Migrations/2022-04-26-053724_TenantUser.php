<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use phpDocumentor\Reflection\Types\Nullable;

class TenantUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 31, 'auto_increment'=> true, 'unsinged'=>true,],
            'firstname'      => ['type' => 'varchar', 'constraint' => 31],
            'lastname'      => ['type' => 'varchar', 'constraint' => 31],
            'phone_number'      => ['type' => 'INT', 'constraint' => 31],
            'email'      => ['type' => 'varchar', 'constraint' => 31],
            'business_name'      => ['type' => 'varchar', 'constraint' => 31],
            'number_branches'      => ['type' => 'INT', 'constraint' => 31],
            'postion_title'      => ['type' => 'varchar', 'constraint' => 31],
            'country'      => ['type' => 'varchar', 'constraint' => 31],
            'state'      => ['type' => 'varchar', 'constraint' => 31],
            'city'      => ['type' => 'varchar', 'constraint' => 31],
            'address'      => ['type' => 'varchar', 'constraint' => 31],
            'zipcode'      => ['type' => 'varchar', 'constraint' => 31],
            'paymentmode'      => ['type' => 'varchar', 'constraint' => 31],
            'image'      => ['type' => 'varchar', 'constraint' => 31],
            'cash'      => ['type' => 'varchar', 'constraint' => 31],
           

            // 'paymentmode' => ['type' =>'enum', 'c','cheq','tran'],
            'plan_name'      => ['type' => 'varchar', 'constraint' => 31],
            'billing_type'      => ['type' => 'varchar', 'constraint' => 31],
            // 'billing_type'=>(['type' =>'enum',"Monthly","Anually","All"])->Nullable,
             'domain_name'=>['type'=>'varchar','constraint'=>31],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
    
         
        ]);
        $this->forge->addKey('id',true);
        $this->forge->createTable('Tenant_user');
    }

    public function down()
    {
        $this->forge->dropTable('Tenant_user');
        
    }
}
