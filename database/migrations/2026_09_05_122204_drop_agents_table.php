<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('agents');
    }

    public function down(): void
    {
        // Old agents table is intentionally removed.
    }
};