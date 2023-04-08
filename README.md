# Active Record

The active record pattern is an approach to accessing data in a database. A database table or view is wrapped into a class. Thus, an object instance is tied to a single row in the table. After creation of an object, a new row is added to the table upon save. Any object loaded gets its information from the database. When an object is updated, the corresponding row in the table is also updated. The wrapper class implements accessor methods or properties for each column in the table or view.

## Project Structure

1. `src:` source code

2. `vendor:` external libraries

## Contributing

To contribuit to this project [follow these steps](./CONTRIBUTING).

## Getting started

1. Clone this repository

```bash
git clone https://github.com/AssoDePicche/boilerplate.git
```

## How to Use

First, you need to config the `DSN` at `.env` file in root folder, then you must create a class which represents a table at your database and extends the `ActiveRecord` class. To perform a sql statement it's necessary to instantiate the correspondent class. It's possible to perform: `Insert`, `Select`, `Update`, and `Delete`.

```php
<?php

class User extends \ActiveRecord\ActiveRecord
{
}

$model = new User;

$model->username = 'Frank Miller';

$statement = new \ActiveRecord\Statement\Update;

$rows = $model->execute($statement);

```

## Get in touch

Samuel do Prado Rodrigues (AssoDePicche) - samuelprado730@gmail.com
