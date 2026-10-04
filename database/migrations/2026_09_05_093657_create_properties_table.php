<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            $table->string('title', 255);
            $table->string('slug', 255)->unique();

            $table->foreignId('property_type_id')
                ->constrained('property_types')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('location_id')
                ->constrained('locations')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('agent_id')
                ->nullable()
                ->constrained('agents')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->enum('purpose', ['sale', 'rent']);

            $table->decimal('price', 15, 2);

            $table->decimal('area', 12, 2)->nullable();

            $table->unsignedInteger('bedrooms')->nullable();
            $table->unsignedInteger('bathrooms')->nullable();
            $table->unsignedInteger('garages')->nullable();

            $table->text('address')->nullable();

            $table->longText('description')->nullable();

            $table->enum('status', [
                'available',
                'sold',
                'rented',
                'pending'
            ])->default('available');

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('purpose');
            $table->index('status');
            $table->index('is_featured');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};