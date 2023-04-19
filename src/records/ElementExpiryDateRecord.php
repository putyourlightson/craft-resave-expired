<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\resaveexpired\records;

use craft\db\ActiveRecord;
use DateTime;

/**
 * @property int $elementId
 * @property string $elementType
 * @property DateTime $expiryDate
 */
class ElementExpiryDateRecord extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%resaveexpired_elementexpirydates}}';
    }
}
