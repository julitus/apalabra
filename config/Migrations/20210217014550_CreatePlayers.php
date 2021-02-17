<?php
use Migrations\AbstractMigration;

class CreatePlayers extends AbstractMigration
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
        $table = $this->table('players');
        $table->addColumn('email', 'string', [
            'limit' => 128,
            'null' => false,
        ])->addIndex(['email'], ['unique' => true]);
        $table->addColumn('password', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('firstname', 'string', [
            'limit' => 128,
            'null' => false,
        ]);
        $table->addColumn('lastname', 'string', [
            'limit' => 128,
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
