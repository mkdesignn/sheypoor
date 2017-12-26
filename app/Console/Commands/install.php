<?php

namespace App\Console\Commands;

use App\ThemeDependencies\Seed;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install the theme';

    /**
     * @var Seed|\Seed
     */
    protected $seed;

    /**
     * @var
     */
    protected $tables;

    /**
     * @var
     */
    protected $username;

    /**
     * @var
     */
    protected $password;

    /**
     * Create a new command instance.
     * @param Seed|\Seed $seed
     */
    public function __construct(Seed $seed)
    {
        parent::__construct();
        $this->seed = $seed;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // connect to database
        $this->connectToDatabase();

        // re render the config cache file
//        $this->call("config:clear");


        // migrate the tables
        $this->call("migrate");

        //generates model
        $this->generateModel();

        // scaffold the model tables with appropriate data
        $this->scaffoldModel();

        // seed the tables
        $this->seed();

        // run composer update
        exec('composer update');

        // run npm install
        exec('npm install');

        // what menu you need to have for the sidebar and what sub menu it does need.


    }

    /**
     * @param $environmentName
     * @param $configKey
     * @param $newValue
     */
    private function setEnvironmentValue($environmentName, $configKey, $newValue) {

        file_put_contents(App::environmentFilePath(), str_replace(
            $environmentName . '=' . env($configKey),
            $environmentName . '=' . $newValue,
            file_get_contents(App::environmentFilePath())
        ));

    }

    /**
     *
     */
    public function connectToDatabase(){

        try {
            $database_driver = $this->ask("tell me your host driver", 'mysql');
            $database_host = $this->ask("tell me your host", 'localhost');
            $database_port_number = $this->ask("tell me your database port number", '3306');
            $database_name = $this->ask("tell me your database name", '');
            $database_user_name = $this->ask("tell me your database username");
            $database_password = $this->ask("tell me your database password", false);
            $webapp_address = $this->ask("tell me your webapp address", false);
            $webapp_name = $this->ask("tell me your webapp name", false);
            $this->username = $this->ask("tell me your username", false);
            $this->password = $this->ask("tell me your password", false);


            $pdo = new \PDO($database_driver . ":host=" . $database_host . ";port=" . $database_port_number . ';dbname=' . $database_name, $database_user_name, $database_password);

            $this->call('config:clear');

            Config::set('database.connections.mysql.host', $database_host);
            Config::set('database.connections.mysql.driver', $database_driver);
            Config::set('database.connections.mysql.port', $database_host);
            Config::set('database.connections.mysql.database', $database_name);
            Config::set('database.connections.mysql.username', $database_user_name);
            Config::set('database.connections.mysql.password', $database_password);

            $this->setEnvironmentValue("DB_CONNECTION", 'DB_CONNECTION', $database_driver);
            $this->setEnvironmentValue("DB_HOST", 'DB_HOST', $database_host);
            $this->setEnvironmentValue("DB_PORT", 'DB_PORT', $database_port_number);
            $this->setEnvironmentValue("DB_DATABASE", 'DB_DATABASE', $database_name);
            $this->setEnvironmentValue("DB_USERNAME", 'DB_USERNAME', $database_user_name);
            $this->setEnvironmentValue("DB_PASSWORD", 'DB_PASSWORD', $database_password);
            $this->setEnvironmentValue("APP_URL", 'APP_URL', $webapp_address);
            $this->setEnvironmentValue("WEBAPP_TITLE", 'WEBAPP_TITLE', $webapp_name);

        } catch(\Exception $ex){

            $this->comment("there was some error in connecting to the database please be sure you have the database .");
            $this->connectToDatabase();
        }
    }

    /**
     * seed the table
     */
    private function seed(){

        // clear all tables data
        foreach( $this->tables as $table ){
            DB::table($table)->delete();
        }

        // fill status table
        $this->seed->makeStatus();

        // fill the roles table
        $this->seed->makeRole();

        // create one user
        factory(User::class)->create([ 'username'=> $this->username, 'password' => Hash::make($this->password), "role_id" => "8" ]);

    }


    /**
     * scaffold model
     */
    private function scaffoldModel(){

        // get all tables
        $php_files = preg_grep("/\\.php/", scandir(app_path()));
        foreach( $php_files as $table ){

            // change the file name to class name
            $table = snake_case(str_replace(".php", "", $table));

            // get the class columns
            $columns = DB::getSchemaBuilder()->getColumnListing(str_plural($table));
            $this->tables[] = str_plural($table);

            // build the table and fillable table
            $protected_tables = 'protected $table = "'.str_plural($table).'";';
            $protect_columns = 'protected $fillable = [';
            foreach( $columns as $column ){
                if( $column != 'created_at' && $column != 'updated_at' && $column != "id"){
                    $protect_columns .= "'".$column."' ,";
                }
            }

            $protect_columns = substr($protect_columns, 0, strlen($protect_columns) - 1);
            $protect_columns .= "];";

            // if table was user
            if( $table === 'user' )
                $protect_columns .= " \n \n ".$this->addUserMethod()." \n \n ";

            $file_content = file_get_contents(app_path()."/".camel_case($table).".php");

            //replace the content between {  }
            $first_curly_braces = stripos($file_content, "{");
            $file_content = substr($file_content, 0, $first_curly_braces);

            $file_content .= "{ \n \n \t".$protected_tables."\n \n \t".$protect_columns." \n }";
            file_put_contents(app_path()."/".camel_case($table).".php", $file_content);

        }
    }

    private function addUserMethod(){
        return '
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles(){
        return $this->hasMany("App\\Role", "id", "role_id");
    }

    /**
     * @param $query
     * @param $parameters
     * @param $value
     */
    public function scopeSearch($query, $parameters, $value){

        foreach( $parameters as $key => $parameter ){
            if( $key == 0 )
                $query->where($parameter[0], "LIKE", "%".$value."%");
            else
                $query->orWhere($parameter[0], "LIKE", "%".$value."%");

        }
    }';
    }

    /**
     * generate models
     */
    private function generateModel(){

        exec('php artisan make:model Category');
        exec('php artisan make:model Comment');
        exec('php artisan make:model File');
        exec('php artisan make:model Meta');
        exec('php artisan make:model Post');
        exec('php artisan make:model PostCategory');
        exec('php artisan make:model Role');
        exec('php artisan make:model Status');
        exec('php artisan make:model Tag');
        exec('php artisan make:model User');
        exec('php artisan make:model UserMeta');
        exec('php artisan make:model UserRole');

    }
}
