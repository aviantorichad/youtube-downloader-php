<!DOCTYPE html>
<html>

<head>
  <title>YOUTUBE DOWNLOADER</title>

  <style>
    div#result2 iframe {
      border: 1px dashed;
      background: #f0f0f0;
    }
  </style>

  <script src="./jquery.min.js"></script>
</head>

<body>
  <h1>YOUTUBE DOWNLOADER</h1>
  <p>Download Youtube Now ~ <a href="https://github.com/aviantorichad">@aviantorichad</a>

    <form>
      <input type="text" name="url" id="url" placeholder="input url here... ex: http://youtube.com/xxx..." style="width:50%" autocomplete="off" />
      <button type="button" id="submit">proses</button>
    </form>

    <div id="result"></div>
    <div id="result2"></div>
    <div id="result3"></div>

    <script>
      function cek(val) {
        if (val) {
          window.cek_interval = setInterval(always_bottom, 1000);
        } else {
          clearInterval(window.cek_interval);
        }
      }

      function always_bottom() {
        var $contents = $('iframe').contents();
        $contents.scrollTop($contents.height());
      }

      function unduh2(url, format) {
        $('#result2').html(`<iframe id="iframe_result2" src="proses.php?proses=download&url=${url}&format=${format}" width="100%" height="300" seamless="seamless"></iframe><br/><label><input type="checkbox" id="cek_akhir" onclick="cek(this.checked)" checked>always check last process</label>`);
        cek(true);
      }

      $(document).ready(function() {

        $('#submit').click(function() {
          $('#result').html('loading...');
          $('#result2').html('');
          var formData = {
            'proses': 'cek',
            'url': $('#url').val()
          };
          reqAjax = $.ajax({
            url: "proses.php",
            type: 'POST',
            data: formData,
            success: function(response) {
              $('#result').html(response);
            },
            error: function(err) {
              console.log(err);
              var msg = `Terjadi kesalahan internal - Silakan coba lagi.\n${err.status} (${err.statusText})`

              $('#result').html(msg);
            }
          });
        });

      });
    </script>
</body>

</html>