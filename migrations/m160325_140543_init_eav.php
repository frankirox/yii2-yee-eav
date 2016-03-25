<?php

use yii\db\Migration;

class m160325_140543_init_eav extends Migration
{

    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        //---------------- eav_entity_model ----------------

        $this->createTable('eav_entity_model', [
            'id' => $this->primaryKey(),
            'entity_name' => $this->string(100)->notNull(),
            'entity_model' => $this->string(100)->notNull(),
        ], $tableOptions);

        $this->createIndex('eav_entity_model_unique_model', 'eav_entity_model', ['entity_model'], true);

        //---------------- eav_attribute_type ----------------

        $this->createTable('eav_attribute_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'store_type' => $this->string('32')->notNull()->defaultValue('raw')
        ], $tableOptions);

        $this->insert('eav_attribute_type', ['name' => 'text', 'store_type' => 'raw']);
        $this->insert('eav_attribute_type', ['name' => 'select', 'store_type' => 'option']);

        //---------------- eav_attribute ----------------

        $this->createTable('eav_attribute', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'label' => $this->string(),
            'default_value' => $this->string(),
            'icon' => $this->string(64),
            'description' => $this->string(),
            'required' => $this->integer(1),
        ], $tableOptions);

        $this->createIndex('eav_attribute_type_id', 'eav_attribute', ['type_id']);
        $this->createIndex('eav_attribute_name', 'eav_attribute', ['name']);

        $this->addForeignKey('fk_eav_attribute_type', 'eav_attribute', 'type_id', 'eav_attribute_type', 'id', 'CASCADE', 'CASCADE');

        //---------------- eav_attribute_option ----------------

        $this->createTable('eav_attribute_option', [
            'id' => $this->primaryKey(),
            'attribute_id' => $this->integer(),
            'value' => $this->string(),
        ], $tableOptions);

        $this->createIndex('eav_attribute_option_attribute_id', 'eav_attribute_option', ['attribute_id']);

        $this->addForeignKey('fk_eav_option_attribute', 'eav_attribute_option', 'attribute_id', 'eav_attribute', 'id', 'CASCADE', 'CASCADE');

        //---------------- eav_entity ----------------

        $this->createTable('eav_entity', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer(),
            'category_id' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('eav_entity_model_id', 'eav_entity', ['model_id']);
        $this->createIndex('eav_entity_category_id', 'eav_entity', ['category_id']);

        $this->addForeignKey('eav_entity_model', 'eav_entity', 'model_id', 'eav_entity_model', 'id', 'CASCADE', 'CASCADE');


        //---------------- eav_entity_attribute ----------------

        $this->createTable('eav_entity_attribute', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer(),
            'attribute_id' => $this->integer(),
            'order' => $this->integer()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('eav_entity_attribute_entity_id', 'eav_entity_attribute', ['entity_id']);
        $this->createIndex('eav_entity_attribute_attribute_id', 'eav_entity_attribute', ['attribute_id']);

        $this->addForeignKey('eav_entity_attribute_entity', 'eav_entity_attribute', 'entity_id', 'eav_attribute', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('eav_entity_attribute_attribute', 'eav_entity_attribute', 'attribute_id', 'eav_attribute', 'id', 'CASCADE', 'CASCADE');


        //---------------- eav_value ----------------

        $this->createTable('eav_value', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer(),
            'attribute_id' => $this->integer(),
            'item_id' => $this->integer(),
            'value' => $this->text(),
        ], $tableOptions);

        $this->createIndex('eav_value_entity_id', 'eav_value', ['entity_id']);
        $this->createIndex('eav_value_attribute_id', 'eav_value', ['attribute_id']);
        $this->createIndex('eav_value_item_id', 'eav_value', ['item_id']);

        $this->addForeignKey('eav_value_entity', 'eav_value', 'entity_id', 'eav_attribute', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('eav_value_attribute', 'eav_value', 'attribute_id', 'eav_attribute', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_eav_attribute_type', 'eav_attribute');
        $this->dropForeignKey('fk_eav_option_attribute', 'eav_attribute_option');
        $this->dropForeignKey('eav_entity_model', 'eav_entity', 'model_id');
        $this->dropForeignKey('eav_entity_attribute_entity', 'eav_entity_attribute');
        $this->dropForeignKey('eav_entity_attribute_attribute', 'eav_entity_attribute');
        $this->dropForeignKey('eav_value_entity', 'eav_value');
        $this->dropForeignKey('eav_value_attribute', 'eav_value');

        $this->dropTable('eav_attribute');
        $this->dropTable('eav_attribute_option');
        $this->dropTable('eav_attribute_type');
        $this->dropTable('eav_entity');
        $this->dropTable('eav_entity_attribute');
        $this->dropTable('eav_entity_model');
    }

}
