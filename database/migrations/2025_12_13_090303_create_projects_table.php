<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); // ID
            $table->string('title'); // Project Title
            $table->enum('status', ['ongoing', 'completed', 'archived'])
                  ->default('ongoing'); // Status
            $table->text('description')->nullable(); // Description
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
