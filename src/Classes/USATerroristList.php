<?php

namespace Jota\USATerroristList\Classes;

use Goutte\Client;

class USATerroristList
{
    /**
     * name to search
     * @var string
     */
    private string $name;

    /**
     * result to search
     * @var array
     */
    private array $result;

    public function __construct()
    {
        $this->result['is_registered'] = false;
        $this->result['total_results'] = 0;
        $this->result['result'] = [];
    }

    /**
     * search by specific names into usa terrorist list
     * @param string $name
     * @return void
     */
    public function searchByName(string $name)
    {
        $this->name = strtolower($name);
        $client = new Client();
        $crawler = $client->request('GET', config('usaterrorist.url'));

        $table = $crawler->filter('table')->first();
        $table->filter('tr')->each(function ($row) {
            $name = $row->filter('td')->last()->html();
            if (strcmp($this->name, strtolower($name)) == 0) {
                $info = [
                    'name' => $this->name,
                ];
                $this->result['total_results'] += 1;
                $this->result['is_registered'] = true;
                $this->result['result'] = $info;
            }
        });
    }

    /**
     * Return a search result in json form
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }
}
