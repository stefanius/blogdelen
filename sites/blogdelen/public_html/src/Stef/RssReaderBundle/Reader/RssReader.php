<?php

namespace Stef\RssReaderBundle\Reader;

class RssReader extends AbstractXmlReader
{
    protected $items;

    protected $index = -1;

    public function init()
    {
        parent::init();

        $this->items = $this->simpleXMLElement->channel->item[1];
    }

    public function getItems()
    {
        return $this->items;
    }

    public function next()
    {
        $this->index++;

        return ($this->simpleXMLElement->channel->item[$this->index]);
    }

    public function prev()
    {
        $this->index--;

        return ($this->simpleXMLElement->channel->item[$this->index]);
    }

    public function getCurrent()
    {
        return $this->simpleXMLElement->channel->item[$this->index];
    }

    public function getCurrentTitle()
    {
        return $this->getCurrent()->title;
    }

    public function getCurrentDescription()
    {
        return $this->getCurrent()->description;
    }

    public function getCurrentPubDate()
    {
        return $this->getCurrent()->pubDate;
    }

    public function getCurrentLink()
    {
        return $this->getCurrent()->link;
    }

    public function getCurrentGuid()
    {
        return $this->getCurrent()->guid;
    }
}