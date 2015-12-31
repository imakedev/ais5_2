<?php 
namespace App\Http\Controllers; 
use Illuminate\Database\Eloquent\Model as Eloquent;
use DB;

class ParentRegionList extends Eloquent{

    protected $connection = 'mysql_ais_pd'; // this will use the specified database conneciton
    protected $table = "book_db"; // set table name

    public $timestamps = false;

    public static function destinationSearch(){

        $query = new ParentRegionList;
        $query = DB::connection($query->connection);
        $query = DB::table($query->table)->where('id', '1')->get();


        $query = DB::getQueryLog();
        dd($query);
    }
}
?>