<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Importer;
use App\Players;
use Response;

class IndexController extends Controller
{
    protected $importer;

    protected $players;

    public function __construct(Importer $importer, Players $players)
    {
        $this->importer = $importer;
        $this->players = $players;
    }

    // saving of data fetched from the importer is handled by the controller
    // and model.

    public function import()
    {
        $data = $this->importer->getPlayers();
        if(is_array($data) && $data != null) {
            $this->players->truncate();
            $result = $this->players->insert($data);
            if($result){
                $status = 201;
                $message = "succussfully saved";        
            } else {
                $status = 500;
                $message = "something went wrong with saving";
            }
        }
        else {
            $status = 500;
            $message = $data;
        }
        return Response::json(array(
            'status' => $status,
            'message' => $message
        ), $status);
    }

    public function get($id)
    {
        $data = $this->players->get($id);
        if($data){
            return $data;
        }    
        $error = array(
            'status' => 400,
            'message' => 'Invalid Request'
        );
        return Response::json($error, 400);
    }
    
    public function list()
    {
        $data = $this->players->list();
        if($data){
            return $data;
        }   
        $error = array(
            'status' => 400,
            'message' => 'Invalid Request'
        );
        return Response::json($error, 400);
    }
}