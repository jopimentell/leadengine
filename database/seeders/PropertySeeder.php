<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        // Lista de imagens de imóveis do Unsplash
        $imageUrls = [
            'https://plus.unsplash.com/premium_photo-1689609950112-d66095626efb?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1598228723793-52759bba239c?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1515263487990-61b07816b324?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800&auto=format&fit=crop',
            'https://plus.unsplash.com/premium_photo-1676321046262-4978a752fb15?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1718755923874-587a925767ce?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1718755923874-49a5e15ad928?w=800&auto=format&fit=crop',
            'https://plus.unsplash.com/premium_photo-1742418127279-c9a43d9acf2a?w=800&auto=format&fit=crop',
            'https://plus.unsplash.com/premium_photo-1678172259039-ecdde7744c17?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1583608205776-bfd35f0d9f83?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1523217582562-09d0def993a6?w=800&auto=format&fit=crop',
            'https://plus.unsplash.com/premium_photo-1661883964999-c1bcb57a7357?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1554995207-c18c203602cb?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1494526585095-c41746248156?w=800&auto=format&fit=crop',
        ];

        // Buscar todos os corretores (excluindo admin)
        $users = User::where('is_admin', false)->get();

        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) {
                $status = $faker->randomElement(['active', 'active', 'active', 'inactive', 'sold']);
                $price = $faker->numberBetween(200000, 2500000);
                $priceRent = $faker->optional(0.4)->numberBetween(800, 8000);
                $bedrooms = $faker->numberBetween(1, 5);
                $bathrooms = $faker->numberBetween(1, 4);
                $area = $faker->numberBetween(30, 300);

                $street = $faker->streetName;
                $neighborhood = $faker->cityPrefix . ' ' . $faker->lastName;
                $city = $faker->city;
                $state = $faker->stateAbbr;
                $lat = $faker->latitude(-33, 5);
                $lng = $faker->longitude(-73, -34);

                $property = Property::create([
                    'id' => (string) Str::uuid(),
                    'user_id' => $user->id,
                    'slug' => Str::slug($faker->sentence(3)) . '-' . Str::random(6),
                    'title' => $faker->sentence(3),
                    'description' => $faker->paragraphs(3, true),
                    'price' => $price,
                    'price_rent' => $priceRent,
                    'street' => $street,
                    'neighborhood' => $neighborhood,
                    'city' => $city,
                    'state' => $state,
                    'latitude' => $lat,
                    'longitude' => $lng,
                    'bedrooms' => $bedrooms,
                    'bathrooms' => $bathrooms,
                    'area_sqmt' => $area,
                    'status' => $status,
                    'views_count' => $faker->numberBetween(0, 500),
                    'lead_count' => $faker->numberBetween(0, 30),
                ]);

                // Embaralhar as imagens para cada imóvel
                $shuffledImages = $imageUrls;
                shuffle($shuffledImages);

                // Selecionar de 3 a 5 imagens aleatórias da lista
                $numImages = $faker->numberBetween(3, 5);
                $selectedImages = array_slice($shuffledImages, 0, $numImages);

                foreach ($selectedImages as $index => $url) {
                    PropertyImage::create([
                        'property_id' => $property->id,
                        'url' => $url,
                        'order' => $index + 1,
                        'is_enhanced' => false,
                    ]);
                }
            }
        }
    }
}