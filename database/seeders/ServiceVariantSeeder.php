<?php

namespace Database\Seeders;

use App\Models\ServiceVariant;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceVariantSeeder extends Seeder
{
    public function run(): void
    {
        // Variantes de Sitio Web Responsivo
        $webResp = Service::where('name', 'Sitio Web Responsivo')->first();

        ServiceVariant::create([
            'service_id' => $webResp->id,
            'name' => 'Paquete Básico',
            'sku' => 'WEB-BASIC',
            'cost_price' => 500.00,
            'sale_price' => 1200.00,
            'features' => json_encode([
                'pages' => 5,
                'designs' => 1,
                'domains' => 1,
                'ssl' => true,
                'support_months' => 3,
                'mobile_responsive' => true
            ]),
            'delivery_days' => 14,
            'revisions_included' => 2
        ]);

        ServiceVariant::create([
            'service_id' => $webResp->id,
            'name' => 'Paquete Profesional',
            'sku' => 'WEB-PRO',
            'cost_price' => 1000.00,
            'sale_price' => 2500.00,
            'features' => json_encode([
                'pages' => 10,
                'designs' => 3,
                'domains' => 2,
                'ssl' => true,
                'support_months' => 6,
                'mobile_responsive' => true,
                'seo_optimization' => true
            ]),
            'delivery_days' => 21,
            'revisions_included' => 5
        ]);

        ServiceVariant::create([
            'service_id' => $webResp->id,
            'name' => 'Paquete Premium',
            'sku' => 'WEB-PREMIUM',
            'cost_price' => 1500.00,
            'sale_price' => 4000.00,
            'features' => json_encode([
                'pages' => 'Ilimitadas',
                'designs' => 5,
                'domains' => 3,
                'ssl' => true,
                'support_months' => 12,
                'mobile_responsive' => true,
                'seo_optimization' => true,
                'blog_integration' => true,
                'newsletter' => true
            ]),
            'delivery_days' => 30,
            'revisions_included' => 10
        ]);

        // Variantes de E-commerce
        $ecommerce = Service::where('name', 'Tienda E-commerce')->first();

        ServiceVariant::create([
            'service_id' => $ecommerce->id,
            'name' => 'E-commerce Básico',
            'sku' => 'ECOM-BASIC',
            'cost_price' => 800.00,
            'sale_price' => 1800.00,
            'features' => json_encode([
                'products' => 50,
                'payment_methods' => 2,
                'pages' => 8,
                'ssl' => true,
                'support_months' => 3
            ]),
            'delivery_days' => 21,
            'revisions_included' => 3
        ]);

        ServiceVariant::create([
            'service_id' => $ecommerce->id,
            'name' => 'E-commerce Premium',
            'sku' => 'ECOM-PREM',
            'cost_price' => 1500.00,
            'sale_price' => 3500.00,
            'features' => json_encode([
                'products' => 500,
                'payment_methods' => 5,
                'pages' => 15,
                'ssl' => true,
                'support_months' => 6,
                'inventory_system' => true,
                'email_marketing' => true
            ]),
            'delivery_days' => 30,
            'revisions_included' => 5
        ]);

        // Variantes de Logo
        $logo = Service::where('name', 'Diseño de Logo')->first();

        ServiceVariant::create([
            'service_id' => $logo->id,
            'name' => 'Logo Simple',
            'sku' => 'LOGO-SIMPLE',
            'cost_price' => 100.00,
            'sale_price' => 300.00,
            'features' => json_encode([
                'concepts' => 3,
                'revisions' => 3,
                'formats' => ['PNG', 'JPG', 'SVG']
            ]),
            'delivery_days' => 7,
            'revisions_included' => 3
        ]);

        ServiceVariant::create([
            'service_id' => $logo->id,
            'name' => 'Logo Premium',
            'sku' => 'LOGO-PREM',
            'cost_price' => 250.00,
            'sale_price' => 700.00,
            'features' => json_encode([
                'concepts' => 5,
                'revisions' => 5,
                'formats' => ['PNG', 'JPG', 'SVG', 'PDF'],
                'brand_guide' => true
            ]),
            'delivery_days' => 14,
            'revisions_included' => 5
        ]);

        // Variantes de Identidad Corporativa
        $identidad = Service::where('name', 'Identidad Corporativa Completa')->first();

        ServiceVariant::create([
            'service_id' => $identidad->id,
            'name' => 'Identidad Corporativa Completa',
            'sku' => 'BRAND-COMPLETE',
            'cost_price' => 500.00,
            'sale_price' => 1500.00,
            'features' => json_encode([
                'logo' => true,
                'brand_guide' => true,
                'business_cards' => true,
                'letterhead' => true,
                'envelope' => true,
                'concepts' => 3
            ]),
            'delivery_days' => 21,
            'revisions_included' => 4
        ]);

        // Variantes de Redes Sociales (por hora)
        $redes = Service::where('name', 'Gestión de Redes Sociales')->first();

        ServiceVariant::create([
            'service_id' => $redes->id,
            'name' => 'Consultoría por Hora',
            'sku' => 'REDES-HORA',
            'cost_price' => 25.00,
            'sale_price' => 75.00,
            'features' => json_encode([
                'unit' => 'hora',
                'includes' => 'Asesoramiento y estrategia'
            ]),
            'delivery_days' => 1,
            'revisions_included' => 0
        ]);

        ServiceVariant::create([
            'service_id' => $redes->id,
            'name' => 'Paquete Mensual',
            'sku' => 'REDES-MES',
            'cost_price' => 400.00,
            'sale_price' => 999.00,
            'features' => json_encode([
                'platforms' => 3,
                'posts_monthly' => 20,
                'stories' => true,
                'engagement' => true,
                'monthly_report' => true
            ]),
            'delivery_days' => 30,
            'revisions_included' => 10
        ]);

        // Variantes de Publicidad Digital
        $pubDigital = Service::where('name', 'Campaña de Publicidad Digital')->first();

        ServiceVariant::create([
            'service_id' => $pubDigital->id,
            'name' => 'Campaña Estándar',
            'sku' => 'PUB-STANDARD',
            'cost_price' => 300.00,
            'sale_price' => 800.00,
            'features' => json_encode([
                'platforms' => ['Facebook', 'Instagram'],
                'duration_days' => 30,
                'budget' => '$500-1000',
                'reports' => true
            ]),
            'delivery_days' => 3,
            'revisions_included' => 2
        ]);

        ServiceVariant::create([
            'service_id' => $pubDigital->id,
            'name' => 'Campaña Premium',
            'sku' => 'PUB-PREM',
            'cost_price' => 600.00,
            'sale_price' => 1500.00,
            'features' => json_encode([
                'platforms' => ['Facebook', 'Instagram', 'Google Ads', 'TikTok'],
                'duration_days' => 60,
                'budget' => '$1500-3000',
                'reports' => true,
                'daily_monitoring' => true,
                'optimization' => true
            ]),
            'delivery_days' => 3,
            'revisions_included' => 5
        ]);
    }
}