# Laravel Database Prefix

**Laravel Database Prefix** is a package that allows you to dynamically add a database prefix to Eloquent models, including specifying the database name. This is particularly useful when multiple databases are used within the same database connection in Laravel.

By leveraging this package, you can properly define relationships between models that belong to different databases, making **cross-database relations** possible—something that Laravel does not support out of the box.

## Installation

Install the package via Composer:

```bash
composer require megaezz/laravel-database-prefix
```

## Usage

Assume you have a database connection defined in `config/database.php`:

```php
'mysql' => [
    ...
],
```

Within this connection, you have multiple databases: `default`, `database1`, and `database2`. You want to use Eloquent models where the corresponding tables are located in different databases within this same connection.

### Example

Define a `User` model that belongs to `database1`:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Megaezz\LaravelDatabasePrefix\HasDatabasePrefix;

class User extends Model
{
    use HasDatabasePrefix;

    protected $database = 'database1';

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
```

Define an `Article` model that belongs to `database2`:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Megaezz\LaravelDatabasePrefix\HasDatabasePrefix;

class Article extends Model
{
    use HasDatabasePrefix;

    protected $database = 'database2';
}
```

### Querying Across Databases

Now, the following query will work correctly, even though `users` and `articles` are in different databases:

```php
User::has('articles')->get();
```

## License

This package is open-source and available under the MIT license.