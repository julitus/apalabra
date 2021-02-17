<?php
use Migrations\AbstractMigration;

class CreateRecords extends AbstractMigration
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
        $table = $this->table('records');
        $table->addColumn('player_id', 'integer', [
            'null' => false,
        ])->addForeignKey('player_id', 'players', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION']);
        $table->addColumn('challenge_id', 'integer', [
            'null' => false,
        ])->addForeignKey('challenge_id', 'challenges', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION']);
        $table->addColumn('result_id', 'integer', [
            'null' => false,
        ])->addForeignKey('result_id', 'results', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION']);
        $table->addColumn('score', 'float', [
            'null' => false,
        ]);
        $table->addColumn('time', 'integer', [
            'null' => false,
        ]);
        $table->addColumn('successful', 'integer', [
            'null' => false,
        ]);
        $table->addColumn('wrong', 'integer', [
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'null' => false,
        ]);
        $table->create();
    }
}
