document.addEventListener("DOMContentLoaded", function () {
  // Function to refresh log content every 60 seconds
  function refreshLogContent() {
    const logContent = document.getElementById("log-content");
    const logFile = "/logs/user_activity.log";

    // Fetch new log entries from the server
    fetch("/backend/api/logs/get-log.php")
      .then((response) => response.text())
      .then((data) => {
        logContent.innerHTML = `<p>${data}</p>`;
      })
      .catch((error) => {
        console.error("Error fetching log data:", error);
      });
  }
  // Refresh log content every 60 seconds
  setInterval(refreshLogContent, 60000);

  // Initial log content fetch
  refreshLogContent();
});

const checkMessage = (id) => {
  let formData = new FormData();
  formData.append("id", id);

  fetch("/backend/api/support/check.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      // refresh page
      window.location.reload();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
};
