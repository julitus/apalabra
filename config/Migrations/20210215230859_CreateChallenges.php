<?php
use Migrations\AbstractMigration;

class CreateChallenges extends AbstractMigration
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
        $table = $this->table('challenges');
        $table->addColumn('user_id', 'integer', [
            'null' => false,
        ])->addForeignKey('user_id', 'users', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION']);
        $table->addColumn('name', 'string', [
            'limit' => 64,
            'null' => false,
        ]);
        $table->addColumn('time', 'integer', [
            'null' => false,
        ]);
        $table->addColumn('code', 'string', [
            'limit' => 32,
            'null' => true,
        ]);
        $table->addColumn('points', 'float', [
            'null' => false,
        ]);
        $table->addColumn('questions', 'integer', [
            'null' => false,
        ]);
        $table->addColumn('attemps', 'integer', [
            'default' => 0,
            'null' => false,
        ]);
        $table->addColumn('active', 'boolean', [
            'default' => true,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'null' => false,
        ]);
        $table->create();
    }
}
