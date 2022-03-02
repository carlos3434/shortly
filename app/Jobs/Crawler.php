<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Link;

class Crawler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $link;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($link)
    {
        $this->link = $link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //process
        $url = $this->link->url;
        $data = file_get_contents($url);
        //$title = preg_match('/(title)/', $data);

        if(preg_match("/<title>(.+)<\/title>/i", $data, $matches)) {
            $link = Link::find($this->link->id);
            $link->name = $matches[1];
            $link->save();
        } else {
            return ['not found'];
        }

    }
}
