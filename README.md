# cURL-MultiHandle-Library
We all know how cURL multi handles difficult. With this library, you can make parallel connection in same time easily.

# Why?
I was trying to make parallel connections with Zebra Curl library. First times it was a good library to handle basic stuff. But when i need to use callback for my script it starts to inadequate for me. I couldn't even change or improve it. So i want to create my multi handle library. With this library you can handle multi URLs easily. And you can use callbacks with URL information. That's the point.

# How?
It's very simple actually. Just write function, give the URLs, define your callback. That's it.

```php
multiCurl($URLS, function(){
    //Do want do you want!
});
```

# Some examples
- Download multi files

```php
multiCurl($URLS, function($url, $header, $html){
    file_put_contents(basename($url), $html);
});
```

- Filter by content-types

```php
multiCurl($URLS, function($url, $header, $html){
    if($header['content-type'] == 'image/jpeg'){
        echo $url;
    }
});
```
