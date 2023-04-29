<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chat GPT</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
<!-- History feature-->
<!--<div class="sidebar">
    <button class="tablink" id="tab1" onclick="openTab(event, 'tab1')">History Chat</button>
    <button class="tablink" id="tab2" onclick="openTab(event, 'tab2')">New Topic</button>
</div>-->

<section class="msger">
    <header class="msger-header">
        <div class="msger-header-title">
            <i class="fas fa-comment-alt"></i> ChatGPT
            &nbsp;| ID: <input type="text" id="id" hidden> <span class="id_session"></span>
        </div>
        <div class="msger-header-options">
            <button class="btn_link" onclick="history.back();">返回</button>
            <button class="btn_link" id="list-button">历史话题</button>
            <button class="btn_link" id="delete-button">新话题</button>
        </div>
    </header>

    <main class="msger-chat">
    </main>

    <form class="msger-inputarea">
        <input class="msger-input" placeholder="Enter your message..." require>
        <button type="submit" class="msger-send-btn">Send</button>
    </form>
</section>
<!--<script src='https://use.fontawesome.com/releases/v5.0.13/js/all.js'></script>-->
<script src='./all.js'></script>
<script src="./script.js"></script>
<!-- History feature-->
<!--<script>
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>-->


</body>

</html>