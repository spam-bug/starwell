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
                'name' => 'Serenity Shores Retreat',
                'description' => 'Discover a haven of tranquility at Serenity Shores Retreat, nestled between lush tropical foliage and the pristine coastline. Immerse yourself in the luxurious embrace of our resort, where every detail is crafted for your ultimate relaxation. From the infinity pool overlooking the azure waters to personalized spa treatments and gourmet dining experiences, Serenity Shores is a sanctuary for those seeking a perfect blend of indulgence and natural beauty.',
                'price' => 3000000,
                'type' => AccommodationType::Resort,
                'max_person' => 50,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/DB24N0JK9SuuB5hK5BDEDPXCaAKeodBNOQUsgfDa.png',
            ],
            [
                'name' => 'Mountain Mist Lodge',
                'description' => 'Escape to the enchanting Mountain Mist Lodge, where the crisp mountain air and breathtaking vistas create an idyllic retreat. Tucked away in the heart of the mist-kissed mountains, our resort offers a seamless blend of rustic charm and modern comforts. Whether you\'re exploring nearby hiking trails, unwinding in our cozy cabins, or savoring farm-to-table cuisine, every moment at Mountain Mist Lodge is a celebration of nature\'s beauty and the joy of retreat.',
                'price' => 5000000,
                'type' => AccommodationType::Resort,
                'max_person' => 100,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/5Af8eqFgaWsnYejmRicF4WcyEN4SkLkQK1W4j9Hf.png',
            ],
            [
                'name' => 'Urban Bistro Lounge',
                'description' => 'Experience the vibrant pulse of the city at Urban Bistro Lounge, a chic and lively restobar where delectable cuisine meets trendy ambiance. From craft cocktails expertly mixed by our skilled bartenders to a diverse menu featuring global culinary delights, Urban Bistro Lounge is the perfect fusion of gastronomic excitement and urban sophistication. Whether you\'re savoring small bites with friends or enjoying a night out, our eclectic atmosphere ensures every visit is a celebration.',
                'price' => 80000,
                'type' => AccommodationType::Restobar,
                'max_person' => 10,
                'max_daily_capacity' => 5,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/iMPGtAbr3rsiTwA5FMME7Jz9Y8HxYmzQsuEaR2Ap.png',
            ],
            [
                'name' => 'Harborview Taverna',
                'description' => 'Nestled along the waterfront, Harborview Taverna beckons you to a culinary journey by the sea. Indulge in a symphony of flavors inspired by coastal traditions, as our skilled chefs craft exquisite dishes using the freshest local ingredients. With a laid-back atmosphere, panoramic views, and an extensive selection of wines and craft beers, Harborview Taverna is not just a restobar – it\'s a destination where every sip and bite is a seaside escape.',
                'price' => 100000,
                'type' => AccommodationType::Restobar,
                'max_person' => 15,
                'max_daily_capacity' => 5,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/i1o9p4h1PRh6FQKMYnbSdFC01cYHljERMBRjRgR1.png',
            ],
            [
                'name' => 'Gentleman\'s Haven Barbershop',
                'description' => 'Step into the refined world of grooming at Gentleman\'s Haven Barbershop, where classic craftsmanship meets contemporary style. Our skilled barbers are dedicated to providing precision haircuts, timeless shaves, and personalized grooming experiences. With an inviting atmosphere that combines vintage charm and modern aesthetics, our barbershop is more than just a place for a haircut – it\'s a haven for discerning gentlemen seeking a tailored and sophisticated grooming experience.',
                'price' => 50000,
                'type' => AccommodationType::Barbershop,
                'max_daily_capacity' => 10,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/L8sT2HGXuS0CNeCZUk6xZgZsIQBSsq53bex2hDhA.png'
            ],
            [
                'name' => 'Shear Elegance Studio',
                'description' => 'Unleash your style potential at Shear Elegance Studio, where passion for hair artistry meets a commitment to individuality. Our experienced stylists are here to transform your look with precision cuts, creative styling, and personalized consultations. The studio\'s sleek and modern design creates a comfortable space where you can relax and entrust your style evolution to our skilled hands. Step into Shear Elegance Studio and let your unique personality shine through your refreshed and refined look.',
                'price' => 30000,
                'type' => AccommodationType::Barbershop,
                'max_daily_capacity' => 10,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/jTfqwyOOj2tyl4RIiWWCj8gkER4wJoXSWFg727om.png',
            ],
            [
                'name' => 'Elevate Fitness Hub',
                'description' => 'At Elevate Fitness Hub, we redefine your fitness journey with state-of-the-art facilities, cutting-edge equipment, and a motivating atmosphere. Whether you\'re a seasoned athlete or a fitness beginner, our expert trainers are here to guide you towards your goals. With dynamic group classes, personalized training plans, and a commitment to your well-being, Elevate is not just a gym – it\'s a community dedicated to helping you reach new heights in health and fitness.',
                'price' => 35000,
                'type' => AccommodationType::Gym,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/Zp7YVXdl3IguebL7cfJ6AhUoUsXcUknSzDQveI6c.png',
            ],
            [
                'name' => 'Pulse Performance Center',
                'description' => 'Ignite your passion for fitness at Pulse Performance Center, where energy, innovation, and dedication converge. Our gym is equipped with the latest fitness technology, offering a diverse range of workouts to suit every fitness level. From high-intensity training zones to rejuvenating yoga studios, Pulse is designed for a holistic approach to health. Join our community of fitness enthusiasts, and let the beat of Pulse guide you to a healthier, stronger, and more vibrant you.',
                'price' => 50000,
                'type' => AccommodationType::Gym,
                'status' => AccommodationStatus::available,
                'photo' => 'photos/nSou02LvSD7ZFqCxz9oy0q4vURmumqgdCnwHGVWn.png',
            ]
        ];
    }
}
