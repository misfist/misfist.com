=== Explanatory Dictionary ===
Contributors: exed internet, s_ruben
Tags: explanatory dictionary, dictionary, vocabulary, glossary, lexicon, explain, explanation, tooltips, descriptions
Requires at least: 3.5.0
Tested up to: 3.8.0
Stable tag: 4.0.2

This plugin is used when there are words, words expressions or sentences to be explained via tooltips in the posts or pages of your wordpress blog.

== Description ==

This plugin is used when there are some words, words expressions or sentences to be explained in the posts or pages of your wordpress blog. It will help the visitors to read the explanations of the words (words expressions, sentences) you need via tooltips. It can also be used as a glossary.

= Contact =
In case of suggestions or improvements please contact EXED at service@exed.nl, or through the GitHub repository (see below).

= More information =
Read the following items for more information:

* Follow EXED internet on [Facebook](https://www.facebook.com/EXEDInternet), [Twitter](https://twitter.com/exedinternet) and our [blog](http://blog.exed.nl) *(Dutch only)*
* Other WordPress Plugins by EXED internet. - http://profiles.wordpress.org/exed-internet/
* EXED internet official website - [http://www.exed.nl](http://www.exed.nl?utm_source=wordpress&utm_medium=social%2Bmedia)

== Installation ==

1. Upload the explanatory-dictionary directory (including all files within) to the /wp-content/plugins/ directory
2. Activate the plugin through the Plugins menu in WordPress
3. If you want to show all words (words expressions, sentences) with their explanations like a glossary in a post or a page, add [explanatory-dictionary] in it.

= Also =

* To show all words (words expressions, sentences) with their explanations like a glossary in a post or a page, add [explanatory-dictionary] in it.
* To exclude the words (words expressions, sentences) from being explained by getting those words (words expressions, sentences) into [no-explanation][/no-explanation] tags.

== Screenshots ==

1. The Explanation Tooltips
2. Manage Explanatory Dictionary
3. Explanatory Dictionary Options
3. Explanatory Dictionary Overview on page

== Changelog ==

= 4.0.2 =
* New icon so it looks cooler witht the new admin layout
* Bugfix: Diacritics can be used again
* Bugfix: Words were being replaced inside input tags
* Bugfix: Padding inside the bubble works again
* Bugfix: Bubble doesn't dissapear anymore if you try to hover over it

= 4.0.1 =

* You can still use [explanatory dictionary] (without the dash, but note that this will be deprecated in the near future)
* Words between [no-explanation] will be ignored (use with the dash, without the dash will be deprecated in the near future)
* Moved the definitioner to the end of the page and made sure it's only build once
* Cleaned up the code for the tooltips so the code only exists once on a page 
* Bugfix: Definitioner showing in excerpts
* Bugfix: White spaces before and after the word that has a definition
* Bugfix: You can add content above your dictionary on the glossary page
* Bugfix: Preg match warning on dictionary page 

= 4.0.0 =

* Complete rewrite to add new features in the future.

= 3.0.2 =

* Solved jquery error problem.

= 3.0.1 =

* Fixed some bugs for unicode.

= 3.0 =

* The tooltips show and hide using jQuery fadeIn and fadeOut effects.
* Now you can move the mouse cursor over the tooltip.
* You can add HTML code in the explanation.
* Added "Synonyms and forms" field where you can add the synonyms and/or the different forms of the words (words expressions, sentences) and it will show their explanation as well.
* Besides the fields "Explanation" you can also edit the fields "Word (words expression, sentence)" and "Synonyms and forms" as well.
* The first page of the glossary shows all words (words expressions, sentences) with their explanations.
* Now you can remove the alphabet.
* Now you can remove the tooltips and use only the glossary page.

= 2.0 =

* Now you can set an external CSS for styling the explanatory dictionary.
* You can separate the shown words (words expressions, sentences) of the explanatory dictionary by the alphabet.
* You can exclude the words (words expressions, sentences) from being explained by getting those words (words expressions, sentences) into [no explanation][/no explanation] tags.

= 1.5 =

* The bug which shows an error when you use several characters in explanatory dictionary is fixed.

= 1.4 =

* You can add words (words expressions, sentences) which are already existed in the words (words expressions, sentences) you added before.
* You can edit the explanations of the dictionary.
* The problem with posts images captions is solved.

= 1.3 =

* Added new options - "Set Explaining Word (Words Expression, Sentence) Style", "Exclude", "Limit".

= 1.2 =

* The problem that the tooltip appears not near the word in the several themes is already solved.

= 1.1 =

* Added new option "unicode".
* Now you can show all words (words expressions, sentences) with their explanations.
* Fixed some bugs.

= 1.0 =
* First release.

== Upgrade Notice ==

= 4.0.2 =
* New icon so it looks cooler witht the new admin layout
* Bugfix: Diacritics can be used again
* Bugfix: Words were being replaced inside input tags
* Bugfix: Padding inside the bubble works again
* Bugfix: Bubble doesn't dissapear anymore if you try to hover over it

= 4.0.1 =
Few bug fixes and a couple of improvements
* You can still use [explanatory dictionary] (without the dash, but note that this will be deprecated in the near future)
* Words between [no-explanation] will be ignored (use with the dash, without the dash will be deprecated in the near future)
* Moved the definitioner to the end of the page and made sure it's only build once
* Cleaned up the code for the tooltips so the code only exists once on a page 
* Bugfix: Definitioner showing in excerpts
* Bugfix: White spaces before and after the word that has a definition
* Bugfix: You can now add content above your dictionary on the glossary page
* Bugfix: Preg match warning on dictionary page 

= 4.0.0 =
A complete rewrite of the code, removed a lot of buggy code for a more stable plugin.
The shortcode itself has changed and how contains a hyphen and should be used as followed: [explanatory-dictionary]