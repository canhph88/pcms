<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Excel\Entities\BooksExcel;

class ExcelBackup implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**@var BooksExcel */
    private $booksExcel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->booksExcel = app()->make('BooksExcel');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $this->booksExcel->export();
    }
}
