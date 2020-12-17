<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Imports\UsersAgeImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Concerns\ToModel;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class SaveExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //Property 
    protected $title;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('comenzo el proceso');
        Excel::import(new UsersAgeImport, storage_path('/file/' . $this->title));
        Log::info('termino el proceso');
    }
}
