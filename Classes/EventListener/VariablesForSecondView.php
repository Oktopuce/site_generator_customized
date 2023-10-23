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

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use Oktopuce\SiteGeneratorCustomized\Domain\Repository\FrontendUserRepository;
use Oktopuce\SiteGenerator\Wizard\Event\BeforeRenderingSecondStepViewEvent;

class VariablesForSecondView
{
    /**
     * @var ?FrontendUserRepository
     */
    protected ?FrontendUserRepository $frontendUserRepository = null;

    /**
     * @var ?Typo3QuerySettings
     */
    protected ?Typo3QuerySettings $typo3QuerySettings = null;

    /**
     * Class constructor
     *
     * @param FrontendUserRepository $frontendUserRepository
     * @param Typo3QuerySettings $typo3QuerySettings
     */
    public function __construct(FrontendUserRepository $frontendUserRepository, Typo3QuerySettings $typo3QuerySettings)
    {
        $this->frontendUserRepository = $frontendUserRepository;
        $this->typo3QuerySettings = $typo3QuerySettings;
    }

    /**
     * __invoke
     *
     * @param BeforeRenderingSecondStepViewEvent $event
     * @return void
     */
    public function __invoke(BeforeRenderingSecondStepViewEvent $event): void
    {
        $this->typo3QuerySettings->setRespectStoragePage(false);
        $this->frontendUserRepository->setDefaultOrderings([
            'name' => QueryInterface::ORDER_ASCENDING
        ]);
        $this->frontendUserRepository->setDefaultQuerySettings($this->typo3QuerySettings);

        $feUsers = $this->frontendUserRepository->findAll();

        $variables = [
            'feUsers' => $feUsers,
            'test' => 'une autre',
            'rules' => 'erased'
        ];

        $event->addViewVariables($variables);
        $event->addViewVariables(['second ajout' => 'for test']);
        // $event->addViewVariables(['feUsers' => $feUsers]);
    }
}
