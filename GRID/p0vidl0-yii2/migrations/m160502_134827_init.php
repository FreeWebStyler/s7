<?php

use yii\db\Migration;

class m160502_134827_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('country', [
            'id' => $this->primaryKey()->comment('Уникальный идентификатор страны'),
            'country_name' => $this->string()->comment('Название страны'),
        ], $tableOptions);


        $this->createTable('person', [
            'id' => $this->primaryKey()->comment('Уникальный идентификатор человека'),
            'first_name' => $this->string()->comment('Имя'),
            'last_name' => $this->string()->comment('Фамилия'),
            'country_id' => $this->integer()->comment('Страна проживания'),
            'parent_id' => $this->integer()->comment('Родитель'),
        ], $tableOptions);

        $this->createIndex('country_id', 'person', 'country_id');

        $this->addForeignKey(
            'fk-person-country_id-country-id',
            'person', 'country_id',
            'country', 'id',
            'SET NULL', 'CASCADE'
        );


    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-person-country_id-country-id', 'person');
        $this->dropIndex('country_id', 'person');
        $this->dropTable('person');
        $this->dropTable('country');

    }
}
