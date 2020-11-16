<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Ino\Blog\Block;

use Ino\Blog\Model\ArticleFactory;
use Magento\Framework\View\Element\Template;

class ArticleList extends Template
{
    const URL_PATH_VIEW = 'articles';

    protected $articleFactory;

    /**
     * Constructor
     *
     * @param Template\Context $context
     * @param ArticleFactory $articleFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        ArticleFactory $articleFactory,
        array $data = []
    ) {
        $this->articleFactory = $articleFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function displayArticles()
    {
        $page = 'list';
        $articleModel = $this->articleFactory->create();
        $articleId = $this->_request->getParam('article_id');
        $articles = [];
        if ($articleId) {
            $collection = [$articleModel->load($articleId)];
            $page = 'article';
        } else {
            $collection = $articleModel->getCollection();
        }
        foreach ($collection as $item) {
            $articles[] = [
                'title' => $item->getTitle(),
                'smallDescription' => $item->getSmallDescription(),
                'description' => $item->getDescription(),
                'href' => $this->getUrl(self::URL_PATH_VIEW, ['article_id' => $item->getId()]),
            ];
        }

        return ['page' => $page, 'articles' => $articles];
    }
}
