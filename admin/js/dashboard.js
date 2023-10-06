document.addEventListener("DOMContentLoaded", function () {
    // Array of widgets with data
  

    // Calculate and update "Allocated Time Per Page" for each widget
    widgets.forEach(widget => {
        const allocatedTimePerPage = widget.allocated_total_time / widget.published;
        widget.allocated_time_per_page = allocatedTimePerPage.toFixed(2) + 's'; // Format as seconds
    });

    // Render widgets
    const dashboardWidgets = document.querySelector(".dashboard-widgets");

    widgets.forEach(widget => {
        const widgetElement = document.createElement("div");
        widgetElement.classList.add("widget");

        widgetElement.innerHTML = `
            <h2 class="widget-title">${widget.title}</h2>
            <p class="widget-info">Total Pages: ${widget.total_pages}</p>
            <p class="widget-info">Published: ${widget.published}</p>
            <p class="widget-info">Allocated Total Time: ${widget.allocated_total_time}s</p>
            <p class="widget-info">Allocated Time Per Page: ${widget.allocated_time_per_page}</p>
            <div class="widget-buttons">
                <button class="preview-button">Preview</button>
                <button class="manage-button">Manage</button>
            </div>
        `;

        dashboardWidgets.appendChild(widgetElement);
    });
});
