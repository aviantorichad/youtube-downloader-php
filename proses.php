<?php

if (isset($_REQUEST['proses'])) {
  switch ($_REQUEST['proses']) {
    case "cek":
      // menjalankan youtube-dl
      if (isset($_REQUEST['url'])) {
        $url = $_REQUEST['url'];
        $cmd = "youtube-dl -o '%(title)s.%(ext)s' -F " . $url;
        exec($cmd, $output, $exitcode);
        echo "<pre>";
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
