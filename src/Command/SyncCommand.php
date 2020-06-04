<?php

declare(strict_types=1);

/*
 * This file is part of the Contao YouTube Sync extension.
 *
 * (c) inspiredminds
 *
 * @license proprietary
 */

namespace InspiredMinds\ContaoYouTubeSync\Command;

use InspiredMinds\ContaoYouTubeSync\Sync\NewsYouTubeSync;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncCommand extends Command
{
    private $newsSync;

    public function __construct(NewsYouTubeSync $newsSync)
    {
        parent::__construct();
        $this->newsSync = $newsSync;
    }

    protected function configure(): void
    {
        $this->setDescription('Synchronises all configured news archives with YouTube.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        ($this->newsSync)();
    }
}