<?php

namespace Stef\RssReaderBundle\Reader;

class AbstractXmlReader
{
    protected $link;

    /**
     * @var \SimpleXMLElement
     */
    protected $simpleXMLElement;


    public function __construct($link, $init = true)
    {
        $this->link = $link;

        if ($init === true) {
            $this->init();
        }
    }

    public function init()
    {
        $this->simpleXMLElement = simplexml_load_file($this->link);
    }
}