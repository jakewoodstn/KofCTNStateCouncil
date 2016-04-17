<?php return array (
  '29465a8d291945d3a870ee6ac1f3d4ba' => 
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
  'b1036e261f88b4cd42b9340df274a0e7' => 
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
      'editedon' => '2014-09-01 11:18:23',
    ),
  ),
  '4030cddd7b9e6294899e957183de3442' => 
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
  '3037725487e8d7b78c86ebb00815b058' => 
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
  'b4ae0031728c4ba67fdb1fac1ea35f56' => 
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
  '438ecf30128282509fcfb20faae69c2c' => 
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
  '6aa775fdb0d1b80896afe541fe285932' => 
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
  'c4be8bf891d64e5873be6da42a310eee' => 
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
  'fadb77b5fb646df19d7ca3495f62833f' => 
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
  'ae8f0012efa79fbc0895e16467872c65' => 
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
  'e71afe178f493212eef11a380b44e83b' => 
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
  '4b590ffe614fcf632db3a4e5196fc05f' => 
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
  '05ae3ff4526dcc2c799f397786307d33' => 
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
  'a680fc8251b3ddc86c1bff36519b6914' => 
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
  ),
  'faee43cf72b2e8a9090ec06b9cead34f' => 
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
  '4a4ddc80a523949b952093c6394f0dfb' => 
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
  '677b41ab00d33bb56e6e787b5b3f77e3' => 
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
  '4d915c884198fe6887456578e51f992a' => 
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
  'df0b574d95ba4a99fa0d60e2ab5c92ca' => 
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
  '036812e41e39c3c8036894e9fe703428' => 
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
  '203961a28c14005950fd6eb694d371f0' => 
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
  '15198fa55a4d290ad1eb7efaed7b5a5c' => 
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
  '6df403df854f59fabad16ec173f7e68a' => 
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
  '2ca8a521df750f79b8ad90996158415c' => 
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
  '87607eb2decbb5e3bd5f884834f551e5' => 
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