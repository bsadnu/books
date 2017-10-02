<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Author;
use App\Models\Book;
use App\Models\AuthorBookPivot;

/**
 * Table controller
 */
class TableController extends \Core\Controller
{
    /**
     * Number of records per page
     */
    public $rowLimit = 5;

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $authorModel = new Author();
        $authors = $authorModel->all();
        $authorsTotal = $authorModel->count();

        $bookModel = new Book();
        $booksTotal = $bookModel->count();
        $rowLimit = $this->rowLimit;
        $totalPages = ceil($booksTotal/$rowLimit);
        $books = $bookModel->getPortion(0, $rowLimit);

        View::renderTwig('table/index.html', [
        	'authors' => $authors,
            'books' => $books,
            'bookModel' => $bookModel,
            'booksTotal' => $booksTotal,
            'rowLimit' => $rowLimit,
            'totalPages' => $totalPages,
            'authorsTotal' => $authorsTotal,
        ]);
    }

    /**
     * Reset table data
     *
     * @return void
     */
    public function resetAction()
    {
        $booksNumber = rand(30, 50);
        $authorModel = new Author();
        $bookModel = new Book();
        $pivotModel = new AuthorBookPivot();

        $authorModel->deleteAll();
        $bookModel->deleteAll();
        $pivotModel->deleteAll();

        for ($i=0; $i < $booksNumber; $i++) { 
            $bookModel->insert();
            $bookId = $bookModel->lastInsertId();

            $authorsNumber = rand(1, 5);
            for ($j=0; $j < $authorsNumber; $j++) { 
                $authorModel->insert();
                $authorId = $authorModel->lastInsertId();
                $pivotModel->insert($authorId, $bookId);
            }            
        }
    }

    /**
     * Extract rows for specific page
     *
     * @return void
     */
    public function paginateAction()
    {
        if (isset($_POST['page']) && isset($_POST['rowLimit'])) {
            $start = (($_POST['page'] - 1) * $_POST['rowLimit']);
            $bookModel = new Book();
            $books = $bookModel->getPortion($start, $_POST['rowLimit']);
            foreach ($books as $key => $value) {
                $books[$key]['authors'] = $bookModel->authors($value['id']);
            }
            echo json_encode($books);
        } else echo 'no data';
    }
}
