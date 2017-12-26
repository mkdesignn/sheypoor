<?php

class Climate
{

    protected $lang;
    protected $lat;
    protected $status;

    function __construct($lang, $lat)
    {
        $this->lang = $lang;
        $this->lat  = $lat;

        $this->status = ["partly-cloudy-night"=>"نیمه ابری",
        "partly-cloudy-day"=>"نیمه ابری", "cloudy"=>"نیمه ابری",
        "fog"=>"نیمه ابری", "wind"=>"آفتابی", "storm"=>"طوفانی", "snow"=>"بارانی",
        "rain"=>"بارانی", "clear-night"=>"آفتابی", "clear-day"=> "آفتابی", "Sunny"=>"آفتابی",
            "Mostly Sunny"=>"آفتابی", "Rain"=>"ابری", "Mostly Cloudy"=>"ابری",
            "Partly Cloudy"=>"نیمه ابری", "Cloudy"=>"ابری", "wi-windy"=>"طوفانی"];
    }

    function show(){

        try{
            $endpoint = 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20text%3D%22iran%2C%20ahvaz%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys';
            $result = file_get_contents($endpoint);
            $data = json_decode($result);
            $data = $data->query->results->channel->item->forecast;

            $icons = [
                'Partly Cloudy'=>"wi-day-cloudy",
                'Sunny'=>'wi-day-sunny',
                'Mostly Sunny' =>'wi-day-sunny',
                'clear-day' => 'wi-day-sunny',
                'clear-night' => 'wi-night-clear',
                'rain'=>'wi-rain',
                'snow'=>'wi-snow',
                'sleet'=>'wi-leet',
                'wind'=>'wi-windy',
                'fog'=>'wi-fog',
                'Cloudy'=>'wi-cloudy',
                'partly-cloudy-day'=>'wi-day-cloudy',
                'partly-cloudy-night'=>'wi-night-cloudy',
                "Mostly Cloudy"=>'wi-cloudy',
                "Rain"=>"wi-rain",
                "Showers"=>"wi-rain",
                "Scattered Thunderstorms"=>"wi-windy"
            ];

            $weather = [
                'clear-day' => 'sunny',
                'clear-night' => 'sunny',
                'rain'=>'rain',
                'snow'=>'rain',
                'sleet'=>'storm',
                'wind'=>'sunny',
                'fog'=>'drizzle',
                'cloudy'=>'drizzle',
                'partly-cloudy-day'=>'drizzle',
                'partly-cloudy-night'=>'drizzle'
            ];

            $days = ["Fri"=>"جمعه", "Sat"=>"شنبه", "Sun"=>"یکشنبه", "Mon"=>"دوشنبه",
                "Tue"=>"سشنبه", "Wed"=>"چهارشنبه", "Thu"=>"پنجشنبه"];


            $html = "";
            $j= 0;

            foreach ($data as $key => $day) {
                if( $j >= 4 )
                    break;

                $temperatureMin = sprintf("%01.0f", $day->high);
                $temperatureMax = sprintf("%01.0f", $day->low);
                $temp_min = ($temperatureMin -32) / 1.8 ;
                $temp_max = ($temperatureMax -32) / 1.8;
                settype($temp_min, "integer");
                settype($temp_max, "integer");
                $today_status = "";
                if( $key == 0){
                    $html .= "<div class='weather-now col-md-12'>" .
                        "<div class='col-md-6'><span>".$this->status[$day->text]."</span> <br/> <span>".$temp_min."<sup>o</sup> &nbsp;".$temp_max."<sup>o</sup></span></div>" .
                        "<div class='col-md-6'><i class='wi ".$icons[$day->text]."'></i></div></div>" .
                        "<div class='weather-three-day col-md-12'>";
                }else{
                    $html .= "<div class='col-md-4'> <h6>".$days[$day->day]."</h6> <span> ".$temp_min."<sup>o</sup> &nbsp;".$temp_max."<sup>o</sup></span><br/><i class='wi ".$icons[$day->text]."'></i></div>";
                }
                $j++;
            }
            $html .= '</div>';
            return $html;
        }catch (Exception $ex){

            $ex->getLine();
        }
    }

}