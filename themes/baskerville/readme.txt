Copyright
--------------

Baskerville WordPress Theme, Copyright 2015 Anders Norén
Baskerville is distributed under the terms of the GNU GPL v2



Install Steps
--------------

1. Upload the theme
2. Activate the theme



Implement Like Functionality
--------------

1. Go to http://www.themezilla.com/plugins/zillalikes/ and download the plugin.
2. Upload the plugin to the /wp-content/plugins/ folder on your WordPress installation.
3. Go to Admin > Plugins > Installed Plugins.
4. Find "ZillaLikes" in the list and activate it.
5. Click ZillaLikes in the menu.
6. Check "I want to use my own CSS styles".
7. Click "Save Changes".



The Link Format
--------------

1. Create a new post.
2. Select "Link" in the Format window to the right.
3. In the post content, enter the title of your link within a paragraph element, and the link to the page in a link element.
4. Directly after the two elements, add the <!--more--> tag followed by the rest of the content. Example:

<p>[title]</p>
<a href="[url]">[website]</a>
<!--more-->
The rest of the content...

5. Publish.
6. The link title and link will now be displayed in a separate section from the content of your post.



The Quote Format
--------------

1. Create a new post.
2. Select "Quote" in the Format window to the right.
3. In the post content, enter the quote content within a blockquote element, and the quote attribution within a cite element.
4. Directly after the two elements, add the <!--more--> tag followed by the rest of the content. Example:

<blockquote>[quote content]
<cite>[quote attribution]</cite>
</blockquote>
<!--more-->
The rest of the content...

5. Publish.
6. The quote will now be displayed in a separate section from the content of your post.


The Video Format
--------------

1. Create a new post.
2. Select "Video" in the Format window to the right.
3. In the post content, enter the full url to the video you want to include.
4. Directly after the url, add the <!--more--> tag followed by the rest of the content. Example:

https://www.youtube.com/watch?v=iszwuX1AK6A
<!--more-->
The rest of the content...

5. Publish.
6. The video will now be displayed in a separate section from the content of your post.



Licenses
--------------

Standard header image license: CC0 1.0 Universal (CC0 1.0) http://creativecommons.org/publicdomain/zero/1.0/

Pacifico font license : SIL Open Font License, 1.1 http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL

Roboto font license : SIL Open Font License, 1.1 http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL

Roboto Slab font license : SIL Open Font License, 1.1 http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL

FontAwesome icon set license : MIT License http://opensource.org/licenses/mit-license.html

Masonry cascading grid layout library : MIT License http://desandro.mit-license.org

FlexSlider jQuery slider : GNU GPL v2.0 http://www.gnu.org/licenses/gpl-2.0.html