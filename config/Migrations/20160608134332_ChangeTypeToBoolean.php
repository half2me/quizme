<?php
use Migrations\AbstractMigration;

class ChangeTypeToBoolean extends AbstractMigration
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
        $table = $this->table('attribute_types');
        $table->changeColumn('cardinality', 'boolean', [
            'default' => false,
            'null' => false
        ]);
        $table->update();
    }
}
