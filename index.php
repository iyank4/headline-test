<!doctype html>
<html>
<head>
  <title>Headline Test</title>
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
      max-width: 360px;
      margin: 0 auto;
      padding: 16px;
      background-color: #ECF0F1;
      border-radius: 0 10px 10px 0;
    }
    .ht-center {
      text-align: center;
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
    <div class="ht-body">
      <p>We are testing your response when reading news, whether you what to share, like it, not interseted or you believe the news was fake</p>

      <select name="news-site" multiple>
        <option value="http">detik.com</option>
      </select>

      <div class="ht-center">
        <button class="topcoat-button--cta">Start Test</button>
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
  </div>

  <div id="rss-feeds"></div>

  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/moment.min.js"></script>
  <script type="text/javascript" src="js/jquery.rss.min.js"></script>

  <script type="text/javascript">
    jQuery(function($) {
      $("#rss-feeds").rss("http://rss.detik.com/index.php/detikcom_nasional",
      {
        entryTemplate:'<li><a href="{url}">[{author}@{date}] {title}</a><br/>{teaserImage}{shortBodyPlain}</li>'
      })
    })
  </script>

</body>
</html>
