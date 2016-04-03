<?php

class m160401_202952_create_books_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{books}}', array(
            'id' => 'pk',
            'name' => 'string NOT NULL',
            'date_create' => 'date',
            'date_update' => 'date',
            'preview' => 'string',
            'date' => 'date',
            'author_id' => 'int',
        ));

        $this->createIndex('idx-books-author_id', '{{books}}', 'author_id');

        $this->addForeignKey('fk-author_id', '{{books}}', 'author_id', '{{authors}}', 'id', 'SET NULL', 'RESTRICT');

    }

	public function down()
	{
        $this->dropTable('{{books}}');
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