# Installation

Require this package in your `composer.json` and update composer.

```php
"marlemiesz/wp-sdk": "dev-master"
```
OR
```php
composer require marlemiesz/wp-sdk: dev-master
```

# Docs
## Authentication
To use the SDK, you need to create an instance of the `Wordpress` class and pass it your credentials.

```php
use Marlemiesz\SdkWordpress\Wordpress;
$wp = new Wordpress('http://example.com', 'username', 'password');
```
## Categories
Api Reference: https://developer.wordpress.org/rest-api/reference/categories/
### Get all categories
```php
$categories = $wp->getCategories();
```
## Posts
Api Reference: https://developer.wordpress.org/rest-api/reference/posts/
### Get all posts
```php
$posts = $wp->getPosts();
```
### Add new post
```php
$post = $wp->addPost(
    'Post title',
    'Post content',
    \Marlemiesz\WpSDK\Enum\PostStatuses::PUBLISH,
    [1, 2, 3],
        )?->getFirstItem();
```
### Update post
```php
$post = $wp->updatePost(
    1,
    'Post title',
    'Post content',
    \Marlemiesz\WpSDK\Enum\PostStatuses::PUBLISH,
    [1, 2, 3],
        )?->getFirstItem();
```
### Delete post
```php
$wp->deletePost(1);
```
