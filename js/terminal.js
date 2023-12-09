// Function to fetch and display data based on terminal
const fetchAndDisplayData = (terminal) => {
  const sectionID = `${terminal}-section`;
  const section = document.getElementById(sectionID);

  const dataUrl = `php/pass_fetch.php?terminal=${encodeURIComponent(terminal)}`;
  fetch(dataUrl)
    .then((response) => response.text())
    .then((data) => {
      section.innerHTML = data;
    })
    .catch((error) => {
      console.error(`Error fetching data: ${error}`);
    });
};

fetchAndDisplayData("MBLCT");
fetchAndDisplayData("MARQUEE");

setInterval(() => {
  fetchAndDisplayData("MBLCT");
  fetchAndDisplayData("MARQUEE");
}, 1000);
