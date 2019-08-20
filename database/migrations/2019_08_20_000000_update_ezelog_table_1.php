<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEzelogTable1 extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        $config = config('ezelog');
        $tableName = $config['table_name'];
        Schema::table($tableName, function (Blueprint $table)
        {
            try {
                $table->string('from_ip', 64)->change();
                $table->string('log_type', 10)->default('audit')->index(); // type of system or audit
            }
            catch (\Illuminate\Database\QueryException $ex) {
                echo $ex->getMessage();
            }
            catch (\PDOException $ex) {
                echo $ex->getMessage();
            }
        });
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
    {
        $config = config('ezelog');
        $tableName = $config['table_name'];

        Schema::table($tableName, function(Blueprint $table)
        {
            if (Schema::hasTable($tableName)) {
                try {
                    $table->dropColumn('log_type');
                }
                catch (\Exception $ex) {
                    echo $ex->getMessage();
                }
            }
        });
	}
}
