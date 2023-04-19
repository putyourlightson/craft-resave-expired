<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\resaveexpired;

use craft\base\Plugin;
use craft\events\ElementEvent;
use craft\services\Elements;
use putyourlightson\resaveexpired\services\ElementsService;
use yii\base\Event;

/**
 * @property-read ElementsService $elements
 */
class ResaveExpired extends Plugin
{
    public static ResaveExpired $plugin;

    public string $schemaVersion = '1.0.0';

    public function init(): void
    {
        parent::init();

        self::$plugin = $this;

        $this->_registerComponents();
        $this->_registerElementEvents();
    }

    private function _registerComponents(): void
    {
        $this->setComponents([
            'elements' => ElementsService::class,
        ]);
    }


    private function _registerElementEvents(): void
    {
        Event::on(Elements::class, Elements::EVENT_AFTER_SAVE_ELEMENT,
            function(ElementEvent $event) {
                $this->elements->addElementExpiryDates($event->element);
            }
        );
    }
}
