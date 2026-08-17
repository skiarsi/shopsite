<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Featured' => [
                'Power Banks',
                'Car Audio & Video',
                'Hunting & Tactical Accessories',
                'Women\'s Panties',
                'Massage Tools',
                'Living Room Furniture',
                'Home Decor Products',
                'Women\'s Jewelry',
                'Bedding',
                'Bedroom Furniture',
                'Women\'s Dresses',
                'Home Storage & Organization',
                'Women\'s T-Shirt',
                'Kitchen Storage & Organization',
                'Seasonal Decor',
                'Patio Furniture',
                'Mowers & Outdoor Power Tools',
                'Event & Party Supplies',
                'Kitchen Utensils & Supplies',
                'Men\'s T-Shirts',
            ],
            'Automotive' => [
                'Car Audio & Video',
                'Car Electronics & Accessories',
                'Interior Accessories',
                'Exterior Accessories',
                'Motorcycle Accessories & Parts',
                'Oils & Fluids',
                'Replacement Parts',
                'Tools & Equipment',
            ],
            'Home & Kitchen' => [
                'Kitchen & Dining',
                'Bedding',
                'Bath',
                'Home Decor',
                'Home Storage & Organization',
                'Heating, Cooling & Air Quality',
                'Cleaning Supplies',
                'Furniture',
            ],
            'Women\'s Clothing' => [
                'Dresses',
                'Tops & Tees',
                'Coats, Jackets & Vests',
                'Sweaters',
                'Pants & Capris',
                'Swimwear',
                'Activewear',
                'Sleep & Lounge',
            ],
            'Women\'s Curve Clothing' => [
                'Plus Size Dresses',
                'Plus Size Tops',
                'Plus Size Outerwear',
                'Plus Size Bottoms',
                'Plus Size Swimwear',
            ],
            'Women\'s Shoes' => [
                'Sneakers',
                'Boots',
                'Sandals',
                'Pumps',
                'Flats',
                'Slippers',
            ],
            'Women\'s Lingerie & Lounge' => [
                'Bras',
                'Women\'s Panties',
                'Shapewear',
                'Thermal Underwear',
                'Robes & Sleepwear',
            ],
            'Men\'s Clothing' => [
                'Men\'s T-Shirts',
                'Shirts',
                'Hoodies & Sweatshirts',
                'Pants',
                'Jackets & Coats',
                'Shorts',
                'Activewear',
            ],
            'Men\'s Shoes' => [
                'Athletic Shoes',
                'Casual Shoes',
                'Boots',
                'Loafers & Slip-Ons',
                'Sandals & Slippers',
            ],
            'Men\'s Big & Tall' => [
                'Big & Tall Tops',
                'Big & Tall Pants',
                'Big & Tall Outerwear',
                'Big & Tall Activewear',
            ],
            'Men\'s Underwear & Sleepwear' => [
                'Boxers & Briefs',
                'Socks',
                'Sleepwear & Robes',
                'Thermals',
            ],
            'Sports & Outdoors' => [
                'Hunting & Tactical Accessories',
                'Exercise & Fitness',
                'Outdoor Recreation',
                'Cycling',
                'Water Sports',
                'Team Sports',
            ],
            'Jewelry & Accessories' => [
                'Women\'s Jewelry',
                'Men\'s Jewelry',
                'Hats & Caps',
                'Sunglasses & Eyewear',
                'Scarves & Wraps',
                'Belts',
            ],
            'Beauty & Personal Care' => [
                'Massage Tools',
                'Makeup',
                'Skin Care',
                'Hair Care',
                'Fragrance',
                'Personal Care',
            ],
            'Toys & Games' => [
                'Action Figures & Statues',
                'Building Toys',
                'Dolls & Accessories',
                'Puzzles',
                'Remote Control Toys',
            ],
            'Kids\' Fashion' => [
                'Girls\' Clothing',
                'Boys\' Clothing',
                'Baby Clothing',
                'Kids\' Accessories',
            ],
            'Kids\' Shoes' => [
                'Girls\' Shoes',
                'Boys\' Shoes',
                'Baby Shoes',
            ],
            'Baby & Maternity' => [
                'Maternity Clothing',
                'Nursery Bedding & Decor',
                'Feeding & Nursing',
                'Diapering',
            ],
            'Bags & Luggage' => [
                'Backpacks',
                'Handbags & Wallets',
                'Luggage & Travel Gear',
                'Tote Bags',
            ],
            'Patio, Lawn & Garden' => [
                'Patio Furniture',
                'Mowers & Outdoor Power Tools',
                'Plant Support & Care',
                'Watering & Irrigation',
                'Outdoor Holiday Decor',
                'Canopies, Gazebos & Pergolas',
                'Garden Sculptures',
                'Outdoor Storage',
                'Pools & Hot Tubs',
                'Outdoor Carts & Picnic',
                'Pest Control',
                'Grills & Outdoor Cooking',
                'Gardening Tools',
                'Greenhouses & Growing',
                'Yard Signs & Wall Art',
                'Backyard Livestock',
            ],
            'Arts, Crafts & Sewing' => [
                'Crafting Supplies',
                'Sewing & Fabric',
                'Painting & Drawing',
                'Jewelry Making',
            ],
            'Electronics' => [
                'Power Banks',
                'Headphones & Earbuds',
                'Smartwatches & Accessories',
                'Cameras & Photography',
                'Audio & Video Systems',
            ],
            'Business, Industry & Science' => [
                'Industrial Hardware',
                'Lab & Scientific Supplies',
                'Safety & Security Equipment',
                'Commercial Lighting',
            ],
            'Tools & Home Improvement' => [
                'Hand Tools',
                'Power Tools',
                'Electrical Equipment',
                'Plumbing',
                'Building Materials',
            ],
            'Appliances' => [
                'Small Appliances',
                'Kitchen Appliances',
                'Major Appliances',
                'Vacuums & Floor Care',
            ],
            'Office & School Supplies' => [
                'Office Electronics',
                'Writing & Correction Supplies',
                'Notebooks & Paper',
                'Desk Organizers',
            ],
            'Health & Household' => [
                'Vitamins & Supplements',
                'Health Care',
                'Household Cleaning',
                'Paper & Plastic Products',
            ],
            'Pet Supplies' => [
                'Dog Supplies',
                'Cat Supplies',
                'Fish & Aquatics',
                'Bird Supplies',
            ],
            'Cell Phones & Accessories' => [
                'Cell Phone Cases',
                'Chargers & Cables',
                'Screen Protectors',
                'Cell Phone Mounts',
            ],
            'Smart Home' => [
                'Smart Lighting',
                'Smart Plugs & Switches',
                'Security Cameras',
                'Smart Locks',
            ],
            'Musical Instruments' => [
                'Guitars & Accessories',
                'Keyboards & Pianos',
                'Drums & Percussion',
                'Studio & Recording Equipment',
            ],
            'Food & Grocery' => [
                'Snacks & Sweets',
                'Beverages',
                'Pantry Staples',
                'Breakfast Foods',
            ],
            'Books & Media' => [
                'Books',
                'Movies & TV',
                'Music',
                'Magazines',
            ],
            'Beachwear' => [
                'Women\'s Swimwear',
                'Men\'s Swim Trunks',
                'Cover-ups',
                'Beach Towels & Bags',
            ],
            'Furniture' => [
                'Living Room Furniture',
                'Bedroom Furniture',
                'Office Furniture',
                'Kitchen & Dining Furniture',
            ],
        ];

        foreach ($categories as $parentName => $subCategories) {
            $parentSlug = $this->makeUniqueSlug($parentName);

            $parentCategory = Category::create([
                'parent_id' => null,
                'name' => $parentName,
                'slug' => $parentSlug,
            ]);

            foreach ($subCategories as $subName) {
                $subSlug = $this->makeUniqueSlug($subName, $parentName);

                Category::create([
                    'parent_id' => $parentCategory->id,
                    'name' => $subName,
                    'slug' => $subSlug,
                ]);
            }
        }
    }

    private function makeUniqueSlug(string $name, ?string $prefix = null): string
    {
        $baseSlug = Str::slug($prefix ? "{$prefix}-{$name}" : $name);
        $slug = $baseSlug;
        $count = 1;

        while (Category::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$count}";
            $count++;
        }

        return $slug;
    }
}
