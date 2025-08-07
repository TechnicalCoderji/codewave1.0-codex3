<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CallSense Dashboard</title>
  <link rel="stylesheet" href="dashboard.css" />
  <link rel="icon" href="Images/callsense.png">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
  <div class="logo"><img src="Images/callsense-logo.png" alt="CallSense Logo"></div>
  <ul id="nav-links" >
    <li class="nav-links"><a href="#">Dashboard</a></li>
    <li class="nav-links"><a href="about.php">About Us</a></li>
    <li class="nav-links"><a href="logout.php">Logout</a></li>
  </ul>
  <img src="Images/hamburger.png" alt="Hamburger" id="hamburger" class="hamburger-img">
</nav>

<!-- DASHBOARD -->
<main class="dashboard">
  

  <div class="container">
    <h1>🎙️ CallSense: Audio to Text & Auto-Summary</h1>

    <input type="file" id="audioFile" accept="audio/*" />
    <button id="transcribeBtn">Transcribe & Summarize</button>
    <p id="status"></p>

    <h2>📝 Call Data</h2>
    <div id="transcript" class="box">Waiting for audio...</div>

    <h2>📌 Summary</h2>
    <div id="summaryOutput" class="box">No summary yet.</div>

    <h2>📈 Overall Top Issues</h2>
    <div id="overallIssues" class="box">No issues aggregated yet.</div>
    
    <h2>📚 History</h2>
    <div id="history">
      <div id="overallIssues" class="box">No history yet!</div>
    </div>
    
  </div>

</main>

<!-- FOOTER -->
<footer class="footer">
  <p>© 2025 CallSense. All rights reserved.</p>
</footer>

<script src="dashboard.js"></script>
<script src="standard.js"></script>

</body>
</html>

