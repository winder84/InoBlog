<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Ino\Blog\Model;

use Ino\Blog\Api\ArticleRepositoryInterface;
use Ino\Blog\Api\Data\ArticleInterfaceFactory;
use Ino\Blog\Api\Data\ArticleSearchResultsInterfaceFactory;
use Ino\Blog\Model\ResourceModel\Article as ResourceArticle;
use Ino\Blog\Model\ResourceModel\Article\CollectionFactory as ArticleCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class ArticleRepository implements ArticleRepositoryInterface
{

    protected $dataObjectProcessor;

    protected $resource;

    protected $extensionAttributesJoinProcessor;

    protected $articleCollectionFactory;

    protected $articleFactory;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;
    protected $dataArticleFactory;

    private $storeManager;

    protected $searchResultsFactory;

    protected $dataObjectHelper;


    /**
     * @param ResourceArticle $resource
     * @param ArticleFactory $articleFactory
     * @param ArticleInterfaceFactory $dataArticleFactory
     * @param ArticleCollectionFactory $articleCollectionFactory
     * @param ArticleSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceArticle $resource,
        ArticleFactory $articleFactory,
        ArticleInterfaceFactory $dataArticleFactory,
        ArticleCollectionFactory $articleCollectionFactory,
        ArticleSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->articleFactory = $articleFactory;
        $this->articleCollectionFactory = $articleCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataArticleFactory = $dataArticleFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Ino\Blog\Api\Data\ArticleInterface $article
    ) {
        /* if (empty($article->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $article->setStoreId($storeId);
        } */
        
        $articleData = $this->extensibleDataObjectConverter->toNestedArray(
            $article,
            [],
            \Ino\Blog\Api\Data\ArticleInterface::class
        );
        
        $articleModel = $this->articleFactory->create()->setData($articleData);
        
        try {
            $this->resource->save($articleModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the article: %1',
                $exception->getMessage()
            ));
        }
        return $articleModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($articleId)
    {
        $article = $this->articleFactory->create();
        $this->resource->load($article, $articleId);
        if (!$article->getId()) {
            throw new NoSuchEntityException(__('Article with id "%1" does not exist.', $articleId));
        }
        return $article->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->articleCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Ino\Blog\Api\Data\ArticleInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Ino\Blog\Api\Data\ArticleInterface $article
    ) {
        try {
            $articleModel = $this->articleFactory->create();
            $this->resource->load($articleModel, $article->getArticleId());
            $this->resource->delete($articleModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Article: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($articleId)
    {
        return $this->delete($this->get($articleId));
    }
}

