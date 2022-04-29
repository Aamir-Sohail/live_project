<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpgradeUserPlan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 10, 'auto_increment'=> true, 'unsinged'=>true,],
            //cash
            'user_id'      => ['type' => 'INT', 'constraint' => 8],
            'amount'      => ['type' => 'INT', 'constraint' => 31],
            'recived_by'      => ['type' => 'varchar', 'constraint' => 31],
            'payment_date'      => ['type' => 'varchar', 'constraint' => 31],
           // cheque
            'image'      => ['type' => 'varchar', 'constraint' => 31],
            'Cheque_amount'      => ['type' => 'varchar', 'constraint' => 31],
            'payee_name'      => ['type' => 'varchar', 'constraint' => 31],
            'bank_name'      => ['type' => 'varchar', 'constraint' => 31],
            'recived_cheque'      => ['type' => 'varchar', 'constraint' => 31],
            'cheque_date'      => ['type' => 'varchar', 'constraint' => 31],
           //payments information.
           'image_transfer'      => ['type' => 'varchar', 'constraint' => 31],
           'from_account_number'      => ['type' => 'varchar', 'constraint' => 31],
           'to_account_number'      => ['type' => 'varchar', 'constraint' => 31],
           'name_bank'      => ['type' => 'varchar', 'constraint' => 31],
           'payment_transfer_date'      => ['type' => 'varchar', 'constraint' => 31],
           'recived_name'      => ['type' => 'varchar', 'constraint' => 31],
           'plan_name'      => ['type' => 'varchar', 'constraint' => 31],
           'billing_type'      => ['type' => 'varchar', 'constraint' => 31],

            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
    
         
        ]);
        $this->forge->addKey('id',true);
        $this->forge->addForeignKey('user_id','Tenant_user','id','CASCADE','CASCADE');
        $this->forge->createTable('UpgradeUser');
    }

    public function down()
    {
        $this->forge->dropTable('UpgradeUser');
        
    }
}
