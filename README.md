# CallSense – codewave1.0-codex3

**AI-Powered Call Transcript & Summarization Tool**

---

## 🚀 Problem Statement

Support teams receive hundreds of customer-care calls daily. Manually reviewing recordings to spot common issues is time-consuming and error-prone. **CallSense** automates this process by transcribing audio calls and generating concise summaries, helping teams quickly identify recurring problems.

---

## ⚙️ How It Works

1. **Upload Audio**  
   – Supported formats: MP3, WAV, M4A, OGG, FLAC, WEBM, etc.

2. **Transcription (AssemblyAI API)**  
   – Audio is uploaded directly from the browser to AssemblyAI.  
   – AssemblyAI returns a full text transcript.

3. **Auto-Summary (Pollinations AI)**  
   – The transcript is passed to Pollinations.ai via a single HTTP call.  
   – Pollinations returns a one-line summary of the call.

4. **History & Insights**  
   – Each transcript + summary is stored in MySQL via a PHP API.  
   – On page load and after each run, the app fetches all records, displays a history table, and aggregates unique “Top Issues” across all calls (e.g. “Login Issue”, “Payment Issue”).

---

## 🛠️ Tech Stack

- **Frontend**: HTML5, CSS3, Vanilla JavaScript (Fetch API)  
- **Speech-to-Text**: [AssemblyAI](https://www.assemblyai.com/)  
- **AI Summarization**: [Pollinations.ai](https://text.pollinations.ai/) (no API key required)  
- **Backend**: PHP 8+, MySQL (via XAMPP)  
- **Storage**: MySQL table `records`  
  - Fields: `id`, `file_name`, `transcript`, `summary`, `created_at`

---

## ⚙️ Setup & Run Locally

### 1. Clone the Repository

```bash
git clone https://github.com/your-org/codewave1.0-codex3.git
cd codewave1.0-codex3
```

### 2. Configure XAMPP

- Copy the project folder into `C:\xampp\htdocs\` (or your Apache root directory)
- Start **Apache** & **MySQL** via XAMPP Control Panel

### 3. Get AssemblyAI API Key

- Sign up at [AssemblyAI](https://www.assemblyai.com/)
- Copy your API key

### 4. Configure Frontend

- Open `index.html`
- Replace `YOUR_ASSEMBLY_API_KEY` with your actual API key

### 5. Launch the App

- Open in browser:

```
http://localhost/codewave1.0-codex3/index.html
```

---

## 👥 Team Members

- **Chudasama Bhargav Jitubhai** – Backend & Database (PHP, MySQL)  
- **Chauhan Hardik Rajnikantbhai** – UI/UX & Styling (HTML, CSS)  
- **Parmar Dip Rajeshbhai** – JavaScript Logic & API Integration

---

## 📌 Notes

- Pollinations.ai does not require an API key.
- Ensure your browser supports audio file uploads and Fetch API.
- For production, consider securing API keys and sanitizing inputs.

---

## 📄 License

This project is licensed under the MIT License. See `LICENSE` for details.
```

Let me know if you'd like a badge section, deployment instructions, or a demo GIF added.
