<!DOCTYPE html>
<html>
<head>
    <title>I'm Very Sorry</title>
    <style>
        body {
            font-family: 'Press Start 2P', cursive;
            background-color: #262626;
            color: #fff;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            font-size: 36px;
            margin-top: 50px;
        }
        .button {
            background-color: #ff5733;
            color: #fff;
            border: 2px solid #ff5733;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s, font-size 0.3s; /* Add font-size transition */
            margin: 20px;
            outline: none;
        }
        .button:hover {
            background-color: #ff8c66;
        }
        .button:focus {
            outline: none;
        }
        .button:active {
            background-color: #d9521a;
        }
        .image {
            display: none;
            max-width: 300px;
            margin: 20px auto;
        }
        #message {
            display: none;
            font-size: 24px;
            margin-top: 50px;
        }
    </style>
    <script>
        function changeButtonText() {
            var yesButton = document.getElementById('yesButton');
            var noButton = document.getElementById('noButton');
            var primogemsImage = document.getElementById('primogemsImage');
            var mlDiamondImage = document.getElementById('mlDiamondImage');
            var message = document.getElementById('message');

            if (yesButton.innerText === 'Yes') {
                yesButton.innerText = 'Please?';
            } else if (yesButton.innerText === 'Please?') {
                yesButton.innerText = 'Pleaseee?';
            } else if (yesButton.innerText === 'Pleaseee?') {
                yesButton.innerText = 'Come on pleaseee?';
            } else if (yesButton.innerText === 'Come on pleaseee?') {
                yesButton.innerText = 'What if I give primogems?';
                primogemsImage.style.display = 'block';
            } else if (yesButton.innerText === 'What if I give primogems?') {
                yesButton.innerText = 'no good?';
                primogemsImage.style.display = 'none';
            } else if (yesButton.innerText === 'no good?') {
                yesButton.innerText = 'What if I give mobile legends diamond';
                mlDiamondImage.style.display = 'block';
            } else if (yesButton.innerText === 'What if I give mobile legends diamond') {
                mlDiamondImage.style.display = 'none';
                yesButton.innerText = 'awh';
            } else if (yesButton.innerText === 'awh') {
                yesButton.style.display = 'none';
                noButton.style.display = 'none';
                message.innerText = 'Okay, that\'s okay. I promise to be better! Thank you for being so patient with me...';
                message.style.display = 'block';
                document.getElementById('apologyText').style.display = 'none'; 
            }

            yesButton.style.fontSize = (parseInt(yesButton.style.fontSize) || 16) + 2 + 'px';
        }

    
        function handleYesButtonClick() {
            var yesButton = document.getElementById('yesButton');
            var message = document.getElementById('message');
            var happySorinImage = document.getElementById('happySorinImage');

            yesButton.style.display = 'none';
			message.style.display = 'block';
                document.getElementById('apologyText').style.display = 'none'; 
			noButton.style.display = 'none';
            message.innerText = 'Yay! Happy Sorin thank you so much :(';
            message.style.display = 'block';
            happySorinImage.style.display = 'block';
            document.getElementById('apologyText').style.display = 'none';
        }
    </script>
</head>
<body>
    <h1 id="apologyText">I'm sorry</h1>
    <button id="yesButton" class="button" onclick="handleYesButtonClick()">Yes</button>
    <button id="noButton" class="button" onclick="changeButtonText()">No</button>
    <img id="primogemsImage" class="image" src="https://beebom.com/wp-content/uploads/2024/01/genshin-impact-4.4-primogem-count.jpg" alt="Primogems"> 
    <img id="mlDiamondImage" class="image" src="https://berita.99.co/wp-content/uploads/2023/04/harga-diamond-ml-cover.jpg" alt="Mobile Legends Diamond"> 
    <img id="happySorinImage" class="image" src="happysorin.png" alt="Happy Sorin" style="display: none;"> 
    <p id="message">Okay, that's okay. I promise to be better! Thank you for being so patient with me...</p>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</body>
</html>
