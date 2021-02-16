<?php
use Migrations\AbstractMigration;

class CreateQuestions extends AbstractMigration
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
        $table = $this->table('questions');
        $table->addColumn('challenge_id', 'integer', [
            'null' => false,
        ])->addForeignKey('challenge_id', 'challenges', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION']);
        $table->addColumn('label', 'string', [
            'limit' => 16,
            'null' => false,
        ]);
        $table->addColumn('title', 'string', [
            'limit' => 128,
            'null' => false,
        ]);
        $table->addColumn('clue', 'text', [
            'null' => false,
        ]);
        $table->addColumn('answer', 'string', [
            'limit' => 128,
            'null' => false,
        ]);
        $table->addColumn('points', 'float', [
            'null' => false,
        ]);
        $table->create();
    }
}
