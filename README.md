# GitHub Flavored Markdown Preview

## Introduction

It turns out that most of the [Markdown](http://daringfireball.net/projects/markdown/) I produce these days is for GitHub READMEs or other GitHub-hosted documentation, comments and so on. I'm still having a hard time parting with [TextMate](http://macromates.com). Yes, I've tried [Sublime Text 2](http://www.sublimetext.com/), and many other things -- I keep coming back to TextMate.

TextMate has always had a Markdown bundle, which includes a Markdown preview, HTML conversion, and other nice things. However, it's never been useful for [GitHub Flavored Markdown](http://github.github.com/github-flavored-markdown/). Like many of you, I've done the edit-commit-push-refresh-edit cycle over and over until I get my GFM pages looking how I want them ... or more likely, I give up and never really get them how I want them, and move on anyway.

Thanks to [GitHub's API](http://developer.github.com/v3/markdown/), and a bit of hacking, this is all over. Bring on the sexy GFM READMEs!

## Installation

The best way to install the Plugin is to clone it. For TextMate 2.x (which automatically reloads bundles):

	cd ~/Library/Application\ Support/TextMate/Bundles
	git clone git://github.com/claylo/gfm-preview.git "GitHub Flavored Markdown.tmbundle"

## TextMate 2 Users

As of release 1.1.0, the bundle will pop a preview open whenever you save a Markdown file. Focus will shifted back to the document you're editing immediately after the preview refreshes.

If you don't like this behavior, you can disable it by going to `Bundles` -> `Edit Bundles...` and modifying the Preview menu item of the `GitHub Flavored Markdown` bundle. If you remove `callback.document.did-save` from the Semantic Class field on the script drawer, the Preview will only appear when you manually select it.

## Screen Shot

Here's what the README for [Monolog](https://github.com/Seldaek/monolog/) looks like.

![Screenshot](http://i.imgur.com/prJ1J.png)

## Author

Clay Loveless - <clay@loveless.net> - <http://twitter.com/claylo>

## License

The GitHub Flavored Markdown.tmbundle is licensed under [the MIT license](http://claylo.mit-license.org/2012-2022/).

## Acknowledgements

Thanks to the GitHub team for GitHub Flavored Markdown itself, as well as for granting permission to use the CSS in this bundle.

Thanks to [MediaLoot](http://www.medialoot.com/) for the [Awake](http://medialoot.com/item/awake-free-web-font/) font.

Finally, thanks to [Allen Odgaard](https://github.com/sorbits) for TextMate.
