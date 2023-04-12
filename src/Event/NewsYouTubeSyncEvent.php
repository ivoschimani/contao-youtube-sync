<?php

declare(strict_types=1);

/*
 * This file is part of the Contao YouTube Sync extension.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

namespace InspiredMinds\ContaoYouTubeSync\Event;

use Contao\NewsModel;
use Google\Service\YouTube\Video;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * This event is dispatched, whenever a YouTube video is imported as a news article.
 */
class NewsYouTubeSyncEvent extends Event
{
    /**
     * @var bool
     */
    private $discard = false;

    /**
     * @var NewsModel
     */
    private $news;

    /**
     * @var Video
     */
    private $video;

    public function __construct(NewsModel $news, Video $video)
    {
        $this->news = $news;
        $this->video = $video;
    }

    /**
     * Sets whether or not this news import should be discarded.
     */
    public function setDicard(bool $discard): self
    {
        $this->discard = $discard;

        return $this;
    }

    /**
     * Whether or not this news import should be discarded.
     */
    public function getDiscard(): bool
    {
        return $this->discard;
    }

    /**
     * The news item to be saved to the database.
     */
    public function getNews(): NewsModel
    {
        return $this->news;
    }

    /**
     * The YouTube video instance.
     */
    public function getVideo(): Video
    {
        return $this->video;
    }
}
