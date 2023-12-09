const openModal = (modalID) => {
  document.getElementById(modalID).style.display = "flex";
};

const closeModal = (modalID) => {
  document.getElementById(modalID).style.display = "none";
};

const addJeep = () => {
  const jeepName = document.getElementById("jeepName").value;
  const counter = document.getElementById("counter").value;
  const terminal = document.getElementById("terminal").value;

  // Validation
  if (isNaN(counter) || counter < 0) {
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

  // Send the data to the server using AJAX
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "add_jeep.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      console.log(xhr.responseText);
      closeModal("AddJeepModal");
      fetchAndDisplayData(terminal);
    } else {
      // const errorModal = document.createElement("div");
      // errorModal.innerHTML = `<p style="color: #f4496b;">Error adding jeep: ${xhr.responseText}</p>`;
      // errorModal.style.position = "fixed";
      // errorModal.style.top = "50%";
      // errorModal.style.left = "50%";
      // errorModal.style.transform = "translate(-50%, -50%)";
      // errorModal.style.padding = "20px";
      // errorModal.style.background = "white";
      // errorModal.style.border = "2px solid red";
      // document.body.appendChild(errorModal);
      // setTimeout(() => {
      //   document.body.removeChild(errorModal);
      // }, 3000);
    }
  };
  xhr.send(
    `jeepName=${encodeURIComponent(jeepName)}&counter=${encodeURIComponent(
      counter
    )}&terminal=${encodeURIComponent(terminal)}`
  );
};

// Function to fetch and display data based on terminal
const fetchAndDisplayData = (terminal) => {
  const sectionID = `${terminal}-section`;
  const section = document.getElementById(sectionID);

  const dataUrl = `fetch_data.php?terminal=${encodeURIComponent(terminal)}`;
  fetch(dataUrl)
    .then((response) => response.text())
    .then((data) => {
      section.innerHTML = data;
    })
    .catch((error) => {
      console.error(`Error fetching data: ${error}`);
    });
};

const updateCounter = (jeepId, operation) => {
  // Send the data to the server using AJAX

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "update_counter.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      fetchAndDisplayData("MBLCT");
      fetchAndDisplayData("MARQUEE");
    }
  };
  xhr.send(`jeepId=${encodeURIComponent(jeepId)}&operation=${operation}`);
};

document.addEventListener("click", (event) => {
  const target = event.target;

  if (target.classList.contains("increment-button")) {
    const jeepId = target.closest(".jeep-item").dataset.jeepId;
    updateCounter(jeepId, 1);
  } else if (target.classList.contains("decrement-button")) {
    const jeepId = target.closest(".jeep-item").dataset.jeepId;
    updateCounter(jeepId, -1);
  }
});

fetchAndDisplayData("MBLCT");
fetchAndDisplayData("MARQUEE");

const openEditModal = (jeepId, currentName) => {
  // Populate the current name in the model
  document.getElementById(
    "currentJeepName"
  ).innerHTML = `Current Name: ${currentName}`;

  // Set the jeepId as a data attribute to use later
  document.getElementById("EditJeepModal").dataset.jeepId = jeepId;

  // Open the modal
  openModal("EditJeepModal");
};

const saveChanges = () => {
  const jeepId = document.getElementById("EditJeepModal").dataset.jeepId;
  const editJeepName = document.getElementById("editJeepName").value;

  // Validation (perform any necessary client-side validation)
  // if (newJeepName.trim() === "") {
  //   // Display error in a modal
  //   const errorModal = document.createElement("div");
  //   errorModal.innerHTML = `<p style="color: #f4496b;">Invalid input. Please provide valid values.</p>`;
  //   errorModal.style.position = "fixed";
  //   errorModal.style.top = "50%";
  //   errorModal.style.left = "50%";
  //   errorModal.style.transform = "translate(-50%, -50%)";
  //   errorModal.style.padding = "20px";
  //   errorModal.style.background = "white";
  //   errorModal.style.border = "2px solid red";
  //   document.body.appendChild(errorModal);

  //   setTimeout(() => {
  //     document.body.removeChild(errorModal);
  //   }, 1000);
  //   return;
  // }

  // Send the data to the server using AJAX for saving changes
  // fetch("save_changes.php", {
  //   method: "POST",
  //   headers: {
  //     "Content-Type": "application/x-www-form-urlencoded",
  //   },
  //   body: `jeepId=${encodeURIComponent(
  //     jeepId
  //   )}&editJeepName=${encodeURIComponent(editJeepName)}`,
  // })
  //   .then((response) => {
  //     if (!response.ok) {
  //       throw new Error(`HTTP Error! Status: ${response.status}`);
  //     }
  //     return response.text();
  //   })
  //   .then((data) => {
  //     console.log(data); // Log the server response
  //     closeModal("EditJeepModal");
  //     fetchAndDisplayData("MBLCT");
  //     fetchAndDisplayData("MARQUEE");
  //   })
  //   .catch((error) => {
  //     // Display error in a modal
  //     console.error(error.message);
  //   });
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "save_changes.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      console.log(xhr.responseText); // Log the server response
      closeModal("EditJeepModal");
      fetchAndDisplayData("MBLCT");
      fetchAndDisplayData("MARQUEE");
    }
  };
  xhr.send(
    `jeepId=${encodeURIComponent(jeepId)}&editJeepName=${encodeURIComponent(
      editJeepName
    )}`
  );
};

const deleteJeep = () => {
  const jeepId = document.getElementById("EditJeepModal").dataset.jeepId;

  // Send the data to the server using AJAX for deleting the record
  fetch("delete_jeep.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `jeepId=${encodeURIComponent(jeepId)}`,
  })
    .then((response) => response.text())
    .then((data) => {
      console.log(data); // Log the server response
      closeModal("EditJeepModal");
      fetchAndDisplayData("MBLCT");
      fetchAndDisplayData("MARQUEE");
    })
    .catch((error) => {
      console.error(`Error deleting jeep: ${error}`);
    });
};
