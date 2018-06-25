<?php

namespace Modules\Excel\Entities;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Book\Entities\Book;

class BooksExcel
{

    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * @return string
     */

    public function export()
    {
        $data = Book::all();
        $file = Excel::create('books_' . time(), function ($excel) use ($data) {
            $excel->sheet('book', function ($sheet) use ($data) {
                $sheet->row(1, array('num', 'id', 'name', 'image', 'author', 'genre', 'quantity', 'price', 'description'));
                foreach ($data as $index=>$item) {
                    $authorsString = '';
                    foreach ($item->authors as $minIndex => $author) {
                        $authorsString = $authorsString . '' . $author['name'];
                        if ($minIndex < ($item->authors->count()) - 1) {
                            $authorsString = $authorsString . ',';
                        }
                    }

                    $genreString = '';
                    foreach ($item->genres as $minIndex => $genre) {
                        $genreString = $genreString . '' . $genre['name'];
                        if ($minIndex < ($item->genres->count()) - 1) {
                            $genreString = $genreString . ';';
                        }
                    }
                    $sheet->appendRow(array(
                        $index + 1,
                        $item['id'],
                        $item['name'],
                        $item['image'],
                        $authorsString,
                        $genreString,
                        $item['quantity'],
                        $item['price'],
                        $item['description']
                    ));
                }
            });
        });
        return $file->export('xls');
    }

    public function exportToString()
    {
        $data = Book::all();
        $file = Excel::create('books_' . time(), function ($excel) use ($data) {
            $excel->sheet('book', function ($sheet) use ($data) {
                $sheet->row(1, array('num', 'id', 'name', 'image', 'author', 'genre', 'quantity', 'price', 'description'));
                foreach ($data as $index=>$item) {
                    $authorsString = '';
                    foreach ($item->authors as $minIndex => $author) {
                        $authorsString = $authorsString . '' . $author['name'];
                        if ($minIndex < ($item->authors->count()) - 1) {
                            $authorsString = $authorsString . ',';
                        }
                    }

                    $genreString = '';
                    foreach ($item->genres as $minIndex => $genre) {
                        $genreString = $genreString . '' . $genre['name'];
                        if ($minIndex < ($item->genres->count()) - 1) {
                            $genreString = $genreString . ';';
                        }
                    }
                    $sheet->appendRow(array(
                        $index + 1,
                        $item['id'],
                        $item['name'],
                        $item['image'],
                        $authorsString,
                        $genreString,
                        $item['quantity'],
                        $item['price'],
                        $item['description']
                    ));
                }
            });
        });
        return $file->String('xls');
    }

    public function import($file) {
        $extension = File::extension($file->getClientOriginalName());
        if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
            $path = $file->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();

            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $insert[] = [
                        'name' => $value->name,
                        'image' => $value->image,
                        'quantity' => $value->quantity,
                        'price' => $value->price,
                        'description' => $value->description,
                    ];
                }

                if (!empty($insert)) {
                    $insertData = DB::table('books')->insert($insert);
                    if ($insertData) {
                        return 'Your Data has successfully imported';
                    } else {
                        $message = 'Error inserting the data..';
                        return $message;
                    }
                }

            }
            return 'Error reading data file';

        } else {
            $message = 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!';
            return $message;
        }
    }
}
