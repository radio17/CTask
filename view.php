<!DOCTYPE html>
<html lang="ja">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>課題 | Hirohito Higa</title>
  <link href="styles/reset.css" type="text/css" rel="stylesheet">
  <link href="styles/default.css" type="text/css" rel="stylesheet">
  <link href="styles/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<header>
  <span>掲示板</span>
</header>
<main>
  <div class="form_area">
    <form method="POST">
      <div>
        <span>タイトル</span>
        <input type="text" name="title">
      </div>
      <div>
        <span>本文</span>
        <textarea name="text" cols="40" rows="4" maxlength="200"></textarea>
      </div>
      <div class="submit_button">
        <input type="submit" name="send" value="送信">
      </div>
    </form>
  </div>
  <div class="message_area">
  <?php echo $yield ?>
  </div>
</main>

<footer>
  <span>Kadai</span>
</footer>
</body>