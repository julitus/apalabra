<?php
use Migrations\AbstractMigration;

class CreateConnections extends AbstractMigration
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
        $table = $this->table('connections');
        $table->addColumn('user_id', 'integer', [
            'null' => false,
        ])->addForeignKey('user_id', 'users', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION']);
        $table->addColumn('player_id', 'integer', [
            'null' => false,
        ])->addForeignKey('player_id', 'players', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION']);
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
