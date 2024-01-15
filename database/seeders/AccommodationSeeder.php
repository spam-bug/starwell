<?php

namespace Database\Seeders;

use App\Enums\AccommodationStatus;
use App\Enums\AccommodationType;
use App\Models\Accommodation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccommodationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->accommodations() as $accommodation) {
            Accommodation::create($accommodation);
        }
    }

    public function accommodations(): array
    {
        return [
            [
                'name' => 'Overnight Accommodation',
                'description' => 'Discover a haven of tranquility at Starwell Resort, Overnight Accommodation is nestled between lush tropical foliage and the pristine coastline. Immerse yourself in the luxurious embrace of our resort, where every detail is crafted for your ultimate relaxation.',
                'price' => 1000000,
                'type' => AccommodationType::Resort,
                'max_person' => 100,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/DB24N0JK9SuuB5hK5BDEDPXCaAKeodBNOQUsgfDa.png',
            ],
            [
                'name' => 'Day Accommodation',
                'description' => 'Discover a haven of tranquility at Starwell Resort, Day Accommodation is nestled between lush tropical foliage and the pristine coastline. Immerse yourself in the luxurious embrace of our resort, where every detail is crafted for your ultimate relaxation.',
                'price' => 800000,
                'type' => AccommodationType::Resort,
                'max_person' => 100,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/5Af8eqFgaWsnYejmRicF4WcyEN4SkLkQK1W4j9Hf.png',
            ],
            [
                'name' => 'Night Accommodation',
                'description' => 'Discover a haven of tranquility at Starwell Resort, Night Accommodation is nestled between lush tropical foliage and the pristine coastline. Immerse yourself in the luxurious embrace of our resort, where every detail is crafted for your ultimate relaxation.',
                'price' => 900000,
                'type' => AccommodationType::Resort,
                'max_person' => 50,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/5Af8eqFgaWsnYejmRicF4WcyEN4SkLkQK1W4j9Hf.png',
            ],
            [
                'name' => 'Couple Licious',
                'description' => 'Includes 1 bucket of Redhorse beer and 1 sizzling plate of sisig. Good for 2 person',
                'price' => 59900,
                'type' => AccommodationType::Restobar,
                'max_person' => 6,
                'max_daily_capacity' => 5,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/i1o9p4h1PRh6FQKMYnbSdFC01cYHljERMBRjRgR1.png',
            ],
            [
                'name' => 'Shotropa',
                'description' => 'Includes 2 bucket of Redhorse beer and 1 sizzling sisig plus Grilled Pork Belly. Good for 8 person',
                'price' => 119900,
                'type' => AccommodationType::Restobar,
                'max_person' => 8,
                'max_daily_capacity' => 5,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/i1o9p4h1PRh6FQKMYnbSdFC01cYHljERMBRjRgR1.png',
            ],
            [
                'name' => 'Barkada Special',
                'description' => 'Includes 3 bucket of Redhorse beer, 2 large french fries and 2 plate of sizzling sisig. Good for 10 Person',
                'price' => 179900,
                'type' => AccommodationType::Restobar,
                'max_person' => 10,
                'max_daily_capacity' => 3,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/i1o9p4h1PRh6FQKMYnbSdFC01cYHljERMBRjRgR1.png',
            ],
            [
                'name' => 'Haircut',
                'description' => 'Enjoy the Haircut offer by Starwell Barbershop. Do not miss out the best service you will ever experience.',
                'price' => 10000,
                'type' => AccommodationType::Barbershop,
                'max_daily_capacity' => 10,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/L8sT2HGXuS0CNeCZUk6xZgZsIQBSsq53bex2hDhA.png'
            ],
            [
                'name' => 'Shave and Trim',
                'description' => 'Enjoy our Shave and Trim offer by Starwell Barbershop. Do not miss out the best service you will ever experience.',
                'price' => 5500,
                'type' => AccommodationType::Barbershop,
                'max_daily_capacity' => 8,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/jTfqwyOOj2tyl4RIiWWCj8gkER4wJoXSWFg727om.png',
            ],
            [
                'name' => 'Hair Color',
                'description' => 'Enjoy our hair color offer by Starwell Barbershop. Do not miss out the best service you will ever experience.',
                'price' => 50000,
                'type' => AccommodationType::Barbershop,
                'max_daily_capacity' => 5,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/jTfqwyOOj2tyl4RIiWWCj8gkER4wJoXSWFg727om.png',
            ],
            [
                'name' => 'Gym Membership',
                'description' => 'At Starwell Gym, we redefine your fitness journey with state-of-the-art facilities, cutting-edge equipment, and a motivating atmosphere. Whether you are a seasoned athlete or a fitness beginner, our expert trainers are here to guide you towards your goals.',
                'price' => 150000,
                'type' => AccommodationType::Gym,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/nSou02LvSD7ZFqCxz9oy0q4vURmumqgdCnwHGVWn.png',
            ]
        ];
    }
}
