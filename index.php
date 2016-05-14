<!doctype html>
<html>
<head>
  <title>Headline Test</title>
  <meta name=viewport content="width=device-width,initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/topcoat-mobile-light.min.css">
  <style type="text/css">
    body {
      background-color: #f5f5f5;
    }
    .topcoat-navigation-bar {
      background-color: #DF4949;
    }
    .topcoat-navigation-bar__title {
      color: #ffffff;
      text-transform: uppercase;
    }

    .ht-container {
    }
    .ht-body {
      margin: 0 auto;
      padding: 16px;
      background-color: #ECF0F1;
      border-radius: 0 10px 10px 0;
      margin-bottom: 20px;
    }
    .ht-center {
      text-align: center;
    }
    @media screen and (min-width: 361px) {
      .ht-body {
        max-width: 360px;
      }
    }
    #rss-feeds {
      display: none;
    }
    select {
      font-size: 2em;
    }
    #result-score {
      font-weight: bold;
      font-size: 3em;
    }
  </style>
</head>
<body>
  <div class="ht-container">
    <div class="topcoat-navigation-bar">
      <div class="topcoat-navigation-bar__item center full">
        <h1 class="topcoat-navigation-bar__title">Headline Response Test</h1>
      </div>
    </div>
    <div id="panel-loading" class="ht-body ht-center" style="display:none">
      <br><br>
      loading...
    </div>
    <div id="panel1" class="ht-body">
      <p>We are testing your response when reading news, whether you what to share, like it, not interseted or you believe the news was fake</p>

      <div class="ht-center">
        <select id="news-site">
          <option value="http">detik.com</option>
        </select>
        <br>
        <br>
        <button id="start-test" class="topcoat-button--cta">Start Test</button>
      </div>

      <p>Rules:</p>
      <ul>
        <li>10 news title</li>
        <li>you have 20 second to response to the news</li>
        <li>when you not click on any button bla bla bla</li>
        <li>read the news</li>
        <li>decide that news as bla bla bla with hitting on the corresponding button</li>
      </ul>
    </div>

    <div id="panel2" class="ht-body" style="display:none">
      <p>Pertanyaan <span id="posTitle"></span> / <span id="numTitle"></span></p>
      <p>Remaining time: <span id="timerSec"></span></p>
      <br>

      <p id="news-title">title</p>
      <br>

      <div class="ht-center">
        <div class="topcoat-button-bar">
          <div class="topcoat-button-bar__item">
            <button id="btn-yes" class="topcoat-button-bar__button">Menarik</button>
          </div>
          <div class="topcoat-button-bar__item">
            <button id="btn-no" class="topcoat-button-bar__button">Tidak</button>
          </div>
        </div>
      </div>
    </div>

    <div id="panel3" class="ht-body" style="display:none">
      <p class="ht-center">Your Score: <br><span id="result-score">100%</span></p>
      <br>
      <p><i>Some fun message and eye-catching image describe the result, encoure user to share this result. (shared with the link to the test.)</i></p>
      <br>
      <p class="ht-center">Share button to FB, Twitter, etc</p>
    </div>
  </div>

  <div id="rss-feeds"></div>

  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/moment.min.js"></script>
  <script type="text/javascript" src="js/jquery.rss.min.js"></script>

  <script type="text/javascript">
    var numTitle = 10;
    var posTitle = 0;
    var cntMax = 15;
    var cntNow = 15;
    var myPoint = 0;
    var testTimer;

    var rssLists = [
      {title: "detik.com", url: "http://rss.detik.com/index.php/detikcom_nasional"},
      {title: "viva.co.id", url: "http://rss.viva.co.id/get/all"}
    ];

    jQuery(document).ready(function() {
      fillOptions($("#news-site"), rssLists);
    });

    $("#start-test").click(function() {
      initTest($("#news-site").val());
    });

    var fillOptions = function(el, options) {
      el.empty();
      for (var i=0; i<options.length; i++) {
        el.append("<option value=\"" + options[i].url + "\">" + options[i].title + "</option>");
      }
    };

    var initTest = function(rssLink) {
      $("#panel1").hide();
      $("#panel-loading").show();

      jQuery(function($) {
        $("#rss-feeds").empty()
        .rss(rssLink, {
          limit: numTitle,
          entryTemplate:'<p>{title}</p>',
          error: function() {
            console.log("err");
          },
          success: function() {
            numTitle = $("#rss-feeds p").length;
            console.log("fetched: " + numTitle + " headline");
            console.log($("#rss-feeds"));

            $("#panel-loading").hide();
            $("#panel2").show();
            startTest();
          }
        });
      });
    };

    var startTest = function() {
      cntNow = cntMax;
      nextNews();
      testTimer = setInterval(testTick, 1000);
    }
    function testTick() {
      cntNow--;
      if (cntNow <= 0) {
        nextNews();
      }

      $("#timerSec").text(cntNow);
    };

    function nextNews() {
      if (posTitle < numTitle) {
        cntNow = cntMax;
        posTitle++;
        $("#timerSec").text(cntNow);
        $("#posTitle").text(posTitle);
        $("#numTitle").text(numTitle);
        $("#news-title").text($("#rss-feeds p:eq("+(posTitle - 1)+")").text());
      } else {
        // finish
        window.clearInterval(testTimer);
        $("#panel1").hide();
        $("#panel2").hide();
        $("#panel3").show();

        // calculate score
        var score = ((myPoint / numTitle) * 100);
        $("#result-score").text(score + "%");
      }
    }

    $("#btn-yes").click(function() {
      myPoint++;
      nextNews();
    });
    $("#btn-no").click(function() {
      nextNews();
    });
  </script>

</body>
</html>
