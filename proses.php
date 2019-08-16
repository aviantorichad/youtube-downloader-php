<?php

if (isset($_REQUEST['proses'])) {
  switch ($_REQUEST['proses']) {
    case "cek":
      // menjalankan youtube-dl
      if (isset($_REQUEST['url'])) {
        // $url = "https://www.youtube.com/watch?v=A6_NsdY7FKQ";
        $url = $_REQUEST['url'];
        //ambil title
        $cmd1 = "youtube-dl --get-title " . $url;
        exec($cmd1, $output1, $exitcode1);
        if ($exitcode1 == 0) {
          $title = "<div style='display:block;color:blue;font-weight:bold;'>$output1[0]</div>";
        } else {
          $title = "";
        }
        //ambil thumbnail
        $cmd2 = "youtube-dl --get-thumbnail " . $url;
        exec($cmd2, $output2, $exitcode2);
        if ($exitcode2 == 0) {
          $image = "<image src='$output2[0]' align='left' style='margin-right:20px;margin-top:20px;display:inline-block;width:250px;' />";
        } else {
          $image = "";
        }
        // cek file
        $cmd = "youtube-dl -o '%(title)s.%(ext)s' -F " . $url;
        exec($cmd, $output, $exitcode);
        echo $title;
        echo $image;
        echo "<pre style='display:inline-block;width:50%;margin-top:0;'>";
        if ($exitcode == 0) {
          echo "<h2>Choose format:</h2>";
          echo "<ul>";
          for ($i = 4; $i < count($output); $i++) {
            echo '<li>' . $output[$i] . ' </a><a href="#" onclick="unduh2(\'' . $url . '\',\'' . explode(' ', $output[$i])[0] . '\')">download</a></li>';
          }
          echo "</ul>";
        } else {
          echo "error...";
        }
        echo "</pre>";
      } else {
        echo $url . "<br/>";
        echo "invalid url";
      }
      break;
    case "download":
      // menjalankan youtube-dl
      if (isset($_REQUEST['url'])) {
        $url = $_REQUEST['url'];
        $cmd = "youtube-dl -o '%(title)s.%(ext)s' -f " . $_REQUEST['format'] . " " . $url;
        while (@ob_end_flush()); // end all output buffers if any

        $proc = popen($cmd, 'r');
        echo '<pre>';
        while (!feof($proc)) {
          echo fread($proc, 4096);
          @flush();
        }
        echo '</pre>';
      } else {
        echo $url . "<br/>";
        echo "invalid url";
      }
      break;
    default:
      break;
  }
}
