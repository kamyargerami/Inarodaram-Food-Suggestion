<?php

namespace App\Console\Commands;

use App\Models\Food;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DownloadImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download_images';

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
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $foods = Food::all();

        $this->output->progressStart(count($foods));

        foreach ($foods as $food) {
            Storage::disk('local')->put('/images/' . $food->id . '.jpg', file_get_contents($food->images[0]));

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
    }
}
