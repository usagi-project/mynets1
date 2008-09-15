<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>UsagiProject MyNETS Original Tracker</title>
    <link href="import.css" rel="stylesheet" type="text/css" media="screen,projection" />
    <script type="text/javascript" src="tooltips.js"> </script>
    </head>
    <body>
    ({*ここからボディー*})
        <div id="wrap">
          <div id="head">
          ({header_box})
          </div>
          <div id="content">
            <div id="main-body">
              <div class="entry-box">
                <div class="entry-date"></div>
                <h2>({$target_diary.subject|t_body:'title'})</h2>
                <div class="entry-category">({$target_member.nickname|t_body:'name'})</span>({if $type == "f"})さん({/if})の日記</div>
                <div class="entry-body">
                <table>
                <tbody>
                    <tr>
                        <td style="width:120px;">日時</td>
                        <td>({$target_diary.r_datetime|date_format:"%Y年%m月%d日<br>%H:%M"})</td>
                    </tr>
                    <tr>
                        <td>本文</td><td>({$target_diary.body|t_body:'diary'|t_geocode})</td>
                    </tr>
                </tbody>
                </table>
                </div>
                <div class="link-more"><a href="#">修正する</a></div>
                <% if session.contents("login_user_id") = rs("entry_user_id") then %>
                <div class="link-more"><a href="#">削除する</a></div>
                <% end if %>
                </div>
            </div>
            <div id="side-menu">
              <div id="login-box">
              ({login_box})
              </div>
              <div id="category">
                ({category})
              </div>
              <div id="recent-entry">
                <h3>Recent Entry</h3>
                <ul class="link-list">
                  ({foreach from=$new_diary_list item=item})
                  <li><a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})" alt=""  onmouseout="hideTooltip()" onmouseover="showTooltip(event,'({$item.subject|t_body:'title'})');return false">({$item.subject|t_body:'title'})</a></li>
                  ({/foreach})
                </ul>
                ({recent_entry})
              </div>
              <div id="monthly">
                <h3>MONTHLY</h3> 
                <ul class="link-list">
                    ({foreach from=$date_list item=item})
                    <li><a href="({t_url m=pc a=page_fh_diary_list})&amp;target_c_member_id=({$target_member.c_member_id})&amp;year=({$item.year})&amp;month=({$item.month})">({$item.year})年({$item.month})月の一覧</a></li>
                    ({/foreach})
                </ul>
                ({monthry})
              </div>
              <div id="search-box">
                ({search_box})
              </div>
            </div>
          </div>
          <div id="foot">
            ({foot_menu})
            ({copy_right})
          </div>
        </div>
    ({*ここまでボディー*})
    </body>
    </html>
