<?php

namespace Stef\RssReaderBundle\BatchCreator;

use Stef\RssReaderBundle\Manager\ItemManager;
use Stef\RssReaderBundle\Reader\RssReader;
use Symfony\Component\HttpFoundation\ParameterBag;

class ItemCreator {

    /**
     * @var ItemManager
     */
    protected $itemManager;

    /**
     * @param ItemManager $itemManager
     * @param RssReader $rssReader
     */
    public function __construct(ItemManager $itemManager, RssReader $rssReader)
    {
        $this->itemManager = $itemManager;
        $this->rssReader = $rssReader;
    }

    public function batchProcess()
    {
        while ($this->rssReader->next()) {
            $data = new ParameterBag();
            $data->set('title', $this->rssReader->getCurrentTitle());
            $data->set('link', $this->rssReader->getCurrentLink());
            $data->set('guid', $this->rssReader->getCurrentGuid());
            $data->set('description', $this->rssReader->getCurrentDescription());
            $data->set('pubDate', $this->rssReader->getCurrentPubDate());

            $item = $this->itemManager->create($data);

            $this->itemManager->persist($item);
        }

        $this->itemManager->flush();
    }
}