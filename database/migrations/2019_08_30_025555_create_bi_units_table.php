<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('i_project_id')->unsigned()->index()->nullable();
            $table->foreign('i_project_id')->references('id')->on('i_projects');
            $table->string('unit_number', 191);
            $table->integer('seller_id')->unsigned()->index();
            $table->foreign('seller_id')->references('id')->on('users');
            $table->integer('i_position_id')->unsigned()->index()->nullable();
            $table->foreign('i_position_id')->references('id')->on('i_positions');
            $table->integer('i_view_id')->unsigned()->index()->nullable();
            $table->foreign('i_view_id')->references('id')->on('i_views');
            $table->integer('area')->nullable();
            $table->integer('plot_area')->nullable();
            $table->integer('build_up_area')->nullable();
            $table->integer('i_bedroom_id')->unsigned()->index()->nullable();
            $table->foreign('i_bedroom_id')->references('id')->on('i_bedrooms');
            $table->integer('i_bathroom_id')->unsigned()->index()->nullable();
            $table->foreign('i_bathroom_id')->references('id')->on('i_bathrooms');
            $table->integer('i_purpose_id')->unsigned()->index()->nullable();
            $table->foreign('i_purpose_id')->references('id')->on('i_purposes');
            $table->integer('i_purpose_type_id')->unsigned()->index()->nullable();
            $table->foreign('i_purpose_type_id')->references('id')->on('i_purpose_types');
            $table->integer('country_id')->unsigned()->index()->nullable();
            $table->foreign('country_id')->references('id')->on('locations');
            $table->integer('region_id')->unsigned()->index()->nullable();
            $table->foreign('region_id')->references('id')->on('locations');
            $table->integer('city_id')->unsigned()->index()->nullable();
            $table->foreign('city_id')->references('id')->on('locations');
            $table->string('latitude', 191)->nullable();
            $table->string('longitude', 191)->nullable();
            $table->mediumText('address')->nullable();
            $table->integer('i_offering_type_id')->unsigned()->index()->nullable();
            $table->foreign('i_offering_type_id')->references('id')->on('i_offering_types');
            $table->integer('price')->nullable();
            $table->text('description')->nullable();
            $table->integer('i_payment_method_id')->unsigned()->index()->nullable();
            $table->foreign('i_payment_method_id')->references('id')->on('i_payment_methods');
            $table->integer('buyer_id')->unsigned()->index()->nullable();
            $table->foreign('buyer_id')->references('id')->on('users');
            $table->integer('down_payment')->nullable();
            $table->integer('number_of_installments')->nullable();
            $table->string('currency_code', 191)->index()->nullable();
            $table->integer('i_area_unit_id')->unsigned()->index()->nullable();
            $table->foreign('i_area_unit_id')->references('id')->on('i_area_units');
            $table->integer('i_furnishing_status_id')->unsigned()->index()->nullable();
            $table->foreign('i_furnishing_status_id')->references('id')->on('i_furnishing_statuses');
            $table->integer('i_finishing_type_id')->unsigned()->index()->nullable();
            $table->foreign('i_finishing_type_id')->references('id')->on('i_finishing_types');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('i_units');
    }
}
