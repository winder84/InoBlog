<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Ino\Blog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ArticleRepositoryInterface
{

    /**
     * Save Article
     * @param \Ino\Blog\Api\Data\ArticleInterface $article
     * @return \Ino\Blog\Api\Data\ArticleInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Ino\Blog\Api\Data\ArticleInterface $article
    );

    /**
     * Retrieve Article
     * @param string $articleId
     * @return \Ino\Blog\Api\Data\ArticleInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($articleId);

    /**
     * Retrieve Article matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Ino\Blog\Api\Data\ArticleSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Article
     * @param \Ino\Blog\Api\Data\ArticleInterface $article
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Ino\Blog\Api\Data\ArticleInterface $article
    );

    /**
     * Delete Article by ID
     * @param string $articleId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($articleId);
}

