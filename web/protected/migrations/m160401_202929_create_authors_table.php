<?php

class m160401_202929_create_authors_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{authors}}', array(
            'id' => 'pk',
            'firstname' => 'string NOT NULL',
            'lastname' => 'string NOT NULL',
        ));
	}

	public function down()
	{
        $this->dropTable('{{authors}}');
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