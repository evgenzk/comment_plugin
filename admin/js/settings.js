document.addEventListener("DOMContentLoaded", function () {
  // collapse
  document
    .querySelector(".collapse")
    ?.addEventListener("click", function (event) {
      if (element.classList.contains("dashicons-plus")) {
        event.currentTarget.classList
          .add("dashicons-minus")
          .remove("dashicons-plus");
      } else {
        event.currentTarget.classList
          .add("dashicons-plus")
          .remove("dashicons-minus");
      }
      event.currentTarget
        .closest(".collapse-container")
        .querySelector(".collapsed")
        .toggle("slow");
    });

  // quick-register
  document
    .querySelector("#quick-register")
    ?.addEventListener("click", function (event) {
       var data = new FormData();
		 data.append('action','quickRegister'); 
        self = event.currentTarget;
      self.parentElement.querySelector(".ajax-response").innerText = "loading";
      function loadXMLDoc() {
        var xmlhttp = new XMLHttpRequest();
		let cache = false; 
        xmlhttp.open("POST", ajaxurl, cache);
        xmlhttp.send(data);
        if (xmlhttp.readyState == XMLHttpRequest.DONE) {
          // XMLHttpRequest.DONE == 4
            if (xmlhttp.status == 200) {
              self.parentElement.querySelector(".ajax-response").innerText =
                "Done";
              document.querySelector('input[name="AppId"]').value =
                xmlhttp.response;
              document.getElementById("save-settings").click();
				
              // error
            } else {
              self.parentElement.querySelector(
                ".ajax-response"
              ).innerText = "Something went wrong. Please try again later";
            }
          
        }
      }
  loadXMLDoc();
    });
    
  return false;
});
