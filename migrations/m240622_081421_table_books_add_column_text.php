<?php

use yii\db\Migration;

/**
 * Class m240622_081421_table_books_add_column_text
 */
class m240622_081421_table_books_add_column_text extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('books', 'text', $this->json());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240622_081421_table_books_add_column_text cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240622_081421_table_books_add_column_text cannot be reverted.\n";

        return false;
    }
    */
}
