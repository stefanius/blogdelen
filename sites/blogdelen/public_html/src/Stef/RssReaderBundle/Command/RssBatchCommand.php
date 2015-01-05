<?php

namespace Stef\RssReaderBundle\Command;

use Stef\RssReaderBundle\Manager\ItemManager;
use Stef\RssReaderBundle\BatchCreator\ItemCreator;
use Stef\RssReaderBundle\Reader\RssReader;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RssBatchCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('stef:rss:batch')
            ->setDescription('Run RSS batch')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doctrine = $this->getContainer()->get('doctrine.orm.entity_manager');
        $itemManager = new ItemManager($doctrine);

        $repo = $doctrine->getRepository('StefRssReaderBundle:Feed');

        $feeds = $repo->findAll();

        foreach ($feeds as $feed) {
            $rss = new RssReader($feed->getLink());

            $batch = new ItemCreator($itemManager, $rss);

            $batch->batchProcess();
        }
    }
}
