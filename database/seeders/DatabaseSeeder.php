<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::disableQueryLog();

        $this->command->info('1. Creating Roles & Permissions...');
        $this->seedRolesAndPermissions();

        $this->command->info('2. Creating Users & Shops...');
        $this->seedUsersAndShops();

        $this->command->info('3. Creating Full Categories...');
        $this->seedFullCategories();

        $this->command->info('4. Creating Attributes & Values...');
        $this->seedAttributes();

        $this->command->info('5. Creating 50,000 Products and related data in chunks...');
        $this->seedMassiveProducts(50000);

        $this->command->info('Seeding completed successfully!');
    }

    private function seedRolesAndPermissions(): void
    {
        $roles = ['admin', 'seller', 'customer'];
        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['name' => $role, 'guard_name' => 'web'],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }

    private function seedUsersAndShops(): void
    {
        $adminId = DB::table('users')->insertGetId([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');
        DB::table('model_has_roles')->insert([
            'role_id' => $adminRoleId,
            'model_type' => User::class,
            'model_id' => $adminId,
        ]);

        $sellerRoleId = DB::table('roles')->where('name', 'seller')->value('id');

        for ($i = 1; $i <= 10; $i++) {
            $sellerId = DB::table('users')->insertGetId([
                'name' => "Seller {$i}",
                'email' => "seller{$i}@example.com",
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('model_has_roles')->insert([
                'role_id' => $sellerRoleId,
                'model_type' => User::class,
                'model_id' => $sellerId,
            ]);

            DB::table('shops')->insert([
                'user_id' => $sellerId,
                'name' => "Shop Store {$i}",
                'slug' => "shop-store-{$i}",
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function seedFullCategories(): void
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
            $parentSlug = Str::slug($parentName);

            $parentCategory = Category::firstOrCreate(
                ['slug' => $parentSlug],
                ['name' => $parentName, 'parent_id' => null]
            );

            foreach ($subCategories as $subName) {
                $subSlug = Str::slug($subName);

                if (Category::where('slug', $subSlug)->exists()) {
                    $subSlug = Str::slug($parentName . '-' . $subName);
                }

                Category::firstOrCreate(
                    ['slug' => $subSlug],
                    ['name' => $subName, 'parent_id' => $parentCategory->id]
                );
            }
        }
    }

    private function seedAttributes(): void
    {
        $attributes = [
            'Color' => ['Red', 'Blue', 'Black', 'White', 'Silver'],
            'Size' => ['S', 'M', 'L', 'XL', 'XXL'],
            'Storage' => ['64GB', '128GB', '256GB', '512GB']
        ];

        foreach ($attributes as $name => $values) {
            $attrId = DB::table('attributes')->insertGetId([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($values as $val) {
                DB::table('attribute_values')->insert([
                    'attribute_id' => $attrId,
                    'value' => $val,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function seedMassiveProducts(int $totalProducts): void
    {
        $shopIds = DB::table('shops')->pluck('id')->toArray();
        $categoryIds = DB::table('categories')->whereNotNull('parent_id')->pluck('id')->toArray();
        $attributeValueIds = DB::table('attribute_values')->pluck('id')->toArray();
        $customerIds = DB::table('users')->pluck('id')->toArray();

        if (empty($customerIds) || empty($shopIds) || empty($categoryIds)) {
            $this->command->error('Users, Shops, or Categories table is empty!');
            return;
        }

        $chunkSize = 1000; // کاهش حجم چنک برای جلوگیری از عبور از سقف پارامترهای PDO
        $now = now()->toDateTimeString();

        $latestProductId = DB::table('products')->max('id') ?? 0;
        $latestVariantId = DB::table('product_variants')->max('id') ?? 0;

        $comments = [
            'Great quality product, highly recommended!',
            'Fast shipping and good packaging.',
            'Average quality for the price.',
            'Totally satisfied with this purchase.',
            'Not as expected, but customer service was good.'
        ];

        for ($i = 0; $i < $totalProducts; $i += $chunkSize) {
            $products = [];
            $variants = [];
            $specifications = [];
            $images = [];
            $pivotAttributeVariants = [];
            $reviews = [];

            $currentChunk = min($chunkSize, $totalProducts - $i);

            for ($j = 1; $j <= $currentChunk; $j++) {
                $latestProductId++;
                $pId = $latestProductId;
                $basePrice = rand(10, 1000);

                // ۱. محصول
                $products[] = [
                    'id' => $pId,
                    'shop_id' => $shopIds[array_rand($shopIds)],
                    'category_id' => $categoryIds[array_rand($categoryIds)],
                    'name' => "Product Item {$pId} " . Str::random(5),
                    'slug' => "product-item-{$pId}-" . Str::random(6),
                    'description' => "This is a high quality description for product number {$pId}.",
                    'base_price' => $basePrice,
                    'is_active' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                // ۲. عکس
                $images[] = [
                    'product_id' => $pId,
                    'product_variant_id' => null,
                    'path' => "products/default-{$pId}.jpg",
                    'is_primary' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                // ۳. مشخصات
                $specifications[] = [
                    'product_id' => $pId,
                    'key' => 'Brand',
                    'value' => 'Brand ' . rand(1, 20),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                // ۴. تنوع (Variant)
                $variantCount = rand(1, 2);
                for ($v = 0; $v < $variantCount; $v++) {
                    $latestVariantId++;
                    $vId = $latestVariantId;

                    $variants[] = [
                        'id' => $vId,
                        'product_id' => $pId,
                        'sku' => "SKU-{$pId}-{$vId}-" . Str::random(4),
                        'price' => $basePrice + rand(0, 50),
                        'stock' => rand(5, 200),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];

                    if (!empty($attributeValueIds)) {
                        $pivotAttributeVariants[] = [
                            'product_variant_id' => $vId,
                            'attribute_value_id' => $attributeValueIds[array_rand($attributeValueIds)],
                        ];
                    }
                }

                // ۵. ثبت ۱ تا ۲ نظر (Review)
                $reviewCount = rand(1, 2);
                for ($r = 0; $r < $reviewCount; $r++) {
                    $reviews[] = [
                        'product_id' => $pId,
                        'user_id' => $customerIds[array_rand($customerIds)],
                        'rating' => rand(3, 5),
                        'comment' => $comments[array_rand($comments)],
                        'is_approved' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }

            // درج حجمی امن
            DB::table('products')->insert($products);
            DB::table('product_images')->insert($images);
            DB::table('product_specifications')->insert($specifications);
            DB::table('product_variants')->insert($variants);

            if (!empty($pivotAttributeVariants)) {
                DB::table('attribute_value_product_variant')->insert($pivotAttributeVariants);
            }

            // تقسیم Reviewها به دسته‌های ۵۰۰ تایی برای جلوگیری از ارور سقف کوئری
            foreach (array_chunk($reviews, 500) as $reviewChunk) {
                DB::table('reviews')->insert($reviewChunk);
            }

            $insertedSoFar = $i + $currentChunk;
            $this->command->info("--> Inserted {$insertedSoFar} / {$totalProducts} products with reviews...");
        }
    }
}
