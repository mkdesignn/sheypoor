<?php

use Carbon\Carbon;

class Upload
{

    /**
     * @param $request
     * @param $file_name
     * @return string
     */
    public static function uploadFile($request, $file_name){
        $file_names = [];


        if( $request->hasFile($file_name) ) {

            if( count( $request->files->all()[$file_name] ) > 1 ){
                foreach ($request->files->all()[$file_name] as $key =>  $file) {
                    if( $file != null ){
                        $mock_file_name = $file->getClientOriginalName();

                        $mock_file_name = static::setDateOnFile($mock_file_name);

                        $request->file($file_name)[$key]->move(uploadFolderPath(), $mock_file_name);
                        array_push($file_names, $mock_file_name);
                    }else
                        array_push($file_names, "");
                }
                // using this elseif for ajax uploading
            }elseif( count( $request->files->all()[$file_name] ) == 1 ){

                if( $request->file($file_name) != null ) {
                    $mock_file_name = "";
                    if (is_array($request->file($file_name))) {
                        $mock_file_name = $request->file($file_name)[0]->getClientOriginalName();
                        $mock_file_name = static::setDateOnFile($mock_file_name);
                        $request->file($file_name)[0]->move(uploadFolderPath(), $mock_file_name);
                    } else {

                        $mock_file_name = $request->file($file_name)->getClientOriginalName();
                        $mock_file_name = static::setDateOnFile($mock_file_name);

                        $request->file($file_name)->move(uploadFolderPath(), $mock_file_name);

                    }
                    array_push($file_names, $mock_file_name);
                }else
                    array_push($file_names, "");
            }

            return json_encode($file_names);
        }else{
            return "";
        }
    }

    protected static function setDateOnFile($file_name){
        $file_name = explode(".", $file_name);
        $file_name[0] .= "_".Carbon::now().".".$file_name[1];
        $ss = str_replace(":", "-", str_replace(" ", "_", $file_name[0])) ;
        return $ss;
    }
}