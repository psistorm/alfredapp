Alfred 2 Helpers and Workflows
=========

This repository contains my created Alfred 2 (http://www.alfredapp.com) workflows:

Leo Dictionary
---------
![Searching with leo](Leo%20Dictionary/screenshot_de.png)

Searches the Leo dictionary (http://dict.leo.org) for the languages German, English, French, Spanish and Polish. Feeds back the results into Alfred for instantly seeing the translated word. When hitting 'Enter' the translated word is copied to the clipboard. When hitting 'Shift + Enter' the selected word translation is opened with Leo.
With Version 1.2 newly introduced a somewhat "automatic" detection of the language of the entered word. 

There are three ways to search Leo:
* de - Translating a German word to English and vice versa.
* df - Translating a German word to French and vice versa.
* ds - Translating a German word to Spanish and vice versa.
* di - Translating a German word to Italian and vice versa.
* dr - Translating a German word to Russian and vice versa.
* db - Translating a German word to Portuguese and vice versa.
* dp - Translating a German word to Polish and vice versa.

Download the workflow: [Leo Dictionary](https://github.com/psistorm/alfredapp/blob/master/Leo%20Dictionary/Leo%20Dictionary.alfredworkflow?raw=true)

Release Notes:

V 1.1:
- Added two hotkey inputs, transferring the current selected text to Alfred for getting translation. The used hotkeys are not imported and need to be set as wished.

V 1.2:
- Only one keyword per language needed now. The language of the entered word is automatically detected.
- Opening Leo with the selected word when hitting 'Shift + Enter'.
- Fixed problem with German umlauts.

V 1.2.1:
- Fixed problem with opening the URL in some cases.
- Fixed problem with some special words preventing results from being shown.

V 1.3
- Added support for translation of German to Polish and vice versa ([Sebastian Kusnier][kusnier])

V 1.3.1
- Quick fix for changes in Leo site to make the workflow work again ([Oderwat][oderwat])

V 1.4
- Added timeout for php request to avoid high process load when loosing internet connection.
- Open Leo with the originally entered word when hitting 'Ctrl+Enter'.

V 1.4.1
- Fix for changes in Leo site, now using the XML API ([Daniel Diekmeier][danieldiekmeier])

V 1.4.2
- Changing the used PHP XML library, fixing issues occurred in 1.4.1

[kusnier]: https://github.com/kusnier
[oderwat]: https://github.com/oderwat
[danieldiekmeier]: https://github.com/danieldiekmeier
