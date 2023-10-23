<?php

declare(strict_types=1);

/***
 *
 * This file is part of the "Site Generator Customized" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 ***/

namespace Oktopuce\SiteGeneratorCustomized\Wizard;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Log\LogLevel;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use Oktopuce\SiteGenerator\Wizard\SiteGeneratorWizard;
use Oktopuce\SiteGenerator\Wizard\SiteGeneratorStateInterface;
use Oktopuce\SiteGenerator\Wizard\StateBase;
use Oktopuce\SiteGeneratorCustomized\Dto\SiteGeneratorDto;

/**
 * StateCreateFeGroup
 */
class StateCreateFeGroup extends StateBase implements SiteGeneratorStateInterface
{
    /**
     * Create FE user group
     *
     * @param SiteGeneratorWizard $context
     * @return void
     * @throws \Exception
     */
    public function process(SiteGeneratorWizard $context): void
    {
        $settings = $context->getSettings();

        // Create FE group
        $groupId = $this->createFeGroup($context->getSiteData(), (int)$settings['siteGenerator']['wizard']['pidFeGroup'], (int)$settings['siteGenerator']['wizard']['baseFeGroupUid']);
        $context->getSiteData()->setFeGroupId($groupId);
    }

    /**
     * Create FE group
     *
     * @param SiteGeneratorDto $siteData New site data
     * @param int $pidFeGroup Pid for FE group creation
     * @param int $baseFeGroupUid Base Workgroup UID
     * @throws \Exception
     *
     * @return int The uid of the group created
     */
    protected function createFeGroup(SiteGeneratorDto $siteData, int $pidFeGroup, int $baseFeGroupUid): int
    {
        // Create a new FE group with specific subgroup
        $data = [];
        $newUniqueId = 'NEW' . uniqid();
        $groupName = $siteData->getCustomizedData() . ' - ' . $siteData->getTitle();
        $data['fe_groups'][$newUniqueId] = [
            'pid' => $pidFeGroup,
            'title' => $groupName,
            'subgroup' => $baseFeGroupUid
        ];

        /* @var $tce DataHandler */
        $tce = GeneralUtility::makeInstance(DataHandler::class);
        $tce->start($data, []);
        $tce->process_datamap();

        // Retrieve uid of user group created
        $groupId = $tce->substNEWwithIDs[$newUniqueId];

        if ($groupId > 0) {
            $this->log(LogLevel::NOTICE, 'Create FE group successful (uid = ' . $groupId);
            $siteData->addMessage($this->translate('generate.success.feGroupCreated', [$groupName, $groupId]));
        }
        else {
            $this->log(LogLevel::ERROR, 'Create FE group error');
            throw new \Exception($this->translate('wizard.feGroup.error'));
        }

        return ($groupId);
    }

}
