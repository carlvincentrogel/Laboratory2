<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MusicModel;

class MusicController extends BaseController
{
    private $musi;
    private $pla;

    public function __construct(){
        $this->musi = new \App\models\MusicModel();
        $this->pla = new \App\models\MusikoModel();
    }
    public function addsong(){
            $data["musicname"] = $this->request->getVar("musicname");
            $this->musi->save($data);
            return redirect()->to('main');
    }
    public function createplaylist(){
        $data["playlist"] = $this->request->getVar("playlist");
        $this->pla->save($data);
        return redirect()->to('main');
    }
    public function index()
    {
        $data= ['mus' => $this->musi->findAll(),
        'plays' => $this->pla->findAll()];
        return view('music',$data);
    }
    public function searchsong(){
        $searchQuery = $this->request->getVar('search');

        if ($searchQuery) {
            $main = new MusicModel();
            $data = ['mus' =>$main->like('musicname', $searchQuery)->findAll(),
                    'plays' => $this->pla->findAll()];  
    }
    return view('music', $data);
}
}