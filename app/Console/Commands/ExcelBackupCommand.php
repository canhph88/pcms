<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Modules\Excel\Entities\BooksExcel;

class ExcelBackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    /**@var BooksExcel */
    private $booksExcel;

    protected $signature = 'excel:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->booksExcel = app()->make('BooksExcel');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
//        $this->booksExcel->export();
//        $this->run('ls');
        $fileName = 'books_'.time().'.xls';
        Storage::disk('local')->put($fileName, $this->booksExcel->exportToString());
        File::copy(storage_path().'/app/'.$fileName, '/var/www/logs/'.$fileName);
//        $this->info('run every minute');
    }
}
