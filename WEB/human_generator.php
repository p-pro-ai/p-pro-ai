<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Text Generator</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #000;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #8d21a3;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .output {
            height: 400px;
            background-color: #f7e39e;
            border-radius: 10px;
            padding: 10px;
            overflow-y: scroll;
            margin-bottom: 20px;
            word-wrap: break-word;
        }

        .input-container {
            display: flex;
            flex-direction: row;
            margin-bottom: 20px;
        }

        .input {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
            background-color: #eee;
            resize: none;
        }

        .button {
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #f7e39e;
            color: #000;
            font-size: 16px;
            margin-left: 10px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #a32121;
            color: #fff;
        }

        .comment-container {
            display: flex;
            flex-direction: row;
            margin-bottom: 20px;
        }

        .comment {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
            background-color: #eee;
            resize: none;
        }

        .comment-button {
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #f7e39e;
            color: #000;
            font-size: 16px;
            margin-left: 10px;
            cursor: pointer;
        }

        .comment-button:hover {
            background-color: #a32121;
            color: #fff;
        }
        /* Add these styles to your existing CSS */
.text-generator {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.generated-text {
  height: 400px;
  resize: none;
}

.input {
  height: 100px;
  resize: none;
}

.comment {
  display: flex;
  flex-direction: row;
  gap: 10px;
  margin-top: 20px;
}

.comment-input {
  flex: 1;
  padding: 10px;
  border-radius: 5px;
  border: none;
  font-size: 16px;
  background-color: #eee;
  resize: none;
}
.back-to-dashboard {
    display: inline-flex;
    align-items: center;
    background-color: #a32121;
    color: #ffffff;
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.arrow {
    margin-right: 8px;
}

.back-to-dashboard:hover {
    background-color:#a32121bf;
}
    </style>
</head>
<body>
<a href="dashboard.php" class="back-to-dashboard">
        <span class="arrow">&#8592;</span> Back to Dashboard
    </a>
<div class="container">
  <div class="text-generator">
    <textarea class="generated-text" id="generated-text" readonly></textarea>
    <textarea class="input" id="input-message" placeholder="Enter your task here"></textarea>
    <div style="display: flex; flex-direction: row;">
<label for="type_text" style="color: white; font-weight: 600;">Type (Essay, ...): </label>
    <input type="text" id="type_text" style="width: 200px; padding: 5px; ">
</div>
    <div style="display: flex; flex-direction: row;">
    <label for="word_count" style="color: white; font-weight: 600;">Word count: </label>
    <input type="text" id="word_count" style="width: 200px; padding: 5px; ">
</div>
<div style="display: flex; flex-direction: row;">
    <label for="language" style="color: white; font-weight: 600;">Language: </label>
    <input type="text" id="language" style="width: 200px; padding: 5px; ">
</div>

    <button class="button" onclick="sendMessage()">Generate Text</button>
  </div>
</div>

<script>
    async function sendMessage() {
  const inputMessage = document.querySelector("#input-message").value;
  const wordCount = document.querySelector("#word_count").value;
  const language = document.querySelector("#language").value;
  const type_text = document.querySelector("#type_text").value;
  const generatedText = document.querySelector("#generated-text");

  const requestData = new FormData();
  requestData.append("input", inputMessage);
  requestData.append("word_count", wordCount);
  requestData.append("language", language);
  requestData.append("type_cont", type_text);

  generatedText.value = "Loading...";

  try {
    const response = await fetch("human_generator_be.php", {
      method: "POST",
      body: requestData,
    });

    if (response.ok) {
      const jsonResponse = await response.json();
      generatedText.value = jsonResponse.message;
    } else {
      generatedText.value = "Error: Unable to generate text.";
    }
  } catch (error) {
    console.error("Error:", error);
    generatedText.value = "Error: Unable to generate text.";
  }
}

</script>

</body>
</html>
