<?php

declare(strict_types=1);

namespace Oktopuce\SiteGeneratorCustomized\Domain\Repository;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class FrontendUserRepository extends Repository
{
    public function __construct(
        private readonly ConnectionPool $connectionPool
    ) {
        parent::__construct();
    }

    public function findAll(): array|QueryResultInterface
    {
        $queryBuilder = $this->connectionPool
            ->getQueryBuilderForTable('fe_users');

        $result = $queryBuilder
            ->select('uid', 'name')
            ->from('fe_users')
            ->executeQuery();

        return $result->fetchAllAssociative();
    }
}