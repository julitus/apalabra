<?php
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string', [
            'limit' => 128,
            'null' => false,
        ]);
        $table->addColumn('password', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('role', 'integer', [
            'default' => 0,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('name', 'string', [
            'limit' => 128,
            'null' => false,
        ]);
        $table->addColumn('email', 'string', [
            'limit' => 128,
            'null' => true,
        ]);
        $table->addColumn('phone', 'string', [
            'limit' => 64,
            'null' => true,
        ]);
        $table->addColumn('code', 'string', [
            'limit' => 32,
            'null' => false,
        ])->addIndex(['code'], ['unique' => true]);
        $table->addColumn('created', 'datetime', [
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'null' => false,
        ]);
        $table->create();
    }

}
