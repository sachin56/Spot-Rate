<!DOCTYPE html>
<html>
<head>
    <title>Fedex</title>
</head>
<body>
    Dear {{$mailData['name']}},
    <p>Please find the following system generated password as you requested. If not please report this to IT Department.</p>
    <h5>Password={{ $mailData['password'] }}</h5>
    <p>Change the above password ones you access the system by navigating to the user profile.</p>
    <p>Thanks & Regards,<br>
        it@fedexlk.com</p>
    {{-- <img src="{{ $img }}"  width="80" height="70"> --}}
</body>
</html>