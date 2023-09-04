
<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    var pusher = new Pusher('9aa8ddebf0fda08d390f', {
      cluster: 'us2'
    });
    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
      console.log(JSON.stringify(data));
    });
  </script>
</head>
<body>
  <h1>Recibir sokets </h1>

</body>