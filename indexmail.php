<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1SecMail Web</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #bada55; /* Màu xanh nõn chuối */
            color: #333; /* Màu chữ */
            padding: 20px; /* Khoảng cách viền */
        }
        .container { 
            margin: 0 auto; 
            max-width: 800px; /* Chiều rộng tối đa */
            background-color: #fff; /* Màu nền của nội dung */
            padding: 20px; /* Khoảng cách viền nội dung */
            border-radius: 8px; /* Bo góc */
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Đổ bóng */
        }
        .mailbox, .messages, .message-detail { margin-bottom: 20px; }
        button { margin: 5px; }
        select, input { margin: 5px; padding: 5px; }
        .mailbox-creation { display: flex; align-items: center; }
        .mailbox-creation input, .mailbox-creation select, .mailbox-creation button { margin-right: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>1SecMail Web</h1>
        <div class="mailbox">
            <h2>Create Custom Mailbox</h2>
            <div class="mailbox-creation">
                <input type="text" id="custom-user" placeholder="Enter username">
                <select id="custom-domain-list"></select>
                <button onclick="createCustomMailbox()">Create Mailbox</button>
            </div>
            <ul id="custom-mailbox-list"></ul>
        </div>
        <div class="messages">
            <h2>Messages</h2>
            <ul id="message-list"></ul>
        </div>
        <div class="message-detail">
            <h2>Message Details</h2>
            <div id="message-detail"></div>
        </div>
    </div>

    <script>
        let selectedMailbox = '';

        document.addEventListener('DOMContentLoaded', (event) => {
            fetchDomains();
        });

        function fetchDomains() {
            fetch('domains.php')
                .then(response => response.json())
                .then(data => {
                    const customDomainList = document.getElementById('custom-domain-list');
                    customDomainList.innerHTML = '';
                    data.forEach(domain => {
                        const option = document.createElement('option');
                        option.value = domain;
                        option.textContent = domain;
                        customDomainList.appendChild(option);
                    });
                });
        }

        function createCustomMailbox() {
            const user = document.getElementById('custom-user').value;
            const domain = document.getElementById('custom-domain-list').value;
            const mailbox = `${user}@${domain}`;
            const customMailboxList = document.getElementById('custom-mailbox-list');
            
            customMailboxList.innerHTML = ''; // Clear the list of mailboxes
            const li = document.createElement('li');
            const button = document.createElement('button');
            button.textContent = mailbox;
            button.onclick = () => {
                selectedMailbox = mailbox;
                fetchMessages(mailbox);
            };
            li.appendChild(button);
            customMailboxList.appendChild(li);
        }

        function fetchMessages(mailbox) {
            const [login, domain] = mailbox.split('@');
            fetch(`messages.php?login=${login}&domain=${domain}`)
                .then(response => response.json())
                .then(data => {
                    const messageList = document.getElementById('message-list');
                    messageList.innerHTML = ''; // Clear the list of messages
                    const messageDetail = document.getElementById('message-detail');
                    messageDetail.innerHTML = ''; // Clear the message detail
                    if (data.length === 0) {
                        messageList.innerHTML = '<li>No messages found.</li>';
                    } else {
                        data.forEach(message => {
                            const li = document.createElement('li');
                            const button = document.createElement('button');
                            button.textContent = message.subject;
                            button.onclick = () => fetchMessageDetail(login, domain, message.id);
                            li.appendChild(button);
                            messageList.appendChild(li);
                        });
                    }
                });
        }

        function fetchMessageDetail(login, domain, id) {
            fetch(`readmessage.php?login=${login}&domain=${domain}&id=${id}`)
                .then(response => response.json())
                .then(data => {
                    const messageDetail = document.getElementById('message-detail');
                    messageDetail.innerHTML = `<h3>${data.subject}</h3><p>${data.textBody}</p>`;
                });
        }

        function autoRefreshMessages() {
            if (selectedMailbox) {
                fetchMessages(selectedMailbox);
            }
        }

        setInterval(autoRefreshMessages, 5000);
    </script>
</body>
</html>
