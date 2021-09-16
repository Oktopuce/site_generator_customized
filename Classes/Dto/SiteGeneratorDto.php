<?php

declare(strict_types=1);

/*
 *
 * This file is part of the "Site Generator" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 */

namespace Oktopuce\SiteGeneratorCustomized\Dto;

/**
 * SiteGeneratorDto DTO for data exchange beetwen form and Wizard
 *
 * @author Florian Rival <florian.typo3@oktopuce.fr>
 */
class SiteGeneratorDto extends \Oktopuce\SiteGenerator\Dto\SiteGeneratorDto
{

    /**
     * My customized data from form
     *
     * @var string
     */
    protected $customizedData = '';

    /**
     * FE User
     *
     * @var int
     */
    protected $feUser = 0;

    /**
     * CustomizedData
     *
     * @param string $customizedData
     * @return void
     */
    public function setCustomizedData(string $customizedData): void
    {
        $this->customizedData = $customizedData;
    }

    /**
     * Get customizedData
     *
     * @return string
     */
    public function getCustomizedData(): string
    {
        return $this->customizedData;
    }

    /**
     * FeUser
     *
     * @param int $feUser
     * @return void
     */
    public function setFeUser(int $feUser): void
    {
        $this->feUser = $feUser;
    }

    /**
     * Get feUser
     *
     * @return int
     */
    public function getFeUser(): int
    {
        return $this->feUser;
    }
}
