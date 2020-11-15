<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Ino\Blog\Model\Data;

use Ino\Blog\Api\Data\ArticleInterface;

class Article extends \Magento\Framework\Api\AbstractExtensibleObject implements ArticleInterface
{

    /**
     * Get article_id
     * @return string|null
     */
    public function getArticleId()
    {
        return $this->_get(self::ARTICLE_ID);
    }

    /**
     * Set article_id
     * @param string $articleId
     * @return \Ino\Blog\Api\Data\ArticleInterface
     */
    public function setArticleId($articleId)
    {
        return $this->setData(self::ARTICLE_ID, $articleId);
    }

    /**
     * Get title
     * @return string|null
     */
    public function getTitle()
    {
        return $this->_get(self::TITLE);
    }

    /**
     * Set title
     * @param string $title
     * @return \Ino\Blog\Api\Data\ArticleInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Ino\Blog\Api\Data\ArticleExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Ino\Blog\Api\Data\ArticleExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Ino\Blog\Api\Data\ArticleExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get small_description
     * @return string|null
     */
    public function getSmallDescription()
    {
        return $this->_get(self::SMALL_DESCRIPTION);
    }

    /**
     * Set small_description
     * @param string $smallDescription
     * @return \Ino\Blog\Api\Data\ArticleInterface
     */
    public function setSmallDescription($smallDescription)
    {
        return $this->setData(self::SMALL_DESCRIPTION, $smallDescription);
    }

    /**
     * Get description
     * @return string|null
     */
    public function getDescription()
    {
        return $this->_get(self::DESCRIPTION);
    }

    /**
     * Set description
     * @param string $description
     * @return \Ino\Blog\Api\Data\ArticleInterface
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }
}

