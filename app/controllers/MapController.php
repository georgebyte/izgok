<?php

class MapController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    public function getIndex()
    {
        return Redirect::to("/map/show/");
    }

    public function getDrawworld()
    {        
        /* branje extremov iz baze */
        $minX = Territory::min('pos_x');
        $minY = Territory::min('pos_y');
        $maxX = Territory::max('pos_x');
        $maxY = Territory::max('pos_y');

        /* nastavljanje velikosti slike */
        $width=abs($minX)+abs($maxX);
        $height=abs($minY)+abs($maxY);
        /* poveca slike */
        $sizeMultiplier = 72;
        /* velikost pike na zemljevidu (1=1 2=4 3=9) */
        $dotSize = 3;


        /* size multipling */
        $width *= $sizeMultiplier;
        $height *= $sizeMultiplier;

        /* half size */
        $wHalf=$width/2;
        $hHalf=$height/2;

        /* risanje slike celotnega zemljevida */
        header ('Content-Type: image/png');

        /* izdelava osnovne slike velikosti $width in $height */
        $im = imagecreatetruecolor($width, $height);

        /* inicializacija barv */
        $red = imagecolorallocate($im,239,0,0);
        $green = imagecolorallocate($im,0,239,0); 
        $blue = imagecolorallocate($im,0,0,239);
        $black = imagecolorallocate($im, 65, 65, 65);
        $background = imagecolorallocate($im,0,119,0); 

        /* nastavljanje velikosti */
        $size=1;

        /* polnilo slike */
        imagefilledrectangle($im, 0, 0, $width, $height, $background);

        /* izris koordinatnega sistema */
        imageline($im,$width/2,0,$width/2,$height,$black);
        imageline($im,0,($height/2)-1,$width,($height/2)-1,$black);

        /* risanje */
        $visibleTerritories = Territory::get();
        foreach ($visibleTerritories as $territory) {

            /* Iskanje lastnika ozemlja */
            $territoryOwner = User::find($territory['id_owner'])['username'];
            $mapX = $territory['pos_x'];
            $mapY = $territory['pos_y'];

            /* centriranje na sredino mape */
            $mapX = $mapX + $wHalf;
            $mapY = $mapY >= 0 ? $hHalf - $mapY : $mapY + $height;

            /* barvanje svojih teritorijev v zeleno */
            if($territoryOwner == Auth::user() -> username){
                for($i=$mapX-$dotSize; $i <= $mapX + $dotSize; $i++){
                    for($j=$mapY-$dotSize; $j <= $mapY + $dotSize; $j++){
                        imagesetpixel($im, $i, $j, $green);
                    }  
                }

            }

            /* barvanje NPC teritorijev v modro */
            elseif($territory['is_npc_village'] == 1){
                for($i=$mapX-$dotSize; $i <= $mapX + $dotSize; $i++){
                    for($j=$mapY-$dotSize; $j <= $mapY + $dotSize; $j++){
                        imagesetpixel($im, $i, $j, $blue);
                    }  
                }
            }

            /* barvanje ostalih teritorijev v rdeco */
            else{
                for($i=$mapX-$dotSize; $i <= $mapX + $dotSize; $i++){
                    for($j=$mapY-$dotSize; $j <= $mapY + $dotSize; $j++){
                        imagesetpixel($im, $i, $j, $red);
                    }  
                }
            }
        }
        
        /* se par nastavitev in kreiranje slike */
        imagepng($im);
        imagedestroy($im);
    }

    public function getWorld()
    {
        return View::make("world");   
    }

    public function getShow($x = NULL, $y = NULL)
    {
        if($x == NULL && $y == NULL){
            $myID = Auth::user() -> id;
            $mainTerritory = Territory::where('id_owner', '=', $myID) -> where('is_main_village','=','1') -> get()[0];
            $x = $mainTerritory['pos_x'];
            $y = $mainTerritory['pos_y'];
        }

        $visibleMapSize = Config::get('map.visibleMapSize', 4);
        $data = array('x' => $x, 'y' => $y, 'visibleTerritories' => null, 'visibleMapSize' => $visibleMapSize);
        $rules = array(
            'x' => 'integer',
            'y'    => 'integer'
        );
        $validator = Validator::make($data, $rules);
        if (!$validator->passes()) {
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Navedene koordinate niso veljavne.");
        }

        /* Iz baze dobi vsa naselja ki se nahajajo v kvadratu 9x9 okoli izbrane tocke z x, y koordinatama */
        $visibleTerritories = Territory::whereBetween('pos_x', array($x-$visibleMapSize, $x+$visibleMapSize)) -> whereBetween('pos_y', array($y-$visibleMapSize, $y+$visibleMapSize)) -> get();

        $visibleTerritoriesData = array();
        $territoryOwners = array();
        foreach ($visibleTerritories as $territory) {
            /* Iskanje lastnika ozemlja */
            $territoryOwner = User::find($territory['id_owner'])['username'];
            $tempTerritoryID = $territory['id'];
            $territoryOwners[$tempTerritoryID] = $territoryOwner;
            array_push($visibleTerritoriesData, $territory);
        }
        $data['visibleTerritories'] = $visibleTerritoriesData;
        $data['leaders'] = $territoryOwners;

        return View::make('map', $data);
    }

    public function getTerritory($territoryID = null, $x = null, $y = null)
    {
        $data = array('territoryID' => $territoryID, 'x' => $x, 'y' => $y);
        $rules = array(
            'territoryID' => 'required|integer',
            'x'           => 'required|integer',
            'y'           => 'required|integer'
        );
        $validator = Validator::make($data, $rules);
        if (!$validator->passes()) {
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Navedene koordinate niso veljavne.");
        }

        $data = array('territoryID' => $territoryID, 'name' => null, 'description' => null, 'player' => null, 'playerID' => null, 'x' => $x, 'y' => $y);
        if (!$territoryID) {
            $data['name'] = "Divjina";
            $data['description'] = "Nenaseljeno ozemlje";
            $data['player'] = "---";
            $data['playerID'] = 0;
            $data['is_main_village'] = 0;
            $data['is_npc_village'] = 0;            
            return View::make('territory', $data);
        } else {
            $dbTerritory = Territory::where('id', '=', $territoryID)->first();
            $dbPlayer = User::where('id', '=', $dbTerritory['id_owner'])->first();
            $data['name'] = $dbTerritory['name'];
            $data['description'] = $dbTerritory['description'];
            $data['player'] = $dbPlayer['username'];
            $data['playerID'] = $dbPlayer['id'];
            $data['is_main_village'] = $dbTerritory['is_main_village'];
            $data['is_npc_village'] = $dbTerritory['is_npc_village'];
            return View::make('territory', $data);
        }
    }

}