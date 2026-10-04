<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('property_transactions', function (Blueprint $table) {

            $table->id();

            // USER
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // PROPERTY
            $table->foreignId('property_id')
                ->constrained('properties')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // BUY / RENT
            $table->enum('type', [
                'buy',
                'rent',
            ]);

            // PROPERTY PRICE AT THE TIME OF REQUEST
            $table->decimal('amount', 15, 2);

            // USER CONTACT DETAILS AT THE TIME OF REQUEST
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('phone', 20);

            // USER ADDRESS
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('pincode', 20)->nullable();

            // REQUEST STATUS
            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'completed',
            ])->default('pending');

            // ADMIN NOTE
            $table->text('admin_note')->nullable();

            $table->timestamps();

            // INDEXES
            $table->index('user_id');
            $table->index('property_id');
            $table->index('type');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_transactions');
    }
};