// ----- Filter buttons -----
var buttons = document.querySelectorAll(".filter");
var works = document.querySelectorAll(".work");

buttons.forEach(function (button) {
  button.addEventListener("click", function () {
    // make the clicked button red
    buttons.forEach(function (b) { b.classList.remove("active"); });
    button.classList.add("active");

    var filter = button.getAttribute("data-filter");

    works.forEach(function (work) {
      var match = (filter === "all" || work.getAttribute("data-category") === filter);
      work.hidden = !match;
      // restart the pop animation for the cards that are shown
      work.classList.remove("pop");
      if (match) {
        void work.offsetWidth;
        work.classList.add("pop");
      }
    });
  });
});

// ----- Show sections when you scroll to them -----
var reveals = document.querySelectorAll(".reveal");

if ("IntersectionObserver" in window) {
  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add("show");
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });

  reveals.forEach(function (el) { observer.observe(el); });
} else {
  reveals.forEach(function (el) { el.classList.add("show"); });
}
