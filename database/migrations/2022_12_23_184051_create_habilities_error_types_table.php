<?php

use App\Models\ErrorType;
use App\Models\Hability;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habilities_error_types', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Hability::class, "hability_id")->constrained();
            $table->foreignIdFor(ErrorType::class,"error_type_id")->references("id")->on("error_types")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('habilities_error_types');
    }
};
