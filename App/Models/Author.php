<?php

namespace App\Models;

use Faker\Factory;

/**
 * Author model
 */
class Author extends \Core\Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'authors';

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
    protected $attributes = ['id', 'first_name', 'last_name'];


    /**
     * Insert a row into the author table with fake values
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

        $values = [$faker->firstName, $faker->lastName];

        $sql = 'INSERT INTO ' . $table . ' SET ' . $set;
        $statement = $this->execute($sql, $values);

        return ($statement->rowCount() == 1);
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
