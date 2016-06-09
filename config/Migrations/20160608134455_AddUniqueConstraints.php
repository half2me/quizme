<?php
use Migrations\AbstractMigration;

class AddUniqueConstraints extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('data')->addIndex(
            ['quiz_id', 'name'],
            ['unique' => true]
        )->update();

        $this->table('attribute_types')->addIndex(
            ['quiz_id', 'name'],
            ['unique' => true]
        )->update();

        $this->table('quizzes')->addIndex(
            ['id', 'name'],
            ['unique' => true]
        )->update();

        $this->table('shared_users')->addIndex(
            ['quiz_id', 'user_id'],
            ['unique' => true]
        )->update();

        $this->table('users')->addIndex(
            ['name'],
            ['unique' => true]
        )->addIndex(
            ['email'],
            ['unique' => true]
        )->update();
    }
}
