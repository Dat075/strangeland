<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Image</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div id="image-container">
        <img id="random-image" src="" alt="Random Image">
    </div>

    <script>
    // Function to fetch a random image
    async function fetchRandomImage() {
        try {
            const response = await fetch('https://picsum.photos/1200/800'); // Using Lorem Picsum for random images
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const imageURL = response.url;
            document.getElementById('random-image').src = imageURL;
        } catch (error) {
            console.error('Error fetching random image:', error);
        }
    }

    // Call the function to fetch the random image when the page loads
    window.onload = fetchRandomImage();

    </script>
</body>
</html>
