const shrink_btn = document.querySelector(".shrink-btn");
const sidebar_links = document.querySelectorAll(".sidebar-links a");
const active_tab = document.querySelector(".active-tab");
const tooltip_elements = document.querySelectorAll(".tooltip-element");

let activeIndex;

shrink_btn.addEventListener("click", () => {
  document.body.classList.toggle("shrink");
  setTimeout(moveActiveTab, 400);

  shrink_btn.classList.add("hovered");

  setTimeout(() => {
    shrink_btn.classList.remove("hovered");
  }, 500);
});
function moveActiveTab() {
  let topPosition = activeIndex * 58 + 2.5;

  if (activeIndex > 10) {
    topPosition += shortcuts.clientHeight;
  }

  active_tab.style.top = `${topPosition}px`;
}

function changeLink() {
  sidebar_links.forEach((sideLink) => sideLink.classList.remove("active"));
  this.classList.add("active");

  activeIndex = this.dataset.active;

  moveActiveTab();
}

sidebar_links.forEach((link) => link.addEventListener("click", changeLink));

function showTooltip() {
  let tooltip = this.parentNode.lastElementChild;
  let spans = tooltip.children;
  let tooltipIndex = this.dataset.tooltip;

  Array.from(spans).forEach((sp) => sp.classList.remove("show"));
  spans[tooltipIndex].classList.add("show");

  tooltip.style.top = `${(100 / (spans.length * 2)) * (tooltipIndex * 2 + 1)}%`;
}

tooltip_elements.forEach((elem) => {
  elem.addEventListener("mouseover", showTooltip);
});



//shrink checking script start

document.addEventListener("DOMContentLoaded", function () {
  // Check if the 'shrink' class is present in the body
  if (document.body.classList.contains("shrink")) {
    console.log("working");
    // If 'shrink' class is present, update the checkbox state
    document.getElementById("shrink-checkbox").checked = true;
  }
  console.log("working");
  // Add event listener to the shrink checkbox
  document.getElementById("shrink-checkbox").addEventListener("change", function () {
    // Toggle the 'shrink' class on the body based on the checkbox state
    document.body.classList.toggle("shrink", this.checked);

    // Save the sidebar state in local storage
    localStorage.setItem("sidebarState", this.checked ? "shrink" : "");
  });
});

//shrink checking script end