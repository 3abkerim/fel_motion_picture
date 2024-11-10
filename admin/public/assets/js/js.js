document.addEventListener("DOMContentLoaded", () => {
  document.addEventListener("change", (event) => {
    const target = event.target;
    if (target.type === "checkbox" && target.getAttribute("role") === "switch" && target.dataset.type === "project") {
      const projectId = target.dataset.id;
      const publieValue = target.checked ? 1 : 0;

      fetch("../controller/project/traitement_projet_enLigne.php", {
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

    fetch("../controller/update_order.php", {
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

// ? IMAGES ORDRES

let draggedItem = null;
let draggedItemOrder = null;
let droppedItemOrder = null;

document.addEventListener("DOMContentLoaded", function () {
  const imageContainer = document.getElementById("imageContainer");
  const imageItems = document.querySelectorAll(".imageItem");

  imageItems.forEach((item) => {
    item.setAttribute("draggable", "true");

    item.addEventListener("dragstart", (e) => {
      draggedItem = item;
      e.dataTransfer.setData("text/plain", "");
    });

    item.addEventListener("dragover", (e) => {
      e.preventDefault();
    });

    item.addEventListener("drop", (e) => {
      e.preventDefault();
      if (draggedItem !== item) {
        // Swap the positions of the dragged item and the target item
        const draggedItemNextSibling = draggedItem.nextElementSibling;
        const targetItemNextSibling = item.nextElementSibling;

        if (draggedItemNextSibling === item) {
          // If the dragged item is right before the target item, insert the target item before the dragged item
          imageContainer.insertBefore(item, draggedItem);
        } else if (targetItemNextSibling === draggedItem) {
          // If the target item is right before the dragged item, insert the dragged item before the target item
          imageContainer.insertBefore(draggedItem, item);
        } else {
          // Otherwise, insert the dragged item before the target item and the target item before the original next sibling of the dragged item
          imageContainer.insertBefore(draggedItem, targetItemNextSibling);
          imageContainer.insertBefore(item, draggedItemNextSibling);
        }

        // Recalculate draggedItemOrder and droppedItemOrder after the order has changed
        draggedItemOrder = Array.from(imageItems).indexOf(draggedItem) + 1;
        droppedItemOrder = Array.from(imageItems).indexOf(item) + 1;

        updateImageOrder();
      }
    });
  });
});

function updateImageOrder() {
  const imageItems = document.querySelectorAll(".imageItem");
  let imageOrderData = [];

  imageItems.forEach((item, index) => {
    const imageId = item.dataset.image;
    const imageOrder = index + 1;
    item.querySelector(".number").textContent = imageOrder;
    imageOrderData.push({ id: imageId, order: imageOrder });
  });

  let swappedImages = imageOrderData.filter((item) => item.order === draggedItemOrder || item.order === droppedItemOrder);
  console.log("Image Order Data to be sent:", swappedImages);

  // AJAX call to update the order in the database
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../controller/homepage/homepageEditImageOrderController.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.send(JSON.stringify(swappedImages));

  xhr.onload = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log("Response from the server: \n" + xhr.responseText);
    }
  };
}

// ? FIN IMAGES ORDRES
