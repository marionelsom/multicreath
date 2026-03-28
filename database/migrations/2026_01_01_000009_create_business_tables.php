<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('discount_percentage', 5, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->text('address')->nullable();
            $table->unsignedBigInteger('customer_type_id')->nullable();
            $table->string('nit')->nullable();
            $table->string('company_name')->nullable();
            $table->string('contact_person')->nullable();
            $table->decimal('credit_limit', 10, 2)->nullable();
            $table->decimal('credit_used', 10, 2)->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('customer_type_id')->references('id')->on('customer_types')->onDelete('set null');
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('order_number')->unique();
            $table->enum('status', ['pendiente', 'procesando', 'completado', 'cancelado', 'enviado'])->default('pendiente');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->enum('payment_method', ['efectivo', 'tarjeta', 'transferencia'])->nullable();
            $table->enum('payment_status', ['pendiente', 'pagado', 'parcial'])->default('pendiente');
            $table->text('shipping_address')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_variant_id');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->json('custom_design')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_variant_id')->references('id')->on('product_variants');
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['propuesta', 'en_proceso', 'completado', 'cancelado'])->default('propuesta');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('budget', 10, 2)->default(0);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
        });

        Schema::create('project_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('service_variant_id');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->enum('status', ['pendiente', 'en_proceso', 'completado'])->default('pendiente');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('service_variant_id')->references('id')->on('service_variants');
        });

        Schema::create('project_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->enum('type', ['inicio', 'progreso', 'entrega', 'cambio', 'pausa', 'completado']);
            $table->text('description');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('quotation_number')->unique();
            $table->enum('type', ['producto', 'servicio', 'mixto'])->default('mixto');
            $table->enum('status', ['borrador', 'enviado', 'aceptado', 'rechazado'])->default('borrador');
            $table->json('items')->nullable();
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->date('valid_until')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('invoice_number')->unique();
            $table->enum('status', ['pendiente', 'pagada', 'parcial', 'anulada'])->default('pendiente');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->timestamp('issued_at')->nullable();
            $table->date('due_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('quotations');
        Schema::dropIfExists('project_movements');
        Schema::dropIfExists('project_services');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('customer_types');
    }
};
