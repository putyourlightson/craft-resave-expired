<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\resaveexpired\migrations;

use craft\db\Migration;
use putyourlightson\resaveexpired\records\ElementExpiryDateRecord;

class Install extends Migration
{
    public function safeUp(): bool
    {
        if (!$this->db->tableExists(ElementExpiryDateRecord::tableName())) {
            $this->createTable(ElementExpiryDateRecord::tableName(), [
                'id' => $this->primaryKey(),
                'elementId' => $this->integer()->notNull(),
                'elementType' => $this->string()->notNull(),
                'expiryDate' => $this->dateTime()->notNull(),
                'dateCreated' => $this->dateTime()->notNull(),
                'dateUpdated' => $this->dateTime()->notNull(),
                'uid' => $this->uid(),
            ]);

            $this->addForeignKey(null, ElementExpiryDateRecord::tableName(), 'elementId', '{{%elements}}', 'id', 'CASCADE');
        }

        return true;
    }

    public function safeDown(): bool
    {
        $this->dropTableIfExists(ElementExpiryDateRecord::tableName());

        return true;
    }
}
