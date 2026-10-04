<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->enum('approval_status', [
                'pending',
                'approved',
                'rejected',
            ])
                ->default('pending')
                ->after('status')
                ->index();
        });

        /*
         * Existing active properties ko approved maan rahe hain,
         * taaki existing public listings hide na ho jayein.
         *
         * Jo property already "pending" status me hai,
         * use approval ke liye pending hi rakhenge.
         */
        DB::table('properties')
            ->where('is_active', true)
            ->where('status', '!=', 'pending')
            ->update([
                'approval_status' => 'approved',
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('approval_status');
        });
    }
};