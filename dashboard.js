
// code for the AI summary
const API_KEY = "7c648f2f7e1a480fbe2eec002b78d550";
const records = [];
const keywords = ["login", "payment", "refund", "delivery", "crash", "error", "network", "charge", "delay"];

function buildSummaryPrompt(text) {
  return encodeURIComponent(`
        Summarize this customer support transcript in one line.
        Transcript:
        ${text}
      `.trim());
}

async function fetchSummaryAI(text) {
  try {
    const prompt = buildSummaryPrompt(text);
    const res = await fetch(`https://text.pollinations.ai/${prompt}`);
    let data = await res.text();
    if (data.startsWith("{")) { data = JSON.parse(data).error || "⚠️ Unexpected JSON"; }
    if (data === "403 Forbidden") data = "⚠️ AI unavailable.";
    return data.trim();
  } catch {
    return "⚠️ Error fetching summary.";
  }
}

async function handleTranscribe() {
  const fileInput = document.getElementById("audioFile");
  const status = document.getElementById("status");
  const transcriptBox = document.getElementById("transcript");
  const summaryBox = document.getElementById("summaryOutput");

  if (!fileInput.files.length) {
    alert("Select an audio file.");
    return;
  }

  const file = fileInput.files[0];
  try {
    status.textContent = "🔁 Uploading audio...";
    const upRes = await fetch("https://api.assemblyai.com/v2/upload", {
      method: "POST",
      headers: { authorization: API_KEY },
      body: file
    });
    const { upload_url } = await upRes.json();

    status.textContent = "🎤 Transcribing audio...";
    const trRes = await fetch("https://api.assemblyai.com/v2/transcript", {
      method: "POST",
      headers: { authorization: API_KEY, "content-type": "application/json" },
      body: JSON.stringify({ audio_url: upload_url })
    });
    const { id } = await trRes.json();

    let transcript = "";
    while (true) {
      const poll = await fetch(`https://api.assemblyai.com/v2/transcript/${id}`, {
        headers: { authorization: API_KEY }
      });
      const data = await poll.json();
      if (data.status === "completed") {
        transcript = data.text;
        break;
      }
      if (data.status === "error") throw new Error(data.error);
      await new Promise(r => setTimeout(r, 3000));
    }

    status.textContent = "✅ Transcription complete";
    transcriptBox.textContent = transcript;
    summaryBox.textContent = "⏳ Generating summary...";

    // Auto-generate summary
    const summary = await fetchSummaryAI(transcript);
    summaryBox.textContent = summary;

    // Save record
    records.push({
      fileName: file.name,
      transcript: transcript,
      summary: summary
    });

    renderHistory();
    renderOverallIssues();
  } catch (err) {
    console.error(err);
    status.textContent = "❌ " + err.message;
  }
}

function renderHistory() {
  const container = document.getElementById("history");
  if (!records.length) {
    container.innerHTML = "<p>No history yet.</p>";
    return;
  }
  let html = `<table>
        <tr><th>No.</th><th>File</th><th>Transcript</th><th>Summary</th></tr>`;
  records.forEach((r, i) => {
    html += `<tr>
          <td>${i + 1}</td>
          <td>${r.fileName}</td>
          <td><div class="box">${r.transcript.slice(0, 80)}…</div></td>
          <td><div class="box">${r.summary}</div></td>
        </tr>`;
  });
  html += `</table>`;
  container.innerHTML = html;
}

function renderOverallIssues() {
  const freq = {};
  records.forEach(r => {
    const text = r.transcript.toLowerCase();
    keywords.forEach(k => {
      if (text.includes(k)) freq[k] = (freq[k] || 0) + 1;
    });
  });
  const top = Object.entries(freq)
    .sort((a, b) => b[1] - a[1])
    .slice(0, 5)
    .map(([k, c]) => `${k.charAt(0).toUpperCase() + k.slice(1)} (${c})`);
  const div = document.getElementById("overallIssues");
  div.innerHTML = top.length
    ? `<ul>${top.map(i => `<li>${i}</li>`).join("")}</ul>`
    : "<p>No issues aggregated yet.</p>";
}

document.getElementById("transcribeBtn").addEventListener("click", handleTranscribe);