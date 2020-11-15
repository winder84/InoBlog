<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Ino\Blog\Model;

use Ino\Blog\Api\Data\ArticleInterface;
use Ino\Blog\Api\Data\ArticleInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Article extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $_eventPrefix = 'ino_blog_article';
    protected $articleDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ArticleInterfaceFactory $articleDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Ino\Blog\Model\ResourceModel\Article $resource
     * @param \Ino\Blog\Model\ResourceModel\Article\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ArticleInterfaceFactory $articleDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Ino\Blog\Model\ResourceModel\Article $resource,
        \Ino\Blog\Model\ResourceModel\Article\Collection $resourceCollection,
        array $data = []
    ) {
        $this->articleDataFactory = $articleDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve article model with article data
     * @return ArticleInterface
     */
    public function getDataModel()
    {
        $articleData = $this->getData();
        
        $articleDataObject = $this->articleDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $articleDataObject,
            $articleData,
            ArticleInterface::class
        );
        
        return $articleDataObject;
    }
}

