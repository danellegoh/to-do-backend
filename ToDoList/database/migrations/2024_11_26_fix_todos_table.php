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
        Schema::table('todos', function (Blueprint $table) {
            // Drop existing columns if they exist
            if (Schema::hasColumn('todos', 'task')) {
                $table->dropColumn('task');
            }
            if (Schema::hasColumn('todos', 'completed')) {
                $table->dropColumn('completed');
            }
            
            // Add new columns if they don't exist
            if (!Schema::hasColumn('todos', 'description')) {
                $table->string('description')->nullable(false);
            }
            if (!Schema::hasColumn('todos', 'is_done')) {
                $table->boolean('is_done')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            // Drop new columns if they exist
            if (Schema::hasColumn('todos', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('todos', 'is_done')) {
                $table->dropColumn('is_done');
            }
            
            // Add back original columns
            if (!Schema::hasColumn('todos', 'task')) {
                $table->string('task');
            }
            if (!Schema::hasColumn('todos', 'completed')) {
                $table->boolean('completed')->default(false);
            }
        });
    }
};
