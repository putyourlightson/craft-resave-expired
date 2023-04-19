<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\resaveexpired\services;

use Craft;
use craft\base\Component;
use craft\base\ElementInterface;
use craft\helpers\Db;
use craft\helpers\ElementHelper;
use DateTime;
use putyourlightson\resaveexpired\events\ResaveElementsEvent;
use putyourlightson\resaveexpired\records\ElementExpiryDateRecord;

class ElementsService extends Component
{
    /**
     * @event ResaveElementsEvent
     */
    public const EVENT_BEFORE_RESAVE_ELEMENTS = 'beforeResaveElements';

    /**
     * @event ResaveElementsEvent
     */
    public const EVENT_AFTER_RESAVE_ELEMENTS = 'beforeResaveElements';

    public function addElementExpiryDates(ElementInterface $element): void
    {
        ElementExpiryDateRecord::deleteAll(['elementId' => $element->id]);

        if ($element->getStatus() === 'disabled'
            || ElementHelper::isDraftOrRevision($element)) {
            return;
        }

        $now = new DateTime();
        $expiryDate = null;

        if (!empty($element->postDate) && $element->postDate > $now) {
            $expiryDate = $element->postDate;
        } elseif (!empty($element->expiryDate) && $element->expiryDate > $now) {
            $expiryDate = $element->expiryDate;
        }

        if ($expiryDate === null) {
            return;
        }

        $expiryDate = Db::prepareDateForDb($expiryDate);

        $record = ElementExpiryDateRecord::find()
            ->where(['elementId' => $element->id])
            ->one();

        if ($record === null) {
            $record = new ElementExpiryDateRecord();
            $record->elementId = $element->id;
            $record->elementType = $element::class;
        }

        $record->expiryDate = $expiryDate;
        $record->save();
    }

    public function resaveExpiryDates(string $elementType): void
    {
        $now = Db::prepareDateForDb(new DateTime());

        /** @var ElementInterface $elementType */
        $elements = $elementType::find()
            ->where(['<', 'postDate', $now])
            ->orWhere(['>', 'expiryDate', $now])
            ->site('*')
            ->status(['not', 'disabled'])
            ->all();

        foreach ($elements as $element) {
            $this->addElementExpiryDates($element);
        }
    }

    public function resaveExpiredElements(): void
    {
        $now = Db::prepareDateForDb(new DateTime());

        $elementTypes = ElementExpiryDateRecord::find()
            ->select('elementType')
            ->where(['<', 'expiryDate', $now])
            ->groupBy('elementType')
            ->column();

        foreach ($elementTypes as $elementType) {
            $elementIds = ElementExpiryDateRecord::find()
                ->select('elementId')
                ->where(['elementType' => $elementType])
                ->andWhere(['<', 'expiryDate', $now])
                ->column();

            if (class_exists($elementType)) {
                $this->_resaveExpiredElementsByType($elementType, $elementIds);
            }
        }
    }

    private function _resaveExpiredElementsByType(string $elementType, array $elementIds): void
    {
        $event = new ResaveElementsEvent();
        $event->elementType = $elementType;
        $event->elementIds = $elementIds;
        $this->trigger(self::EVENT_BEFORE_RESAVE_ELEMENTS, $event);

        if ($event->isValid) {
            /** @var ElementInterface $elementType */
            $query = $elementType::find()
                ->id($elementIds)
                ->status(['not', 'disabled']);

            Craft::$app->getElements()->resaveElements($query);
        }

        if ($this->hasEventHandlers(self::EVENT_AFTER_RESAVE_ELEMENTS)) {
            $this->trigger(self::EVENT_AFTER_RESAVE_ELEMENTS, $event);
        }
    }
}
