const header = document.querySelector("header");
let sticky_header = false;

window.addEventListener("scroll", function () {
  const sec_header_height = 40;

  if (window.scrollY > sec_header_height) {
    if (sticky_header === false) {
      header.classList.add("sticky-top")
      sticky_header = true;
    }
  }
  else {
    if (sticky_header) {
      header.classList.remove("sticky-top")
      sticky_header = false;
    }
  }
});
