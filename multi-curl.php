<?php

    function multiCurl($URLS, $callback, $options){
        $cct   = curl_multi_init();
        $curls = array();
        foreach ($URLS as $url) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curl, CURLOPT_BINARYTRANSFER,1);
            curl_setopt($curl, CURLINFO_HEADER_OUT,true);
            foreach ($options as $meta => $value) {
                curl_setopt($curl, $meta, $value);
            }
            curl_multi_add_handle($cct, $curl);

            $curls[] = $curl;
        }

        do {
            curl_multi_exec($cct, $running);
            curl_multi_select($cct);
        } while ($running > 0);
            curl_multi_close($cct);

        foreach ($curls as $key => $ch) {
            $html = curl_multi_getcontent($ch);
            list($header, $html) = explode("\r\n\r\n", $html, 2);
            $header = http_parse_headers(strtolower($header));

            $callback($URLS[$key], $header, $html);
        }
    }

?>
