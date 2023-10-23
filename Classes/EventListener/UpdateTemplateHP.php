<?php

declare(strict_types=1);

/* * *
 *
 * This file is part of the "site_generator_customized" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * * */

namespace Oktopuce\SiteGeneratorCustomized\EventListener;

use Oktopuce\SiteGenerator\Wizard\Event\UpdateTemplateHPEvent;

class UpdateTemplateHP
{
    /**
     * __invoke
     *
     * @param UpdateTemplateHPEvent $event
     * @return void
     */
    public function __invoke(UpdateTemplateHPEvent $event): void
    {
        $action = $event->getAction();
        if ($action === 'customAction') {
            $parameters = $event->getParameters();
            $value = $event->getValue();
            $dataMapping = $event->getFilteredMapping();
            $updatedValue = "params = $parameters - value = $value - dataMapping = " . implode(',', $dataMapping);

            $event->setUpdatedValue($updatedValue);
        }
    }
}
