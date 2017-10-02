<?php

namespace App\Models;

use Faker\Factory;

/**
 * Book model
 */
class Book extends \Core\Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';    

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = ['id', 'artikul', 'title', 'production_year'];

    /**
     * Insert a row into the book table with fake values
     *
     * @return boolean indicating success
     */
    public function insert()
    {
        $table = $this->table;
        $faker = Factory::create();

        $set = [];
        foreach ($this->attributes as $attribute) {
            if ($attribute !== $this->primaryKey) {
                $set[] = $attribute . ' = ?';
            }
        }
        $set = implode(' ,', $set);

        $values = [
            $faker->swiftBicNumber,
            $faker->sentence(6, true),
            $faker->year
        ];

        $sql = 'INSERT INTO ' . $table . ' SET ' . $set;
        $statement = $this->execute($sql, $values);

        return ($statement->rowCount() == 1);
    }

    /**
     * Get all authors for the book
     *
     * @return array
     */
    public function authors($bookId)
    {
        $db = $this->getDB();
        $sql = 'SELECT a.* FROM books b JOIN author_book ab on b.id = ab.book_id JOIN authors a on a.id = ab.author_id WHERE b.id = ' . $bookId;
        $statement = $this->execute($sql);
        return $statement->fetchAll();
    }

    /**
     * Delete a record by its primary key
     *
     * @return boolean show result
     */
    public function deleteById($id)
    {
        $table = $this->table;
        $pk = $this->primaryKey;
        $sql = 'DELETE FROM ' . $table . ' WHERE ' . $pk . ' = ? LIMIT 1';
        $statement = $this->execute($sql, [$id]);

        return ($statement->rowCount() == 1);
    }       
}