let url =
  "//vuukle.com/api.asmx/getCommentCountListByHost?id=" +
  params.api_key +
  "&list=" +
  posts.toString() +
  "&host=" +
  params.host;
let cache = false;

document.addEventListener("DOMContentLoaded", function (event) {
  var posts = [];
  var elems = document.getElementsByClassName("vuukle-postid");
  elems.forEach(function callback(currentValue, index, array) {
    posts.push(currentValue.getAttribute("data-postid"));
  });
  if (posts.length < 1) {
    return;
  }
  loadXMLDoc();
});

function loadXMLDoc() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == XMLHttpRequest.DONE) {
      // XMLHttpRequest.DONE == 4
      if (xmlhttp.status == 200) {
        var posts_comments_count = JSON.parse(xmlhttp.response);
        for (const [key, value] of Object.entries(posts_comments_count)) {
          console.log(key, value);
          var text = val > 1 ? val + " Comments" : val + " Comment";
          if (val > 0) {
            document
              .querySelector('.vuukle-postid[data-postid="' + key + '"]')
              .text(text).style.visibility = "visible";
          } else {
            document.querySelector(
              '.vuukle-postid[data-postid="' + key + '"]'
            ).style.visibility = "visible";
          }
        }
      }
    }
  };

  xmlhttp.open("GET", url, cache);
  xmlhttp.send();
}
