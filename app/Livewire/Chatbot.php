<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Chatbot extends Component
{
    public array $messages = [];

    #[Rule('required')]
    public string $message = '';

    public function mount()
    {
        $this->messages = Cache::get('chatbot_messages', []);

        if (empty($this->messages)) {
            $this->messages[] = ['type' => 'bot', 'content' => 'How can I help you today?'];
            Cache::put('chatbot_messages', $this->messages, now()->addDay());
        }
    }

    public function sendMessage()
    {
        $this->validate();
        $message = $this->message;
        $this->message = '';
        $this->messages[] = ['type' => 'user', 'content' => $message];

        $response = $this->processMessage($message);

        $this->messages[] = ['type' => 'bot', 'content' => $response];

        Cache::put('chatbot_messages', $this->messages, now()->addDay());
    }

    private function processMessage($message)
    {
        $url = "https://api.wit.ai/message?v=20231229&q=".urlencode($message);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Authorization: Bearer XCQJT3SXGYRWWTFQN3RGS5JC7SYA7KWR",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $witResponse = curl_exec($curl);

        curl_close($curl);

        $witResponse = json_decode($witResponse, true);

        $intent = isset($witResponse['intents'][0]['name']) ? $witResponse['intents'][0]['name'] : null;

        switch ($intent) {
            case 'greet':
                return 'Hi, just ask me if you have any question';
            case 'ask_help':
                return 'How can I help you?';
            case 'mode_of_payment':
                return 'Our available mode of payment is GCash';
            case 'starwell_address':
                return 'Purok 6, Kawayan Kiling, Cataning, Hermosa, Bataan';
            case 'view_accommodations':
                return 'You can check our available accommodations <a href="'. route('accommodations') .'" wire:navigate class="text-blue-500 hover:underline">here</a>.';
            default:
                return 'I didn\'t understand that. Can you please rephrase your question?';
        }
    }
}
