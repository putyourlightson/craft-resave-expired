<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\resaveexpired\events;

use craft\events\CancelableEvent;

class ResaveElementsEvent extends CancelableEvent
{
    public ?string $elementType = null;

    /**
     * @var int[]
     */
    public array $elementIds = [];
}
