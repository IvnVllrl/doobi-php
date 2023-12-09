const openModal = (modalID) => {
  document.getElementById(modalID).style.display = "flex";
};

const closeModal = (modalID) => {
  document.getElementById(modalID).style.display = "none";
};

const fetchAndDisplayData = () => {
  fetch("pass_info.php") // Adjust the actual PHP script name
    .then((response) => response.json())
    .then((data) => {
      data.forEach((item, index) => {
        const listItem = document.createElement("li");
        listItem.classList.add("jeep-item");
        listItem.setAttribute("data-jeep-id", item.id); // Add this line

        const jeepNameSpan = document.createElement("span");
        jeepNameSpan.classList.add("jeep-name");
        jeepNameSpan.textContent = item.jeepney_name;

        const detailsButton = document.createElement("button");
        detailsButton.classList.add("details-button");
        detailsButton.textContent = "See Details";
        detailsButton.addEventListener("click", () =>
          openModalWithDetails(item)
        );

        const seeRouteButton = document.createElement("button");
        seeRouteButton.classList.add("see-route-button");
        seeRouteButton.textContent = "See Route";
        seeRouteButton.addEventListener("click", () =>
          openRouteFile(item.file_route)
        );

        listItem.appendChild(jeepNameSpan);
        listItem.appendChild(detailsButton);
        listItem.appendChild(seeRouteButton);

        document.getElementById("dataSection").appendChild(listItem);
      });
    })
    .catch((error) => console.error("Error fetching data:", error));
};

const openRouteFile = (filePath) => {
  // Open the file in a new tab or window
  window.open(filePath, "_blank");
};
// Call the fetchAndDisplayData function when the page loads
document.addEventListener("DOMContentLoaded", fetchAndDisplayData);

const openModalWithDetails = (details) => {
  openModal("DetailsModal");

  document.getElementById("modalJeepId").value = details.id;
  document.getElementById("editJeepName").value = details.jeepney_name;
  document.getElementById("editJeepColor").value = details.jeepney_color;
  document.getElementById("editMaxSeats").value = details.jeepney_seats;
};

// This function displays the data on the page
const displayData = (data) => {
  const jeepContent = document.getElementById("dataSection");
  const jeepList = document.createElement("ul");
  jeepList.className = "jeep-list";

  // Check if there is data
  if (data.length > 0) {
    data.forEach((item) => {
      const listItem = document.createElement("li");
      listItem.className = "jeep-item";

      const jeepNameSpan = document.createElement("span");
      jeepNameSpan.className = "jeep-name";
      jeepNameSpan.textContent = item.jeepney_name; // Use the correct column name from your database

      const detailsButton = document.createElement("button");
      detailsButton.className = "details-button";
      detailsButton.textContent = "See Details";
      detailsButton.addEventListener("click", () =>
        openModalWithDetails("Modal" + item.id)
      );

      listItem.appendChild(jeepNameSpan);
      listItem.appendChild(detailsButton);

      jeepList.appendChild(listItem);
    });
  } else {
    const noDataMessage = document.createElement("p");
    noDataMessage.textContent = "No jeep information available.";
    jeepList.appendChild(noDataMessage);
  }

  // Replace the existing content with the new list
  jeepContent.innerHTML = "";
  jeepContent.appendChild(jeepList);
};
