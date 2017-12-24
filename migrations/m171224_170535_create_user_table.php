<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m171224_170535_create_user_table extends Migration
{
	protected $table = '{{user}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
	        'username'=>$this->string()->notNull(),
	        'email'=>$this->string()->notNull(),
        ]);

	    $this->createIndex('{{ux_user_username}}', $this->table, 'username', true);
	    $this->createIndex('{{ux_user_email}}', $this->table, 'email', true);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
