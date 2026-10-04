<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE property_transactions
            MODIFY status ENUM(
                'pending',
                'approved',
                'rejected',
                'completed',
                'cancelled'
            ) NOT NULL DEFAULT 'pending'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE property_transactions
            MODIFY status ENUM(
                'pending',
                'approved',
                'rejected',
                'completed'
            ) NOT NULL DEFAULT 'pending'
        ");
    }
};