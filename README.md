# Backlink-Injector
Simple Script that let you insert link in website even you lose the access of admin panel.

# Usage
1) Copy all file to your website root dir
2) Modify config.php with your mysql configuration and script password
3) Import backlink.sql to your website database using any GUI based tool
4) Visit backlink.php on your browser and request 2 options using get method
5) First is "backlink" where you can specify url which you want to insert
6) Second is "passwd" for security purpose so no other can misuse, default password 123456 but you can change it from config.php
```
Example: https://yoursite.com/backlink.php?backlink=https://anysite.com&passwd=123456
```
7) After requesting, if everything gone right you will be prompted Link Published
8) Visit showlink.php to get all inserted url in site

(Note: If you want to show link in different page simply copy code from showlink.php to your favourite page)

Links
----

* Homepage: https://thisisvivek.ninja
* Instagram: [@heythisisvivek](https://instagram.com/heythisisvivek)
* Twitter: [@heythisisvivek](https://twitter.com/heythisisvivek)
* Telegram: [@heythisisvivek](https://t.me/heythisisvivek)

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.