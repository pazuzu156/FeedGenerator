## FeedGenerator
FeedGenerator is a small and simple RSS and Atom feed generator

## Using
You need to include the code in your project. The easiest way is to use composer

```bash
$ composer require pazuzu156/feedgenerator dev-master
```

## Plugin
I'm working on making FeedGenerator compatible with Laravel, Scara, and Lithium

## Testing
I decided to use MongoDB to test the feed generation using some sort of database, and Mongo was easiest.

You need MongoDB server and driver for PHP as well as it's PHP library.

Simply run `mongod.bat` to run the server. Oh, and make sure you make a directory in the root of this project called `mongo_database` so the server has somewhere to place it's shit.

You need stuff in your database, when the MongoDB server is up and you have a web server to navigate, go to: `http://<YOUR_URL_TO_ROOT_DIR_HERE>/tests/seed.php` to seed the data, and going to `atom.php` or `rss.php` to test out the library
