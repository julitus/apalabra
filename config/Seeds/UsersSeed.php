<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'username'  => 'admin',
            'password' => (new DefaultPasswordHasher)->hash('123456'),
            'name' => 'Administrador',
            'code' => uniqid(),
            'created' => '2021-01-01 00:00:00',
            'modified' => '2021-01-01 00:00:00',
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
