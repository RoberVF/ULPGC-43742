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

class DebugTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name' => 'Test Company 2',
            'slug' => 'test-company-2',
            'logo' => 'no-logo.png',
            'is_active' => true,
            'settings' => null,
        ]);

        User::create([
            'name' => 'Staff Miguel',
            'email' => 'miguel@ejemplo.com',
            'password' => Hash::make('password'),
            'role' => RoleType::Staff,
            'company_id' => 2,
            'is_company_root' => true,
        ]);

        Category::create([
            'name' => 'Test Category 2',
            'company_id' => 2,
            'slug' => 'test-category-2',
            'description' => 'This is a test category.',
        ]);

        Product::create([
            'category_id' => 2,
            'company_id' => 2,
            'sku' => 'TEST-002',
            'name' => 'Test Product 2',
            'description' => 'This is a test product.',
            'image_path' => 'no-image.png',
            'purchase_price' => 1.00,
            'sale_price' => 5.00,
            'security_stock' => 10,
        ]);

        Warehouse::create([
            'name' => 'Main Warehouse',
            'company_id' => 2,
            'location' => '123 Main St, City, Country',
            'is_active' => true,
        ]);

        StockMovement::create([
            'product_id' => 2,
            'warehouse_id' => 2,
            'user_id' => 3,
            'company_id' => 2,
            'quantity' => 100,
            'type' => 'exit',
            'reference' => 'Initial Stock',
        ]);
    }
}
