<?php

namespace App\Console\Commands;

use App\Photo;
use App\Dimension;
use Illuminate\Console\Command;
use Intervention\Image\ImageManager;

class SyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Command';

    /**
     *
     * @var ImageManager
     */
    private $manager;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ImageManager $manager)
    {
        parent::__construct();

        $this->manager = $manager;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // request API
        $json = file_get_contents(env('API'));

        // parse data
        $data = json_decode($json, true);

        // get images
        $images = $data['images'];

        foreach ($images as $image) {

            // get basename
            $basename = pathinfo(parse_url($image['url'])['path'])['basename'];

            // verify if this image was already stored
            if (!is_null(Photo::where('name', $basename)->first())) continue;

            $photo = new Photo();
            $photo->name = $basename;
            $photo->save();

            // get filename
            $filename = pathinfo(parse_url($image['url'])['path'])['filename'];

            // get extension
            $extension = pathinfo(parse_url($image['url'])['path'])['extension'];

            // save file
            file_put_contents(storage_path('photos/' . $basename), file_get_contents($image['url']));

            $dimensions = [
                ['w' => 320, 'h' => 240],
                ['w' => 384, 'h' => 288],
                ['w' => 640, 'h' => 480]
            ];

            // resize images
            foreach ($dimensions as $value) {
                $this->manager
                    ->make(storage_path('photos/' . $basename))
                    ->resize($value['w'], $value['h'])
                    ->save(public_path('photos/' . $filename . '-' . implode('x', $value) . '.' . $extension));

                $dimension = new Dimension();
                $dimension->path = env('APP_URL') . '/photos/' . $filename . '-' . implode('x', $value) . '.' . $extension;
                $dimension->photo()->associate($photo);
                $dimension->save();
            }
        }
    }
}
