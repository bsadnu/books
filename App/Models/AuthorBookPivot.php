<?php

namespace App\Models;


/**
 * AuthorBookPivot model
 */
class AuthorBookPivot extends \Core\Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'author_book';

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = ['author_id', 'book_id'];


    /**
     * Insert a row into the author_book table
     *
     * @return boolean indicating success
     */
    public function insert($authorId, $bookId)
    {
        $table = $this->table;
   
        $set = [];
        foreach ($this->attributes as $attribute) {
            $set[] = $attribute . ' = ?';
        }
        $set = implode(' ,', $set);

        $values = [$authorId, $bookId];

        $sql = 'INSERT INTO ' . $table . ' SET ' . $set;
        $statement = $this->execute($sql, $values);

        return ($statement->rowCount() == 1);
    }
}
