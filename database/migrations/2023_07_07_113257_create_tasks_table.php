<?php

use App\Models\Category;
use App\Models\Priority;
use App\Models\Schedule;
use App\Models\Status;
use App\Models\User;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->foreignIdFor(User::class, 'iduser');
            $table->foreignIdFor(Status::class, 'status_id');
            $table->foreignIdFor(Priority::class, 'priority_id');
            $table->foreignIdFor(Schedule::class, 'schedule_id');
            $table->foreignIdFor(Category::class, 'idcategory');
            $table->timestamps();


            // $table->dateTime('dtInicio');
            // $table->boolean('status_task');
            // $table->foreignIdFor(User::class, 'iduser');
            // $table->foreignIdFor(Category::class, 'idcategory');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
