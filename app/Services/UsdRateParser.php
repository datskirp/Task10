<?php

namespace App\Services;

use GuzzleHttp\Client;

class UsdRateParser
{
    public const QUOTE_PROVIDERS = [
        ['https://buhgalter.by/exchangerate/banks/', "//*[@id='exchange_rate']/table/tbody/tr[2]/td[6]"],
        ['https://bankchart.by/spravochniki/kursy_valyut/840/sale', '//div[@class="currency-exchange-rates-info"]/div[2]/p[2]'],
    ];
    private Client $httpClient;
    private $domDoc;

    /**
     * @param Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->domDoc = new \DOMDocument();
    }

    public function getUsdQuote(): float
    {
        foreach (self::QUOTE_PROVIDERS as $provider) {
            $rate = $this->resolveRate($provider[0], $provider[1]);
            if ($rate) {
                return $rate;
            }
        }

        return 0;
    }

    public function resolveRate(string $url, string $domPath)
    {
        $response = $this->httpClient->get($url);
        $content = $response->getBody()->getContents();
        @$this->domDoc->loadHTML($content);
        $xpath = new \DOMXPath($this->domDoc);
        $quoteNode = $xpath->query($domPath);
        if ($quoteNode->item(0)) {
            return floatval(str_replace(',', '.', $quoteNode->item(0)->textContent));
        }

        return 0;
    }
}
