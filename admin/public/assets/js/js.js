document.addEventListener("DOMContentLoaded", () => {
  document.addEventListener("change", (event) => {
    const target = event.target;
    if (target.type === "checkbox" && target.getAttribute("role") === "switch" && target.dataset.type === "project") {
      const projectId = target.dataset.id;
      const publieValue = target.checked ? 1 : 0;

      fetch("../controlleur/traitement_projet_enLigne.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `id=${projectId}&publie=${publieValue}`,
      })
        .then((response) => response.text())
        .then((data) => {
          console.log(data);
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    }
  });
});

//ORDER TABLE

document.addEventListener("DOMContentLoaded", function () {
  function initializeDragAndDrop(table) {
    const tableBody = table.querySelector("tbody");
    let draggedRow = null;

    tableBody.querySelectorAll(".dragBtns").forEach((dragBtn) => {
      dragBtn.addEventListener("mousedown", function (e) {
        const row = e.target.closest("tr");
        row.setAttribute("draggable", "true");
        row.classList.add("dragging"); // Add dragging class to the row

        // Change cursor to dragging state
        dragBtn.classList.add("dragging");

        row.addEventListener(
          "dragstart",
          function (e) {
            draggedRow = row;
            e.dataTransfer.effectAllowed = "move";
            e.dataTransfer.setData("text/plain", "");
            console.log("Drag started:", draggedRow);
          },
          { once: true }
        );

        row.addEventListener(
          "dragend",
          function () {
            row.removeAttribute("draggable");
            row.classList.remove("dragging"); // Remove dragging class from the row
            // Remove dragging state cursor
            dragBtn.classList.remove("dragging");
          },
          { once: true }
        );

        row.addEventListener(
          "mouseleave",
          function () {
            row.removeAttribute("draggable");
            row.classList.remove("dragging"); // Remove dragging class from the row
            // Remove dragging state cursor
            dragBtn.classList.remove("dragging");
          },
          { once: true }
        );
      });
    });

    tableBody.addEventListener("dragover", function (e) {
      e.preventDefault();
      e.dataTransfer.dropEffect = "move";
      console.log("Drag over:", e.target.closest("tr"));
    });

    tableBody.addEventListener("drop", function (e) {
      e.preventDefault();
      const targetRow = e.target.closest("tr");
      console.log("Dropped on:", targetRow);

      if (draggedRow && targetRow && draggedRow !== targetRow) {
        const draggedRowIndex = Array.from(tableBody.rows).indexOf(draggedRow);
        const targetRowIndex = Array.from(tableBody.rows).indexOf(targetRow);
        console.log("Dragged row index:", draggedRowIndex, "Target row index:", targetRowIndex);

        if (draggedRowIndex < targetRowIndex) {
          tableBody.insertBefore(draggedRow, targetRow.nextSibling);
        } else {
          tableBody.insertBefore(draggedRow, targetRow);
        }

        updateTableOrder(table);
      }

      // Ensure the dragging class is removed after drop
      draggedRow.classList.remove("dragging");
    });
  }

  function updateTableOrder(table) {
    const tableName = table.getAttribute("data-table");
    const rows = table.querySelectorAll("tbody tr");
    const orderData = [];

    rows.forEach((row, index) => {
      const rowId = row.dataset.id;
      row.querySelector("td:nth-child(2)").textContent = index + 1;
      orderData.push({ id: rowId, order: index + 1 });
    });

    console.log("Updated order data:", orderData);

    fetch("../controlleur/update_order.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ table: tableName, data: orderData }),
    })
      .then((response) => response.text())
      .then((data) => console.log("Response from the server: \n" + data))
      .catch((error) => console.error("Error updating order:", error));
  }

  document.querySelectorAll(".draggable-table").forEach((table) => {
    initializeDragAndDrop(table);
  });
});
