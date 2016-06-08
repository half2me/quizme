<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public function up()
    {

        $this->table('attribute_types', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'biginteger', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('cardinality', 'integer', [
                'default' => 0,
                'limit' => 1,
                'null' => false,
            ])
            ->addColumn('quiz_id', 'biginteger', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addIndex(
                [
                    'quiz_id',
                ]
            )
            ->create();

        $this->table('attributes', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'biginteger', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('attribute_type_id', 'biginteger', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('value', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'attribute_type_id',
                ]
            )
            ->create();

        $this->table('data', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'biginteger', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('quiz_id', 'biginteger', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addIndex(
                [
                    'quiz_id',
                ]
            )
            ->create();

        $this->table('data_attributes', ['id' => false, 'primary_key' => ['data_id', 'attribute_id']])
            ->addColumn('data_id', 'biginteger', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('attribute_id', 'biginteger', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addIndex(
                [
                    'attribute_id',
                ]
            )
            ->addIndex(
                [
                    'data_id',
                ]
            )
            ->create();

        $this->table('quizzes', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'biginteger', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('user_id', 'biginteger', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $this->table('shared_users', ['id' => false, 'primary_key' => ['quiz_id', 'user_id']])
            ->addColumn('quiz_id', 'biginteger', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('user_id', 'biginteger', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addIndex(
                [
                    'quiz_id',
                ]
            )
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $this->table('users', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'biginteger', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->create();

        $this->table('attribute_types')
            ->addForeignKey(
                'quiz_id',
                'quizzes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('attributes')
            ->addForeignKey(
                'attribute_type_id',
                'attribute_types',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('data')
            ->addForeignKey(
                'quiz_id',
                'quizzes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('data_attributes')
            ->addForeignKey(
                'attribute_id',
                'attributes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'data_id',
                'data',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('quizzes')
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('shared_users')
            ->addForeignKey(
                'quiz_id',
                'quizzes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();
    }

    public function down()
    {
        $this->table('attribute_types')
            ->dropForeignKey(
                'quiz_id'
            );

        $this->table('attributes')
            ->dropForeignKey(
                'attribute_type_id'
            );

        $this->table('data')
            ->dropForeignKey(
                'quiz_id'
            );

        $this->table('data_attributes')
            ->dropForeignKey(
                'attribute_id'
            )
            ->dropForeignKey(
                'data_id'
            );

        $this->table('quizzes')
            ->dropForeignKey(
                'user_id'
            );

        $this->table('shared_users')
            ->dropForeignKey(
                'quiz_id'
            )
            ->dropForeignKey(
                'user_id'
            );

        $this->dropTable('attribute_types');
        $this->dropTable('attributes');
        $this->dropTable('data');
        $this->dropTable('data_attributes');
        $this->dropTable('quizzes');
        $this->dropTable('shared_users');
        $this->dropTable('users');
    }
}
