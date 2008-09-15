({php}) header('Content-type: text/xml');({/php})
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">
<!-- Created by OpenDiary 0.0.1 -->
<url>
<loc>({$smarty.const.OPENPNE_URL})</loc>
<lastmod>({$date|date_format:"%Y-%m-%dT%H:%M:%S+09:00"})</lastmod>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
<url>
<loc>({$smarty.const.OPENPNE_URL})?m=diary&amp;a=page_home</loc>
<lastmod>({$date|date_format:"%Y-%m-%dT%H:%M:%S+09:00"})</lastmod>
<changefreq>daily</changefreq>
<priority>0.8</priority>
</url>
({foreach from=$date_list item=date})
<url>
<loc>({$smarty.const.OPENPNE_URL})?m=diary&amp;a=page_home&amp;year=({$date.year})&amp;month=({$date.month})</loc>
<lastmod>({$r_datetime|date_format:"%Y-%m-%dT%H:%M:%S+09:00"})</lastmod>
<changefreq>daily</changefreq>
<priority>0.5</priority>
</url>
({foreach from=$date.calendar.days item=week})
({foreach from=$week item=calendar})
({if $calendar.is_diary})
<url>
<loc>({$smarty.const.OPENPNE_URL})?m=diary&amp;a=page_home&amp;year=({$date.year})&amp;month=({$date.month})&amp;day=({$calendar.day})</loc>
<lastmod>({$r_datetime|date_format:"%Y-%m-%dT%H:%M:%S+09:00"})</lastmod>
<changefreq>daily</changefreq>
<priority>0.5</priority>
</url>
({/if})
({/foreach})
({/foreach})
({/foreach})
({foreach from=$c_member_list item=item})
<url>
<loc>({$smarty.const.OPENPNE_URL})?m=diary&amp;a=page_list&amp;target_c_member_id=({$item.c_member_id})</loc>
<lastmod>({$r_datetime|date_format:"%Y-%m-%dT%H:%M:%S+09:00"})</lastmod>
<changefreq>daily</changefreq>
<priority>0.5</priority>
</url>
({foreach from=$item.date_list item=date})
<url>
<loc>({$smarty.const.OPENPNE_URL})?m=diary&amp;a=page_list&amp;target_c_member_id=({$item.c_member_id})&amp;year=({$date.year})&amp;month=({$date.month})</loc>
<lastmod>({$r_datetime|date_format:"%Y-%m-%dT%H:%M:%S+09:00"})</lastmod>
<changefreq>daily</changefreq>
<priority>0.5</priority>
</url>
({foreach from=$date.calendar.days item=week})
({foreach from=$week item=calendar})
({if $calendar.is_diary})
<url>
<loc>({$smarty.const.OPENPNE_URL})?m=diary&amp;a=page_list&amp;target_c_member_id=({$item.c_member_id})&amp;year=({$date.year})&amp;month=({$date.month})&amp;day=({$calendar.day})</loc>
<lastmod>({$r_datetime|date_format:"%Y-%m-%dT%H:%M:%S+09:00"})</lastmod>
<changefreq>daily</changefreq>
<priority>0.5</priority>
</url>
({/if})
({/foreach})
({/foreach})
({/foreach})
({/foreach})
({foreach from=$c_diary_list item=item})
<url>
<loc>({$smarty.const.OPENPNE_URL})?m=diary&amp;a=page_detail&amp;target_c_diary_id=({$item.c_diary_id})</loc>
<lastmod>({$item.r_datetime|date_format:"%Y-%m-%dT%H:%M:%S+09:00"})</lastmod>
<changefreq>daily</changefreq>
<priority>0.5</priority>
</url>
({/foreach})
</urlset>
