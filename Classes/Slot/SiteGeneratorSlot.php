<?php

namespace Oktopuce\SiteGeneratorCustomized\Slot;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
/* * *
 *
 * This file is part of the "site_generator_customized" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * * */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;

class SiteGeneratorSlot
{

    /**
     * Add more variable for first step view
     *
     * @param array &$viewVariables The variables array with already assigned variables
     *
     * @return void
     */
    public function addFirstStepViewVariables(array &$viewVariables): void
    {
        /** @var ObjectManager $objectManager */
        /** @var FrontendUserRepository $frontendUserRepository */
        /** @var Typo3QuerySettings $typo3QuerySettings */
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $frontendUserRepository = $objectManager->get(FrontendUserRepository::class);
        $typo3QuerySettings = $objectManager->get(Typo3QuerySettings::class);

        $typo3QuerySettings->setRespectStoragePage(false);
        $frontendUserRepository->setDefaultOrderings([
            'name' => QueryInterface::ORDER_ASCENDING
        ]);
        $frontendUserRepository->setDefaultQuerySettings($typo3QuerySettings);

        $feUsers = $frontendUserRepository->findAll();

        $viewVariables['feUsers'] = $feUsers;
    }

    /**
     * Add more variable for second step view
     *
     * @param array &$viewVariables The variables array with already assigned variables
     *
     * @return void
     */
    public function addSecondStepViewVariables(array &$viewVariables): void
    {
        /** @var ObjectManager $objectManager */
        /** @var FrontendUserRepository $frontendUserRepository */
        /** @var Typo3QuerySettings $typo3QuerySettings */
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $frontendUserRepository = $objectManager->get(FrontendUserRepository::class);
        $typo3QuerySettings = $objectManager->get(Typo3QuerySettings::class);

        $typo3QuerySettings->setRespectStoragePage(false);
        $frontendUserRepository->setDefaultOrderings([
            'name' => QueryInterface::ORDER_ASCENDING
        ]);
        $frontendUserRepository->setDefaultQuerySettings($typo3QuerySettings);

        $feUsers = $frontendUserRepository->findAll();

        $viewVariables['feUsers'] = $feUsers;
    }

}
