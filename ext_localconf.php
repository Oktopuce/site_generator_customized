<?php

defined('TYPO3') || die('Access denied.');

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher;

call_user_func(
    function() {
        // Register signal slot
        $signalSlotDispatcher = GeneralUtility::makeInstance(Dispatcher::class);
        $signalSlotDispatcher->connect(
            \Oktopuce\SiteGenerator\Controller\SiteGeneratorController::class,
            'addFirstStepViewVariables',
            \Oktopuce\SiteGeneratorCustomized\Slot\SiteGeneratorSlot::class,
            'addFirstStepViewVariables'
        );

        $signalSlotDispatcherSecond = GeneralUtility::makeInstance(Dispatcher::class);
        $signalSlotDispatcherSecond->connect(
            \Oktopuce\SiteGenerator\Controller\SiteGeneratorController::class,
            'addSecondStepViewVariables',
            \Oktopuce\SiteGeneratorCustomized\Slot\SiteGeneratorSlot::class,
            'addSecondStepViewVariables'
        );
    }
);
