<?php

class m160401_193835_create_users_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{users}}', array(
            'id' => 'pk',
            'username' => 'string NOT NULL',
            'email' => 'string NOT NULL',
            'password' => 'string NOT NULL',
        ));
	}

	public function down()
	{
        $this->dropTable('{{users}}');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}