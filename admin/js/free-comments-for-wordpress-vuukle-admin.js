"use strict";

/**
 * All of the code for your admin-facing JavaScript source
 * should reside in this file.
 *
 * Note: It has been assumed you will write jQuery code here, so the
 * $ function reference has been prepared for usage within the scope
 * of this function.
 *
 * This enables you to define handlers, for when the DOM is ready:
 *
 * $(function() {
 *
 * });
 *
 * When the window is loaded:
 *
 * $( window ).load(function() {
 *
 * });
 *
 * ...and/or other possibilities.
 *
 * Ideally, it is not considered best practise to attach more than a
 * single DOM-ready or window-load handler for a particular page.
 * Although scripts in the WordPress core, Plugins and Themes may be
 * practising this, we should strive to set a better example in our own work.
 */
var url = "/wp-admin/admin-ajax.php";
document.addEventListener("DOMContentLoaded", function () {
  const cbox1 = document.getElementsByClassName("nav-tab");
  for (let i = 0; i < cbox1.length; i++) {
    cbox1[i].addEventListener("click", function (event) {
      let elemenetID = event.currentTarget.getAttribute("href");
      let active_tab = event.currentTarget.getAttribute("data-tab");
      document.getElementById("hidden_tab").value = active_tab;
      document
        .querySelectorAll(".nav-tab-wrapper a.nav-tab")
        .forEach((element) => {
          if (element.classList.contains("nav-tab-active")) {
            element.classList.remove("nav-tab-active");
          }
        });
      event.currentTarget.classList.add("nav-tab-active");
      document.querySelectorAll(".vuukle-tab-content").forEach((element) => {
        if (element.classList.contains("vuukle-tab-content-active")) {
          element.classList.remove("vuukle-tab-content-active");
        }
      });
      document.querySelectorAll("[name='vuukle-tab']").value = active_tab;
      document
        .querySelector(".vuukle-tab-content" + elemenetID)
        .classList.add("vuukle-tab-content-active");
      event.preventDefault();
    });
  }

  document
    .querySelector(".vuukle_popup_close")
    ?.addEventListener("click", function (event) {
      event.currentTarget.parentElement.parentElement.style.visibility =
        "hidden";
    });
  document
    .querySelector("#export_button2")
    ?.addEventListener("click", function (event) {
      var amount_comments = document.querySelector(".amount_comments").value;
      var thisButton = event.currentTarget;
      thisButton.style.display = "none";
      document.querySelectorAll(".loader-animation")[0].style.visibility =
        "visible";
      loadXMLDoc();
      function loadXMLDoc() {
        var offset = thisButton.getAttribute("offset");
        var xmlhttp = new XMLHttpRequest();
        let cache = false;
        var params = {
          action: "export_comments_plugin_page",
          offset: offset,
          export_xml: 2,
          amount_comments: amount_comments,
          _wpnonce: `<?php echo esc_attr(wp_create_nonce('export_xml2')); ?>`,
        };
        var queryString = Object.keys(params)
          .map(function (key) {
            return key + "=" + params[key];
          })
          .join("&");
        xmlhttp.open("GET", url + "?" + queryString, cache);
        xmlhttp.send();
        if (xmlhttp.readyState == XMLHttpRequest.DONE) {
          // XMLHttpRequest.DONE == 4
          if (xmlhttp.status == 200) {
            var result = JSON.parse(xmlhttp.response);
            if (result.result > 0) {
              thisButton.setAttribute("offset", result.result);
              loadXMLDoc();
            } else if (result.result == 0) {
              thisButton.setAttribute("offset", result.result);
              document.querySelector(".loader-animation").style.visibility =
                "hidden";
              thisButton.style.display = "inline-block";
              window.location.assign(result.link);
            } else if (result.result < 0) {
              alert(result.message);
            }
          }
        }
      }
    });

  document
    .querySelector("input[name=embed_comments]")
    ?.addEventListener("click", function (event) {
      let htmlElem = document.querySelector(".embed_fields input[type=text]");
      htmlElem.classList.remove("reg");
      htmlElem.style.boxShadow = "none";
      let nextSibling = htmlElem.parentElement.nextElementSibling;
      while (nextSibling) {
        nextSibling = element.style.boxShadow = "none";
      }
      var nodes = [];
      var element = event.currentTarget;
      nodes.push(element);
      while (element.parentNode) {
        nodes.unshift(element.parentNode);
        element = element.parentNode;
      }
      let filteredNodes = nodes.filter((el) => el.tagName === "td");
      filteredNodes.forEach((el) => {
        el.querySelector("input[type=text]").classList.add("reg");
      });
    });
  const addEventForChild = function (parent, eventName, childSelector, cb) {
    parent.addEventListener(eventName, function (event) {
      const clickedElement = event.target,
        matchingChild = clickedElement.closest(childSelector);
      if (matchingChild) cb(matchingChild);
    });
  };

  addEventForChild(document, "click", "input.reg", function () {
    let nextSibling = querySelectorAll(
      ".embed_fields input[type=text]"
    ).nextElementSibling;
    while (nextSibling) {
      nextSibling = element.style.boxShadow = "none";
    }
  });

  document
    .querySelector("input[name=embed_emotes]")
    ?.addEventListener("click", function (event) {
      let el = document.querySelector(".embed_fields_emotes input[type=text]");
      el.classList.remove("reg1");
      var result = [],
        node = el.parentNode.firstChild;
      while (node) {
        if (node !== this && node.nodeType === Node.ELEMENT_NODE)
          result.push(node);
        node = node.nextElementSibling || node.nextSibling;
      }
      result.forEach((element) => (element.style.boxShadow = "none"));
      var nodes = [];
      var element = event.currentTarget;
      nodes.push(element);
      while (element.parentNode) {
        nodes.unshift(element.parentNode);
        element = element.parentNode;
      }
      let filteredNodes = nodes.filter((el) => el.tagName === "td");
      filteredNodes.forEach((el) => {
        el.querySelector("input[type=text]").classList.add("reg1");
      });
    });

  addEventForChild(document, "click", "input.reg", function () {
    let nextSibling = querySelectorAll(
      ".embed_fields input[type=text]"
    ).nextElementSibling;
    while (nextSibling) {
      nextSibling = element.style.boxShadow = "none";
    }
  });

  window.addEventListener("load", function (event) {
    if (window.location.pathname == "/wp-admin/admin.php") {
      if (
        document
          .getElementById("tab10")
          .classList.contains("vuukle-tab-content-active")
      ) {
        document.getElementById("vis").style.display = "none";
      } else {
        document.getElementById("vis").style.display = "block";
      }
    }
  });

  document
    .querySelector("#save-settings")
    ?.addEventListener("click", function (event) {
      var hiddenTab = document.querySelector("#hidden_tab").value;
      var hiddenUrl = document.querySelector("#hidden_url").value;
			if(hiddenTab !== 'tab10'){
      document
        .querySelector("#vuukle-settings-form")
        .setAttribute("action", hiddenUrl + "&vuukle_tab=" + hiddenTab);
      if (document.querySelectorAll("input.reg").length > 0) {
        if (!document.querySelector("input.reg").value) {
          let nextSibling =
            document.querySelector("input.reg").nextElementSibling;
          while (nextSibling) {
            nextSibling = element.style.boxShadow = "0px 0px 3px 2px red";
          }

          document.querySelector("html, body").animate(
            {
              scrollTop: $("input.reg").offset().top - 150,
            },
            1000
          );
        }
      }

      if (document.querySelectorAll("input.reg1").length > 0) {
        if (!document.querySelector("input.reg1").value) {
          let nextSibling =
            document.querySelector("input.reg1").nextElementSibling;
          while (nextSibling) {
            nextSibling = element.style.boxShadow = "0px 0px 3px 2px red";
          }
          document.querySelector("html, body").animate(
            {
              scrollTop:
                document.querySelector("input.reg1").getBoundingClientRect()
                  .top - 150,
            },
            1000
          );
        }
      }

      if (
        (!document.querySelector("input.reg")?.value &&
          document.querySelectorAll("input.reg").length > 0) ||
        (!document.querySelector("input.reg1")?.value &&
          document.querySelectorAll("input.reg1").length > 0)
      ) {
        return false;
      }
		 }
    });

  document
    .querySelector("#save_settings_ads")
    ?.addEventListener("click", function (event) {
      var hiddenTab = document.querySelector("#hidden_tab").value;
      var hiddenUrl = document.querySelector("#hidden_url").value;

      document
        .querySelector("#vuukle-settings-form1")
        .setAttribute("action", hiddenUrl + "&vuukle_tab=" + hiddenTab);
      if (document.querySelectorAll("input.reg").length > 0) {
        if (!document.querySelector("input.reg").value) {
          let nextSibling =
            document.querySelector("input.reg").nextElementSibling;
			
          while (nextSibling) {
            nextSibling = element.style.boxShadow = "0px 0px 3px 2px red";
          }

          document.querySelector("html, body").animate(
            {
              scrollTop: $("input.reg").offset().top - 150,
            },
            1000
          );
        }
      }

      if (document.querySelectorAll("input.reg1").length > 0) {
        if (!document.querySelector("input.reg1").value) {
          let nextSibling =
            document.querySelector("input.reg1").nextElementSibling;
          while (nextSibling) {
            nextSibling = element.style.boxShadow = "0px 0px 3px 2px red";
          }
          document.querySelector("html, body").animate(
            {
              scrollTop:
                document.querySelector("input.reg1").getBoundingClientRect()
                  .top - 150,
            },
            1000
          );
        }
      }

      if (
        (!document.querySelector("input.reg")?.value &&
          document.querySelectorAll("input.reg").length > 0) ||
        (!document.querySelector("input.reg1")?.value &&
          document.querySelectorAll("input.reg1").length > 0)
      ) {
        return false;
      }
    });
  const cbox = document.querySelectorAll('input[name="reset"]');
  for (let i = 0; i < cbox.length; i++) {
    cbox[i].addEventListener("click", function (event) {
      if (!confirm("Are you sure you want to reset to default settings?")) {
        return false;
      }
    });
  }
});
