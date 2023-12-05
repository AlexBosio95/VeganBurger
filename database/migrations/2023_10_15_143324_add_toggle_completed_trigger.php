<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToggleCompletedTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER update_order_status
        AFTER UPDATE ON orderitems
        FOR EACH ROW
        BEGIN
            DECLARE total_completed INT;
            DECLARE total_items INT;

            SELECT COUNT(*) INTO total_completed FROM orderitems WHERE order_id = NEW.order_id AND completed = 1;
            SELECT COUNT(*) INTO total_items FROM orderitems WHERE order_id = NEW.order_id;

            IF total_completed = total_items THEN
                UPDATE orders SET status = "completed" WHERE id = NEW.order_id;
            ELSE
                UPDATE orders SET status = "incomplete" WHERE id = NEW.order_id;
            END IF;
        END;
    ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
