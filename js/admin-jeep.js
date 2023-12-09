const openModal = (modalID) => {
  document.getElementById(modalID).style.display = "flex";
};

const closeModal = (modalID) => {
  document.getElementById(modalID).style.display = "none";
};

const addJeep = () => {
  const jeepName = document.getElementById("jeepName").value;
  const jeepColor = document.getElementById("jeepColor").value;
  const maxSeats = document.getElementById("maxSeats").value;
  const maxSeatsNum = parseInt(maxSeats);
  const fileInput = document.getElementById("fileUpload");
  const file = fileInput.files[0];

  // Validation
  if (jeepName.trim() === "" || maxSeatsNum < 1 || !file) {
    // Display error in a modal
    const errorModal = document.createElement("div");
    errorModal.innerHTML = `<p style="color: #f4496b;">Invalid input. Please provide valid values.</p>`;
    errorModal.style.position = "fixed";
    errorModal.style.top = "50%";
    errorModal.style.left = "50%";
    errorModal.style.transform = "translate(-50%, -50%)";
    errorModal.style.padding = "20px";
    errorModal.style.background = "white";
    errorModal.style.border = "2px solid red";
    document.body.appendChild(errorModal);

    setTimeout(() => {
      document.body.removeChild(errorModal);
    }, 1000);
    return;
  }

  const formData = new FormData();
  formData.append("jeepName", jeepName);
  formData.append("jeepColor", jeepColor);
  formData.append("maxSeats", maxSeats);
  formData.append("file", file);

  fetch("add_jeep_ajax.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        closeModal("AddJeepModal");
        // Clear existing data before fetching and displaying updated data
        document.getElementById("dataSection").innerHTML = "";
        // Fetch and display updated data after successful addition
        fetchAndDisplayData();
      }
    })
    .catch((error) => console.error("Error:", error));
};

const fetchAndDisplayData = () => {
  fetch("fetch_info.php") // Adjust the actual PHP script name
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
        detailsButton.textContent = "Edit Details";
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
      detailsButton.textContent = "Edit Details";
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

const openModalWithDetails = (details) => {
  openModal("DetailsModal");

  document.getElementById("modalJeepId").value = details.id;
  document.getElementById("editJeepName").value = details.jeepney_name;
  document.getElementById("editJeepColor").value = details.jeepney_color;
  document.getElementById("editMaxSeats").value = details.jeepney_seats;

  document.getElementById("originalFilePath").value = details.file_route;
};

const saveChanges = () => {
  const jeepId = document.getElementById("modalJeepId").value;
  const jeepName = document.getElementById("editJeepName").value;
  const jeepColor = document.getElementById("editJeepColor").value;
  const maxSeats = document.getElementById("editMaxSeats").value;
  const maxSeatsNum = parseInt(maxSeats);

  const fileInput = document.getElementById("editFileUpload");
  const newFile = fileInput.files[0];
  const originalFilePath = document.getElementById("originalFilePath").value;

  const formData = new FormData();
  formData.append("jeepId", jeepId);
  formData.append("editJeepName", jeepName);
  formData.append("editJeepColor", jeepColor);
  formData.append("editMaxSeats", maxSeats);

  if (newFile) {
    formData.append("fileUpload", newFile);
  }
  formData.append("originalFilePath", originalFilePath);

  // Validation
  if (jeepName.trim() === "" || maxSeatsNum < 1 || !newFile) {
    // Display error in a modal
    const errorModal = document.createElement("div");
    errorModal.innerHTML = `<p style="color: #f4496b;">Invalid input. Please provide valid values.</p>`;
    errorModal.style.position = "fixed";
    errorModal.style.top = "50%";
    errorModal.style.left = "50%";
    errorModal.style.transform = "translate(-50%, -50%)";
    errorModal.style.padding = "20px";
    errorModal.style.background = "white";
    errorModal.style.border = "2px solid red";
    document.body.appendChild(errorModal);

    setTimeout(() => {
      document.body.removeChild(errorModal);
    }, 1000);
    return;
  }

  fetch("update_jeep_ajax.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        closeModal("DetailsModal");

        const updatedItem = document.querySelector(
          `[data-jeep-id="${jeepId}"]`
        );
        if (updatedItem) {
          const jeepNameSpan = updatedItem.querySelector(".jeep-name");
          if (jeepNameSpan) {
            jeepNameSpan.textContent = jeepName;
          }
        }
      }
    })
    .catch((error) => console.error("Error:", error));
};

const deleteJeep = () => {
  const jeepId = document.getElementById("modalJeepId").value;

  fetch("delete_jeep_ajax.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      jeepId,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        closeModal("DetailsModal");

        // Remove the deleted item from the displayed list
        const deletedItem = document.querySelector(
          `[data-jeep-id="${jeepId}"]`
        );
        if (deletedItem) {
          deletedItem.remove();
        }
      }
    })
    .catch((error) => console.error("Error:", error));
};
