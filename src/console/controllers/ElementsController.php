<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\resaveexpired\console\controllers;

use craft\elements\Entry;
use putyourlightson\resaveexpired\resaveexpired;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\BaseConsole;

class ElementsController extends Controller
{
    /**
     * Resaves expired elements.
     */
    public function actionResaveExpired(): int
    {
        ResaveExpired::$plugin->elements->resaveExpiredElements();

        $this->stdout('Expired elements successfully resaved.' . PHP_EOL, BaseConsole::FG_GREEN);

        return ExitCode::OK;
    }

    /**
     * Resaves expiry dates.
     */
    public function actionResaveExpiryDates(?string $elementType = null): int
    {
        $elementType = $elementType ?? Entry::class;
        ResaveExpired::$plugin->elements->resaveExpiryDates($elementType);

        $this->stdout('Expiry dates successfully resaved.' . PHP_EOL, BaseConsole::FG_GREEN);

        return ExitCode::OK;
    }
}
