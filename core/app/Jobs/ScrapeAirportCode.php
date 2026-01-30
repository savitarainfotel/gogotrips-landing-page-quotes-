<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\AirportCode;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeAirportCode implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels, Dispatchable;

    /**
     * The number of times the job may be attempted.
     */
    public $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     */
    public $backoff = [10, 30, 60];

    /**
     * The link to process.
     */
    protected $link;

    /**
     * Create a new job instance.
     */
    public function __construct(string $link)
    {
        $this->link = $link;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Http::get($this->link);

        if ($response->successful()){
            $crawler = new Crawler($response->body());

            $crawler->filter('table > tbody > tr')->each(function (Crawler $tr) {

                // HREF
                $href = $tr->filter('th a')->count() ? $tr->filter('th a')->attr('href') : null;
                $airport = $tr->filter('th a')->count() ? $tr->filter('th a')->getNode(0)->textContent : "";

                // TD values
                $tdValues = [];
                $tdValues[] = $airport;

                $tr->filter('td')->each(function (Crawler $td) use (&$tdValues) {
                    // Clone DOM node so we don’t destroy original
                    $node = $td->getNode(0);
                    $clone = $node->cloneNode(true);

                    // Remove only child ELEMENT nodes (span, strong, etc.)
                    foreach (iterator_to_array($clone->childNodes) as $child) {
                        if ($child->nodeType === XML_ELEMENT_NODE) {
                            $clone->removeChild($child);
                        }
                    }

                    $tdValues[] = trim(preg_replace('/\s+/', ' ', $clone->textContent));
                });

                if(!empty($tdValues) && count($tdValues) === 7) {
                    AirportCode::create([
                        'airport'       => $tdValues[0],
                        'airport_type'  => $tdValues[1],
                        'city'          => $tdValues[2],
                        'country'       => $tdValues[3],
                        'iata'          => $tdValues[4],
                        'icao'          => $tdValues[5],
                        'faa'           => $tdValues[6],
                    ]);
                }
            });
        }

        sleep(5);
    }
}