<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%role}}`
 */
class m240301_081732_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'role_id' => $this->integer()->defaultValue(1),
            'username' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'middle_name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull()->unique(),
        ]);

        // creates index for column `role_id`
        $this->createIndex(
            '{{%idx-user-role_id}}',
            '{{%user}}',
            'role_id'
        );

        // add foreign key for table `{{%role}}`
        $this->addForeignKey(
            '{{%fk-user-role_id}}',
            '{{%user}}',
            'role_id',
            '{{%role}}',
            'id',
            'CASCADE'
        );

        $this->insert('{{%user}}', [
            'role_id' => 2,
            'username' => 'copp',
            'password' => md5('password'),
            'email' => 'copp@gmail.com',
            'first_name' => 'copp',
            'last_name' => 'copp',
            'middle_name' => 'copp',
            'phone' => '+7(999)999-99-99',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%role}}`
        $this->dropForeignKey(
            '{{%fk-user-role_id}}',
            '{{%user}}'
        );

        // drops index for column `role_id`
        $this->dropIndex(
            '{{%idx-user-role_id}}',
            '{{%user}}'
        );

        $this->dropTable('{{%user}}');
    }
}
