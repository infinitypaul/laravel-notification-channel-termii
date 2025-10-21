<?php

namespace Infinitypaul\Termii;

use GuzzleHttp\Client;
use Infinitypaul\Termii\Exceptions\CouldNotSendNotification;
class Termii
{
    public $body = [];
    public $client;
    protected $baseUrl = 'https://api.ng.termii.com/';

    /**
     * @throws CouldNotSendNotification
     */
    public function __construct()
    {
        $this->setConstant();
        $this->checkConstant();
        $this->prepareClient();
    }

    protected function setConstant()
    {
        $this->add('api_key', config('services.termii.api_key'));
    }

    /**
     * @throws CouldNotSendNotification
     */
    protected function checkConstant()
    {
        if (empty($this->body['api_key'])) {
            throw CouldNotSendNotification::serviceRespondedWithAnError('TERMII API KEY Not Set');
        }
    }

    protected function prepareClient()
    {
        $this->client  = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);
    }

    public function add($key, $value): Termii
    {
        $this->body[$key] = $value;

        return $this;
    }

    public function sendMessage(){
        $response = $this->client->request('POST', 'api/sms/send', [
            'json' => $this->body
        ]);

        return json_decode($response->getBody()->getContents());
    }
}
