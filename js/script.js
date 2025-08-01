document.getElementById("urlForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const longUrl = document.getElementById("longUrl").value;
    if (longUrl === "") {
        alert("Please enter a URL.");
        return;
    }

    // Simulate URL shortening logic
    const shortUrl = "https://tinyurl.com/" + btoa(longUrl).slice(0, 8);
    document.getElementById("result").innerHTML = `<strong>Shortened URL:</strong> <a href="${shortUrl}" target="_blank">${shortUrl}</a>`;
});
