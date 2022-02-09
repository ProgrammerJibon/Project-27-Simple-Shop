<?php

session_start();

error_reporting(E_ALL);

ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');

$result = array();
function request_url($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_DNS_SHUFFLE_ADDRESSES, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
    curl_setopt($ch, CURLOPT_COOKIESESSION, true);/*
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');*/
    $buffer = curl_exec($ch);
    curl_close($ch);
    return $buffer;
}
$xdex = "";

if (dirname($_SERVER['PHP_SELF']) != "/") {
    $xdex = "/";
}
/*function request_url($url, $header=NULL, $p=NULL)
    {
    	$header = array(
                "Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*\/*;q=0.5",
                "Accept-Language: en-gb,en;q=0.5",
                "Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7");
    	$p = null;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:9.0.1) Gecko/20100101 Firefox/9.0.1");

	    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
	    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');


        if ($p) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
        }
        $result = curl_exec($ch);

        if ($result) {
            return $result;
        } else {
            return curl_error($ch);
        }
        curl_close($ch);
    }*/
$gl = "";

if(isset($_GET['target'])){

    $gl = $_GET['target'];

}elseif(isset($_POST['target'])){

    $gl = $_POST['target'];

}else{
    $result['error'] = 'no_link';
    echo json_encode($result);
	exit();

}

/*echo json_encode($_POST);

exit();*/

function filter_namex($strip = null, $replace = null, $full_name = null){

    $r = "";

    $u = explode($strip, $full_name);

    $i = 0;

    foreach($u as $data){

        if($i != 0){

            $data = $replace.$data;

        }

        $r .= $data;

        $i++;

    }

    return $r;

}

if($gl == ""){

    $result['error'] =  "no_link";

}elseif(!strpos($gl,"5play.ru")){

    $result['error'] = "invalid_link";

}else{

    $x= request_url($gl);



    $x = explode('" class="download-line s-green"', $x);

    if(!isset($x[1])){

        $result['error'] = "unable1";

    }else{

        $y = explode('<a href="', $x[0]);

        $z = $y[count($y)-1];

    

        $a= request_url($z);



        $a = explode('"><input type="button"', $a);

        if(!isset($a[1])){

            $result['error'] = "unable2";

        }else{

            $b = explode('<a href="', $a[0]);

            $c = $b[count($b)-1];

    

            // edit changing name here

            $n = filter_namex("t-5play.ru"/*replace_from*/, ""/*replace_to*/,basename($c));
            $n = filter_namex("t-5play"/*replace_from*/, ""/*replace_to*/,basename($n));
            $n = filter_namex("-t-5play"/*replace_from*/, ""/*replace_to*/,basename($n));
            $n = filter_namex("5play.ru"/*replace_from*/, ""/*replace_to*/,basename($n));
            $n = filter_namex("5play"/*replace_from*/, ""/*replace_to*/,basename($n));

    

            $yx = date("Y");

            $mx = $yx."/".date("m");

            $dx = $mx;

            if(!file_exists($yx)){

                mkdir($yx);

            }if(!file_exists($mx)){

                mkdir($mx);

            }if(!file_exists($dx)){

                mkdir($dx);

            }

            $sx = $dx."/".$n;

            if(file_exists($sx) && filesize($sx) > (1024*1024)){

                $result['link'] = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].$xdex."/".$sx;

                $result['name'] = basename($sx);

                $result['size'] = floor(filesize($sx)/1024/1024*100)/100;

                $result ['exists_version'] = true;

            }else{

                $d = request_url($c);


            
                


                if(file_put_contents($sx, $d)){

                    $result['link'] = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].$xdex."/".$sx;

                    $result['name'] = basename($sx);

                    $result['size'] = floor(filesize($sx)/1024/1024*100)/100;

                }else{

                    $result['error'] = "timeout";
                    

                }

            }

        }

        if (isset($x[2])) {

            $y = explode('<a href="', $x[1]);

            $z = $y[count($y)-1];

    

            $a= request_url($z);



            $a = explode('"><input type="button"', $a);

            if(!isset($a[1])){

                $result['error'] = "unable3";

            }else{

                $b = explode('<a href="', $a[0]);

                $c = $b[count($b)-1];

    

                // edit changing name here

                $n = filter_namex("t-5play.ru"/*replace_from*/, ""/*replace_to*/,basename($c));
                $n = filter_namex("t-5play"/*replace_from*/, ""/*replace_to*/,basename($n));
                $n = filter_namex("5play.ru"/*replace_from*/, ""/*replace_to*/,basename($n));
                $n = filter_namex("-5play.ru"/*replace_from*/, ""/*replace_to*/,basename($n));
                $n = filter_namex("5play"/*replace_from*/, ""/*replace_to*/,basename($n));

    

                $yx = date("Y");

                $mx = $yx."/".date("m");

                $dx = $mx;

                if(!file_exists($yx)){

                    mkdir($yx);

                }if(!file_exists($mx)){

                    mkdir($mx);

                }if(!file_exists($dx)){

                    mkdir($dx);

                }

                $sx = $dx."/".$n;

                if(file_exists($sx) && filesize($sx) > (1024*1024)){

                    $result['linkx'] = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].$xdex."/".$sx;

                    $result['namex'] = basename($sx);

                    $result['sizex'] = floor(filesize($sx)/1024/1024*100)/100;

                    $result ['exists_versionX'] = true;

                }else{

                    $d = request_url($c);


                    if(file_put_contents($sx, $d)){

                        $result['linkx'] = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].$xdex."/".$sx;

                        $result['namex'] = basename($sx);

                        $result['sizex'] = floor(filesize($sx)/1024/1024*100)/100;

                    }else{

                        $result['error'] = "timeout";

                    }

                }

            }

        }

    }

}

    

    



echo json_encode($result);