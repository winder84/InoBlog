<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Ino\Blog\Api\Data;

interface ArticleInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const TITLE = 'title';
    const ARTICLE_ID = 'article_id';
    const DESCRIPTION = 'description';
    const SMALL_DESCRIPTION = 'small_description';

    /**
     * Get article_id
     * @return string|null
     */
    public function getArticleId();

    /**
     * Set article_id
     * @param string $articleId
     * @return \Ino\Blog\Api\Data\ArticleInterface
     */
    public function setArticleId($articleId);

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \Ino\Blog\Api\Data\ArticleInterface
     */
    public function setTitle($title);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Ino\Blog\Api\Data\ArticleExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Ino\Blog\Api\Data\ArticleExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Ino\Blog\Api\Data\ArticleExtensionInterface $extensionAttributes
    );

    /**
     * Get small_description
     * @return string|null
     */
    public function getSmallDescription();

    /**
     * Set small_description
     * @param string $smallDescription
     * @return \Ino\Blog\Api\Data\ArticleInterface
     */
    public function setSmallDescription($smallDescription);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \Ino\Blog\Api\Data\ArticleInterface
     */
    public function setDescription($description);
}

