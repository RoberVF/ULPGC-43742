<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name' => 'Test Company',
            'slug' => 'test-company',
            'logo' => 'no-logo.png',
            'is_active' => true,
            'settings' => null,
        ]);

        User::create([
            'name' => 'Staff Roberto',
            'email' => 'user@ejemplo.com',
            'password' => Hash::make('password'),
            'role' => RoleType::Staff,
            'company_id' => 1,
            'is_company_root' => true,
        ]);

        Category::create([
            'name' => 'Test Category',
            'company_id' => 1,
            'slug' => 'test-category',
            'description' => 'This is a test category.',
        ]);

        Product::create([
            'category_id' => 1,
            'company_id' => 1,
            'sku' => 'TEST-001',
            'name' => 'Test Product',
            'description' => 'This is a test product.',
            'image_path' => 'no-image.png',
            'purchase_price' => 10.00,
            'sale_price' => 15.00,
            'security_stock' => 5,
        ]);

        Warehouse::create([
            'name' => 'Main Warehouse',
            'company_id' => 1,
            'location' => '123 Main St, City, Country',
            'is_active' => true,
        ]);

        StockMovement::create([
            'product_id' => 1,
            'warehouse_id' => 1,
            'user_id' => 2,
            'company_id' => 1,
            'quantity' => 100,
            'type' => 'exit',
            'reference' => 'Initial Stock',
        ]);
    }
}
