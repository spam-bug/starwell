<?php

namespace App\Livewire;

use App\Enums\BookingStatus;
use App\Models\Booking;
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
            case 'ask_name':
                return 'Hello, I\'m Starwell chatbot. How can I help you?';
            case 'ask_accommodations':
                return 'We have resort, restobar, gym, and barbershop.';
            case 'ask_booking':
                return 'Go to the accommodation page and select the accommodation you want to book.';
            case 'ask_resort':
                return 'The Starwell Resort includes two swimming pool, deluxe room, guest room with a living room. It also have function hall that can accommodate maximum of 150 person.';
            case 'ask_gym':
                return 'The Starwell Gym offers 1 month membership for only 1,500.00 pesos. It includes unlimited use of equipment in the gym, like leg press machine, seated curl machine, barbells, dumbells, and treadmill.';
            case 'ask_restobar':
                return 'The Starwell Restobar offers you the best feeling ever where you can book your table that includes our best promos and deals.';
            case 'ask_barbershop':
                return 'The Starwell Barbershop will give you the best service you ever wanted. We offer the best haircut, hair color, hair treatment and shave or trim to you to make you the best look as ever you want to be.';
            case 'welcome':
                return 'Thank you';
            case 'thank_you':
                return "You're welcome!";
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
