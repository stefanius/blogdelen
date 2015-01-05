<?php

namespace Stef\RssReaderBundle\Manager;

use Doctrine\Entity;
use Stef\RssReaderBundle\Entity\Item;
use Symfony\Component\HttpFoundation\ParameterBag;

class ItemManager extends AbstractObjectManager
{
    /**
     * Create and return an Enity
     *
     * @param ParameterBag $data
     *
     * @return Entity
     */
    public function create(ParameterBag $data)
    {
        $item = new Item();
        $item->setTitle($data->get('title'));
        $item->setDescription($data->get('description'));
        $item->setGuid($data->get('guid'));
        $item->setLink($data->get('link'));
        $item->setPubDate(new \DateTime($data->get('pubDate')));

        return $item;
    }

    public function persist($entity)
    {
        if ($this->findByLink($entity->getLink() === null)) {
            parent::persist($entity);
        }
    }

    public function findByLink($link)
    {
        return $this->om->getRepository('StefRssReaderBundle:Item')->findOneByLink($link);
    }
}