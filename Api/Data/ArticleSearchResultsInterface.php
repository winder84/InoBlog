<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Ino\Blog\Api\Data;

interface ArticleSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Article list.
     * @return \Ino\Blog\Api\Data\ArticleInterface[]
     */
    public function getItems();

    /**
     * Set title list.
     * @param \Ino\Blog\Api\Data\ArticleInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

