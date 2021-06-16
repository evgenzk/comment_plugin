document.addEventListener("DOMContentLoaded", function (event) {
  var posts = [];
  document.querySelectorAll(".vuukle-postid").forEach((element) => {
    posts.push(event.currentTarget.dataset.postid);
  });
  if (posts.length < 1) {
    return;
  }
  var url =
    "//vuukle.com/api.asmx/getCommentCountListByHost?id=" +
    params.api_key +
    "&list=" +
    posts.toString() +
    "&host=" +
    params.host;

  function loadXMLDoc() {
    var cache = false;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", url, cache);
    xmlhttp.send();
    then(function (response) {
      var posts_comments_count = JSON.parse(response);
      document.querySelector().forEach(
        (element) => posts_comments_count,
        function (key, val) {
          var text = val > 1 ? val + " Comments" : val + " Comment";
          if (val > 0) {
            document.querySelector(
              '.vuukle-postid[data-postid="' + key + '"]'
            ).innerText = text;
            document.querySelector(
              '.vuukle-postid[data-postid="' + key + '"]'
            ).style.visibility = "visible";
          } else {
            document.querySelector(
              '.vuukle-postid[data-postid="' + key + '"]'
            ).style.visibility = "visible";
          }
        }
      );
    });
  }
});
