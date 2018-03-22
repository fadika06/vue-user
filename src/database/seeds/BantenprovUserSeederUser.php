<?php

use Illuminate\Database\Seeder;

/**
 * Usage : 
 * [1] $ composer dump-autoload -o
 * [2] $ php artisan db:seed --class=UserSeeder
 */

class BantenprovUserSeederUser extends Seeder
{
    /* text color */
    protected $RED     ="\033[0;31m";
    protected $CYAN    ="\033[0;36m";
    protected $YELLOW  ="\033[1;33m";
    protected $ORANGE  ="\033[0;33m"; 
    protected $PUR     ="\033[0;35m";
    protected $GRN     ="\e[32m";
    protected $WHI     ="\e[37m";
    protected $NC      ="\033[0m";

    /* File name */
    /* location : /databse/seeds/file_name.csv */
    protected $fileName = "BantenprovUserSeederUser.csv";

    /* text info : default (true) */
    protected $textInfo = true;

    /* model class */
    protected $model;

    /* __construct */
    public function __construct(){

        $this->model = new App\User;

    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $this->insertData();
    }

    /* function insert data */
    protected function insertData()
    {
        /* silahkan di rubah sesuai kebutuhan */
        foreach($this->readCSV() as $data){ 
            $password['p1'] = rand(1376123,999234999);
            $password['p2'] = rand(785482,9785482);            

            $this->model->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($password['p1'].$password['p2'])
            ]);
            
            if($this->textInfo){                
                echo "============[Account]============\n";
                $this->orangeText('name : ').$this->greenText($data['name']);
                echo"\n";
                $this->orangeText('email : ').$this->greenText($data['email']);
                echo"\n";
                $this->orangeText('password : ').$this->greenText($password['p1'].$password['p2']);
                echo"\n";
                echo "============[Account]============\n\n";
            }
            
        }

        $this->greenText('[ SEEDER DONE ]');
        echo"\n\n";
    }

    /* text color: orange */
    protected function orangeText($text)
    {    
        printf($this->ORANGE.$text.$this->NC);
    }

    /* text color: green */
    protected function greenText($text)
    {    
        printf($this->GRN.$text.$this->NC);
    }

    /* function read CSV file */
    protected function readCSV()
    {

        $file = fopen(database_path("seeds/".$this->fileName), "r");
        $all_data = array();
        $row = 1;
        while(($data = fgetcsv($file, 1000, ",")) !== FALSE){            
            $all_data[] = ['name' => $data[0], 'email' => $data[1]];
        }        
        fclose($file);

        return  $all_data;
    }
}
