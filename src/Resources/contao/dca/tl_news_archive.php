<?php

declare(strict_types=1);

/*
 * This file is part of the Contao YouTube Sync extension.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

use Contao\ArrayUtil;
use Contao\CoreBundle\DataContainer\PaletteManipulator;
use InspiredMinds\ContaoYouTubeSync\Action\SyncAction;

$globalOperation = [
    'youtube_sync_trigger' => [
        'route' => SyncAction::class,
        'icon' => 'bundles/contaoyoutubesync/youtube.svg',
    ],
];

if (class_exists(ArrayUtil::class)) {
    ArrayUtil::arrayInsert($GLOBALS['TL_DCA']['tl_news_archive']['list']['global_operations'], 1, $globalOperation);
} else {
    array_insert($GLOBALS['TL_DCA']['tl_news_archive']['list']['global_operations'], 1, $globalOperation);
}

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['enable_youtube_sync'] = [
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => ['submitOnChange' => true],
    'sql' => ['type' => 'boolean', 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['enable_youtube_sync_channel'] = [
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => ['submitOnChange' => true],
    'sql' => ['type' => 'boolean', 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['enable_youtube_sync_playlist'] = [
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => ['submitOnChange' => true],
    'sql' => ['type' => 'boolean', 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['youtube_channel_id'] = [
    'inputType' => 'text',
    'exclude' => true,
    'eval' => ['maxlength' => 64, 'tl_class' => 'w50', 'mandatory' => true],
    'sql' => ['type' => 'string', 'length' => 64, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['youtube_playlist_id'] = [
    'inputType' => 'text',
    'exclude' => true,
    'eval' => ['maxlength' => 64, 'tl_class' => 'w50', 'mandatory' => true],
    'sql' => ['type' => 'string', 'length' => 64, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['youtube_sync_author'] = [
    'exclude' => true,
    'inputType' => 'select',
    'foreignKey' => 'tl_user.name',
    'eval' => ['chosen' => true, 'mandatory' => true, 'includeBlankOption' => true, 'tl_class' => 'w50'],
    'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
    'relation' => ['type' => 'hasOne', 'load' => 'lazy'],
];

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['youtube_sync_publish'] = [
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => ['tl_class' => 'clr w50'],
    'sql' => ['type' => 'boolean', 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['youtube_sync_update'] = [
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => ['tl_class' => 'w50'],
    'sql' => ['type' => 'boolean', 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['youtube_sync_dir'] = [
    'exclude' => true,
    'inputType' => 'fileTree',
    'eval' => ['tl_class' => 'clr', 'mandatory' => true, 'fieldType' => 'radio'],
    'sql' => ['type' => 'binary', 'length' => 16, 'notnull' => false],
];

PaletteManipulator::create()
    ->addLegend('youtube_sync_legend', null)
    ->addField('enable_youtube_sync', 'youtube_sync_legend')
    ->applyToPalette('default', 'tl_news_archive');

$GLOBALS['TL_DCA']['tl_news_archive']['palettes']['__selector__'][] = 'enable_youtube_sync';
$GLOBALS['TL_DCA']['tl_news_archive']['palettes']['__selector__'][] = 'enable_youtube_sync_playlist';
$GLOBALS['TL_DCA']['tl_news_archive']['palettes']['__selector__'][] = 'enable_youtube_sync_channel';
$GLOBALS['TL_DCA']['tl_news_archive']['subpalettes']['enable_youtube_sync'] = 'enable_youtube_sync_channel,enable_youtube_sync_playlist,youtube_sync_author,youtube_sync_publish,youtube_sync_update,youtube_sync_dir';
$GLOBALS['TL_DCA']['tl_news_archive']['subpalettes']['enable_youtube_sync_playlist'] = 'youtube_playlist_id';
$GLOBALS['TL_DCA']['tl_news_archive']['subpalettes']['enable_youtube_sync_channel'] = 'youtube_channel_id';
