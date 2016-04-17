<?php return array (
  'c836f0b0023c5f9c348a011d9967c64a' => 
  array (
    'criteria' => 
    array (
      'name' => 'articles',
    ),
    'object' => 
    array (
      'name' => 'articles',
      'path' => '{core_path}components/articles/',
      'assets_path' => '{assets_path}components/articles/',
    ),
  ),
  'ea670394dd2321b2b68d8f57f8689559' => 
  array (
    'criteria' => 
    array (
      'key' => 'articles.container_ids',
    ),
    'object' => 
    array (
      'key' => 'articles.container_ids',
      'value' => ',10:arc_,12:arc_,35:arc_',
      'xtype' => 'textfield',
      'namespace' => 'articles',
      'area' => 'furls',
      'editedon' => '2014-09-01 17:18:23',
    ),
  ),
  'f7e46dfd145fd1d702ea5b7ed426bec8' => 
  array (
    'criteria' => 
    array (
      'key' => 'articles.default_container_template',
    ),
    'object' => 
    array (
      'key' => 'articles.default_container_template',
      'value' => '0',
      'xtype' => 'modx-combo-template',
      'namespace' => 'articles',
      'area' => 'site',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '0c56c3e23b07e356eb0c7b678db28ac6' => 
  array (
    'criteria' => 
    array (
      'key' => 'articles.default_article_template',
    ),
    'object' => 
    array (
      'key' => 'articles.default_article_template',
      'value' => '0',
      'xtype' => 'modx-combo-template',
      'namespace' => 'articles',
      'area' => 'site',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '7207aa671f2373a1452a57dd9f486ef5' => 
  array (
    'criteria' => 
    array (
      'key' => 'articles.default_article_sort_field',
    ),
    'object' => 
    array (
      'key' => 'articles.default_article_sort_field',
      'value' => 'createdon',
      'xtype' => 'textfield',
      'namespace' => 'articles',
      'area' => 'site',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'bad655508acfc563d4c864466ddd19ff' => 
  array (
    'criteria' => 
    array (
      'key' => 'articles.article_show_longtitle',
    ),
    'object' => 
    array (
      'key' => 'articles.article_show_longtitle',
      'value' => '',
      'xtype' => 'combo-boolean',
      'namespace' => 'articles',
      'area' => 'site',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '4c4db479ba699b287c35e753457898b6' => 
  array (
    'criteria' => 
    array (
      'key' => 'articles.mgr_date_format',
    ),
    'object' => 
    array (
      'key' => 'articles.mgr_date_format',
      'value' => '%b %d',
      'xtype' => 'textfield',
      'namespace' => 'articles',
      'area' => 'site',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '2dabe9fa0e45c19f390b0a428bd04077' => 
  array (
    'criteria' => 
    array (
      'key' => 'articles.mgr_time_format',
    ),
    'object' => 
    array (
      'key' => 'articles.mgr_time_format',
      'value' => '%H:%I %p',
      'xtype' => 'textfield',
      'namespace' => 'articles',
      'area' => 'site',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '7addb4333e4c200327aa8382b26cede3' => 
  array (
    'criteria' => 
    array (
      'name' => 'ArticlesPlugin',
    ),
    'object' => 
    array (
      'id' => 4,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ArticlesPlugin',
      'description' => 'Handles FURLs for Articles.',
      'editor_type' => 0,
      'category' => 0,
      'cache_type' => 0,
      'plugincode' => '/**
 * Articles
 *
 * Copyright 2011-12 by Shaun McCormick <shaun+articles@modx.com>
 *
 * Articles is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Articles is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Articles; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package articles
 */
/**
 * @var modX $modx
 * @var array $scriptProperties
 */
switch ($modx->event->name) {
    case \'OnManagerPageInit\':
        $cssFile = $modx->getOption(\'articles.assets_url\',null,$modx->getOption(\'assets_url\').\'components/articles/\').\'css/mgr.css\';
        $modx->regClientCSS($cssFile);
        break;
    case \'OnPageNotFound\':
        $corePath = $modx->getOption(\'articles.core_path\',null,$modx->getOption(\'core_path\').\'components/articles/\');
        require_once $corePath.\'model/articles/articlesrouter.class.php\';
        $router = new ArticlesRouter($modx);
        $router->route();
        return;
    case \'OnDocPublished\':
        /** @var Article $resource */
        $resource =& $scriptProperties[\'resource\'];
        if ($resource instanceof Article) {
            $resource->setArchiveUri();
            $resource->save();
            $modx->cacheManager->refresh(array(
                \'db\' => array(),
                \'auto_publish\' => array(\'contexts\' => array($resource->get(\'context_key\'))),
                \'context_settings\' => array(\'contexts\' => array($resource->get(\'context_key\'))),
                \'resource\' => array(\'contexts\' => array($resource->get(\'context_key\'))),
            ));
            $resource->notifyUpdateServices();
            $resource->sendNotifications();
        }
        break;
    case \'OnDocUnPublished\':
        $resource =& $scriptProperties[\'resource\'];
        break;

}
return;',
      'locked' => 0,
      'properties' => NULL,
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Articles
 *
 * Copyright 2011-12 by Shaun McCormick <shaun+articles@modx.com>
 *
 * Articles is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Articles is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Articles; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package articles
 */
/**
 * @var modX $modx
 * @var array $scriptProperties
 */
switch ($modx->event->name) {
    case \'OnManagerPageInit\':
        $cssFile = $modx->getOption(\'articles.assets_url\',null,$modx->getOption(\'assets_url\').\'components/articles/\').\'css/mgr.css\';
        $modx->regClientCSS($cssFile);
        break;
    case \'OnPageNotFound\':
        $corePath = $modx->getOption(\'articles.core_path\',null,$modx->getOption(\'core_path\').\'components/articles/\');
        require_once $corePath.\'model/articles/articlesrouter.class.php\';
        $router = new ArticlesRouter($modx);
        $router->route();
        return;
    case \'OnDocPublished\':
        /** @var Article $resource */
        $resource =& $scriptProperties[\'resource\'];
        if ($resource instanceof Article) {
            $resource->setArchiveUri();
            $resource->save();
            $modx->cacheManager->refresh(array(
                \'db\' => array(),
                \'auto_publish\' => array(\'contexts\' => array($resource->get(\'context_key\'))),
                \'context_settings\' => array(\'contexts\' => array($resource->get(\'context_key\'))),
                \'resource\' => array(\'contexts\' => array($resource->get(\'context_key\'))),
            ));
            $resource->notifyUpdateServices();
            $resource->sendNotifications();
        }
        break;
    case \'OnDocUnPublished\':
        $resource =& $scriptProperties[\'resource\'];
        break;

}
return;',
    ),
  ),
  'ef70fe14622807fd63dfc7f2308ca4a3' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnPageNotFound',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnPageNotFound',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '536e5046b2be746da64b92e7cf688557' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnManagerPageInit',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnManagerPageInit',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'f2f699fddf7c3d9b66ca5bb71ac65532' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnDocPublished',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnDocPublished',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '6be066a9c25d997bd29869735df31276' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnDocUnPublished',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnDocUnPublished',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '25cac3fb5d8064fca938eba263a517bc' => 
  array (
    'criteria' => 
    array (
      'category' => 'Articles',
    ),
    'object' => 
    array (
      'id' => 10,
      'parent' => 0,
      'category' => 'Articles',
    ),
    'files' => 
    array (
      0 => '/var/kcwww/assets/components',
    ),
  ),
  '1b4ecc0a7bc1825181acdc52a6d5b833' => 
  array (
    'criteria' => 
    array (
      'name' => 'sample.ArticlesLatestPostTpl',
    ),
    'object' => 
    array (
      'id' => 47,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'sample.ArticlesLatestPostTpl',
      'description' => 'The tpl row for the latest post. Duplicate this to override it.',
      'editor_type' => 0,
      'category' => 10,
      'cache_type' => 0,
      'snippet' => '<li>
  <a href="[[~[[+id]]]]">[[+pagetitle]]</a>
  [[+publishedon:notempty=`<br /> - [[+publishedon:strtotime:date=`%b %d, %Y`]]`]]
</li>',
      'locked' => 0,
      'properties' => NULL,
      'static' => 0,
      'static_file' => '',
      'content' => '<li>
  <a href="[[~[[+id]]]]">[[+pagetitle]]</a>
  [[+publishedon:notempty=`<br /> - [[+publishedon:strtotime:date=`%b %d, %Y`]]`]]
</li>',
    ),
  ),
  'c9f144096911ff97d2feaa4b02677ec3' => 
  array (
    'criteria' => 
    array (
      'name' => 'sample.ArticleRowTpl',
    ),
    'object' => 
    array (
      'id' => 48,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'sample.ArticleRowTpl',
      'description' => 'The tpl row for each post when listed on the main Articles Container page. Duplicate this to override it.',
      'editor_type' => 0,
      'category' => 10,
      'cache_type' => 0,
      'snippet' => '<div class="post">
    <h2 class="title"><a href="[[~[[+id]]]]">[[+pagetitle]]</a></h2>
    <p class="post-info">[[%articles.posted_by]] <a href="[[~[[*id]]]]author/[[+createdby:userinfo=`username`]]">[[+createdby:userinfo=`username`]]</a> [[+tv.articlestags:notempty=` | <span class="tags">[[%articles.tags]]: [[!tolinks? &items=`[[+tv.articlestags]]` &target=`[[*id]]` &useTagsFurl=`1`]]</span>`]]</p>
    <div class="entry">
	    <p>[[+introtext:default=`[[+content:ellipsis=`400`]]`]]</p>
    </div>
    <p class="postmeta">
      <span class="links">
        <a href="[[~[[+id]]]]" class="readmore">[[%articles.read_more]]</a>
        [[+comments_enabled:is=`1`:then=`| <a href="[[~[[+id]]]]#comments" class="comments">[[%articles.comments]] ([[!QuipCount? &thread=`article-b[[+parent]]-[[+id]]`]])</a>`]]
        | <span class="date">[[+publishedon:strtotime:date=`%b %d, %Y`]]</span>
      </span>
    </p>
</div>',
      'locked' => 0,
      'properties' => NULL,
      'static' => 0,
      'static_file' => '',
      'content' => '<div class="post">
    <h2 class="title"><a href="[[~[[+id]]]]">[[+pagetitle]]</a></h2>
    <p class="post-info">[[%articles.posted_by]] <a href="[[~[[*id]]]]author/[[+createdby:userinfo=`username`]]">[[+createdby:userinfo=`username`]]</a> [[+tv.articlestags:notempty=` | <span class="tags">[[%articles.tags]]: [[!tolinks? &items=`[[+tv.articlestags]]` &target=`[[*id]]` &useTagsFurl=`1`]]</span>`]]</p>
    <div class="entry">
	    <p>[[+introtext:default=`[[+content:ellipsis=`400`]]`]]</p>
    </div>
    <p class="postmeta">
      <span class="links">
        <a href="[[~[[+id]]]]" class="readmore">[[%articles.read_more]]</a>
        [[+comments_enabled:is=`1`:then=`| <a href="[[~[[+id]]]]#comments" class="comments">[[%articles.comments]] ([[!QuipCount? &thread=`article-b[[+parent]]-[[+id]]`]])</a>`]]
        | <span class="date">[[+publishedon:strtotime:date=`%b %d, %Y`]]</span>
      </span>
    </p>
</div>',
    ),
  ),
  'a0e6e44ffe46a2d8336e0f771a8e400f' => 
  array (
    'criteria' => 
    array (
      'name' => 'sample.ArticlesRss',
    ),
    'object' => 
    array (
      'id' => 49,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'sample.ArticlesRss',
      'description' => 'The tpl for the RSS feed. Duplicate this to override it.',
      'editor_type' => 0,
      'category' => 10,
      'cache_type' => 0,
      'snippet' => '<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xml:lang="en-US">
<channel>
  <title>[[++site_name]]</title>
  <link>[[~[[*id]]?scheme=`full`]]</link>
  <description>[[*description:cdata]]</description>
  <language>en</language>
  <copyright>Copyright [[+year]] by [[++site_admin]]. All Rights Reserved.</copyright>
  <ttl>120</ttl>
  [[+content]]
</channel>
</rss>',
      'locked' => 0,
      'properties' => NULL,
      'static' => 0,
      'static_file' => '',
      'content' => '<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xml:lang="en-US">
<channel>
  <title>[[++site_name]]</title>
  <link>[[~[[*id]]?scheme=`full`]]</link>
  <description>[[*description:cdata]]</description>
  <language>en</language>
  <copyright>Copyright [[+year]] by [[++site_admin]]. All Rights Reserved.</copyright>
  <ttl>120</ttl>
  [[+content]]
</channel>
</rss>',
    ),
  ),
  '160ddd2c15863b68fdf036751dce3357' => 
  array (
    'criteria' => 
    array (
      'name' => 'sample.ArticlesRssItem',
    ),
    'object' => 
    array (
      'id' => 50,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'sample.ArticlesRssItem',
      'description' => 'The tpl row for each RSS feed item. Duplicate this to override it.',
      'editor_type' => 0,
      'category' => 10,
      'cache_type' => 0,
      'snippet' => '<item>
    <title>[[+pagetitle]]</title>
    <link>[[~[[+id]]?scheme=`full`]]</link>
    <description>[[+introtext:default=`[[+content:ellipsis=`400`]]`:cdata]]</description>
    <pubDate>[[+publishedon:strtotime:date=`%a, %d %b %Y %H:%M:%S %z`]]</pubDate>
    <guid>[[~[[+id]]?scheme=`full`]]</guid>
    <author>[[+createdby:userinfo=`email`]] ([[+createdby:userinfo=`fullname`]])</author>
    [[!ArticlesStringSplitter? &string=`[[+tv.articlestags]]` &tpl=`sample.ArticlesRssCategoryNode`]]
</item>
',
      'locked' => 0,
      'properties' => NULL,
      'static' => 0,
      'static_file' => '',
      'content' => '<item>
    <title>[[+pagetitle]]</title>
    <link>[[~[[+id]]?scheme=`full`]]</link>
    <description>[[+introtext:default=`[[+content:ellipsis=`400`]]`:cdata]]</description>
    <pubDate>[[+publishedon:strtotime:date=`%a, %d %b %Y %H:%M:%S %z`]]</pubDate>
    <guid>[[~[[+id]]?scheme=`full`]]</guid>
    <author>[[+createdby:userinfo=`email`]] ([[+createdby:userinfo=`fullname`]])</author>
    [[!ArticlesStringSplitter? &string=`[[+tv.articlestags]]` &tpl=`sample.ArticlesRssCategoryNode`]]
</item>
',
    ),
  ),
  '77ef4fb1282de9d155569b2ed2f16756' => 
  array (
    'criteria' => 
    array (
      'name' => 'sample.ArchiveGroupByYear',
    ),
    'object' => 
    array (
      'id' => 51,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'sample.ArchiveGroupByYear',
      'description' => 'The tpl wrapper for archives when grouped by year.',
      'editor_type' => 0,
      'category' => 10,
      'cache_type' => 0,
      'snippet' => '<ul>
    <li><a href="[[+url]]">[[+year]]</a>
    <ul>
        [[+row]]
    </ul>
    </li>
</ul>',
      'locked' => 0,
      'properties' => NULL,
      'static' => 0,
      'static_file' => '',
      'content' => '<ul>
    <li><a href="[[+url]]">[[+year]]</a>
    <ul>
        [[+row]]
    </ul>
    </li>
</ul>',
    ),
  ),
  'f8eb50543fe99b94691c659eb943d6b9' => 
  array (
    'criteria' => 
    array (
      'name' => 'sample.ArticlesRssCategoryNode',
    ),
    'object' => 
    array (
      'id' => 52,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'sample.ArticlesRssCategoryNode',
      'description' => 'The tpl for each RSS category node for tagging.',
      'editor_type' => 0,
      'category' => 10,
      'cache_type' => 0,
      'snippet' => '<category>[[+item]]</category>',
      'locked' => 0,
      'properties' => NULL,
      'static' => 0,
      'static_file' => '',
      'content' => '<category>[[+item]]</category>',
    ),
  ),
  '3ee2f85f32899c4c9b2cf54bf8ab806a' => 
  array (
    'criteria' => 
    array (
      'name' => 'ArticlesStringSplitter',
    ),
    'object' => 
    array (
      'id' => 30,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ArticlesStringSplitter',
      'description' => 'Utility snippet for Articles; splits strings by a delimiter and chunkifys the result.',
      'editor_type' => 0,
      'category' => 10,
      'cache_type' => 0,
      'snippet' => '/**
 * Articles
 *
 * Copyright 2011-12 by Shaun McCormick <shaun+articles@modx.com>
 *
 * Articles is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Articles is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Articles; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package articles
 */
/**
 * @var modX $modx
 * @var array $scriptProperties
 */
$string = $modx->getOption(\'string\',$scriptProperties,\'\');
$delimiter = $modx->getOption(\'delimiter\',$scriptProperties,\',\');
$tpl = $modx->getOption(\'tpl\',$scriptProperties,\'articlerssitem\');
$outputSeparator = $modx->getOption(\'outputSeparator\',$scriptProperties,"\\n");
$outputSeparator = str_replace(\'\\\\n\',"\\n",$outputSeparator);
$toPlaceholder = $modx->getOption(\'toPlaceholder\',$scriptProperties,\'\');

$items = explode($delimiter,$string);
$items = array_unique($items);
$list = array();
foreach ($items as $item) {
    $list[] = $modx->getChunk($tpl,array(
        \'item\' => $item,
    ));
}

$output = implode($outputSeparator,$list);
if (!empty($toPlaceholder)) {
    $modx->setPlaceholder($toPlaceholder,$output);
    return \'\';
}
return $output;',
      'locked' => 0,
      'properties' => NULL,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Articles
 *
 * Copyright 2011-12 by Shaun McCormick <shaun+articles@modx.com>
 *
 * Articles is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Articles is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Articles; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package articles
 */
/**
 * @var modX $modx
 * @var array $scriptProperties
 */
$string = $modx->getOption(\'string\',$scriptProperties,\'\');
$delimiter = $modx->getOption(\'delimiter\',$scriptProperties,\',\');
$tpl = $modx->getOption(\'tpl\',$scriptProperties,\'articlerssitem\');
$outputSeparator = $modx->getOption(\'outputSeparator\',$scriptProperties,"\\n");
$outputSeparator = str_replace(\'\\\\n\',"\\n",$outputSeparator);
$toPlaceholder = $modx->getOption(\'toPlaceholder\',$scriptProperties,\'\');

$items = explode($delimiter,$string);
$items = array_unique($items);
$list = array();
foreach ($items as $item) {
    $list[] = $modx->getChunk($tpl,array(
        \'item\' => $item,
    ));
}

$output = implode($outputSeparator,$list);
if (!empty($toPlaceholder)) {
    $modx->setPlaceholder($toPlaceholder,$output);
    return \'\';
}
return $output;',
    ),
  ),
  'b5ad1944b3be2bf7ce10b7b343d0d6db' => 
  array (
    'criteria' => 
    array (
      'name' => 'Articles',
    ),
    'object' => 
    array (
      'id' => 31,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'Articles',
      'description' => 'Displays Articles for a Container anywhere on your MODX site.',
      'editor_type' => 0,
      'category' => 10,
      'cache_type' => 0,
      'snippet' => '/**
 * Articles
 *
 * Copyright 2011-12 by Shaun McCormick <shaun+articles@modx.com>
 *
 * Articles is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Articles is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Articles; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package articles
 */
/**
 * Displays a list of posts for a container
 *
 * @var modX $modx
 * @var array $scriptProperties
 *
 * @package articles
 */
$modx->lexicon->load(\'articles:frontend\');

$container = $modx->getOption(\'container\',$scriptProperties,0);
if (empty($container)) return \'\';
/** @var ArticlesContainer $container */
$container = $modx->getObject(\'ArticlesContainer\',$container);
if (empty($container)) return \'\';

$placeholderPrefix = $modx->getOption(\'placeholderPrefix\',$scriptProperties,\'\');

$container->getPostListingCall($placeholderPrefix);
$container->getArchivistCall($placeholderPrefix);
$container->getTagListerCall($placeholderPrefix);
$container->getLatestPostsCall($placeholderPrefix);
$settings = $container->getContainerSettings();
if ($modx->getOption(\'commentsEnabled\',$settings,true)) {
    $container->getLatestCommentsCall($placeholderPrefix);
    $modx->setPlaceholder($placeholderPrefix.\'comments_enabled\',1);
} else {
    $modx->setPlaceholder($placeholderPrefix.\'comments_enabled\',0);
}
return \'\';',
      'locked' => 0,
      'properties' => NULL,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Articles
 *
 * Copyright 2011-12 by Shaun McCormick <shaun+articles@modx.com>
 *
 * Articles is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Articles is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Articles; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package articles
 */
/**
 * Displays a list of posts for a container
 *
 * @var modX $modx
 * @var array $scriptProperties
 *
 * @package articles
 */
$modx->lexicon->load(\'articles:frontend\');

$container = $modx->getOption(\'container\',$scriptProperties,0);
if (empty($container)) return \'\';
/** @var ArticlesContainer $container */
$container = $modx->getObject(\'ArticlesContainer\',$container);
if (empty($container)) return \'\';

$placeholderPrefix = $modx->getOption(\'placeholderPrefix\',$scriptProperties,\'\');

$container->getPostListingCall($placeholderPrefix);
$container->getArchivistCall($placeholderPrefix);
$container->getTagListerCall($placeholderPrefix);
$container->getLatestPostsCall($placeholderPrefix);
$settings = $container->getContainerSettings();
if ($modx->getOption(\'commentsEnabled\',$settings,true)) {
    $container->getLatestCommentsCall($placeholderPrefix);
    $modx->setPlaceholder($placeholderPrefix.\'comments_enabled\',1);
} else {
    $modx->setPlaceholder($placeholderPrefix.\'comments_enabled\',0);
}
return \'\';',
    ),
  ),
  'ea53856a7faa8326773baea2301db307' => 
  array (
    'criteria' => 
    array (
      'templatename' => 'sample.ArticlesContainerTemplate',
    ),
    'object' => 
    array (
      'id' => 5,
      'source' => 0,
      'property_preprocess' => 0,
      'templatename' => 'sample.ArticlesContainerTemplate',
      'description' => 'The default Template for the Articles Container. Duplicate this to override it.',
      'editor_type' => 0,
      'category' => 10,
      'icon' => '',
      'template_type' => 0,
      'content' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Articles - [[*pagetitle]]</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="stylesheet" type="text/css" href="[[++articles.assets_url:default=`[[++base_url]]assets/components/articles/`]]themes/default/style.css" />
<base href="[[++site_url]]" />
</head>
<body>

<div id="header-wrap">
  <div id="header" class="container_16">
    <h1 id="logo-text"><a href="[[~[[*id]]]]" title="">Articles</a></h1>
    <p id="intro">Articles By Me</p>
    <!-- navigation -->
    <div id="nav">
      <ul><li class="first"><a href="[[~[[*id]]]]" title="Home" >Home</a></li></ul>
    </div>
    <div id="header-image"></div>
      <div id="search">

<form id="quick-search" action="search-results.html" method="get">
<p>
  <label for="qsearch">Search:</label>
  <input class="tbox" id="qsearch" type="text" name="search" value="" title="Start typing and hit ENTER" />
  <input class="btn" alt="Search" type="image" title="Search" src="[[++articles.assets_url:default=`assets/components/articles/`]]themes/default/images/search.gif" />
</p>
</form>
</div>
      
      <!-- header ends here -->
  </div>
</div>
<!-- content starts -->
<div id="content-outer"><div id="content-wrapper" class="container_16">

<!-- main -->
<div id="main" class="grid_12">
[[*content]]
</div>

<!-- main ends -->


<div id="left-columns" class="grid_4">
  <div class="grid_4 alpha">

<div class="sidemenu">
  <h3>Latest Posts</h3>
  <ul>
  [[+latest_posts]]
  </ul>
</div>

[[+comments_enabled:is=`1`:then=`
<div class="sidemenu">
  <h3>Latest Comments</h3>
  <ul>
  [[+latest_comments]]
  </ul>
</div>
`]]


  </div>
  <!-- end left-columns -->
</div>
<!-- contents end here -->

</div></div>

<!-- footer starts here -->
<div id="footer-wrapper" class="container_12">

  <div id="footer-content">
    <div class="grid_4">
<h3>Tags</h3>
[[+tags]]
    </div>
    <div class="grid_4">
  <h3>Archives</h3>
  [[+archives]]
    </div>
  </div>
  <div id="footer-bottom">
   <p class="bottom-left">
&nbsp; &copy; 2010-2012 Articles. all rights reserved.
      &nbsp; &nbsp; powered by <a href="http://modx.com/">modx revolution</a>
      &nbsp; &nbsp; <a href="http://www.bluewebtemplates.com/" title="Website Templates">website templates</a> by <a href="http://www.styleshout.com/">styleshout</a>
      </p>

      <p class="bottom-right" >
        <a href="[[~1]]">Home</a> |
        <a href="[[~1]]">Sitemap</a> |
        <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> |
             <a href="http://validator.w3.org/check/referer">XHTML</a>
      </p>

  </div>
</div>

</body>
</html>',
      'locked' => 0,
      'properties' => NULL,
      'static' => 0,
      'static_file' => '',
    ),
  ),
  '68e34b5e2961c27974a126d6aaaefd34' => 
  array (
    'criteria' => 
    array (
      'templatename' => 'sample.ArticleTemplate',
    ),
    'object' => 
    array (
      'id' => 6,
      'source' => 0,
      'property_preprocess' => 0,
      'templatename' => 'sample.ArticleTemplate',
      'description' => 'The default Template for an Article. Duplicate this to override it.',
      'editor_type' => 0,
      'category' => 10,
      'icon' => '',
      'template_type' => 0,
      'content' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Articles - [[*pagetitle]]</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="stylesheet" type="text/css" href="[[++articles.assets_url:default=`[[++base_url]]assets/components/articles/`]]themes/default/style.css" />
<base href="[[++site_url]]" />
</head>
<body>

<div id="header-wrap">
  <div id="header" class="container_16">
    <h1 id="logo-text"><a href="[[~[[*parent]]]]" title="">Articles</a></h1>
    <p id="intro">Articles By Me</p>
    <!-- navigation -->
    <div id="nav">
      <ul><li class="first"><a href="[[~[[*id]]]]" title="Home" >Home</a></li>
    </div>
    <div id="header-image"></div>
      <div id="search">

<form id="quick-search" action="search-results.html" method="get">
<p>
  <label for="qsearch">Search:</label>
  <input class="tbox" id="qsearch" type="text" name="search" value="" title="Start typing and hit ENTER" />
  <input class="btn" alt="Search" type="image" title="Search" src="[[++articles.assets_url:default=`assets/components/articles/`]]themes/default/images/search.gif" />
</p>
</form>
</div>
      <!-- header ends here -->
  </div>
</div>
<!-- content starts -->
<div id="content-outer"><div id="content-wrapper" class="container_16">

<!-- main -->
<div id="main" class="grid_12">
    <h2 class="title"><a href="[[~[[*id]]]]">[[*pagetitle]]</a></h2>
    <p class="post-info">
        <span class="left">Posted on [[*publishedon:strtotime:date=`%b %d, %Y`]] by <a href="[[~[[*parent]]]]author/[[*publishedby:userinfo=`username`]]">[[*publishedby:userinfo=`username`]]</a></span>
[[*articlestags:notempty=`
        <span class="tags left">&nbsp;| Tags: [[+article_tags]]</span>
`]]
        [[+comments_enabled:is=`1`:then=`&nbsp;| <a href="[[~[[*id]]]]#comments" class="comments">Comments ([[+comments_count]])</a>`]]
    </p>
    <div class="entry">
        <p>[[*introtext]]</p>
        <hr />
        [[*content]]
    </div>

    <hr />

    <div class="post-comments" id="comments">
        [[+comments]]
        <br />
        <h3>Add a Comment</h3>
        [[+comments_form]]
    </div>
</div>

<div id="left-columns" class="grid_4">
  <div class="grid_4 alpha">

    <div class="sidemenu">
      <h3>Latest Posts</h3>
      <ul>
      [[+latest_posts]]
      </ul>
    </div>

    [[+comments_enabled:is=`1`:then=`
    <div class="sidemenu">
      <h3>Latest Comments</h3>
      <ul>
      [[+latest_comments]]
      </ul>
    </div>
    `]]
  </div>
  <!-- end left-columns -->
</div>
<!-- contents end here -->


</div></div>

<!-- footer starts here -->
<div id="footer-wrapper" class="container_12">

  <div id="footer-content">
    <div class="grid_4">
<h3>Tags</h3>
[[+tags]]
    </div>
    <div class="grid_4">
  <h3>Archives</h3>
  [[+archives]]
    </div>
  </div>
  <div id="footer-bottom">
   <p class="bottom-left">
&nbsp; &copy; 2010-2012 Articles. all rights reserved.
      &nbsp; &nbsp; powered by <a href="http://modx.com/">modx revolution</a>
      &nbsp; &nbsp; <a href="http://www.bluewebtemplates.com/" title="Website Templates">website templates</a> by <a href="http://www.styleshout.com/">styleshout</a>
      </p>

      <p class="bottom-right" >
        <a href="[[~1]]">Home</a> |
        <a href="[[~1]]">Sitemap</a> |
        <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> |
             <a href="http://validator.w3.org/check/referer">XHTML</a>
      </p>

  </div>
</div>

</body>
</html>',
      'locked' => 0,
      'properties' => NULL,
      'static' => 0,
      'static_file' => '',
    ),
  ),
  '027c6e086876a489482be5bcfde00bb8' => 
  array (
    'criteria' => 
    array (
      'name' => 'articlestags',
    ),
    'object' => 
    array (
      'id' => 5,
      'source' => 0,
      'property_preprocess' => 0,
      'type' => 'hidden',
      'name' => 'articlestags',
      'caption' => 'articlestags',
      'description' => 'The default tags TV for Articles. Do not delete!',
      'editor_type' => 0,
      'category' => 10,
      'locked' => 0,
      'elements' => NULL,
      'rank' => 0,
      'display' => '',
      'default_text' => NULL,
      'properties' => NULL,
      'input_properties' => NULL,
      'output_properties' => NULL,
      'static' => 0,
      'static_file' => '',
      'content' => NULL,
    ),
  ),
);